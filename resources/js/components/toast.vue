<template>
    <div class="toast w-100 position-fixed transition" :class="cls">
        <div class="toast-header text-light" :class="'bg-' + type">
            <strong class="mr-auto">
                <i class="fa fas fa-exclamation-circle mr-2"></i>
                {{ title }}
            </strong>
            <button
                type="button"
                class="ml-2 mb-1 close"
                data-dismiss="toast"
                aria-label="Close"
                @click="hide()"
            >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ message }}
        </div>
    </div>
</template>
<style lang="scss" scoped>
.toast {
    bottom: 0;
    right: 0;
    z-index: 99;
}
</style>
<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
declare var Toast: any;
@Component
export default class Toastr extends Vue {
    @Prop({ type: String, required: true }) public title: string;
    @Prop({ type: String, required: true }) public message: string;
    @Prop({ type: String, required: true }) public type: string;
    public cls: string = "fade";

    public show() {
        this.cls = "showing";
        setTimeout(_ => this.hide(), 3000);
    }

    public hide() {
        this.cls = "fade";
        setTimeout(() => {
            this.cls += " d-none";
        }, 200);
    }

    mounted() {
        // this.show();
    }
}
</script>
