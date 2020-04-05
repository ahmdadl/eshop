<div class="row mt-3">
    <div class="col-12 col-md-9">
        <h3 id='revs'>@lang('t.show.rev')</h3>
        <div class="card card-body col-12">
            <div class="d-block mx-auto w-75 text-center">
                <span class="border border-dark rounded-circle px-3 py-2">
                    <strong>{{$p->rateAvg}}</strong>
                </span>
                <div class="d-block pt-3">
                    <star-rate :percent="{{$p->rateAvg}}"></star-rate>
                </div>
                <p class="text-muted mt-1">
                    {{$p->rates->count()}} @lang('t.show.ratings')
                </p>
            </div>
            <div class="rateform">
                <h3>@lang('t.show.rateThis'):</h3>
                <star-rate :percent="0" :run="true"></star-rate>
            </div>
            <hr/>
            <div class="revS mt-4">
                    @foreach ($p->rates as $r)
                    <p class="m-0">
                        <star-rate :percent="{{$r->rate}}"></star-rate>
                    </p>
                    <p class="m-0">
                        @lang('t.show.by') <strong>{{$r->user->name}}</strong>
                        <span class="mx-2 badge badge-primary p-2">
                            <strong>{{$r->updated_at->format('d M Y')}}</strong>
                        </span>
                    </p>
                    <p>
                        {{$r->message}}
                    </p>
                    @unless ($loop->last)
                    <hr class="mb-3" />
                    @endunless
                    @endforeach
            </div>
        </div>
    </div>
</div>