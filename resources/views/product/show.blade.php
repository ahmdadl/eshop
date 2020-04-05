@extends('layouts.app', ['cpt' => 'show-product'])

@section('title')
{{$p->name}}
@endsection

@section('content')
    @if ($p->amount < 1)
    <div class="d-flex justify-content-center alert alert-danger">
        <strong>@lang('t.show.out')</strong>
    </div>
    @endif
@endsection

