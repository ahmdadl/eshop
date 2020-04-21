<style scoped>
.action-link {
    cursor: pointer;
}
</style>

<template>
    <div>
        <div class="card card-default">
            <div class="card-header bg-primary text-light">
                <div
                    style="display: flex; justify-content: space-between; align-items: center;"
                >
                    <span>
                        OAuth Clients
                    </span>

                    <a
                        class="action-link text-light"
                        tabindex="-1"
                        @click="showCreateClientForm"
                    >
                        <i class="fa fa-plus"></i>
                        Create New Client
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Current Clients -->
                <p class="mb-0" v-if="!loadingClients && clients.length === 0">
                    You have not created any OAuth clients.
                </p>

                <div
                    v-if="loadingClients"
                    class="d-flex justify-content-center mt-2"
                >
                    <div
                        class="spinner-border text-primary"
                        style="width: 3rem; height: 3rem;"
                        role="status"
                    >
                        <div class="spinner-grow text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <table
                    class="table table-borderless mb-0 table-striped"
                    v-if="clients.length > 0"
                >
                    <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Name</th>
                            <th>Secret</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(client, cinxa) in clients" :key="cinxa">
                            <!-- ID -->
                            <td style="vertical-align: middle;">
                                {{ client.id }}
                            </td>

                            <!-- Name -->
                            <td style="vertical-align: middle;">
                                {{ client.name }}
                            </td>

                            <!-- Secret -->
                            <td style="vertical-align: middle;">
                                <code>{{ client.secret }}</code>
                            </td>

                            <!-- Edit Button -->
                            <td style="vertical-align: middle;">
                                <a
                                    class="action-link"
                                    tabindex="-1"
                                    @click="edit(client)"
                                >
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a
                                    class="action-link text-danger"
                                    @click="destroy(client)"
                                >
                                    <span
                                        :id="'spinnerDelete' + client.id"
                                        class="d-none spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true"
                                    ></span>
                                    <i class="fa fa-times"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Client Modal -->
        <div
            class="modal fade"
            id="modal-create-client"
            tabindex="-1"
            role="dialog"
            ref="createModal"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">
                            Create Client
                        </h4>

                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-hidden="true"
                        >
                            &times;
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div
                            class="alert alert-danger"
                            v-if="createForm.errors.length > 0"
                        >
                            <p class="mb-0">
                                <strong>Whoops!</strong> Something went wrong!
                            </p>
                            <br />
                            <ul>
                                <li
                                    v-for="(error,
                                    errinx3) in createForm.errors"
                                    :key="errinx3"
                                >
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Client Form -->
                        <form role="form" class="needs-validation">
                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Name</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="create-client-name"
                                        type="text"
                                        class="form-control"
                                        :class="
                                            !createForm.name.length
                                                ? 'is-invalid'
                                                : ''
                                        "
                                        @keyup.enter="store"
                                        v-model="createForm.name"
                                    />

                                    <span class="form-text text-muted">
                                        Something your users will recognize and
                                        trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Redirect URL -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Redirect URL</label
                                >

                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        :class="
                                            !createForm.redirect.length
                                                ? 'is-invalid'
                                                : ''
                                        "
                                        name="redirect"
                                        @keyup.enter="store"
                                        v-model="createForm.redirect"
                                    />

                                    <span class="form-text text-muted">
                                        Your application's authorization
                                        callback URL.
                                    </span>
                                </div>
                            </div>

                            <!-- Confidential -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Confidential</label
                                >

                                <div class="col-md-9">
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                type="checkbox"
                                                v-model="
                                                    createForm.confidential
                                                "
                                            />
                                        </label>
                                    </div>

                                    <span class="form-text text-muted">
                                        Require the client to authenticate with
                                        a secret. Confidential clients can hold
                                        credentials in a secure way without
                                        exposing them to unauthorized parties.
                                        Public applications, such as native
                                        desktop or JavaScript SPA applications,
                                        are unable to hold secrets securely.
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="store"
                            :disabled="
                                !createForm.name.length ||
                                    !createForm.redirect.length
                            "
                        >
                            <span
                                id="createModalSpinner"
                                class="d-none spinner-border spinner-border-sm"
                                role="status"
                                aria-hidden="true"
                            ></span>
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Client Modal -->
        <div
            class="modal fade"
            id="modal-edit-client"
            tabindex="-1"
            role="dialog"
            ref="editModal"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h4 class="modal-title">
                            Edit Client
                        </h4>

                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-hidden="true"
                        >
                            &times;
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div
                            class="alert alert-danger"
                            v-if="editForm.errors.length > 0"
                        >
                            <p class="mb-0">
                                <strong>Whoops!</strong> Something went wrong!
                            </p>
                            <br />
                            <ul>
                                <li
                                    v-for="(error, inxErr) in editForm.errors"
                                    :key="inxErr"
                                >
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Edit Client Form -->
                        <form role="form" class="needs-validation">
                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Name</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="edit-client-name"
                                        type="text"
                                        class="form-control"
                                        :class="
                                            !editForm.name.length
                                                ? 'is-invalid'
                                                : ''
                                        "
                                        @keyup.enter="update"
                                        v-model="editForm.name"
                                        required
                                    />

                                    <span class="form-text text-muted">
                                        Something your users will recognize and
                                        trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Redirect URL -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Redirect URL</label
                                >

                                <div class="col-md-9">
                                    <input
                                        type="url"
                                        class="form-control"
                                        :class="
                                            !editForm.redirect.length
                                                ? 'is-invalid'
                                                : ''
                                        "
                                        name="redirect"
                                        @keyup.enter="update"
                                        v-model="editForm.redirect"
                                        required
                                    />

                                    <span class="form-text text-muted">
                                        Your application's authorization
                                        callback URL.
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="update"
                            :disabled="
                                !editForm.redirect.length ||
                                    !editForm.name.length
                            "
                        >
                            <span
                                id="editModalSpinner"
                                class="d-none spinner-border spinner-border-sm"
                                role="status"
                                aria-hidden="true"
                            ></span>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Axios from "axios";
import { Vue, Component } from "vue-property-decorator";

@Component
export default class Clients extends Vue {
    public clients: [] = [];
    public loadingClients = false;

    public createForm: any = {
        errors: [],
        name: "",
        redirect: "",
        confidential: true
    };

    public editForm: any = {
        errors: [],
        name: "",
        redirect: ""
    };

    protected $(selector: string): HTMLElement {
        return document.querySelector(selector) as HTMLElement;
    }

    public prepareComponent() {
        this.getClients();

        this.$("#modal-create-client").addEventListener(
            "shown.bs.modal",
            () => {
                this.$("#create-client-name").focus();
            }
        );

        this.$("#modal-edit-client").addEventListener("shown.bs.modal", () => {
            this.$("#edit-client-name").focus();
        });
    }

    /**
     * Get all of the OAuth clients for the user.
     */
    public getClients() {
        this.loadingClients = true;
        this.clients = [];
        Axios.get("/oauth/clients", { baseURL: "" }).then(response => {
            this.clients = response.data;
            this.loadingClients = false;
        });
    }

    /**
     * Show the form for creating new clients.
     */
    public showCreateClientForm() {
        this.showModal("createModal");
    }

    /**
     * Create a new OAuth client for the user.
     */
    public store() {
        this.persistClient(
            "post",
            "/oauth/clients",
            this.createForm,
            "createModal"
        );
    }

    /**
     * Edit the given client.
     */
    public edit(client) {
        this.editForm.id = client.id;
        this.editForm.name = client.name;
        this.editForm.redirect = client.redirect;

        this.showModal("editModal");
    }

    /**
     * Update the client being edited.
     */
    public update() {
        this.persistClient(
            "post",
            "/api/oauth/clients/update/" + this.editForm.id,
            this.editForm,
            "editModal"
        );
    }

    /**
     * Persist the client to storage using the given form.
     */
    private persistClient(method, uri, form, modal) {
        form.errors = [];
        this.showBtnLoader(modal);

        Axios[method](uri, form, { baseURL: "" })
            .then(response => {
                if (!response) {
                    form.errors = ["Something went wrong. Please try again."];
                    return;
                }
                this.getClients();

                form.name = "";
                form.redirect = "";
                form.errors = [];

                this.hideBtnLoader(modal);
                this.hideModal(modal);
            })
            .catch(error => {
                form.errors = ["Something went wrong. Please try again."];
                this.hideBtnLoader(modal);
            });
    }

    /**
     * Destroy the given client.
     */
    public destroy(client) {
        (document.querySelector(
            `#spinnerDelete${client.id}`
        ) as HTMLSpanElement).classList.toggle("d-none");
        Axios.post("oauth/clients/" + client.id + "/delete", {
            baseURL: ""
        }).then(response => {
            this.getClients();
            (document.querySelector(
                `#spinnerDelete${client.id}`
            ) as HTMLSpanElement).classList.toggle("d-none");
        });
    }

    private showModal(refKey: string, options = { backdrop: "static" }) {
        // @ts-ignore
        new Modal(this.$refs[refKey], options).show();
    }

    private hideModal(refKey: string) {
        // @ts-ignore
        new Modal(this.$refs[refKey]).hide();
    }

    private showBtnLoader(parentRef: string) {
        (document.querySelector(
            `#${parentRef}Spinner`
        ) as HTMLElement).classList.remove("d-none");
    }

    private hideBtnLoader(parentRef: string) {
        (document.querySelector(
            `#${parentRef}Spinner`
        ) as HTMLElement).classList.add("d-none");
    }

    mounted() {
        this.prepareComponent();
    }
}
</script>
