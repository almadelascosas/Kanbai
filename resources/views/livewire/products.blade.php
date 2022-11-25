<div class="row">
    
        <div class="col-md-3">
            <h2 class="title-categoryorsub">
            @if($info['subcategory_id']==null)
                {{$info['namecategory']}}
            @else
                {{$info['namesubcategory']}}
            @endif
            </h2>
            <hr>
        @if($info['subcategory_id']==null)
        <div class="row mb-4 mt-5">
            <h4 class="title-filter">Subcategorias</h4>
            <input type="hidden" value="{{$subcategories = App\Models\SubCategories::where('category_id',$info['category_id'])->with('category')->get()}}">
            @foreach ($subcategories as $subcategory)                
                <div class="col-sm-6">
                    <a class="dropdown-item bt-subcategory-filter {{ (request()->is('catalogo/$subcategory->category->slug/subcategory->slug')) ? 'active' : '' }}" href="/catalogo/{{ $subcategory->category->slug }}/{{ $subcategory->slug }}">
                    <img class="image-subcategory-list-product" src="{{ asset('images/subcategories/'.$subcategory->file.'') }}" alt="{{ $subcategory->name }}">
                    {{ $subcategory->name }}</a>
                </div>                 
            @endforeach
        </div>
        @endif

        <div class="row background-item-filter mb-4">
            
            <div class="col-9">
                <label class="form-check-label" for="shipping_price">Envío gratis</label>
            </div>
            <div class="col-3">
                <div class="form-check form-switch">            
                    <input class="form-check-input" type="checkbox" wire:model="shipping_price" id="shipping_price">                        
                </div>
            </div>
        </div>
        
           


            <div class="form-group">
                <label for="exampleFormControlSelect1">Ordenar por</label>
                <select class="form-control" wire:model="keyword" id="exampleFormControlSelect1">
                    <option >Seleccione</option>
                    <option value="1">Por defecto</option>
                    <option value="2" >Últimos</option>
                    <option value="3">Por Precio: bajo a alto</option>
                    <option value="4">Por Precio: alto a bajo</option>
                </select>
            </div>

            <div class="form-group">
                <div class="mall-property mt-3">
                    <div class="mall-property__label" >
                        Precio                        
                     </div>
                     <div class="mall-slider-handles" data-start="1000" data-end="1000" data-min="1" data-max="10000000" data-target="price" style="width: 100%" wire:ignore></div>
                     <div class="row filter-container-1">
                        <div class="col-md-6">
                           <input type="text" class="form-control" data-min="price" id="skip-value-lower"  wire:model.lazy="min_price" readonly>  
                        </div>
                        <div class="col-md-6">
                           <input type="text"  class="form-control" data-max="price" id="skip-value-upper"  wire:model.lazy="max_price" readonly>
                        </div>                        
                     </div>
                </div>
            </div>
            

           

        </div>
          
        <div class="col-md-9">
            <div class="row">
            @foreach($products as $item)
            <!--Estructura desk-->
            <div class="col-md-4 list-products-desk">
                <a href="/catalogo/producto/{{$item->id}}/{{$item->name}}">
                    <div class="card mb-3" >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-12 mb-4">
                                @if(count($item->gallery)>0)
                                    <img src="{{ asset('images/products/thumbnail/list/'.$item->gallery[0]->file.'') }}" alt="{{$item->name}}" class="img-d img-fluid image-list">
                                @endif
                                </div>
                                <h4 class="title-product-desk">{{$item->name}}</h4>
                                <!-- <p class="vendido-po-desk">por {{$item->user->name}}</p> -->
                                <p class="price">
                                    <img src="{{ asset('images/Precio_Icono.png') }}" alt="Rango de precio" class="img-d img-fluid">
                                    Rango: <span>${{number_format($item->price_min, 0, 0, '.')}} - ${{number_format($item->price_max, 0, 0, '.')}}</span> 
                                </p>
                                <p class="quantity">
                                    <img src="{{ asset('images/Cantidad_Icono.png') }}" alt="Pedido minímo" class="img-d img-fluid">
                                    Pedido minímo: <span>{{$item->quantity_min }} </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--Fin Estructura desk-->
            <!--Estructura mobile-->
            <div class="col-md-4 list-products-mobile">
                <a href="/catalogo/producto/{{$item->id}}/{{$item->name}}">
                    <div class="card card-products mb-3" >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-4">
                                @if(count($item->gallery)>0)
                                <img src="{{ asset('images/products/'.$item->gallery[0]->file.'') }}" alt="Razas" class="img-d img-fluid">
                                @endif    
                            </div>
                                <div class="col-md-8 col-8">
                                    <h5 class="card-title title-card-products">{{$item->name}}</h5>
                                    <p class="card-text delivery_time"><i class="bi bi-truck"></i> Recibelo en {{$item->delivery_time}}</p>
                                    <p class="card-text quantity_min">Min. {{$item->quantity_min}} uds</p>
                                    <p class="card-text "><strong>${{number_format($item->price_min, 0, 0, '.')}} - ${{number_format($item->price_max, 0, 0, '.')}}</strong> </p>
                                
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </a>                
            </div>
            <!--Fin Estructura mobile-->
          @endforeach
            </div>
           
          </div>
          {{ $products->links() }}
</div>

@push('scripts')

<script>
        document.addEventListener('livewire:load', function () {
          var $propertiesForm = $('.mall-category-filter');
           $('.mall-slider-handles').each(function () {
               var el = this;
               var start_min=Math.round(@this.start_min);
               var start_max=Math.round(@this.start_max);
               noUiSlider.create(el, {
                   start: [start_min, start_max],
                   connect: true,
                   tooltips: true,
                   range: {
                       min: [start_min],
                       max: [start_max]
                   },
                   pips: {
                       mode: 'range',
                       density: 10
                   }
               }).on('change', function (values) {
                    @this.set('min_price',values[0]),
                    @this.set('max_price',values[1]),
                   $('[data-min="' + el.dataset.target + '"]').val(values[0])
                   $('[data-max="' + el.dataset.target + '"]').val(values[1])
                   //$propertiesForm.trigger('submit');
               });
           })
        })
    </script>
@endpush

          
