import { Component } from "vue-property-decorator";
import Super from "./super";
import Rates from "../interfaces/rates";
import Axios from "axios";

export interface Dynamic {
    slug: string;
    revData: Rates[];
    nextRevUrl: string;
    rateAvg: number;
    loadingRates: boolean;
}

@Component
export default class ShowProduct extends Super {
    public d: Dynamic = {
        slug: "",
        revData: [],
        nextRevUrl: "",
        rateAvg: 0,
        loadingRates: false,
    };

    public loadRevs(append: boolean = false, path: string = this.d.nextRevUrl) {
        this.d.loadingRates = true;
        if (!append) {
            path = `p/${this.d.slug}/rates`;
        }

        Axios.get(path).then(res => {
            if (!append) {
                this.d.revData = res.data.data;
            } else {
                this.d.revData.concat(res.data.data);
            }
            this.d.rateAvg = this.getAvgRate();
            this.d.loadingRates = false;
        });
    }

    private getAvgRate() {
        const sum = this.d.revData.reduce((a, b) => a + Number(b.rate), 0);
        return parseFloat((sum / this.d.revData.length || 0).toFixed(1));
    }

    beforeMount() {
        this.attachToGlobal(this, []);
    }

    mounted() {
        this.d.slug = (document.getElementById(
            "productSlug"
        ) as HTMLInputElement).value;

        this.loadRevs();
    }
}
