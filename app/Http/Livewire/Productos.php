<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Products;

class Productos extends Component
{
    use WithPagination;
    public $info;
    public $keyword = '';
    public $shipping_price;
    protected $paginationTheme = 'bootstrap';
    public $pagination = 12;

    public $min_price;
    public $max_price;

    public $start_min;
    public $start_max;

    public function mount(){
        $this->min_price=Products::min('price_min');
        $this->max_price=Products::max('price_max');

        $this->start_min=Products::min('price_min');
        $this->start_max=Products::max('price_max');
    }

   

    public function render()
    {   

        
        switch ($this->keyword) {            
            case 1:
                if($this->info['subcategory_id']==null){
                    if($this->shipping_price===null){
                        return view('livewire.products',[
                            'products' => Products::with('productcategories','productcategories.category','gallery','user')
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->whereBetween('price_max',[$this->min_price,$this->max_price])->paginate($this->pagination),
                        ]);
                    }else{
                        return view('livewire.products',[
                            'products' => Products::with('productcategories','productcategories.category','gallery','user')
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->whereBetween('price_max',[$this->min_price,$this->max_price])
                            ->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                        ]);
                    }
                    
        
                }else{
                    if($this->shipping_price===null){
                        return view('livewire.products',[
                            'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->whereBetween('price_max',[$this->min_price,$this->max_price])->paginate($this->pagination),
                        ]);
                    }else{
                        return view('livewire.products',[
                            'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->whereBetween('price_max',[$this->min_price,$this->max_price])
                            ->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                        ]);
                    }
                    
                }
                break;
            case 2:
                if($this->info['subcategory_id']==null){
                    if($this->shipping_price===null){
                        return view('livewire.products',[
                            'products' => Products::with('productcategories','productcategories.category','gallery','user')
                            ->whereRelation('productcategories','category_id',$this->info['category_id'])
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->orderBy('updated_at', 'desc')->paginate($this->pagination),
                        ]);
                    }else{
                        return view('livewire.products',[
                            'products' => Products::with('productcategories','productcategories.category','gallery','user')
                            ->whereRelation('productcategories','category_id',$this->info['category_id'])
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->orderBy('updated_at', 'desc')
                            ->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                        ]);
                    }
                    
        
                }else{
                    if($this->shipping_price===null){
                        return view('livewire.products',[
                            'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                            ->whereRelation('productsubcategories','subcategory_id',$this->info['subcategory_id'])
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->orderBy('updated_at', 'desc')->paginate($this->pagination),
                        ]);
                    }else{
                        return view('livewire.products',[
                            'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                            ->whereRelation('productsubcategories','subcategory_id',$this->info['subcategory_id'])
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->orderBy('updated_at', 'desc')
                            ->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                        ]);
                    }
                    
                }
                break;
            case 3:
                if($this->info['subcategory_id']==null){
                    if($this->shipping_price===null){
                        return view('livewire.products',[
                            'products' => Products::with('productcategories','productcategories.category','gallery','user')
                            ->whereRelation('productcategories','category_id',$this->info['category_id'])
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->orderBy('price_min', 'ASC')->paginate($this->pagination),
                        ]);
                    }else{
                        return view('livewire.products',[
                            'products' => Products::with('productcategories','productcategories.category','gallery','user')
                            ->whereRelation('productcategories','category_id',$this->info['category_id'])
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->orderBy('price_min', 'ASC')
                            ->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                        ]);
                    }
                    
            
                }else{
                    if($this->shipping_price===null){
                        return view('livewire.products',[
                            'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                            ->whereRelation('productsubcategories','subcategory_id',$this->info['subcategory_id'])
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->orderBy('price_min', 'ASC')->paginate($this->pagination),
                        ]);
                    }else{
                        return view('livewire.products',[
                            'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                            ->whereRelation('productsubcategories','subcategory_id',$this->info['subcategory_id'])
                            ->where(function ($query) {
                                $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                      ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                            })
                            ->orderBy('price_min', 'ASC')
                            ->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                        ]);
                    }
                    
                }
                break;
                case 4:
                    if($this->info['subcategory_id']==null){
                        if($this->shipping_price===null){
                            return view('livewire.products',[
                                'products' => Products::with('productcategories','productcategories.category','gallery','user')
                                ->whereRelation('productcategories','category_id',$this->info['category_id'])
                                ->where(function ($query) {
                                    $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                          ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                                })
                                ->orderBy('price_max', 'ASC')->paginate($this->pagination),
                            ]);
                        }else{
                            return view('livewire.products',[
                                'products' => Products::with('productcategories','productcategories.category','gallery','user')
                                ->whereRelation('productcategories','category_id',$this->info['category_id'])
                                ->where(function ($query) {
                                    $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                          ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                                })
                                ->orderBy('price_max', 'ASC')
                            ->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                            ]);
                        }
                        
                
                    }else{
                        if($this->shipping_price===null){
                            return view('livewire.products',[
                                'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                                ->whereRelation('productsubcategories','subcategory_id',$this->info['subcategory_id'])
                                ->where(function ($query) {
                                    $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                          ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                                })
                                ->orderBy('price_max', 'ASC')->paginate($this->pagination),
                            ]);
                        }else{
                            return view('livewire.products',[
                                'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                                ->whereRelation('productsubcategories','subcategory_id',$this->info['subcategory_id'])
                                ->where(function ($query) {
                                    $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                          ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                                })
                                ->orderBy('price_max', 'ASC')
                            ->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                            ]);
                        }
                        
                    }
                break;
            default:
            if($this->info['subcategory_id']==null){
                if($this->shipping_price===null){
                    return view('livewire.products',[
                        'products' => Products::with('productcategories','productcategories.category','gallery','user')
                        ->whereRelation('productcategories','category_id',$this->info['category_id'])
                        ->where(function ($query) {
                            $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                  ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                        })->paginate($this->pagination),
                    ]);
                }else{
                    return view('livewire.products',[
                        'products' => Products::with('productcategories','productcategories.category','gallery','user')
                        ->whereRelation('productcategories','category_id',$this->info['category_id'])
                        ->where(function ($query) {
                            $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                  ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                        })
                        ->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                    ]);
                }
                
    
            }else{
                if($this->shipping_price===null){
                    return view('livewire.products',[
                        'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                        ->whereRelation('productsubcategories','subcategory_id',$this->info['subcategory_id'])
                        ->where(function ($query) {
                            $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                  ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                        })->paginate($this->pagination),
                    ]);
                }else{
                    return view('livewire.products',[
                        'products' => Products::with('productsubcategories','productsubcategories.subcategory','gallery','user')
                        ->whereRelation('productsubcategories','subcategory_id',$this->info['subcategory_id'])
                        ->where(function ($query) {
                            $query->whereBetween('price_max',[$this->min_price,$this->max_price])
                                  ->orwhereBetween('price_min',[$this->min_price,$this->max_price]);
                        })->where('shipping_free',$this->shipping_price)->paginate($this->pagination),
                    ]);
                }
                
            }
        }

        
        
    }
}
