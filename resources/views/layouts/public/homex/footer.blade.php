

<!--	Footer
============================================================-->
<footer class="full-row bg-gray">
    <div class="container">
        {{--
        <div class="newsletter py_80 borber_b">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="news_text color-primary">
                                <h4>Enter your email for subscribe to get monthly newsletter</h4>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="subscribe">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Enter your email">
                                    <button class="btn btn-default1" type="submit">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        --}}
        <div class="footer_area py_80 borber_b">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="footer-widget">
                        <div class="footer_logo pb_30">
                            <a href="#"><img class="logo-bottom" src="{{ asset('images/logo/realhome.svg') }}" alt="realhome logo" style="width: 150px; height:auto;"></a>
                        </div>
                        <p class="pb_20">
                            @lang('public.footer_about_us_text_label')
                        </p>
{{--                        <p>Best regards,<br/>Your Real Home Team</p>--}}
                        <a class="btn btn-default1" href="{{ route('register') }}">@lang('public.footer_register_now_button_label')</a>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="footer-widget">
                                <div class="ft-widget-title color-primary">
                                    <h4>@lang('public.footer_support_title')</h4>
                                </div>
                                <div class="help_links pt_50 hover_gray">
                                    <ul>
                                        <li class="pb_20"><a href="{{ route('adatkezelesiSzabalyok') }}">@lang('public.footer_privacy_policy_label')</a></li>
                                        <li class="pb_20"><a href="{{ route('feltetelek') }}">@lang('public.footer_terms_label')</a></li>
                                        <li class="pb_20"><a href="{{ route('kapcsolat') }}">@lang('public.footer_contact_label')</a></li>
                                        <li class="pb_20"><a href="{{ route('rolunk') }}">@lang('public.footer_about_label')</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

{{--                        <div class="col-md-4 col-lg-4">--}}
{{--                            <div class="footer-widget">--}}
{{--                                <div class="ft-widget-title color-primary">--}}
{{--                                    <h4>Quick Links</h4>--}}
{{--                                </div>--}}
{{--                                <div class="help_links pt_50 hover_gray">--}}
{{--                                    <ul>--}}
{{--                                        <li class="pb_20"><a href="{{ route('rolunk') }}">@lang('public.footer_about_label')</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="col-md-6 col-lg-6">
                            <div class="footer-widget">
                                <div class="ft-widget-title color-primary">
                                    <h4>@lang('public.footer_contact_label')</h4>
                                </div>
                                <div class="help_links pt_50 pb_30 color-secondery">
                                    <ul>
                                        <li class="pb_20">{{ \App\Models\SiteParameter::getParameterValue('SiteOwnerAddress', 'SiteOwnerAddress') }}</li>
                                        <li class="pb_20">{{ \App\Models\SiteParameter::getParameterValue('SiteOwnerPhone', 'SiteOwnerPhone') }}</li>
                                        <li class="pb_20">{{ \App\Models\SiteParameter::getParameterValue('SiteOwnerEmail', 'SiteOwnerEmail') }}</li>
                                    </ul>
                                </div>
                                <div class="social_media hover_primary">
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
{{--                                        <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>--}}
                                        <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
{{--                                        <li><a href="#"><i class="fas fa-rss" aria-hidden="true"></i></a></li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright py_30">
            <div class="copy_text color-secondery d-inline">© {{ date('Y') }}</div>
            <div class="policy hover_gray">
                <ul>
                    <li><a href="{{ route('adatkezelesiSzabalyok') }}">@lang('public.footer_privacy_policy_label')</a></li>
{{--                    <li><a href="#"> Site Map</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</footer>
