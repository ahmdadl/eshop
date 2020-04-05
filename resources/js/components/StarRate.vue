<template>
    <div>
        <span class="performance-rating" @mousemove="hover" @click="set">
            <i class="fa star-unfilled star">
                &#xf005;&#xf005;&#xf005;&#xf005;&#xf005;
                <i
                    :style="{ width: w + '%' }"
                    class="fa star-filled star star-visible"
                    >&#xf005;&#xf005;&#xf005;&#xf005;&#xf005;</i
                >
            </i>
        </span>
        <span class="text-muted mx-1" v-if="count"> ({{ count }}) </span>
    </div>
</template>
<style lang="scss">
.performance-rating:hover {
    cursor: pointer;
}
.star {
    position: relative;
    display: inline-block;
    font-size: 16px;
    letter-spacing: 1px;
    white-space: nowrap;
    &.star-unfilled {
        color: #ddd;
    }
    &.star-filled {
        color: #ffd54f;
        overflow: hidden;
        position: absolute;
        top: 0;
        left: 0;
        display: inline-block;
    }
}
</style>

<script lang="ts">
import { Vue, Prop, Component, Watch } from "vue-property-decorator";
@Component
export default class StarRate extends Vue {
    @Prop({ type: Number, required: true }) public percent: number;
    @Prop({ type: Number, required: false }) public count: number;
    @Prop({ type: Boolean }) public run: boolean;
    public w: number = 0;

    private extractX(event): number {
        var rect = event.target.getBoundingClientRect();
        var x = event.clientX - rect.left;
        return x;
    }

    public hover(ev): void {
        if (!this.$props.run) return;
        this.w = this.extractX(ev);
    }

    public set(ev): void {
        if (!this.$props.run) return;
        this.w = this.extractX(ev);
    }

    mounted() {
        this.w = (this.percent / 5) * 100;
    }

    @Watch("percent")
    onPercentChanged(val: number, oldVal: number) {
        this.w = (this.percent / 5) * 100;
    }

    @Watch('run')
    onRunChanged(val: boolean, oldVal: boolean) {
        this.run = val;
    }
}
</script>
