<div class="row mt-3">
    <input id="productSlug" type="hidden" value="{{$p->slug}}" />
    @auth
        <input id="userId" type="hidden" value="{{auth()->id()}}" />
    @endauth
    <div class="col-12 col-md-9">
        <h3 id='revs'>@lang('t.show.rev')</h3>
        <div class="card card-body col-12" v-if="!h.d.loadingRates">
            <div class="d-block mx-auto w-75 text-center">
                <span class="border border-dark rounded-circle px-3 py-2">
                    <strong>@{{h.d.rateAvg}}</strong>
                </span>
                <div class="d-block pt-3">
                    <star-rate :percent="h.d.rateAvg"></star-rate>
                </div>
                <p class="text-muted mt-1">
                    @{{h.d.revData.length}} @lang('t.show.ratings')
                </p>
            </div>
            <div class="rateform">
                <h3>@lang('t.show.rateThis'):</h3>
                <form>
                    <div class="form-group">
                        <star-rate :percent="h.d.userRev.rate" :run="true" v-on:rated="h.d.userRev.rate = $event"></star-rate>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label">@lang('t.show.rateMessage')</label>
                        <textarea type="text" class="form-control" v-model="h.d.userRev.message"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">@lang('t.show.rateBtn')</button>
                    </div>
                </form>
            </div>
            <hr />
            <div class="revS mt-4">
                <div v-for="(r, rteinx) in h.d.revData">
                        <p class="m-0">
                                <star-rate :percent="parseFloat(r.rate)"></star-rate>
                        </p>
                        <p class="m-0">
                            @lang('t.show.by') <strong>@{{r.user.name}}</strong>
                            <span class="mx-2 badge badge-primary p-2">
                                <strong>@{{r.updated}}</strong>
                            </span>
                        </p>
                        <p>
                            @{{r.message}}
                        </p>
                        <hr class="mb-3" v-if="rteinx !== h.d.revData.length-1" />
                </div>
            </div>
        </div>
        <div :class="h.d.loadingRates ? 'd-flex' : 'd-none'"
            class="d-none justify-content-center mt-2">
            <div class="spinner-border text-primary"
                style="width: 3rem; height: 3rem;" role="status">
                <div class="spinner-grow text-danger" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>