<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
/* En cas d'equal, il faut que la route soit strictement egal au parametre (contain ou nom de la route)
    En cas de contain, il suffit que le paremetre soit present dans le nom de la route*/
$active = match(true){
    str_contains($is, 'equal') => (Route::currentRouteName() ===  (!is_null($contain) ?$contain: $routeName) )? 'active' : '',
    str_contains($is, 'contain') => Str::contains(Route::currentRouteName(), $contain ?: $routeName) ? 'active' : '',
    str_contains($is, 'containAndSelf') => Str::contains(Route::currentRouteName(), $contain ?: $routeName) || Str::contains(Route::currentRouteName(), $routeName) ? 'active' : '',
    str_contains($is, 'equalAndSelf') => (Route::currentRouteName() ===  $routeName ) || (Route::currentRouteName() ===  (!is_null($contain) ?$contain: $routeName) ) ? 'active' : '',

    default => Str::contains(Route::currentRouteName(), $contain ?: $routeName) ? 'active' : '',
};

/*Si c'est un parent, pas de lien, sinon la route du lien de navigation */

$route = (Str::contains($is, 'parent') ? "#" : route($routeName, $parameter));
if($originalOrder){
    $route = $route .'?'. $originalOrder;
}
?>
@if(Str::contains($is, 'child'))
    {{--Lien de navigation dans un menu dropdown, sans le li et avec une class differente--}}
    <a {{$attributes->class(['dropdown-item', $active])}}  href="{{ $route }}">
        {{$slot->isNotEmpty() ?  $slot : last(explode('.',$routeName))}}
    </a>
@elseif(Str::contains($is, 'parent'))
    {{--Lien de navigation sans le li (pour le parent d'un dropdown, ou autre) --}}
    <a {{$attributes->class(['nav-link', $active])}}  href="{{ $route }}">
        {{$slot->isNotEmpty() ?  $slot : last(explode('.',$routeName))}}
    </a>
@elseif(Str::contains($is, 'list-group'))
    <li class="nav-item list-group-item list-group-item-action {{$active}}">
        <a {{$attributes->class(['nav-link', $active])}}  href="{{ $route }}">
            {{$slot->isNotEmpty() ?  $slot : last(explode('.',$routeName))}}
        </a>
    </li>
@else
    {{--Lien de navigation classique--}}
    <li class="nav-item {{$active}}">
        <a {{$attributes->class(['nav-link', $active])}}  href="{{ $route }}">
            {{$slot->isNotEmpty() ?  $slot : last(explode('.',$routeName))}}
        </a>
    </li>
@endif
