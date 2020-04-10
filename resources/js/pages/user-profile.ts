import { Component } from "vue-property-decorator";
import Super from "./super";
import Category from "../interfaces/category";

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
            this.d.pimg = '';
            return;
        }
            const reader = new FileReader();

            reader.onload = e => {
                this.d.pimg = (e.target as any).result;
            };

            reader.readAsDataURL((inp.files as FileList)[0]);
    }

    private loadCats() {
        let cats = document.getElementById("catsData") as HTMLInputElement;

        if (!cats) {
            return;
        }

        this.d.cats = JSON.parse(cats.value) || [];
    }

    beforeMount() {
        this.attachToGlobal(this, [
            "onCatChange",
            "validateForm",
            "previewImg"
        ]);
    }

    mounted() {
        this.loadCats();
    }
}
