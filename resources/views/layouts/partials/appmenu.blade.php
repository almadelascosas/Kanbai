<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2 col-logo">
                    <a class="navbar-brand text-brand c-two logo-desck" href="/">
                        <img class="logo" src="{{ asset('images/logo/logo-kanbai-color.png').'?'.rand() }}" />
                        <!--Marce<span class="color-b">Pets</span>-->
                    </a>
                    <a class="nav-link account push" href="/home"><i class="bi bi-person"></i></a>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="col-md-8">
                    <div class="d-none d-sm-none d-md-block">
                        <form class="form" role="form" action="javascript:void(0)" enctype="multipart/form-data" id="main-form-search" autocomplete="off">
                            <input type="hidden" id="_url_search" value="{{ url('serachproduct') }}">
                            <input type="hidden" id="_token_search" value="{{ csrf_token() }}">
                            <div class="input-wrapper">
                                <input type="search" name="search" id="search" class="input" placeholder="Busca lo que quieras" wire:model="keyword">
                                <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div> 
                        </form>

                    </div>
                    <div class="d-block d-sm-block d-md-none">
                        <div class="input-group mb-3 contenedor-search">
                          <input type="text" class="form-control" placeholder="Busca lo que quieras" aria-label="Busca lo que quieras" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary boton-search" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-2">
                    <a class="account-desck" href="/home"> <!-- <i class="bi bi-person-circle"></i> --> Ingresa</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse mt-3" id="navbarDefault">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="/">Inicio</a>
                            </li>
                            <input type="hidden" value="{{$categories = App\Models\Categories::with('subcategories')->where('is_menu',1)->get()}}">
                            @foreach ($categories as $category)
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('catalogo/category->slug')) ? 'active' : '' }}" href="/catalogo/{{ $category->slug }}">{{ $category->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>

$( "#search" ).change(function() {    

    url='/buscar/'+$('#main-form-search #search').val();
    window.location.href = url;


});
</script>
@endpush