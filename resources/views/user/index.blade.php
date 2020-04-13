@extends('layouts.user')

@section('title')
@lang('t.user.title.index')
@endsection

@section('myContent')
<div class="card-group">
    @can ('change-role')
    <x-count-card :title="__('t.user.usersCount')" :count="$usersCount[0]->uc">
    </x-count-card>
    @endcan
    <x-count-card :title="__('t.user.orderCount')" :count="$countOrders[0]->oc">
    </x-count-card>
</div>
<div class="card-group">
    <x-count-card :title="__('t.user.sentOrder')" :count="$sentOrders[0]->sc">
    </x-count-card>
    <x-count-card :title="__('t.user.prod')" :count="$products[0]->pc">
    </x-count-card>
</div>
<div class="card-group">
    <x-count-card :title="__('t.user.paid')"
        :count="number_format($totalPaid[0]->paid, 2)" money="true">
    </x-count-card>
    @can ('change-role')
    <x-count-card :title="__('t.user.revCount')" :count="$revCount[0]->rc">
    </x-count-card>
    @endcan
</div>
@endsection