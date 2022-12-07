<?php

namespace App\Http\Controllers;

use App\Models\ProductQuotation;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

use App\Models\Log\LogSistema;
use Mail;

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
        }else{            
            $quotations = ProductQuotation::with('producto')->get();
        }

        return view ('admin.quotations.index', compact('quotations'));
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

        return json_encode(['success' => true, 'id' => 1]);
        //return json_encode(['success' => true, 'id' => $cotizacion->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductQuotation  $productQuotation
     * @return \Illuminate\Http\Response
     */
    public function show(ProductQuotation $productQuotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductQuotation  $productQuotation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quotation = ProductQuotation::with('producto')->find(\Hashids::decode($id)[0]);

        $log = new LogSistema();
        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha ingresado a editar los datos de la cotizacion: '.$quotation->id.' a las: '
        . date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();
       
        return view('admin.quotations.edit', ['quotation' => $quotation]);
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
        $productquotation = ProductQuotation::find(\Hashids::decode($id)[0]);
        $productquotation->state = $request->state;     
        $productquotation->save();

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
