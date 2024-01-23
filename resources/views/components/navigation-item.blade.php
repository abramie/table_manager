<li class="nav-item {{ Str::contains(Route::currentRouteName(), $contain ? $contain : $routeName)? 'active' : '' }}">
    <a class="nav-link"  href="{{ route($routeName) }}"> {{$slot->isNotEmpty() ?  $slot : last(explode('.',$routeName))}}</a>
</li>
