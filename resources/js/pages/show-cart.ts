import { Component } from "vue-property-decorator";
import Super from "./super";
import Cart from "../interfaces/cart";
import Axios from "axios";

export interface Dynamic {
    cart: Cart[];
    cartLoader: boolean;
    totalPrice: string;
    totalPriceInt: number;
}

@Component
export default class ShowCart extends Super {
    public d: Dynamic = {
        cart: [],
        cartLoader: false,
        totalPrice: "",
        totalPriceInt: 0
    };

    public calcTotalPrice() {
        this.d.totalPriceInt = this.d.cart.reduce(
            (t, c) => (t += parseFloat(c.totalInt || c.total)),
            0
        );

        this.d.totalPrice = this.formatter.format(this.d.totalPriceInt);
        // @ts-ignore
        this.d.cartTotal = this.formatter.format(this.d.totalPriceInt);
    }

    public updateCartTotal(firstTime: boolean = false) {
        this.d.cart.map(x => {
            if (firstTime) {
                x.totalInt = parseFloat(x.total);
            }
            x.total = this.formatter.format(x.totalInt as number);
            return x;
        });
    }

    public run() {
        this.calcTotalPrice();
        this.updateCartTotal(true);
    }

    public convertTo(currency: string = "EGP") {
        this.d.totalPrice = this.convertToNative(
            currency,
            this.d.totalPriceInt
        );
    }

    public changeAmount(ev, inx: number, price: any, id: number) {
        this.d.cartLoader = true;
        const val = parseInt(ev.target.value) || 0;
        if (typeof price === 'string') {
            price = parseFloat(price.replace(/\$|,/gi, ""));
        }
        const total = val * price;

        Axios.patch(
            `/${this.getLocale()}/cart/${id}`,
            {
                amount: val,
                total
            },
            { baseURL: "" }
        ).then(res => {
            if (!res.data || !res.data.updated) {
                this.d.cartLoader = false;
                this.showErrorToast();
                return;
            }
            this.d.cart[inx].amount = val;
            this.d.cart[inx].totalInt = total;
            this.d.cart[inx].total = this.formatter.format(total);
            this.calcTotalPrice();
            this.d.cartLoader = false;
        });
    }

    public removeItem(inx: number, id: number) {
        this.d.cartLoader = true;

        Axios.delete(`/${this.getLocale()}/cart/${id}`, {baseURL: ''})
            .then(res => {
                if (!res.data || !res.data.deleted) {
                    this.d.cartLoader = false;
                    this.showErrorToast();
                    return;
                }
                this.d.cart.splice(inx, 1);
                this.updateCartTotal();
                this.calcTotalPrice();
                this.d.cartLoader = false;
            });
    }

    beforeMount() {
        this.attachToGlobal(this, ["convertTo", "changeAmount", "removeItem"]);
    }

    mounted() {
        this.$on("cartDataLoaded", d => {
            this.run();
        });
    }
}
