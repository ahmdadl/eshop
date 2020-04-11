@props(['id', 'imgArr', 'slug'])

@php
$id = $id ?? bin2hex(random_bytes(5));
@endphp

<div id="carousel{{$id}}" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel{{$id}}" data-slide-to="0" class="active">
        </li>
        <li data-target="#carousel{{$id}}" data-slide-to="1"></li>
        <li data-target="#carousel{{$id}}" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        @foreach ($imgArr as $img)
        <div class="carousel-item {{$loop->index === 1 ? 'active' : ''}}">
            <img src="/img/{{$slug ?? ''}}/{{$img}}" class="d-block w-100" alt=".">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carousel{{$id}}" role="button"
        data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel{{$id}}" role="button"
        data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>