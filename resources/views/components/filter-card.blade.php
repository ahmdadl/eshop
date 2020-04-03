@props(['title', 'show'])

<div class="card">
    <div class="card-header">
        <span class="float-left">@lang('t.' . strtolower($title))</span>
        <span class="float-right">
            <button class="btn btn-primary" type="button" data-toggle="collapse"
                data-target="#collabse{{$title}}List" aria-expanded="true"
                aria-controls="collabse{{$title}}List"
                v-on:click="h.d.toogleCollabseButton($refs.collabse{{$title}}.classList.contains('show'), 'collabse{{$title}}')">
                <span
                    v-text="h.d.collabse.id === 'collabse{{$title}}' ? h.d.collabse.txt : '+'"></span>
            </button>
        </span>
    </div>
    <div ref="collabse{{$title}}" class="collapse @if(isset($show)) show @endif"
        id="collabse{{$title}}List">
        <div class="card card-body">
            {{$slot}}
        </div>
    </div>
</div>