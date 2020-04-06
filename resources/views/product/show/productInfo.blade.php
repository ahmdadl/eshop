@if (isset($p->pi->info))
@foreach ($p->pi->{$type} as $k => $v)
<span class="text-uppercase mt-1"><strong>{{$k}}:</strong></span>
<span class="text-capitalize mx-1">
    @if (is_bool($v))
    @if ($v) <i class="fas fa-check text-success mx-2 fa-2x"></i>
    @else <i class="fas fa-times text-danger mx-2 fa-2x"></i>
    @endif
    @else
    {{$v}}
    @endif
</span><br>
@endforeach
@endif