

<div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand" href="html/ltr/vertical-menu-template/index.html">
                        <span class="brand-logo">
                            <img src="{{ asset('images/logo/logo-kanbai-color.png') }}" />
                        </span>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                @can('Administración')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">Administración</span></a>
                    <ul class="menu-content">
                        @can('Ver Sedes')
                        <!--<li>
                            <a class="d-flex align-items-center" href="/campus"><i data-feather='map-pin'></i><span class="menu-item text-truncate" data-i18n="Second Level">Sedes</span></a>
                        </li>-->
                        @endcan
                        @can('Ver Usuario')
                        <li>
                            <a class="d-flex align-items-center" href="/user"><i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Second Level">Usuarios</span></a>
                        </li>
                        @endcan

                        @can('Ver Permisos')
                        <li><a class="d-flex align-items-center" href="#"><i data-feather='lock'></i><span class="menu-item text-truncate" data-i18n="Second Level">Permisos</span></a>
                            <ul class="menu-content">
                                <input type="hidden" value="{{$roles = Spatie\Permission\Models\Role::get()}}">
                                @foreach ($roles as $role)
                                <li>
                                    <a class="d-flex align-items-center" href="/permission/{{ $role->name }}"><span class="menu-item text-truncate" data-i18n="Third Level">{{ $role->name }}</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endcan
                        @can('Ver Role')
                        <li>
                            <a class="d-flex align-items-center" href="/roles"><i data-feather='user-check'></i><span class="menu-item text-truncate" data-i18n="Second Level">Roles</span></a>
                        </li>
                        @endcan
                        @can('Ver Logins')
                        <li>
                            <a class="d-flex align-items-center" href="/logins"><i data-feather='log-in'></i><span class="menu-item text-truncate" data-i18n="Second Level">Logs  de Login</span></a>
                        </li>
                        @endcan
                        @can('Ver Log Sistema')
                        <li>
                            <a class="d-flex align-items-center" href="/logs"><i data-feather='database'></i><span class="menu-item text-truncate" data-i18n="Second Level">Logs Sistema</span></a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('Tienda')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Tienda">Tienda</span></a>
                    <ul class="menu-content">                        
                        @can('Ver Categorías')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/categories"><i class="fa fa-folder-o" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Categorías">Categorías</span></a>
                        </li>
                        @endcan
                        @can('Ver Sub Categoría')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/subcategories"><i class="fa fa-folder-open-o" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Sub-Categorías">Sub-Categorías</span></a>
                        </li>
                        @endcan
                        @can('Ver Productos')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/products"><i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Productos">Productos</span></a>
                        </li>
                        @endcan
                       
                    </ul>
                </li>
                @endcan


                @can('Ver Cotizaciones')
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="/quotes"><i class="fa fa-usd" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Email">Cotizaciones</span></a>
                </li>
                @endcan
                @can('Ver Solicitudes Personalizadas')
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="/solicituded-personalizadas"><i class="fa fa-money" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Solicitudes Personalizadas">Solicitudes Personalizadas</span></a>
                </li>
                @endcan
                @can('Ver Proyectos')
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="/projects"><i class="fa fa-check-circle" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Proyectos">Proyectos</span></a>
                </li>
                @endcan
                @can('Facturación')
                <!--<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='clipboard'></i><span class="menu-title text-truncate" data-i18n="Menu Levels">Facturación</span></a>
                    <ul class="menu-content">
                        @can('Facturación Electronica')
                        <li><a class="d-flex align-items-center" href="#"><i data-feather='clipboard'></i><span class="menu-item text-truncate" data-i18n="Second Level">Facturación Electronica</span></a>
                            <ul class="menu-content">
                                <li>
                                    <a class="d-flex align-items-center" href="/invoice"><span class="menu-item text-truncate" data-i18n="Third Level">Facturación</span></a>
                                </li>
                                <li>
                                    <a class="d-flex align-items-center" href="/notacredit"><span class="menu-item text-truncate" data-i18n="Third Level">Nota Crédito</span></a>
                                </li>
                               

                            </ul>
                        </li>
                        @endcan
                        @can('Facturación Pos')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/pos"><i data-feather='clipboard'></i><span class="menu-title text-truncate" data-i18n="Email">Facturación POS</span></a>
                        </li>
                        @endcan
                        @can('Ver Cotización')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/quotation"><i data-feather='clipboard'></i><span class="menu-title text-truncate" data-i18n="quote">Cotización</span></a>
                        </li>
                        @endcan
                    </ul>
                </li>-->
                @endcan

                @can('Citas')
                <!--<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fa-h-square" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Menu Levels">Citas</span></a>
                    <ul class="menu-content">
                        @can('Ver Tipo de Citas')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/typequote"><i class="fa fa-keyboard-o" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="disponibilidad">Tipos de Citas</span></a>
                        </li>
                        @endcan
                        @can('Ver Disponibilidad')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/availability"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="disponibilidad">Disponibilidad</span></a>
                        </li>
                        @endcan
                        @can('Ver Citas')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/quote"><i class="fa fa-stethoscope" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Citas Agendadas">Citas Agendadas</span></a>
                        </li>
                        @endcan
                        
                    </ul>
                </li>-->
                @endcan
                @can('Ver Historias Clinicas')
                <!--<li class=" nav-item">
                    <a class="d-flex align-items-center" href="/clinic-history"><i class="fa fa-history" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Historias Clínicas">Historias Clínicas</span></a>
                </li>-->
                @endcan

                @can('Reportes')
                <!--<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fa-pie-chart" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Reportes">Reportes</span></a>
                    <ul class="menu-content">
                        @can('Reporte Facturación Electronica')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/reportinvoiceelectronic"><i class="fa fa-area-chart" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Facturación Electronica">Facturación Electronica</span></a>
                        </li>
                        @endcan
                        @can('Reporte Facturación pos')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/reportinvoicepos"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="POS">POS</span></a>
                        </li>
                        @endcan
                        @can('Reporte Cotizaciones')
                        <li class=" nav-item">
                            <a class="d-flex align-items-center" href="/reportinvoicequotation"><i class="fa fa-area-chart" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="POS">Cotizaciones</span></a>
                        </li>
                        @endcan
                        
                    </ul>
                </li>-->
                @endcan

                @if(Auth::user()->hasrole('Usuario'))
                <!--<li class=" nav-item">
                    <a class="d-flex align-items-center" href="/tele-consultation"><i class="fa fa-user-md" aria-hidden="true"></i><span class="menu-title text-truncate" data-i18n="Teleconsulta">Teleconsulta</span></a>
                </li>-->
                @endif



                <!--<li class=" nav-item"><a class="d-flex align-items-center" href="app-email.html"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Email</span></a>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Invoice</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="app-invoice-list.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-invoice-preview.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Preview</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-invoice-edit.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Edit">Edit</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="app-invoice-add.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>-->

            </ul>
        </div>
