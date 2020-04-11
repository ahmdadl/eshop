<template>
    <div
        :id="'card' + p.id"
        class="transition float-left"
        :class="is_land ? 'col-12 col-md-6' : 'col-6 col-sm-4 col-md-3'"
    >
        <div class="card" :class="is_land ? 'mb-3' : 'mb-1'">
            <div class="row" :class="is_land ? 'no-gutters' : ''">
                <div :class="is_land ? 'col-4' : 'col-12'">
                    <span class="badge badge-danger position-absolute">
                        {{ p.save }} % {{ lang[0] }}
                    </span>
                    <img
                        :src="'/img/' + p.p_cat.parent.slug + '/' + p.img[0]"
                        class="card-img-top"
                        :alt="p.name + ' image'"
                    />
                </div>
                <div :class="is_land ? 'col-8' : 'col-12'">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a :href="'/p/' + p.slug">
                                {{ p.name }}
                            </a>
                        </h5>
                        <p class="card-text">
                            <strong class="text-primary">
                                {{ p.savedPrice }}
                                <p v-if="p.save" class="text-muted">
                                    <span class="text-dell">
                                        {{ p.price }}
                                    </span>
                                    <span v-if="is_land" class="ml-2">
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
                        <button
                            class="btn btn-primary btn-block"
                            @click="$emit('added', p)"
                            :disabled="p.amount < 1"
                        >
                            <span
                                :id="p.id + 'spinnerLoader'"
                                class="d-none spinner-border spinner-border-sm mr-1"
                                role="status"
                                aria-hidden="true"
                            ></span>
                            {{ lang[1] }}
                        </button>
                        <div v-if="isAdmin || isSuper" class="row mt-2">
                            <div class="col-6">
                                <a
                                    v-if="isSuper || isAdmin"
                                    :href="
                                        '/' +
                                            locale +
                                            '/user/' +
                                            userId +
                                            '/p/' +
                                            p.slug +
                                            '/edit'
                                    "
                                    class="btn btn-info"
                                >
                                    <i class="fa fas fa-edit"></i>
                                    {{ lang[3] }}
                                </a>
                            </div>
                            <div class="col-6">
                                <button
                                    v-if="isAdmin"
                                    class="btn btn-danger"
                                    @click="deleteProd()"
                                >
                                    <span
                                        :id="'spinnerDel' + p.id"
                                        :class="showLoader"
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true"
                                    ></span>
                                    <i class="fa fas fa-times"></i>
                                    {{ lang[4] }}
                                </button>
                            </div>
                        </div>
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
    @Prop({ type: String }) public catSlug: string;
    @Prop({ type: Boolean, default: false }) public isAdmin: boolean;
    @Prop({ type: Boolean, default: false }) public isSuper: boolean;
    @Prop({ type: Number, default: 0 }) public userId: number;
    public p: ProductInterface;
    public showLoader: string = "d-none";
    // public catSlug: string = "";

    public deleteProd() {
        this.$emit("delete", this.p);
        this.showLoader = "";
    }

    get locale() {
        return document.documentElement.lang;
    }

    beforeMount() {
        this.p = this.$props.product;
    }

    mounted() {
        // console.log(this.$props.product);
        // const h = document.location.href.split("/");
        // if (!h.indexOf("c") || !h[5]) return;
        // this.catSlug = "/" + h[5];
        // console.log(this.isSuper);
    }
}
</script>
