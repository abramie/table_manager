<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class FormUpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'roles' => ['required']
        ];
    }
    protected function prepareForValidation(): void
    {
        //dd($this->route());
        $roles =[];

        foreach(Role::get('id') as $roleid){
            if($this->request->get('role-'.$roleid->id)){
                $roles[]= $roleid->id;
            }
        }
        $this->merge([
            'roles' => $roles
        ]);
    }

}
