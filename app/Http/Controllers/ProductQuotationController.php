<?php

namespace App\Http\Controllers;

use App\Models\ProductQuotation;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\User;
use App\Models\Projects;
use App\Models\ProductQuotationHistory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Models\Log\LogSistema;
use Mail;

use Barryvdh\DomPDF\Facade as PDF;
set_time_limit(300);

class ProductQuotationController extends Controller
{

    public function __construct()
    {        
        $this->middleware('permission:Ver Cotizaciones')->only('index');
        $this->middleware('permission:Editar Cotizaciones')->only('update');
        $this->middleware('permission:Editar Cotizaciones')->only('edit');
        $this->middleware('permission:Eliminar Cotizaciones')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //@if(Auth::user()->hasrole('Usuario'))
        $log = new LogSistema();
        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha ingresado a ver las cotizaciones: '
        . date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();
        if(auth()->user()->hasrole('Comercio')){            
            $quotations = ProductQuotation::where('user_id',auth()->user()->id)->with('producto')->get();
            $qespera = ProductQuotation::where('user_id',auth()->user()->id)->where('state',0)->with('producto')->get();
            $qcanceladas = ProductQuotation::where('user_id',auth()->user()->id)->where('state',2)->with('producto')->get();
            $qaprobadas = ProductQuotation::where('user_id',auth()->user()->id)->where('state',1)->with('producto')->get();
        }else{            
            $quotations = ProductQuotation::with('producto')->get();
            $qespera = ProductQuotation::where('state', 0)->with('producto')->get();
            $qcanceladas = ProductQuotation::where('state', 2)->with('producto')->get();
            $qaprobadas = ProductQuotation::where('state', 1)->with('producto')->get();
        }

        return view ('admin.quotations.index', compact('quotations','qespera','qcanceladas','qaprobadas'));
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

    public function templateQuotationUser($data=''){
        if($data===''){
                $data=[
                'product_id' => 9,
                'email' => 'yepagu@gmail.com',
                'name' => 'Yeisson Patarroyo Guapacho',
                'cellphone' => '301 531 4546',
                'quantity' => 12,
                'address' => 'Rovira',
                'date_delivery' => '02-12-2022',
                'observations' => 'Que me lo entrguen yaaaa',
                'user_id' => 2,
                'fecha' => '8 de dic, 2022'              
            ];
            $producto=Products::where('id',9)->first();
            $vendedor = User::where('id',$producto->user_id)->first();
            //$producto = Products::with('productcategories','productcategories.category','gallery','user')->where('id',filter_var(9, FILTER_VALIDATE_INT))->first();
        }
        //$data = array('data'=>$request, 'producto'=>$product);        
        return view ('site.quotation.templatequotationuser', compact('data', 'producto', 'vendedor'));
    }

    public function templateQuotationVendor($data=''){
        if($data===''){
                $data=[
                'product_id' => 9,
                'email' => 'yepagu@gmail.com',
                'name' => 'Yeisson Patarroyo Guapacho',
                'cellphone' => '301 531 4546',
                'quantity' => 12,
                'address' => 'Rovira',
                'date_delivery' => '02-12-2022',
                'observations' => 'Que me lo entrguen yaaaa',
                'user_id' => 2,
                'fecha' => '8 de dic, 2022'              
            ];
            $producto=Products::where('id',9)->first();
            $vendedor = User::where('id',$producto->user_id)->first();
            //$producto = Products::with('productcategories','productcategories.category','gallery','user')->where('id',filter_var(9, FILTER_VALIDATE_INT))->first();
        }
        //$data = array('data'=>$request, 'producto'=>$product);        
        return view ('site.quotation.templatequotationuser', compact('data', 'producto', 'vendedor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $producto=Products::where('id',$request->product_id)->first();
        $product=Products::with('user')->where('id',$request->product_id)->first();
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
        $cotizacion = ProductQuotation::create([
            'product_id'=>$request->product_id,
            'email'=>$request->email,
            'name'=>$request->name,
            'cellphone'=>$request->cellphone,
            'quantity'=>$request->quantity,
            'address'=>$request->address,
            'date_delivery'=>$request->date_delivery,
            'observations'=>$request->observations,
            'user_id'=>$product->user->id,  
            'user_request_id'=>$user_id    
        ]);  
        ProductQuotationHistory::create([
            'quotation_id'=>$cotizacion->id,
            'state'=>0,                
        ]); 

        $user = User::where('id',$producto->user_id)->first();

        setlocale(LC_ALL,"es_ES");
        setlocale(LC_TIME, "spanish");
        $newDate = date("d-m-Y", strtotime($request->date_delivery));  
        $fecha = strftime("%d %b, %Y", strtotime($newDate));
        $request['fecha']=$fecha;
        $request['idsolicitud']=$cotizacion->id;
        $data = array('data'=>$request, 'producto'=>$producto, 'vendedor'=> $user);

        Mail::send('site.quotation.templatequotationuser', $data, function($message) use ($request){
             $message->to($request->email, $request->name);
             $message->subject('Solicitud Kanbai No. '.$request->idsolicitud);
             $message->from('solicitud@kanbai.co','Kanbai');
        });

        Mail::send('site.quotation.templatequotationvendor', $data, function($message) use ($request, $user){
             $message->to($user->email, $user->name);
             $message->subject('Solicitud Kanbai No. '.$request->idsolicitud);
             $message->from('solicitud@kanbai.co','Kanbai');
        });

        return json_encode(['success' => true, 'id' => $cotizacion->id]);
        //return json_encode(['success' => true, 'id' => $cotizacion->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductQuotation  $productQuotation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quotation = ProductQuotation::with('producto','producto.gallery','history')->find(\Hashids::decode($id)[0]);
        dd($quotation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductQuotation  $productQuotation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quotation = ProductQuotation::with('producto','producto.gallery','history','user')->find(\Hashids::decode($id)[0]);

        $log = new LogSistema();
        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha ingresado a editar los datos de la cotizacion: '.$quotation->id.' a las: '
        . date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();

        
        //$logo='https://kanbai.co/images/logo/logo-kanbai-color.png'; 
        $logo=null;
        
        return view('admin.quotations.edit', ['quotation' => $quotation,'logo'=>$logo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductQuotation  $productQuotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd('ddd');
        $productquotation = ProductQuotation::with('producto','producto.gallery','history','user')->find(\Hashids::decode($id)[0]);
        $productquotation->state = $request->state; 
        if($request->price_finish){
            $productquotation->price_finish = $request->price_finish; 
        }    
        if($request->price_shiping){
            $productquotation->price_shiping = $request->price_shiping; 
        } 
        if($request->iva){
            $productquotation->iva = $request->iva; 
        } 
        
        if($request->comment){
            $productquotation->comment = $request->comment; 
        } 
        if($request->deny){
            $productquotation->deny = $request->deny; 
        } 
        
        $productquotation->save();

        if($request->state==1){
            $logo='https://kanbai.co/images/logo/logo-kanbai-color.png';            
            $name_pdf = time().'_'. $productquotation->id.'.pdf';
            $quotation = ProductQuotation::with('producto','producto.gallery','history','user')->find(\Hashids::decode($id)[0]);
       
        $pdf = PDF::loadView('admin.quotations.pdf',compact('logo','quotation'))
        ->setPaper('A4', 'portrait')->save(public_path('cotizaciones/'.$name_pdf));
        $quotation->file=$name_pdf;
        $quotation->save();
        
        $quotationsend = ProductQuotation::with('producto','producto.gallery','history','user')->find(\Hashids::decode($id)[0]);
        if($quotationsend->user!=null){
            $name=$quotation->user->name.' '.$quotation->user->lastname;
            $data = array('name'=>$name);
            $pdfsend = PDF::loadView('admin.quotations.pdf',compact('logo','quotation'))->setPaper('A4', 'portrait');
            Mail::send('admin.quotations.templateemail', $data, function($message) use ($quotationsend,$pdfsend){
                $message->to($quotationsend->email, $quotationsend->name);
                $message->subject('Solicitud Kanbai No. '.$quotationsend->id);
                $message->attachData($pdfsend->output(), "cotizacion.pdf");
                $message->from('solicitud@kanbai.co','Kanbai');
           });
        }
        

        }

        
        if($productquotation->state!=$request->state){
            ProductQuotationHistory::create([
                'quotation_id'=>$productquotation->id,
                'state'=>$request->state,                
            ]);  
        }
        if($request->state==3){
            $project=Projects::where('type',1)->where('id_type',$productquotation->id)->first();
            
            if($project==null){
                Projects::create([
                    'type'=>1,
                    'id_type'=>$productquotation->id,
                    'name'=>$productquotation->producto->name,
                    'ubication'=>null,
                    'price_delivery'=>$productquotation->price_shiping,
                    'price'=>$productquotation->price_finish,
                    'quantity'=>$productquotation->quantity,
                    'delivery_date'=>null,
                    'iva'=>$productquotation->quantity,
                    'state'=>1, 
                    'user_request_id'=>$productquotation->user_request_id            
                ]); 
            }
        }

        


        return json_encode(['success' => true, 'campuse_id' => $productquotation->encode_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductQuotation  $productQuotation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = ProductQuotation::find(\Hashids::decode($id)[0])->delete();

        return json_encode(['success' => true]);
    }
}
