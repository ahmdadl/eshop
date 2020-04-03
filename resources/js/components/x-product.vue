<template>
    <div
        class="transition"
        :class="is_land ? 'col-12 col-md-6 col-lg-4' : 'col-6 col-sm-4 col-md-3'"
    >
        <div class="card" :class="is_land ? 'mb-3' : 'mb-1'">
            <div class="row" :class="is_land ? 'no-gutters' : ''">
                <div :class="is_land ? 'col-4' : 'col-12'">
                    <span class="badge badge-danger position-absolute">
                        {{ p.save }} % {{ lang[0] }}
                    </span>
                    <img
                        :src="'/img/' + p.img[0]"
                        class="card-img-top"
                        :alt="p.name + ' image'"
                    />
                </div>
                <div :class="is_land ? 'col-8' : 'col-12'">
                    <div class="card-body">
                        <h5 class="card-title">{{ p.name }}</h5>
                        <p class="card-text">
                            <strong class="text-primary">
                                {{ p.savedPrice }}
                                <p v-if="p.save" class="text-muted">
                                    <span class="text-dell">
                                        {{ p.price }}
                                    </span>
                                    <span :class="is_land ? 'ml-2' : 'd-block'">
                                        {{ lang[2] }} {{ p.youSave }}
                                    </span>
                                </p>
                            </strong>
                        </p>
                        <p>
                            <star-rate
                                :percent="p.rateAvg"
                                :count="p.rates.length"
                            ></star-rate>
                        </p>
                        <p v-if="is_land">
                            {{ p.info }}
                        </p>
                    </div>
                    <div
                        class="card-footer text-center"
                        :class="is_land ? 'border-none bg-white' : ''"
                    >
                        <button class="btn btn-primary btn-block">
                            {{ lang[1] }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
.badge {
    font-size: 0.8rem;
}
.no-gutters {
    .card-img-top {
        margin-top: 50%;
    }
}
</style>
<style lang="scss"></style>
<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import ProductInterface from "../interfaces/product";

@Component
export default class XProduct extends Vue {
    @Prop({ type: Object, required: true }) public product: ProductInterface;
    @Prop({ type: Array, required: true }) public lang: string[];
    @Prop({ type: Boolean }) public is_land: boolean;
    public p: ProductInterface;

    beforeMount() {
        this.p = this.$props.product;
    }
}
</script>
