@php
    /**
    * @var \App\Models\Posts[] $posts
    */
@endphp

@extends('layouts.public.homex.base')

@section('htmlheader')
@endsection


@section('descendant-site')

@include('layouts.public.homex.header-four')

<!--	Banner
===============================================================-->
<div class="page-banner bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="breadcrumbs color-secondery">
                    <ul>
                        <li class="hover_gray"><a href="/">Home</a></li>
                        <li><i class="fas fa-angle-right" aria-hidden="true"></i></li>
                        <li class="color-default">Blog</li>
                    </ul>
                </div>
                <div class="float-right color-primary">
                    <h3 class="banner-title font-weight-bold">Blog</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="full-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="row">
                    @foreach ($posts as $key => $post)
                        {{-- begin post --}}
                        <div class="col-md-4 col-lg-4 mb-4">
                            <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                                <div class="blog_img overlay_one color-white">
                                    <img src="{{ $post->getPublicListFeaturedImage() }}" alt="image">
                                </div>
                                <div class="blog_content p_30 color-secondery">
                                    <div class="hover_primary pb_20">
                                        <h6 class="blog_title m-0"><a href="{{ route('blogPost', $post) }}">{{ $post->getPublicTitle() }}</a></h6>
                                    </div>
                                    <p>{!! $post->lead !!}</p>
                                    <a class="btn-link mt_15" href="{{ route('blogPost', $post) }}">@lang('public.blog_read_more')</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
{{--
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/01.jpg" alt="image">
                                <div class="date">November 26, 2018</div>
                            </div>
                            <div class="blog_content p_30 color-secondery">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">Our team are working to provide the owneship of property.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/02.jpg" alt="image">
                                <div class="date">November 10, 2018</div>
                            </div>
                            <div class="blog_content p_30">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">Your investment is our heart, so you can stay in relax.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/03.jpg" alt="image">
                                <div class="date">October 31, 2018</div>
                            </div>
                            <div class="blog_content p_30">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">What do you thinking for your family house.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/01.jpg" alt="image">
                                <div class="date">November 26, 2018</div>
                            </div>
                            <div class="blog_content p_30 color-secondery">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">Our team are working to provide the owneship of property.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/02.jpg" alt="image">
                                <div class="date">November 10, 2018</div>
                            </div>
                            <div class="blog_content p_30">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">Your investment is our heart, so you can stay in relax.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/03.jpg" alt="image">
                                <div class="date">October 31, 2018</div>
                            </div>
                            <div class="blog_content p_30">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">What do you thinking for your family house.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/01.jpg" alt="image">
                                <div class="date">November 26, 2018</div>
                            </div>
                            <div class="blog_content p_30 color-secondery">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">Our team are working to provide the owneship of property.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/02.jpg" alt="image">
                                <div class="date">November 10, 2018</div>
                            </div>
                            <div class="blog_content p_30">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">Your investment is our heart, so you can stay in relax.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/03.jpg" alt="image">
                                <div class="date">October 31, 2018</div>
                            </div>
                            <div class="blog_content p_30">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">What do you thinking for your family house.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/01.jpg" alt="image">
                                <div class="date">November 26, 2018</div>
                            </div>
                            <div class="blog_content p_30 color-secondery">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">Our team are working to provide the owneship of property.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/02.jpg" alt="image">
                                <div class="date">November 10, 2018</div>
                            </div>
                            <div class="blog_content p_30">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">Your investment is our heart, so you can stay in relax.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="blog_one boxshadow_one bg-white color-secondery h-100">
                            <div class="blog_img overlay_one color-white">
                                <img src="/vendor/homex/images/blog/03.jpg" alt="image">
                                <div class="date">October 31, 2018</div>
                            </div>
                            <div class="blog_content p_30">
                                <div class="hover_primary pb_20">
                                    <h6 class="blog_title m-0"><a href="blog_details.html">What do you thinking for your family house.</a></h6>
                                </div>
                                <p>Nunc tempus, auctor mauris montes, attis fringilla dignissim. Vitae habitant estibulum quisque commodo.</p>
                                <a class="btn-link mt_15" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
--}}
{{--

                    <nav aria-label="Page navigation" class="alinment d-table">
                        <ul class="pagination my-4">
                            <li class="page-item"><a class="page-link active" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">...</li>
                            <li class="page-item"><a class="page-link" href="#">45</a></li>
                            <li class="page-item"><a class="page-link active" href="#">Next</a></li>
                        </ul>
                    </nav>
--}}
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
