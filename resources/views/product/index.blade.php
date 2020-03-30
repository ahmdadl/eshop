@extends('layouts.app', ['cpt' => 'product'])

@section('title')
    @lang('t.all_p')
@endsection

@section('content')
    @dump($pros)
@endsection

