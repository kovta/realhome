
{{--
  Azoknak az oldalaknak az alap sablonja, amik fejlecet es bal oldali menut is tartalmaznak.
--}}


@extends('layouts.admin.main')

@section('title', 'Default page')

@section('container-style')padding-top: 58px;@endsection

@section('navbar')

    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">@lang('messages.admin_main_title_caption')</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="fas fa-arrow-circle-right"></i> @lang('messages.admin_public_site_link_caption')</a>
                </li>
{{--
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Edited lang is {{ strtoupper(Session::get('editedLanguage')) }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ (Session::get('editedLanguage') == 'en') ? 'active' : '' }}" href="{{route('editedLanguage', 'en')}}">english</a>
                        <a class="dropdown-item {{ (Session::get('editedLanguage') == 'hu') ? 'active' : '' }}" href="{{route('editedLanguage', 'hu')}}">hungarian</a>
                    </div>
                </li>
--}}
            </ul>

{{--

            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

--}}

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Layout is {{ strtoupper(App::getLocale()) }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ (App::getLocale() == 'en') ? 'active' : '' }}" href="{{route('language', 'en')}}">english</a>
                        <a class="dropdown-item {{ (App::getLocale() == 'hu') ? 'active' : '' }}" href="{{route('language', 'hu')}}">hungarian</a>
                    </div>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            @if (!Auth::user()->hasRole('clients'))
                            <a class="dropdown-item" href="{{route('userProfile', [Auth::user()])}}"><i class="fas fa-user"></i> @lang('messages.usermenu_user_datapage_caption')</a>
                            <a class="dropdown-item" href="{{route('changePassword')}}"><i class="fas fa-key"></i> @lang('messages.usermenu_user_passwordchange_caption')</a>

                            <div class="dropdown-divider"></div>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-lock"></i> @lang('messages.usermenu_logout_caption')
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>
    </nav>
@endsection

@section('sidebar')
    <div class="col-2" style="background-color: #f8f9fa; border: 1px solid #dddddd;">
        <!-- left menu -->
        <div>
            @hasrole('developers|administrators')
            <div class="admin-left-menu-subtitle">@lang('messages.leftmenu_dictionary_data_section_caption')</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('siteParameters.index')}}">@lang('messages.leftmenu_site_parameters_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('advertisingPartners.index')}}">@lang('messages.leftmenu_advertising_partners_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('currencies.index')}}">@lang('messages.leftmenu_currencies_caption')</a>
                </li>
{{--
                <li class="nav-item">
                    <a class="nav-link" href="{{route('mnbCurrencyQuery')}}">@lang('messages.leftmenu_mnbCurrencyQuery_caption')</a>
                </li>
--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{route('realEstateTypes.index')}}">@lang('messages.leftmenu_real_estate_types_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('locationAreas.index')}}">@lang('messages.leftmenu_location_areas_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('locationTownDistricts.index')}}">@lang('messages.leftmenu_location_town_districts_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('locationNeighborhoods.index')}}">@lang('messages.leftmenu_location_neighborhoods_caption')</a>
                </li>
            </ul>
            @endhasrole


            <div class="admin-left-menu-subtitle">@lang('messages.leftmenu_main_data_section_caption')</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('realEstates.index')}}">@lang('messages.leftmenu_real_estates_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('realEstateOffers.index')}}">@lang('messages.leftmenu_offers_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('clients.index')}}">@lang('messages.leftmenu_clients_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('partners.index')}}">@lang('messages.leftmenu_partners_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('realEstateRoutes.index')}}">@lang('messages.leftmenu_routes_caption')</a>
                </li>
            </ul>


            @hasrole('developers|administrators')
            <div class="admin-left-menu-subtitle">@lang('messages.leftmenu_public_pages_section_caption')</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('specialOfferPages.index')}}">@lang('messages.leftmenu_special_offer_pages_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('textContentPages.index')}}">@lang('messages.leftmenu_text_content_pages_caption')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('posts.index')}}">@lang('messages.leftmenu_posts_caption')</a>
                </li>
            </ul>
            @endhasrole


            @hasrole('developers|administrators')
            <div class="admin-left-menu-subtitle">@lang('messages.leftmenu_authorization_section_caption')</div>
            <ul class="nav flex-column">
                @hasrole('developers')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('roles.index')}}">@lang('messages.leftmenu_roles_caption')</a>
                </li>
                @endhasrole
                <li class="nav-item">
                    <a class="nav-link" href="{{route('adminusers.index')}}">@lang('messages.leftmenu_adminusers_caption')</a>
                </li>
            </ul>
            @endhasrole


            @hasrole('developers')
            <div class="admin-left-menu-subtitle">@lang('messages.leftmenu_prototypes_section_caption')</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('modalEditPrototypes.index')}}">CRUD (modal edit)</a>
                </li>
            </ul>
            @endhasrole

        </div>
    </div>
@endsection


@section('message-area')
    @if ($errors->any())
        <div class="alert alert-danger error-list">
            <i class="icon fa fa-exclamation-triangle"></i>
            <ul>
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-check-circle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
