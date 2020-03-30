@extends('layouts.app', ['cpt' => 'home'])

@section('title')
@lang('t.all_p')
@endsection

@section('content')
<div ref='product_data' class="row">
    @foreach ($pros[0] as $p)
    <div class="card col-6 col-sm-4 col-md-3 col-lg-2">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title">{{$p->name}}</h5>
            <p class="card-text">
                <strong class="text-primary">
                    {{$p->price}}
                </strong>
            </p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div>
    @endforeach
</div>
@endsection