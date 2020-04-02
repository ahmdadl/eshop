@extends('layouts.app', ["cpt" => 'home'])

@section('title')
    EShop HomePage
@endsection

@section('content')
{{-- <div v-if="h.allData">
    <ul>
        <li v-for="c in h.allData">
            @{{c.name}}
</li>
</ul>
<div v-if="!h.allData.length" class="alert alert-danger fade">
    <strong>asdasd</strong>
</div>
<div v-if="h.allData.length" class="alert alert-sucess fade">
    <strong>asdasd</strong>
</div>

</div>
@{{h.allData}} --}}
{{-- <div v-if="h">
    <h3>@{{h.name}}</h3>
</div>
<h1>@{{h.id}}</h1>--}}


    <button v-on:click="h.d.log">asdasd</button><br>
    <button v-on:click="h.d.name = 'rand' + Math.random()">changeName</button><br>
    @{{h.d}}<br>
    @{{h.d.name}}<br>
    @{{h.d.test}}<br>
@endsection