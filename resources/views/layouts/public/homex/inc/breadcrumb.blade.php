<ul>
    <li class="hover_gray"><a href="/">@lang('public.mainmenu_home_label')</a></li>
    <?php $segments = ''; ?>
    @foreach(Request::segments() as $segment)
        <?php
        $segments .= '/'.$segment;
        $link = ($segment != Request::segments()[count(Request::segments())-1]) ? $segments : '';
        $route = app('router')->getRoutes()->match(app('request')->create($segments));
        $caption = ($route->breadCrumbCaption) ? $route->breadCrumbCaption : $route->uri();
        ?>
        <li><i class="fas fa-angle-right" aria-hidden="true"></i></li>
        <li class="hover_gray"><a href="{{ $link }}">@lang($caption)</a></li>
    @endforeach
</ul>
