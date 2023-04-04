<?php

namespace App\Http\Controllers;

use App\Models\CustomRequest;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\CustomRequestHistory;
use App\Models\Projects;
use Illuminate\Support\Facades\Hash;


use App\Models\Log\LogSistema;

class CustomRequestController extends Controller
{

    public function __construct()
    {        
        $this->middleware('permission:Ver Solicitudes Personalizadas')->only('indexpanel');
        $this->middleware('permission:Editar Solicitudes Personalizadas')->only('update');
        $this->middleware('permission:Editar Solicitudes Personalizadas')->only('edit');
        $this->middleware('permission:Eliminar Solicitudes Personalizadas')->only('destroy');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::with('subcategories')->get();
        return view('site.customrequest.create', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexpanel()
    {
        $log = new LogSistema();
        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha ingresado a ver las solicitudes personalizadas: '.date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();    

        $customrequest = CustomRequest::with('category')->get(); 
        $cespera = CustomRequest::where('state',0)->with('category')->get(); 
        $cejecucion = CustomRequest::where('state',1)->with('category')->get(); 
        $ccancelados = CustomRequest::where('state',2)->with('category')->get(); 
        $cfinalizadas = CustomRequest::where('state',9)->with('category')->get(); 
        return view('admin.customrequest.index', compact('customrequest','cespera','cejecucion','ccancelados','cfinalizadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName=null;
        if($request->image){    
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/custom_request'), $imageName);
         
        }
        if(auth()->user()){
            $user_id=auth()->user()->id;
        }else{
            $user=User::create([
                'name' => $request->name_user,
                'email' => $request->email_user,
                'username' => $request->email_user,
                'genero' => null,
                'name_business' => $request->name_business,
                'status'=>1,
                'phone'=> $request->phone,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole(2);
            $user_id=$user->id;

        }
        $customrequest = CustomRequest::create([
            'email'=>$request->email,
            'cellphone'=>$request->cellphone,
            'name'=>$request->name,
            'name_business'=>$request->name_business,
            'quantity'=>$request->quantity,
            'date_delivery'=>$request->date_delivery,
            'budget_unit'=>$request->budget_unit,
            'delivery_method'=>$request->delivery_method,
            'category_id'=>$request->category_id,
            'observations'=>$request->observations,
            'file'=>$imageName,
            'state'=>0,
            'user_request_id'=>$user_id                              
        ]);
        
        return json_encode(['success' => true, 'id' => $customrequest->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomRequest  $CustomRequest
     * @return \Illuminate\Http\Response
     */
    public function show(CustomRequest $CustomRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomRequest  $CustomRequest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customrequest = CustomRequest::with('category','history')->find(\Hashids::decode($id)[0]);
        $log = new LogSistema();
        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha ingresado a editar los datos de la solicitud personalizada: '.$customrequest->id.' a las: '
        . date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();
        $categories = Categories::with('subcategories')->get();
        return view('admin.customrequest.edit', ['customrequest' => $customrequest,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomRequest  $CustomRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $CustomRequest = CustomRequest::find($request->customrequest_id);
        $CustomRequest->state = $request->state; 
        $CustomRequest->price_finish = $request->price_finish;  
        $CustomRequest->shipping_from = $request->shipping_from;  
        $CustomRequest->product = $request->product;      
        $CustomRequest->date_delivery_ok = $request->date_delivery_ok;  
        $CustomRequest->price_shiping = $request->price_shiping;  
       
        if ($request->file('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/custom_request/images'), $imageName);

            /**$image_path = public_path().'/images/categories/'.$category->file;
            if (@getimagesize($image_path)) {
                unlink($image_path);
            }*/
            $CustomRequest->image = $imageName;

        }

       
        $CustomRequest->save();

        if($CustomRequest->state!=$request->state){
            CustomRequestHistory::create([
                'custom_request_id'=>$CustomRequest->id,
                'state'=>$request->state,                
            ]);  
        }
        if($request->state==1){
            $project=Projects::where('type',2)->where('id_type',$CustomRequest->id)->first();
            
            if($project==null){
                Projects::create([
                    'type'=>2,
                    'id_type'=>$CustomRequest->id,
                    'name'=>$request->product,
                    'ubication'=>$request->shipping_from,
                    'price_delivery'=>$request->price_shiping,
                    'price'=>$request->price_finish,
                    'quantity'=>$CustomRequest->quantity,
                    'delivery_date'=>$request->date_delivery_ok,
                    'state'=>1, 
                    'user_request_id'=>$CustomRequest->user_request_id            
                ]); 
            }
        }

        return json_encode(['success' => true, 'campuse_id' => $CustomRequest->encode_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomRequest  $CustomRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        CustomRequest::find(\Hashids::decode($id)[0])->delete();

        return json_encode(['success' => true]);
    }
}
