@extends('admin.base')

@section('title', 'Liste des utilisateurs')


@section('content-admin')

    <h1>Options admin</h1>
    <h1>Liste settings</h1>
        <table>
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Mail</th>
                <th scope="col">Role</th>
            </tr>
            </thead>

            <tbody>
            @foreach(\App\Models\User::get() as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <form action="{{route('profile.change_role', $user)}}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                @foreach(\Spatie\Permission\Models\Role::get() as $role)
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" @checked($user->roles->contains($role) ) name="role-{{$role->id}}" value="{{$role->id}}"/>
                                        <label for="role-{{$role->id}}"  class="form-control" >{{$role->name}}</label>
                                    </div>
                                    @error("roles")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @error("role-1")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                                 @endforeach
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Button</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

@endsection
