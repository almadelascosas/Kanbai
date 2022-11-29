<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Log\LogSistema;
use App\Models\Categories;
use App\Models\ProductsGallery;
use App\Models\ProductsCategories;
use App\Models\ProductsSubcategories;
use App\Models\SubCategories;
use App\Models\User;
use App\Models\ProductsQuestions;

use Image;

class ProductsController extends Controller
{

    public function __construct()
    {        
        $this->middleware('permission:Ver Productos')->only('index');
        $this->middleware('permission:Crear Productos')->only('create');
        $this->middleware('permission:Crear Productos')->only('store');
        $this->middleware('permission:Editar Productos')->only('update');
        $this->middleware('permission:Editar Productos')->only('edit');
        $this->middleware('permission:Eliminar Productos')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $log = new LogSistema();
        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha ingresado a ver los productos: '
        . date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();
        if(auth()->user()->hasrole('Comercio')){            
            $products = Products::where('user_id',auth()->user()->id)->with('productcategories','productcategories.category')->with('productsubcategories','productsubcategories.subcategory')->with('gallery')->get();
        }else{            
            $products = Products::with('productcategories','productcategories.category')->with('productsubcategories','productsubcategories.subcategory')->with('gallery')->get();
        }
       
        
        return view ('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::with('subcategories')->get();
        $relacionEloquent = 'roles';
        $comercios = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Comercio');
        })->get();
        return view ('admin.products.create', compact('categories','comercios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        if($request->shipping_price && $request->shipping_price!=0){
            $shipping_free=false;
        }else{
            $shipping_free=true;
        }
        
        $product = Products::create([
                'name'=>$request->name,
                'price_min'=>$request->price_min,
                'price_max'=>$request->price_max,
                'quantity_min'=>$request->quantity_min,
                'delivery_time'=>$request->delivery_time,
                'shipping_price'=>$request->shipping_price,
                'description'=>$request->description,
                'shipping_free'=>$shipping_free,
                'user_id'=>$request->user_id                          
        ]);
        if($request->file('image')){    
            
            foreach($request->file('image') as $image){
                $imagen = Image::make($image);
                $imageName = time().'_'.$image->getClientOriginalName().'.'.$image->extension();

                $destinationPath = public_path('/thumbnail');
                $imagen->save(public_path('images/products/' . $imageName));
                $imagen->resize(320, 320, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/products/thumbnail/list/' . $imageName));
                $imagen->resize(640, 640, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/products/thumbnail/' . $imageName));
                
                $productgallery = ProductsGallery::create([
                    'file'=>$imageName,
                    'product_id'=>$product->id                                 
                ]);       

            }
        }
        if(isset($request->category_id)){
        foreach($request->category_id as $category){
           ProductsCategories::create([
                'category_id'=>$category,
                'product_id'=>$product->id                             
            ]);
        }
    }
        if(isset($request->subcategory_id)){
        foreach($request->subcategory_id as $subcategory){
            ProductsSubcategories::create([
                 'subcategory_id'=>$subcategory,
                 'product_id'=>$product->id                             
             ]);
         }
        }
         ProductsQuestions::where('product_id',$product->id )->delete();
         if(isset($request->question)){
             foreach($request->question as $key=>$item){
                 ProductsQuestions::create([
                     'question'=>$item,
                     'answer'=>$request->answer[$key],
                     'product_id'=>$product->id                             
                 ]);
             }
         }
        

        $log = new LogSistema();

        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha guardado un nuevo cachorro en el sistema: '.$request->title.' a las: '
        . date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();

        return json_encode(['success' => true, 'id' => $product->encode_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dogs  $dogs
     * @return \Illuminate\Http\Response
     */
    public function show(Dogs $dogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dogs  $dogs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::with('productcategories','productcategories.category')
        ->with('productsubcategories','productsubcategories.subcategory')
        ->with('gallery','questions')->find(\Hashids::decode($id)[0]);

        $log = new LogSistema();
        $log->user_id = auth()->user()->id;
        $log->tx_descripcion = 'El usuario: '.auth()->user()->display_name.' Ha ingresado a editar los datos del producto: '.$product->name.' a las: '
        . date('H:m:i').' del día: '.date('d/m/Y');
        $log->save();
        $categories = Categories::with('subcategories')->get();
        $relacionEloquent = 'roles';
        $comercios = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Comercio');
        })->get();
        return view('admin.products.edit', ['product' => $product,'categories' => $categories,'comercios'=>$comercios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        if($request->shipping_price && $request->shipping_price!=0){
            $shipping_free=false;
        }else{
            $shipping_free=true;
        }
        $product = Products::find(\Hashids::decode($request->id)[0]);        
    
        $product->name=$request->name;
        $product->price_min=$request->price_min;
        $product->price_max=$request->price_max;
        $product->quantity_min=$request->quantity_min;
        $product->quantity_min=$request->quantity_min;
        $product->delivery_time=$request->delivery_time;
        $product->shipping_price=$request->shipping_price;
        $product->description=$request->description;  
        $product->shipping_free=$shipping_free;  
        $product->user_id=$request->user_id;   
        $product->save();

        if($request->file('image')){       
            foreach($request->file('image') as $image){
                $imageName = time().'_'.$image->getClientOriginalName().'.'.$image->extension();
                $imagen = Image::make($image);
                $destinationPath = public_path('/thumbnail');
                $imagen->save(public_path('images/products/' . $imageName));
                $imagen->resize(640, 640, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/products/thumbnail/' . $imageName));
                $imagen->resize(320, 320, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('images/products/thumbnail/list/' . $imageName));

                $doggallery = ProductsGallery::create([
                    'file'=>$imageName,
                    'product_id'=>$product->id                                  
                ]);   
                
                

            }
        }

        ProductsCategories::where('product_id',$product->id )->delete();
        if(isset($request->category_id)){
            foreach($request->category_id as $category){
                ProductsCategories::create([
                    'category_id'=>$category,
                    'product_id'=>$product->id                             
                ]);
            }
        }

         ProductsSubcategories::where('product_id',$product->id )->delete();
         if(isset($request->subcategory_id)){
            foreach($request->subcategory_id as $subcategory){
                ProductsSubcategories::create([
                     'subcategory_id'=>$subcategory,
                     'product_id'=>$product->id                             
                 ]);
             }
         }

         ProductsQuestions::where('product_id',$product->id )->delete();
        if(isset($request->question)){
            foreach($request->question as $key=>$item){
                ProductsQuestions::create([
                    'question'=>$item,
                    'answer'=>$request->answer[$key],
                    'product_id'=>$product->id                             
                ]);
            }
        }
         

        return json_encode(['success' => true, 'customer_id' => $product->encode_id]);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dogs  $dogs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find(\Hashids::decode($id)[0]);
        $gallery=ProductsGallery::where('product_id',$product->id)->get();

        foreach($gallery as $item){
            $image_path = public_path().'/images/products/'.$item->file;
            if (@getimagesize($image_path)) {
                unlink($image_path);
            }
            ProductsGallery::find($item->id)->delete();
        }
        ProductsCategories::where('product_id',$product->id )->delete();
        ProductsSubcategories::where('product_id',$product->id )->delete();
        Products::find(\Hashids::decode($id)[0])->delete();

        return json_encode(['success' => true]);
    }

    public function productsByCategory($category){
        $categorydata = Categories::where('slug',$category)->first();
        $products=Products::with('productcategories','productcategories.category','gallery')->whereRelation('productcategories','category_id',$categorydata->id)->get();
        $info=array(
            'category_id'=>$categorydata->id, 
            'namecategory'=>$categorydata->name, 
            'slugcategory'=>$categorydata->slug, 
            'namesubcategory'=>null, 
            'slugsubcategory'=>null,
            'subcategory_id'=>null,  

        );
        return view ('site.products.list', compact('products','info'));
    }

    public function productsBySubCategory($category,$subcategory){
        $categorydata = Categories::where('slug',$category)->first();
        $subcategorydata = SubCategories::where('slug',$subcategory)->first();
        

        $products=Products::with('productsubcategories','productsubcategories.subcategory','gallery')->whereRelation('productsubcategories','subcategory_id',$subcategorydata->id)->get();
        
        $info=array(
            'category_id'=>$categorydata->id, 
            'namecategory'=>$categorydata->name, 
            'slugcategory'=>$categorydata->slug, 
            'namesubcategory'=>$subcategorydata->name, 
            'slugsubcategory'=>$subcategorydata->slug, 
            'subcategory_id'=>$subcategorydata->id, 

        );
        return view ('site.products.list', compact('products','info'));
    }

    public function productsByid($productoid,$nameproduct){
        if(filter_var($productoid, FILTER_VALIDATE_INT)===false){
            abort(404);
        }
        $product=Products::with('productcategories','productcategories.category','gallery','user','questions')
        ->where('id',filter_var($productoid, FILTER_VALIDATE_INT))->first();
        $categories = array();
        foreach ($product->productcategories as $item){                                      
            array_push($categories, $item->category_id);
         }

         $related=Products::with('productcategories','productcategories.category','gallery','user')
         ->whereHas('productcategories', function($query) use($categories)
         {
            $query->whereIn('category_id', $categories);
         })->where('id','!=',$product->id)->orderBy('updated_at', 'desc')->get(); 
         
         
        return view ('site.products.product', compact('product','related'));
    }

    public function quotation($productoid){
        $product=Products::with('productcategories','productcategories.category','gallery','user')
        ->where('id',filter_var($productoid, FILTER_VALIDATE_INT))->first();
       
        return view ('site.quotation.create', compact('product'));
        
    }

    
}
