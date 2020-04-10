import { Component } from "vue-property-decorator";
import Super from "./super";
import Category from "../interfaces/category";

export interface Dynamic {
    cats: Category[];
    subCat: Category[];
}

@Component
export default class UserProfile extends Super {
    public d: Dynamic = {
        cats: [],
        subCat: []
    };

    public onCatChange(ev) {
        const val = parseInt(ev.target.value);
        console.log(val);
        let arr = this.d.cats.filter(x => x.id === val);
        // @ts-ignore
        this.d.subCat = arr[0].sub_cat as Category[];
    }

    private loadCats() {
        let cats = document.getElementById("catsData") as HTMLInputElement;

        if (!cats) {
            return;
        }

        this.d.cats = JSON.parse(cats.value) || [];
    }

    beforeMount() {
        this.attachToGlobal(this, ["onCatChange"]);
    }

    mounted() {
        this.loadCats();
    }
}
