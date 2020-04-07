import { Component } from "vue-property-decorator";
import Super from "./super";
import Rates from "../interfaces/rates";
import Axios from "axios";

export interface UserRev {
    userId: number;
    id: number;
    index: number;
    rate: number;
    message: string;
    alreadyReved: boolean;
}

export interface Dynamic {
    slug: string;
    userId: number;
    revData: Rates[];
    revCount: number;
    nextRevUrl: string;
    rateAvg: number;
    loadingRates: boolean;
    updatingRates: boolean;
    userRev: UserRev;
    savingRev: boolean;
    lang: string[];
}

@Component
export default class ShowProduct extends Super {
    public d: Dynamic = {
        slug: "",
        revData: [],
        revCount: 0,
        nextRevUrl: "",
        rateAvg: 0,
        loadingRates: false,
        updatingRates: false,
        userId: 0,
        userRev: {
            userId: 0,
            id: 0,
            index: 0,
            rate: 0,
            message: "",
            alreadyReved: false
        },
        savingRev: false,
        lang: []
    };

    public loadRevs(append: boolean = false, path: string = this.d.nextRevUrl) {
        this.d.updatingRates = true;
        if (!append) {
            this.d.loadingRates = true;
            path = `p/${this.d.slug}/rates`;
        }

        Axios.get(path).then(res => {
            if (!res.data || !res.data.data) {
                this.d.loadingRates = false;
                this.d.updatingRates = false;
                this.showErrorToast();
                this.d.revData = [];
                return;
            }
            res = res.data;
            if (!append) {
                this.d.revData = [...res.data];
            } else {
                this.d.revData = [...this.d.revData.concat(res.data)];
                // console.log(this.d.revData);
            }
            // @ts-ignore
            this.d.nextRevUrl = res.next_page_url;
            // @ts-ignore
            this.d.revCount = res.total;
            this.d.rateAvg = this.getAvgRate();
            this.setUserRev(res.data);
            this.d.loadingRates = false;
            this.d.updatingRates = false;
        });
    }

    public addRev() {
        this.d.savingRev = true;
        let method = "post",
            path = `p/${this.d.slug}/rates`;

        if (this.d.userRev.alreadyReved) {
            method = "patch";
            path = `/rates/${this.d.userRev.id}`;
        }

        const r = {
            user_id: this.d.userId,
            rate: this.d.userRev.rate,
            message: this.d.userRev.message
        };

        Axios[method](path, r).then(res => {
            if (!res || !res.data || !res.data.obj) {
                this.d.savingRev = false;
                this.showErrorToast();
                return;
            }

            this.showToast(this.getLang(1), this.getLang(4), "success");

            if (this.d.userRev.alreadyReved) {
                this.d.revData[this.d.userRev.index].rate = res.data.obj.rate;
                this.d.revData[this.d.userRev.index].message =
                    res.data.obj.message;
                this.d.revData[this.d.userRev.index].updated =
                    res.data.obj.updated;
            } else {
                this.d.revData.unshift(res.data.obj);
            }
            this.d.userRev.id = parseInt(res.data.obj.id);
            this.d.userRev.userId = parseInt(res.data.obj.user_id);
            this.d.userRev.alreadyReved = true;
            this.d.savingRev = false;
        });
    }

    private setUserRev(d: Rates[]) {
        // @ts-ignore
        const userId = parseInt(this.d.userId);
        const r = d.filter((x, inx) => {
            if (x.user_id === userId) {
                this.d.userRev.index = inx;
                return x;
            }
        })[0];

        if (r) {
            this.d.userRev.userId = userId;
            this.d.userRev.id = Number(r.id);
            this.d.userRev.rate = Number(r.rate);
            this.d.userRev.message = (r.message as string) || "";
            this.d.userRev.alreadyReved = true;
        }
    }

    private getAvgRate() {
        const sum = this.d.revData.reduce((a, b) => a + Number(b.rate), 0);
        return parseFloat((sum / this.d.revData.length || 0).toFixed(1));
    }

    beforeMount() {
        this.attachToGlobal(this, ["addRev", "loadRevs"]);
    }

    mounted() {
        this.d.slug = this.getInpVal("productSlug");
        this.d.userId = parseInt(this.getInpVal("userId"));

        this.loadRevs();
    }
}
