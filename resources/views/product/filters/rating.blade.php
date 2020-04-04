<x-filter-card title="Rating">
    <span class="rateContainer" v-on:click="h.d.rateFilter(4)">
        <star-rate :percent="4"></star-rate>
    </span>
    <span class="rateContainer" v-on:click="h.d.rateFilter(3)">
        <star-rate :percent="3"></star-rate>
    </span>
    <span class="rateContainer" v-on:click="h.d.rateFilter(2)">
        <star-rate :percent="2"></star-rate>
    </span>
    <span class="rateContainer" v-on:click="h.d.rateFilter(1)">
        <star-rate :percent="1"></star-rate>
    </span>
</x-filter-card>