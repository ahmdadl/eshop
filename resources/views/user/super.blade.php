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
                    @if ($user->isAdmin())
                    <span class="badge badge-danger">
                        {{__('t.user.table.isAdmin')}}
                    </span>
                    @else
                    <span id="notSuper{{$user->id}}"
                        class="badge badge-info {{$user->isSuper() ? '' : 'd-none'}}">
                        {{__('t.user.table.isSuper')}}
                    </span>
                    <span id="isSuper{{$user->id}}"
                        class="badge badge-primary {{$user->isSuper() ? 'd-none' : ''}}">
                        {{__('t.user.table.isNoraml')}}
                    </span>
                    @endif
                </th>
                <td>{{$user->products_count}}</td>
                <td>{{$user->orders_count}}</td>
                <td>
                    @if (!$user->isAdmin())
                    <button class="btn btn-info" id="btn{{$user->id}}"
                        user-role="{{$user->isSuper() ? 0 : 1}}"
                        v-on:click="h.d.updateRole({{$user->id}}, {{\App\User::SuperRole}})">
                        <x-btn-loader :id="'spinnerUpdating' . $user->id">
                        </x-btn-loader>
                        <span id="text">
                            @if ($user->isSuper())
                            {{__('t.user.table.makeNotSuper')}}
                            @else
                            {{__('t.user.table.makeAsSuper')}}
                            @endif
                        </span>
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
<input type="hidden" id="userLang"
    value="{{json_encode([__('t.user.table.makeAsSuper'), __('t.user.table.makeNotSuper')])}}" />
@endsection