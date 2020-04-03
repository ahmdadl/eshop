import { Component } from "vue-property-decorator";
import Super from "./super";
import Axios from "axios";
import ProductInterface from "../interfaces/product";
import Rates from "../interfaces/rates";

export interface Dynamic {
    data: ProductInterface[];
    nextUrl: string;
    slug: string[];
    loadingPosts: boolean;
    is_land_product: boolean;
    filters: string[];
    currentFilter: number | 0 | 1 | 2 | 3;
    brands: Filter[];
    colors: Filter[];
    conditions: Filter[];
    collabse: { id: string; txt?: string };
    range: { from: number; to: number; max: number };
}

export interface Filter {
    txt: string;
    checked: boolean;
}

@Component
export default class Product extends Super {
    d: Dynamic = {
        data: [],
        nextUrl: "",
        slug: [],
        loadingPosts: false,
        is_land_product: false,
        filters: [
            "popularity",
            "top rated",
            "price: low to high",
            "price: high to low"
        ],
        currentFilter: 0,
        brands: [],
        colors: [],
        conditions: [],
        collabse: { id: "", txt: "" },
        range: { from: 0, to: 0, max: 0 }
    };
    public oldData: ProductInterface[];

    public foramtMony(n: number): any {
        return this.formatter.format(n);
    }
    public sortData(finx: number | 1 | 2 | 3 | 4) {
        const arr = [...this.oldData];

        let callback = (a: ProductInterface, b: ProductInterface) => {
            return b.rates.length - a.rates.length; // popularity
        };
        if (finx === 2) {
            callback = (a: ProductInterface, b: ProductInterface) => {
                return (b.rateAvg as number) - (a.rates.length as number);
            };
        } else if (finx === 3) {
            callback = (a: ProductInterface, b: ProductInterface) => {
                return a.savedPriceInt - b.savedPriceInt;
            };
        } else if (finx === 4) {
            callback = (a: ProductInterface, b: ProductInterface) => {
                return b.savedPriceInt - a.savedPriceInt;
            };
        }

        this.d.data = this.oldData.sort(callback);
    }

    public filterData(finx: number): void {
        if (this.d.currentFilter === finx - 1) {
            console.info("is same");
            return;
        }

        this.d.currentFilter = finx - 1;

        this.d.data = [];
        this.showLoader();

        setTimeout(_ => {
            this.sortData(finx);
            this.hideLoader();
        }, 500);
    }

    public loadData(
        subSlug: string = this.d.slug[1],
        nextPath: string | null = null
    ): void {
        this.d.data = [];
        this.showLoader();
        const path = !nextPath ? `sub/${subSlug}` : nextPath;
        Axios.get(path).then((res: any) => {
            res = res.data;
            res.data.map((x: ProductInterface) => {
                x.priceInt = x.price as number;
                x.savedPriceInt = x.savedPrice as number;
                x.youSave = this.foramtMony(
                    (x.price as number) - (x.savedPrice as number)
                );
                x.price = this.foramtMony(x.price as number);
                (x.savedPrice as number) = this.foramtMony(
                    x.savedPrice as number
                );
                return x;
            });
            // this.d.data = res.data;
            this.oldData = [...res.data];
            this.d.nextUrl = res.next_page_url;
            this.doCalc();
            this.sortData(1);
            this.hideLoader();
        });
    }

    public toogleCollabseButton(isShown: boolean, refId: string) {
        this.d.collabse.id = refId;
        this.d.collabse.txt = isShown ? "+" : "-";
    }

    private doCalc() {
        const prices: number[] = [];
        this.oldData.map(x => {
            this.d.brands.push({
                txt: x.brand as string,
                checked: false
            });
            this.d.colors.push({
                txt: x.color[0],
                checked: false
            });
            prices.push(x.savedPriceInt);
            return x;
        });
        this.d.conditions = [
            {
                txt: "New",
                checked: false
            },
            {
                txt: "Used",
                checked: false
            }
        ];

        // sort prices
        prices.sort();
        this.d.range.max = Number(prices[prices.length - 1].toFixed(2));
    }

    private showLoader() {
        this.d.loadingPosts = true;
    }
    private hideLoader() {
        this.d.loadingPosts = false;
    }

    beforeMount() {
        this.attachToGlobal(this, ["filterData", "toogleCollabseButton"]);

        const [cat, sub] = this.extractRoute();
        this.d.slug = [cat, sub];

        this.loadData(sub);
    }

    mounted() {}
}
