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
                @include('product.show.productInfo', [
                'type' => 'miniInfo'
                ])
                <p>
                    <a class="btn btn-outline-primary mt-2"
                        data-toggle="collapse" href="#readMorePrInfo"
                        role="button" aria-expanded="false"
                        aria-controls="readMorePrInfo">
                        @lang('t.show.rmore')
                    </a>
                </p>
                <div class="collapse" id="readMorePrInfo">
                    @include('product.show.productInfo', [
                    'type' => 'info'
                    ])
                </div>
            </div>
        </div>
    </div>
</div>