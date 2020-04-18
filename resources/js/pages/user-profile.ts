import { Component } from "vue-property-decorator";
import Super from "./super";
import Category from "../interfaces/category";
import Axios from "axios";

export interface Dynamic {
    cats: Category[];
    subCat: Category[];
    savingProduct: boolean;
    pimg: string;
}

@Component
export default class UserProfile extends Super {
    public d: Dynamic = {
        cats: [],
        subCat: [],
        savingProduct: false,
        pimg: ""
    };

    public onCatChange(ev) {
        const val = parseInt(ev.target.value);
        console.log(val);
        let arr = this.d.cats.filter(x => x.id === val);
        // @ts-ignore
        this.d.subCat = arr[0].sub_cat as Category[];
    }

    public validateForm(ev) {
        const form: HTMLFormElement = ev.target;

        document
            .querySelectorAll(":required")
            .forEach((x: HTMLInputElement) => {
                form.classList.remove("was-validated");

                if (!x.value || !(x.value as string).length) {
                    form.classList.add("was-validated");
                }
            });

        if (!form.classList.contains("was-validated")) {
            this.d.savingProduct = true;
            form.submit();
        }
    }

    public previewImg(ev) {
        const inp: HTMLInputElement = ev.target;
        if (!inp.files || !inp.files[0]) {
            this.d.pimg = "";
            return;
        }
        const reader = new FileReader();

        reader.onload = e => {
            this.d.pimg = (e.target as any).result;
        };

        reader.readAsDataURL((inp.files as FileList)[0]);
    }

    public deleteProduct(slug: string, id: number, inx: number) {
        this.removeClass(`#spinner${id}`, "d-none");

        Axios.post(`p/${slug}/delete`).then(
            res => {
                if (res.data && res.data.deleted) {
                    this.addClass(`#card${inx}`, "fade");
                    setTimeout(_ => this.removeEl(`#card${inx}`), 400);
                    this.showToast(this.getMessages(0), "------", "success");
                    return;
                }
                this.showErrorToast();
            }
        );
    }

    public updateRole(id: number, superRole: number) {
        const el = document.querySelector(`#btn${id}`);

        // show spinner loader
        this.removeClass(`#spinnerUpdating${id}`, "d-none");
        let role = !!parseInt(
            (el as HTMLElement).getAttribute("user-role") as string
        );

        Axios.post(`user/${id}/role/up`, { super: role }).then(res => {
            if (!res.data || !res.data.updated) {
                this.addClass(`#spinnerUpdating${id}`, "d-none");
                this.showErrorToast();
                return;
            }

            (el as HTMLElement).setAttribute("user-role", role ? "0" : "1");

            if (role) {
                // update user to become a super user
                ((el as HTMLElement).children.item(
                    1
                ) as HTMLElement).textContent = this.getMessages(1);
                this.addClass(`#isSuper${id}`, "d-none");
                this.removeClass(`#notSuper${id}`, "d-none");
            } else {
                // update user to remove super role
                ((el as HTMLElement).children.item(
                    1
                ) as HTMLElement).textContent = this.getMessages(0);
                this.removeClass(`#isSuper${id}`, "d-none");
                this.addClass(`#notSuper${id}`, "d-none");
            }

            // hide loader
            this.addClass(`#spinnerUpdating${id}`, "d-none");
        });
    }

    private loadCats() {
        let cats = document.getElementById("catsData") as HTMLInputElement;

        if (!cats) {
            return;
        }

        this.d.cats = JSON.parse(cats.value) || [];
    }

    private getMessages(num: number) {
        const val = (document.querySelector(`#userLang`) as HTMLInputElement)
            .value;

        return JSON.parse(val as string)[num];
    }

    beforeMount() {
        this.attachToGlobal(this, [
            "onCatChange",
            "validateForm",
            "previewImg",
            "deleteProduct",
            "updateRole"
        ]);
    }

    mounted() {
        this.loadCats();
    }
}
