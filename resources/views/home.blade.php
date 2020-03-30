@extends('layouts.app', ["cpt" => 'home'])

@section('title')
    EShop HomePage
@endsection

@section('content')
    @dump($cats->first->subCat)
    {{-- @dump($cats->first)
    @dump($cats->first)
    @dump($cats->first)
    @dump($cats->first)
    @dump($cats->first)
    @dump($cats->first) --}}
@endsection

