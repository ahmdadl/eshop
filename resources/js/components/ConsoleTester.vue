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
                    <div class="modal-header bg-primary text-light">
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
                        <form class="needs-validation was-validated">
                            <div class="row form-group">
                                <div class="col-4 form-label">Token</div>
                                <div class="col-8">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="token"
                                        required="true"
                                    />
                                </div>
                            </div>
                            <div class="row mt-2">
                                <hr />
                                <span
                                    class="bg-dark text-danger"
                                    v-if="!clients.length"
                                >
                                    you didn`t create any api clients create new
                                    one from user section
                                </span>
                                <div class="col-12">
                                    <h6>Select Client</h6>
                                    <button
                                        type="button"
                                        class="btn btn-primary btnClient mb-2 mr-2 transition"
                                        v-for="(c, cinx) in clients"
                                        :key="cinx"
                                        @click="setClient(cinx, $event)"
                                    >
                                        <i class="fa fa-check text-success mr-1"></i>
                                        {{ c.name }}
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div
                                    class="col-12"
                                    v-if="doc.url_params.length"
                                >
                                    <hr />
                                    <h5>Url PARAMETER</h5>
                                    <div
                                        class="row form-group"
                                        v-for="(url, uinx) in doc.url_params"
                                        :key="uinx"
                                    >
                                        <div class="col-4 form-label font-weight-bold">
                                            {{ url.key }}
                                        </div>
                                        <div class="col-8">
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="url_params[uinx]"
                                                :required="url.req"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12" v-if="doc.query.length">
                                    <hr />
                                    <h5>Query PARAMETER</h5>
                                    <div
                                        class="row form-group"
                                        v-for="(q, qinx) in doc.query"
                                        :key="qinx"
                                    >
                                        <div class="col-4 form-label font-weight-bold">
                                            {{ q.key }}
                                        </div>
                                        <div class="col-8">
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="query[qinx]"
                                                :required="q.req"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-secondary">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Connect
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
import { Doc, Param } from "../pages/console";

@Component
export default class ConsoleTester extends Vue {
    @Prop({ type: Boolean, required: true }) public show: boolean;
    @Prop({ type: Object, required: true }) public doc: Doc;
    @Prop({ type: Array }) public clients: ClientData[];
    public token: string = "";
    public clientId: number = 0;
    public isEdit: boolean = false;
    public query: Param[] = [];
    public url_params: Param[] = [];
    public activeClient: ClientData = this.clients[0];

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

    public setClient(inx: number, ev: Event) {
        this.activeClient = this.clients[inx];
        console.log(this.activeClient);
        this.$emit('remove-active-class', '.btnClient');
        setTimeout(_ => (ev.target as HTMLButtonElement).classList.add('active'));
    }

    @Watch("show")
    onShowChange(val: boolean, oldVal: boolean) {
        this.showModal();
    }

    @Watch("doc")
    onDocChange(val: Doc, oldVal: Doc) {
        this.doc = val;
        // console.log(this.doc);
    }

    mounted() {
        this.token = "*".repeat(50);
    }
}
</script>
