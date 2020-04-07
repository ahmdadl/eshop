import { Component } from "vue-property-decorator";
import Super from "./super";
import Axios from "axios";
import ProductInterface from "../interfaces/product";
import Rates from "../interfaces/rates";

export interface Dynamic {
    prosDataInp: string;
    data: ProductInterface[];
    oldData: ProductInterface[];
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
    selected: { brands: string[]; colors: string[]; conditions: string };
    scroll: number;
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
        range: { from: 0, to: 0, max: 0 },
        selected: {
            brands: [],
            colors: [],
            conditions: ""
        },
        oldData: [],
        scroll: 0,
        prosDataInp: ""
    };
    // public d.oldData: ProductInterface[];

    public foramtMony(n: number): any {
        return this.formatter.format(n);
    }
    public sortData(finx: number | 1 | 2 | 3 | 4) {
        const arr = [...this.d.oldData];

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

        this.d.data = this.d.oldData.sort(callback);
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
        const path = !nextPath ? `sub/${subSlug}` : nextPath;
        if (subSlug && subSlug.length) {
            this.getDataFromServer(path, true);
            return;
        }
        this.setDataFromPHP();
    }

    public toogleCollabseButton(isShown: boolean, refId: string) {
        this.d.collabse.id = refId;
        this.d.collabse.txt = isShown ? "+" : "-";
    }

    public filterByBrands() {
        let path;
        if (this.d.selected.brands.length) {
            path = `sub/${
                this.d.slug[1]
            }/filterBrands/${this.d.selected.brands.join(",")}`;
        }

        this.getDataFromServer(path);
    }

    public filterByColors() {
        if (!this.d.selected.colors.length) {
            this.d.data = [...this.d.oldData];
            return;
        }

        const arr = [...this.d.oldData];
        this.d.data = arr.filter(
            x => this.d.selected.colors.indexOf(x.color[0]) > -1
        );
    }

    public filterByConditions() {
        const val = this.d.selected.conditions === "Used" ? 1 : 0;
        this.getDataFromServer(`sub/${this.d.slug[1]}/filterCondition/${val}`);
    }

    public filterByPrice() {
        // @ts-ignore
        const from = parseFloat(this.d.range.from);
        // @ts-ignore
        const to = parseFloat(this.d.range.to);

        this.getDataFromServer(
            `sub/${this.d.slug[1]}/priceFilter/${from}/${to}`
        );
    }

    public rateFilter(starCount: number) {
        const arr = this.d.oldData.filter(
            x => (x.rateAvg as number) >= starCount
        );

        this.d.data = [];

        this.showLoader();

        setTimeout(_ => {
            this.d.data = arr;
            this.hideLoader();
        }, 300);
    }

    public removeAllfilters() {
        this.d.selected = {
            brands: [],
            colors: [],
            conditions: ""
        };

        this.getDataFromServer();
    }

    public checkIfReachedBottom() {
        window.onscroll = event => {
            this.d.scroll =
                document.documentElement.clientHeight +
                document.documentElement.scrollTop;

            // check if user has reached the end of page
            if (
                this.d.scroll >=
                    (document.querySelector(
                        "#component-container"
                    ) as HTMLDivElement).scrollHeight &&
                this.d.data.length &&
                null !== this.d.nextUrl &&
                !this.d.loadingPosts
            ) {
                this.getDataFromServer(this.d.nextUrl, true, true);
            }
        };
    }

    private setDataFromPHP() {
        const d = (document.getElementById("prosData") as HTMLInputElement)
            .value;
        const res = JSON.parse(d);
        if (!res.data.length) {
            this.d.oldData = [];
            return;
        }
        res.data.map((x: ProductInterface) => {
            x.priceInt = x.price as number;
            x.savedPriceInt = x.savedPrice as number;
            x.youSave = this.foramtMony(
                (x.price as number) - (x.savedPrice as number)
            );
            x.price = this.foramtMony(x.price as number);
            (x.savedPrice as number) = this.foramtMony(x.savedPrice as number);
            return x;
        });
        this.d.oldData = [...res.data];
        this.sortData(1);
        this.doCalc(true, false);
        console.info(this.d.brands);
        this.d.nextUrl = res.next_page_url;
        console.log(this.d.nextUrl);
        this.hideLoader();
    }

    private getDataFromServer(
        path: string = `sub/${this.d.slug[1]}`,
        native: boolean = false,
        append: boolean = false
    ) {
        if (!append) {
            this.d.data = [];
        }

        this.showLoader();
        Axios.get(path).then((res: any) => {
            if (!res.data.data || !res.data.data.length) {
                this.hideLoader();
                return;
            }
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
            if (append) {
                this.d.oldData = this.d.oldData.concat(res.data);
                this.d.data = [...this.d.oldData];
            } else {
                this.d.oldData = [...res.data];
                this.sortData(1);
            }
            this.doCalc(native, append);
            this.d.nextUrl = res.next_page_url;
            this.hideLoader();
        });
    }

    private doCalc(native: boolean, append: boolean) {
        const prices: number[] = [];
        if (native && !append) {
            this.d.brands = [];
            this.d.colors = [];
            this.d.conditions = [];
        }

        this.d.oldData.map(x => {
            if (native && !append) {
                this.d.brands.push({
                    txt: x.brand as string,
                    checked: false
                });
            }
            if (native && !append) {
                this.d.colors.push({
                    txt: x.color[0],
                    checked: false
                });
            }
            prices.push(x.savedPriceInt);
            return x;
        });

        if (native && !append) {
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
        }

        // sort prices

        prices.sort((a, b) => a - b);
        this.d.range.max = Number(prices[prices.length - 1].toFixed(2));
        this.d.range.to = this.d.range.max;
    }

    private showLoader() {
        this.d.loadingPosts = true;
    }
    private hideLoader() {
        this.d.loadingPosts = false;
    }

    beforeMount() {
        this.attachToGlobal(this, [
            "filterData",
            "toogleCollabseButton",
            "filterByBrands",
            "filterByColors",
            "filterByConditions",
            "rateFilter",
            "removeAllfilters",
            "filterByPrice",
            "log"
        ]);

        const [cat, sub] = this.extractRoute();
        this.d.slug = [cat, sub];
    }

    mounted() {
        this.loadData(this.d.slug[1]);
        this.checkIfReachedBottom();
    }
}
