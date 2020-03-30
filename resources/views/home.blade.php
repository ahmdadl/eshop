@extends('layouts.app', ["cpt" => 'home'])

@section('title')
    EShop HomePage
@endsection

@section('content')
    @dump($cats->first)
@endsection

