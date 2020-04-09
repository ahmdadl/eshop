@extends('layouts.user')

@section('title')

@endsection

@section('myContent')
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header bg-primary text-light">
                @lang('t.user.orderCount')
            </div>
            <div class="card-body text-center">
                <h1 class="text-primary">
                    {{$countOrders[0]->oc}}
                </h1>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header bg-primary text-light">
                @lang('t.user.sentOrder')
            </div>
            <div class="card-body text-center">
                <h1 class="text-primary">
                    {{$sentOrders[0]->sc}}
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header bg-primary text-light">
                @lang('t.user.prod')
            </div>
            <div class="card-body text-center">
                <h1 class="text-primary">
                    {{$products[0]->pc}}
                </h1>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header bg-primary text-light">
                @lang('t.user.paid')
            </div>
            <div class="card-body text-center">
                <h3 class="text-primary pb-3">
                    ${{number_format($totalPaid[0]->paid, 2)}}
                </h3>
            </div>
        </div>
    </div>
</div>
@endsection