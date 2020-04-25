<template>
    <div>
        <div
            class="modal fade"
            id="conoleTesterModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="conoleTesterModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="conoleTesterModalLabel">
                            Console Tester
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{doc}}
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="sass"></style>
<script lang="ts">
import { Component, Vue, Prop, Watch } from "vue-property-decorator";
import { Doc } from '../pages/console';

@Component
export default class ConsoleTester extends Vue {
    @Prop({ type: Boolean, required: true }) public show: boolean;
    @Prop({type: Object, required: true}) public doc: Doc;

    public showModal() {
        // @ts-ignore
        new Modal(
            document.getElementById("conoleTesterModal") as HTMLDivElement
        ).show();
    }

    public hideModal() {
        // @ts-ignore
        new Modal(
            document.getElementById("conoleTesterModal") as HTMLDivElement
        ).hide();
    }

    @Watch("show")
    onShowChange(val: boolean, oldVal: boolean) {
        this.showModal();
    }

    @Watch("doc")
    onDocChange(val: Doc, oldVal: Doc) {
        this.doc = val;
    }

    mounted() {}
}
</script>
