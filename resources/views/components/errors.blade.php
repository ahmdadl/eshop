@props(['msg'])

@if ($errors->any() || isset($msg))
<div class="alert alert-danger text-center col-12">
    <p>
        <i
            class="fa fas fa-times border border-dark rounded-circle py-1 px-2 fa-2x"></i>
    </p>
    @isset ($msg)
    <strong class="d-block">{{$msg}}</strong>
    @else
    @foreach ($errors->all() as $err)
    <strong class="d-block">{{$err}}</strong>
    @endforeach
    @endisset
</div>
@endif