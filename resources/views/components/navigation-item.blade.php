<li class="nav-item {{Str::contains(Route::currentRouteName(), $contain ? $contain : $routeName)? 'active' : ''}}">
    <a {{$attributes->class(['nav-link ',Str::contains(Route::currentRouteName(), $contain ? $contain : $routeName)? 'active' : ''])}}  href="{{ route($routeName, $parameter) }}"> {{$slot->isNotEmpty() ?  $slot : last(explode('.',$routeName))}}</a>
</li>
