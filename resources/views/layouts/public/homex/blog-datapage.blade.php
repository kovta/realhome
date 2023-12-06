@php
    use App\Models\Post;
    /**
    * @var Post $post
    * @var Post $lastFivePost
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
                        <li class="hover_gray"><a href="/blog">Blog</a></li>
                        <li><i class="fas fa-angle-right" aria-hidden="true"></i></li>
                        <li class="color-default">Blog Details</li>
                    </ul>
                </div>
                <div class="float-right color-primary">
                    <h3 class="banner-title font-weight-bold">Blog Details</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="full-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="blog_details bg-white color-secondery mb_30">
                            <div class="blog_img overlay_one color-white overfollow">
                                <img src="{{ $post->getPublicDatapageFeaturedImage() }}" alt="image">
                            </div>
                            <div class="blog_content mt-5">
                                <div class="blog_info">
                                    <h4 class="blog_title m-0 pb_20 color-primary">{{ $post->getPublicTitle() }}</h4>
                                    <div>{!! $post->getTranslation(App::getLocale())->lead !!}</div>
                                    <div>{!! $post->getTranslation(App::getLocale())->description !!}</div>
                                </div>
                                <div class="social_media hover_primary py-5 mb-3">
                                    <label class="mr-4 color-primary">Share This Post In Your Media :</label>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fas fa-rss" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="blog-sidebar-right">
                    <div class="sidebar-widget mt-5">
                        <div class="main-title-two pb_60 color-primary">
                            @php // TODO Ide meg kell csinalni meg a nyelvvaltozot! @endphp
                            <h4 class="title">Recent Post</h4>
                        </div>
                        <div class="recent_post">
                            <ul>
                                @foreach($lastFivePost as $post)
                                    <li>
                                        <a href="#"><img src="{{ $post->getPublicListThumbImage() }}" alt="{{ $post->getPublicTitle() }}" title="{{ $post->getPublicTitle() }}"></a>
                                        <div class="post_info">
                                            <h6 class="inner_title"><a href="{{ route('blogPost', [$post->id]) }}">{{ $post->getPublicTitle() }}</a></h6>
                                            <span class="date_time color-secondery">{{ $post->getPublicCreatedAt() }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.public.homex.footer')

@endsection

@section('htmlfooter')
@endsection
