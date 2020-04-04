<x-filter-card title="Price">
    <div class="row">
        <div class="col-8">
            <label for="fromPriceRange">@lang('t.fromPrice')</label>
            <input type="range" class="custom-range" min="0"
                :max="h.d.range.max" v-model="h.d.range.from"
                id="fromPriceRange">
        </div>
        <div class="col-4 form-group pt-3">
            <input type="number" min="0" :max="h.d.range.max"
                class="form-control" v-model="h.d.range.from"
                placeholder="@lang('t.fromPrice')" />
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <label for="toPriceRange">@lang('t.toPrice')</label>
            <input type="range" class="custom-range" min="0"
                :max="h.d.range.max" id="toPriceRange" v-model="h.d.range.to">
        </div>
        <div class="col-4 form-group pt-3">
            <input type="number" min="0" :max="h.d.range.max"
                class="form-control" v-model="h.d.range.to"
                placeholder="@lang('t.toPrice')" />
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-primary btn-block" v-on:click="h.d.filterByPrice()">
                @lang('t.search')
            </button>
        </div>
    </div>
</x-filter-card>