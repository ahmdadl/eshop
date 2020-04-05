@extends('layouts.app', ['cpt' => 'show-product'])

@section('title')
{{$p->name}}
@endsection

@section('content')
{{$p->name}}
@endsection

