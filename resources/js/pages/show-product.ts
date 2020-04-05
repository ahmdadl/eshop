import { Component } from "vue-property-decorator";
import Super from "./super";
import Rates from "../interfaces/rates";
import Axios from "axios";

export interface UserRev {
    userId: number;
    rate: number;
    message: string;
}

export interface Dynamic {
    slug: string;
    userId: number;
    revData: Rates[];
    nextRevUrl: string;
    rateAvg: number;
    loadingRates: boolean;
    userRev: UserRev;
}

@Component
export default class ShowProduct extends Super {
    public d: Dynamic = {
        slug: "",
        revData: [],
        nextRevUrl: "",
        rateAvg: 0,
        loadingRates: false,
        userId: 0,
        userRev: { userId: 0, rate: 0, message: "" }
    };

    public loadRevs(append: boolean = false, path: string = this.d.nextRevUrl) {
        this.d.loadingRates = true;
        if (!append) {
            path = `p/${this.d.slug}/rates`;
        }

        Axios.get(path).then(res => {
            if (!res.data || !res.data.data) {
                this.d.loadingRates = false;
                return;
            }
            res.data = res.data.data;
            if (!append) {
                this.d.revData = [...res.data];
            } else {
                this.d.revData.concat(res.data);
            }
            this.d.rateAvg = this.getAvgRate();
            this.setUserRev(res.data);
            this.d.loadingRates = false;
        });
    }

    private setUserRev(d: Rates[]) {
        const r = d.filter(x => x.user_id === this.d.userId)[0];

        if (r) {
            this.d.userRev.userId = r.user_id;
            this.d.userRev.rate = r.rate;
            this.d.userRev.message = r.message as string;
        }
    }

    private getAvgRate() {
        const sum = this.d.revData.reduce((a, b) => a + Number(b.rate), 0);
        return parseFloat((sum / this.d.revData.length || 0).toFixed(1));
    }

    private getInpVal(id: string): any {
        return (document.getElementById(id) as HTMLInputElement).value;
    }

    beforeMount() {
        this.attachToGlobal(this, []);
    }

    mounted() {
        this.d.slug = this.getInpVal("productSlug");
        this.d.userId = this.getInpVal("userId");

        this.loadRevs();
    }
}
