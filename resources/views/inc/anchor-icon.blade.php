@php
    /**
    * @var \Illuminate\Routing\Route $route
    * @var \String $title
    * @var \String $props
    * @var \String $icon
    */
@endphp
<a class="btn btn-link" href="{{$route}}" title="{{$title}}" {{ $props }}><i class="fas fa-{{ $icon }}"></i></a>
