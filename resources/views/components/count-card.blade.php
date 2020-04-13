@props(['title', 'count', 'money'])

<div class="card mt-4 mx-2">
    <div class="card-header bg-primary text-light">
        {{$title}}
    </div>
    <div class="card-body text-center">
        <h1 class="text-primary">
            @isset($money)$@endisset{{$count}}
        </h1>
    </div>
</div>