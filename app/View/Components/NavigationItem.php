<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavigationItem extends Component
{

    /**
     * Create a new component instance.
     * @param string $routeName C'est le nom de la route auquel ce navigation item redirige
     * @param null $parameter Soit un tableau de modeles, soit un modele qui doit etre passer à la route comme parametre
     * @param string $contain La valeur qui sert à identifier si la route est active, si non specifier, utilise le nom de la route
     * @param string $is Definit le type d'item de navigation, et comment definir si la route est actif,
     *              les options de routes sont "equal" et "contain", les options de types sont 'parent', 'child' et non definit
     */
    public function __construct(public string $routeName, public  $parameter = null ,public string|null $contain = null, public string $is = "contain", public string|null $originalOrder= null)
    {

    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return function (array $data){
            return view('components.navigation-item');
        };

    }
}
