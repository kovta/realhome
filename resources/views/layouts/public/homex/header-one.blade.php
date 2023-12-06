<!--	Header One
=============================================================-->
<header id="header" class="nav-on-banner header_one">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="top_header">
                    <div class="row">
                        <div class="col-md-7 col-xl-6 offset-md-2">
                            <div class="top_left icon_default color-white">
                                <ul>
                                    <li><i class="fas fa-phone" aria-hidden="true"></i>{{ \App\Models\SiteParameter::getParameterValue('SiteOwnerPhone', 'SiteOwnerPhone') }}</li>
                                    <li><i class="fas fa-envelope" aria-hidden="true"></i>{{ \App\Models\SiteParameter::getParameterValue('SiteOwnerEmail', 'SiteOwnerEmail') }}</li>
{{--                                    <li>--}}
{{--                                        <div class="dropdown hover_white">--}}
{{--                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Help and Support</a>--}}
{{--                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}
{{--                                                <a class="dropdown-item" href="faq.html">Faq</a>--}}
{{--                                                <a class="dropdown-item" href="#">Terms and Condition</a>--}}
{{--                                                <a class="dropdown-item" href="#">How it works</a>--}}
{{--                                                <a class="dropdown-item" href="contact.html">Contact</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="currency float-right">
                                <ul>
                                    <li>
                                        <div class="dropdown hover_white">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownLangSelector" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ strtoupper(App::getLocale()) }}</a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownLangSelector">
                                                <a class="dropdown-item {{ (App::getLocale() == 'en') ? 'active' : '' }}" href="{{route('language', 'en')}}">EN</a>
                                                <a class="dropdown-item {{ (App::getLocale() == 'hu') ? 'active' : '' }}" href="{{route('language', 'hu')}}">HU</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                                {{--<form action="#" method="post">--}}
                                    {{--<select class="color-white">--}}
                                        {{--<option>$ USD</option>--}}
                                        {{--<option>£ EUR</option>--}}
                                        {{--<option>₹ Rupi</option>--}}
                                        {{--<option>৳ Taka</option>--}}
                                    {{--</select>--}}
                                    {{--<select class="color-white">--}}
                                        {{--<option>EN</option>--}}
                                        {{--<option>HU</option>--}}
                                    {{--</select>--}}
                                {{--</form>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar_one">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <div>
                                    <a class="navbar-brand" href="{{ url('/') }}">
                                        <img src="{{ asset('images/logo/realhome.svg') }}" alt="realhome logo" style="width: 150px; height:auto;">
                                    </a>
                                </div>
                                <div>
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        {{--
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/') }}">@lang('public.mainmenu_home_label')</a>
                                        </li>
                                        --}}
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('search') }}">@lang('public.mainmenu_search_label')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="{{ route('kiadoIngatlanok') }}">@lang('public.mainmenu_rent_label')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="{{ route('eladoIngatlanok') }}">@lang('public.mainmenu_sale_label')</a>
                                        </li>
                                        @guest
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('kedvencek') }}">@lang('public.mainmenu_my_favorites_label')</a>
                                            </li>
                                            <li class="nav-item dropdown">
                                                @php
                                                    $offerPages = \App\Http\Controllers\SpecialOfferPageController::getOfferPageMenuItems()
                                                @endphp
                                                @if($offerPages->count() > 0)
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('public.mainmenu_offer_pages_label')</a>
                                                <ul class="dropdown-menu">
                                                    @foreach($offerPages as $item)
                                                        <li><a class="dropdown-item" href="{{ route('realEstatePublicList', $item->getSearchMenuParameters() ) }}">{{ $item->menu_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                    <span class="nav-link" {{--style="color: #818181;"--}}>@lang('public.mainmenu_offer_pages_label')</span>
                                                @endif
                                            </li>
                                        @endguest
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('rolunk') }}">@lang('public.mainmenu_about_label')</a>
                                        </li>
                                        <li class="nav-item mr-auto">
                                            <a class="nav-link" href="{{ route('kapcsolat') }}">@lang('public.mainmenu_contact_label')</a>
                                        </li>
                                    </ul>
                                    @guest
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">@lang('public.mainmenu_login_label') / @lang('public.mainmenu_register_label')</a>
                                        </li>
                                        <li class="nav-item d-lg-none" style="border-top: 1px dotted white; text-align:right;">
                                            @if (App::getLocale() === 'en')
                                                <a class="nav-link" href="{{route('language', 'hu')}}">Váltás magyar nyelvre</a>
                                            @else
                                                <a class="nav-link" href="{{route('language', 'en')}}">Switch to English</a>
                                            @endif
                                        </li>
                                    </ul>
                                    @endguest

                                    @guest
                                    @else
                                        <ul class="navbar-nav mr-auto">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle active" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                                                <ul class="dropdown-menu">
                                                    @hasrole('clients')
                                                        <li><a class="dropdown-item" href="{{route('clientProfile', [Auth::user()->client->id])}}">@lang('public.mainmenu_user_datapage_label')</a></li>
                                                        <li><a class="dropdown-item" href="{{route('myRequirements')}}">@lang('public.mainmenu_user_requirements_label')</a></li>
                                                        <li><div class="dropdown-divider"></div></li>
                                                    @endhasrole
                                                @if (!Auth::user()->hasRole('clients'))
                                                        <li><a class="dropdown-item" href="{{route('admin')}}">@lang('public.mainmenu_user_admin_caption')</a></li>
                                                        <li><div class="dropdown-divider"></div></li>
                                                    @endif
                                                    <li><a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        @lang('public.mainmenu_logout_label')</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item d-lg-none" style="border-top: 1px dotted white; text-align:right;">
                                                @if (App::getLocale() === 'en')
                                                    <a class="nav-link" href="{{route('language', 'hu')}}">Váltás magyar nyelvre</a>
                                                @else
                                                    <a class="nav-link" href="{{route('language', 'en')}}">Switch to English</a>
                                                @endif
                                            </li>
                                        </ul>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        {{--
                                          <li class="nav-item dropdown">
                                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                  {{ Auth::user()->name }} <span class="caret"></span>
                                              </a>

                                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                      {{ __('Logout') }}
                                                  </a>

                                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                      @csrf
                                                  </form>
                                              </div>
                                          </li>
                                        --}}
                                    @endguest

                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
