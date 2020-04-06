@props(['showIf'])

<span @isset($showIf) :class="{{$showIf}} ? '' : 'd-none'" @endisset
    class="spinner-border spinner-border-sm" role="status"
    aria-hidden="true"></span>