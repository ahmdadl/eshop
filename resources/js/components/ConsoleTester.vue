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
                                <div
                                    class="col-12"
                                    v-show="errors.length !== 0"
                                >
                                    <div class="alert alert-danger">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item bg-transparent"
                                                v-for="(err, errinx) in errors"
                                                :key="errinx"
                                            >
                                                * {{ err[0] }}
                                            </li>
                                        </ul>
                                    </div>
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
                                        <div
                                            class="col-4 form-label font-weight-bold"
                                        >
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
                                        <div
                                            class="col-4 form-label font-weight-bold"
                                        >
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
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="connect()"
                        >
                            <span
                                v-if="connecting"
                                class="spinner-border spinner-border-sm"
                                role="status"
                                aria-hidden="true"
                            ></span>
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
import Axios from "axios";

@Component
export default class ConsoleTester extends Vue {
    @Prop({ type: Boolean, required: true }) public show: boolean;
    @Prop({ type: Object, required: true }) public doc: Doc;
    @Prop({ type: Array }) public clients: any[];
    public token: string = "";
    public clientId: number = 0;
    public isEdit: boolean = false;
    public query: any[] = [];
    public url_params: any[] = [];
    public activeClient: any = this.clients[0];
    public connecting: boolean = false;
    public url: string = "";
    public errors: any[] = [];

    public showModal() {
        // @ts-ignore
        new Modal(
            document.getElementById("conoleTesterModal") as HTMLDivElement
        ).show();

        this.url_params = [];
        this.query = [];
        this.errors = [];
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
        this.$emit("remove-active-class", ".btnClient");
        setTimeout(_ =>
            (ev.target as HTMLButtonElement).classList.add("active")
        );
    }

    public connect() {
        this.connecting = true;
        this.errors = [];
        this.buildUrl();
        console.log(this.url);
        const data = this.buildFormData();

        Axios.post("console/test", data).then(res => {
            if (res.status > 204) {
                this.connecting = false;
                // if this validation error
                if (res.status === 422) {
                    this.errors = res.data;
                    return;
                }
                this.errors = [['an Error occured with code ' + res.status]];
                return;
            }

            this.$emit('success', {
                res: res.data,
                url: this.url
            });
            this.connecting = false;
            this.hideModal();
        });
    }

    private buildUrl() {
        this.url = this.doc.url_with_params;

        // get query assign sign ?
        const queryPos = this.url.indexOf("?");
        // remove empty queries from url
        if (queryPos > -1) this.url = this.url.slice(0, queryPos);

        // replace url params keys with values
        this.url_params.map((u, i) => {
            const re = new RegExp("{" + this.doc.url_params[i].key + "}", "gi");
            this.url = this.url.replace(re, encodeURI(u));
        });

        // add query to url key=value
        this.query.map((u, i) => {
            u = encodeURI(u);
            if (i === 0) {
                this.url += `?${this.doc.query[i].key}=${u}`;
            } else {
                this.url += `&${this.doc.query[i].key}=${u}`;
            }
        });
    }

    private buildFormData(): FormData {
        const f = new FormData();
        f.append("method", this.doc.method);
        f.append("url", this.url);
        f.append("token", this.token);
        this.query.map((q, i) => {
            f.append(this.doc.query[i].key, q);
        });
        if (this.activeClient) {
            f.append("client_id", this.activeClient.id);
        }
        return f;
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
