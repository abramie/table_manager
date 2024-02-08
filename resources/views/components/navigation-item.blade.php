<li class="nav_item {{Str::contains(Route::currentRouteName(), $contain ? $contain : $routeName)? 'active' : ''}}">
    <a {{$attributes->class(['nav-link '])}}  href="{{ route($routeName, $parameter) }}"> {{$slot->isNotEmpty() ?  $slot : last(explode('.',$routeName))}}</a>
</li>
