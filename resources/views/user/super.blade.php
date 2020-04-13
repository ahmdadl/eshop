@extends('layouts.user')

@section('title')
{{__('t.user.superTitle')}}
@endsection

@section('myContent')
<div class="container-fluid overflow-x">
    <table class="table table-striped">
        <thead class="bg-primary text-light">
            <tr>
                <th>#</th>
                <th>{{__('t.user.table.name')}}</th>
                <th>{{__('t.user.table.products')}}</th>
                <th>{{__('t.user.table.orders')}}</th>
                <th>{{__('t.user.table.role')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <th>
                    {{$user->name}}
                    @switch($user->role)
                    @case(\App\User::AdminRole)
                    <span class="badge badge-danger">
                        {{__('t.user.table.isAdmin')}}
                    </span>
                    @break
                    @case(\App\User::SuperRole)
                    <span class="badge badge-info">
                        {{__('t.user.table.isSuper')}}
                    </span>
                    @break
                    @default
                    <span class="badge badge-primary">
                        {{__('t.user.table.isNormal')}}
                    </span>
                    @endswitch
                </th>
                <td>{{$user->products_count}}</td>
                <td>{{$user->orders_count}}</td>
                <td>
                    @if (!$user->isAdmin() && !$user->isSuper())
                    <button class="btn btn-info">
                        {{__('t.user.table.makeAsSuper')}}
                    </button>
                    @else
                    ----
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$users->links()}}
@endsection