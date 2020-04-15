import { Vue, Component } from "vue-property-decorator";
import Category from "../interfaces/category";
import Axios from "axios";
import Echo from "laravel-echo";
import ToastOption from "../interfaces/toast-option";
import Cart from "../interfaces/cart";
import ProductInterface from "../interfaces/product";

export interface Dynamic {
    toast: ToastOption;
    lang: string[];
    cart: Cart[];
    cartTotal: string;
    carttotalInt: number;
    cartLoader: boolean;
}

@Component({
    template: require("./index-template.html")
})
export default class Super extends Vue {
    public d: Dynamic | any = {
        toast: {
            show: false,
            type: "",
            title: "",
            message: ""
        },
        lang: [],
        cart: [],
        cartTotal: "",
        cartLoader: false
    };
    public allData: Category[] = [];
    public formatter = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD"
    });

    /**
     * attach compoenent properties and methods to global d variable
     *
     * @param self current component instance
     * @param methods array of public methods
     */
    protected attachToGlobal(self: Super, methods: string[]) {
        for (const k in self.$data) {
            if (k === "d") {
                continue;
            }
            this.d[k] = this.$data[k];
        }

        methods.map(x => {
            this.d[x] = self[x];
        });
    }

    protected showToast(
        message: string,
        title: string = "",
        type: string = "primary"
    ) {
        this.d.toast.title = title;
        this.d.toast.type = type;
        this.d.toast.message = message;
        const xtoast = this.$refs.xToast;
        if (xtoast) {
            (xtoast as any).show();
        }
    }

    public showErrorToast(message?: string) {
        this.showToast(message || this.getLang(0), this.getLang(3), "danger");
    }

    protected getInpVal(id: string, asArr: boolean = false): any {
        const el = document.getElementById(id) as HTMLInputElement;

        if (el) {
            return el.value;
        }

        return asArr ? "[]" : null;
    }

    /**
     *
     * @param inx
     * @tutorial 0 => error message
     * @tutorial 1 => success message
     * @tutorial 2 => alert title
     * @tutorial 3 => error title
     * @tutorial 4 => success title
     * @tutorial 5 => product no amount left
     */
    protected getLang(inx: number): string {
        return this.d.lang[inx] || "";
    }

    public extractRoute(): string[] {
        let arr = document.location.pathname.split("/");

        return [arr[3], arr[5]];
    }

    protected addToCartNative(product: any, amount: number = 1) {
        // check if product have any amount left
        if (product.amount < 1) {
            this.hideCartLoader(product.id);
            return;
        }

        this.showCartLoader(product.id);

        // check if item already added to cart
        const pinx = (this.d as Dynamic).cart.findIndex(
            p => p.id === product.id
        );
        if (pinx > -1) {
            // check if amount is the same
            if ((this.d as Dynamic).cart[pinx].amount === amount) {
                // console.log(amount, "same amount");
                this.hideCartLoader(product.id);
                return;
            }
            // amount is not the the same
            // then update the cart amount
            // console.log("changeing amount");
            this.changeAmountNative(
                amount,
                pinx,
                product.savedPrice,
                product.id
            );
            return;
        }

        const total = amount * (product.savedPriceInt || product.savedPrice);

        product.rates = [];

        const ncart: Cart = {
            id: product.id,
            product,
            amount,
            total: total.toFixed(2)
        };

        Axios.post("cart", ncart).then(res => {
            if (!res.data) {
                this.hideCartLoader(product.id);
                this.showErrorToast();
                return;
            }
            (this.d as Dynamic).cart.push(ncart);

            this.calcCartTotal();
            this.hideCartLoader(product.id);
        });
    }

    protected changeAmountNative(
        amount: number,
        inx: number,
        price: any,
        id: number
    ) {
        this.showCartLoader(id);
        if (typeof price === "string") {
            price = parseFloat(price.replace(/\$|,/gi, ""));
        }
        const total = amount * price;

        Axios.patch(
            `cart/${id}`,
            {
                amount: amount,
                total
            }
        ).then(res => {
            if (!res.data || !res.data.updated) {
                this.hideCartLoader(id);
                this.showErrorToast();
                return;
            }
            this.d.cart[inx].amount = amount;
            this.d.cart[inx].totalInt = total;
            this.d.cart[inx].total = this.formatter.format(total);
            this.hideCartLoader(id);
            this.calcCartTotal();
            this.$emit("updated-amount-p", true);
        });
    }

    protected showCartLoader(id: number | null = null) {
        const spinner = document.getElementById(
            id + "spinnerLoader"
        ) as HTMLSpanElement;
        if (spinner) {
            spinner.classList.remove("d-none");
        }
        this.d.cartLoader = true;
    }

    protected hideCartLoader(id: number | null = null) {
        const spinner = document.getElementById(
            id + "spinnerLoader"
        ) as HTMLSpanElement;
        if (spinner) {
            spinner.classList.add("d-none");
        }
        this.d.cartLoader = false;
    }

    protected convertToNative(
        currency: string = "EGP",
        priceInt: number
    ): string {
        const egp = 15.75;
        const eu = 0.92;

        const formatter = new Intl.NumberFormat("en-US", {
            style: "currency",
            currency
        });

        if (currency === "EUR") {
            return formatter.format(priceInt * eu);
        } else if (currency === "EGP") {
            return formatter.format(priceInt * egp);
        }
        return this.formatter.format(priceInt);
    }

    loadCartItems() {
        (this.d as Dynamic).cart = [];
        this.d.cartLoader = true;

        Axios.get(`cart`).then(
            (res: any) => {
                if (!res.data) {
                    this.d.cartLoader = false;
                    this.showErrorToast();
                    return;
                }

                // check for amount error
                const amountErr = res.data[res.data.length-1];
                if (amountErr && amountErr.amountErr) {
                    this.showErrorToast(this.getLang(5));
                }
                
                res.data.pop();
                (this.d as Dynamic).cart = res.data;
                this.$emit("cartDataLoaded", true);
                this.calcCartTotal();
                this.d.cartLoader = false;
            }
        );
    }

    protected calcCartTotal() {
        const total = (this.d as Dynamic).cart.reduce(
            (t, c) => (t += parseFloat(c.totalInt || c.total)),
            0
        );

        // console.log(this.d.cart, total);

        (this.d as Dynamic).cartTotal = this.formatter.format(total);
    }

    protected getLocale(): string {
        return document.documentElement.lang || "en";
    }

    protected addClass(selector: string, cls: string) {
        const el = document.querySelector(selector) as HTMLElement;
        if (!el) return;
        el.classList.add(cls);
    }

    protected removeClass(selector: string, cls: string) {
        const el = document.querySelector(selector) as HTMLElement;
        if (!el) return;
        el.classList.remove(cls);
    }

    protected removeEl(selector: string) {
        const el = document.querySelector(selector) as HTMLElement;
        if (!el) return;
        (el.parentNode as Node).removeChild(el);
    }

    beforeMount() {}

    mounted() {
        this.d.lang = JSON.parse(this.getInpVal("xlang", true));
        this.loadCartItems();
        // @ts-ignore
        // var channel = window.Echo.channel("my-channel");
        // channel.listen(".my-event", function(data) {
        //     console.log(data);
        // });
    }
}
