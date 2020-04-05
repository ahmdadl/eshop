<div class="row mt-3">
    <div class="col-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#spec">@lang('t.show.spec')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#revs">@lang('t.show.rev')</a>
            </li>
        </ul>
    </div>
    <div class="col-12">
        <h3 id="spec">@lang('t.show.pi')</h3>
        <div class="card">
            <div class="card-body">
                @foreach ($p->pi->miniInfo as $k => $v)
                <span class="text-uppercase"><strong>{{$k}}:</strong></span>
                <span class="text-capitalize">{{$v}}</span><br>
                @endforeach
            </div>
        </div>
    </div>
</div>