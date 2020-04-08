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
        cartTotal: 0,
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
        (this.$refs.xToast as any).show();
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
     */
    protected getLang(inx: number): string {
        return this.d.lang[inx] || "";
    }

    public extractRoute(): string[] {
        let arr = document.location.pathname.split("/");

        return [arr[3], arr[5]];
    }

    addToCartNative(product: any, amount: number = 1) {
        // check if item already added to cart
        const found = this.d.cart.some(x => x.id === product.id);
        if (found) {
            return;
        }

        const spinner = product.id + "spinnerLoader";
        (document.getElementById(spinner) as HTMLSpanElement).classList.remove(
            "d-none"
        );
        this.d.cartLoader = true;

        const total = amount * product.savedPriceInt;

        const ncart = {
            id: product.id,
            product,
            amount,
            total
        };

        Axios.post("/cart", ncart).then(res => {
            if (res) {
            }
            (this.d as Dynamic).cart.push(ncart);

            (this.d as Dynamic).cartTotal = this.formatter.format(
                (this.d as Dynamic).cart.reduce((c, a) => {
                    return (c += a.total);
                }, 0)
            );
            (document.getElementById(spinner) as HTMLSpanElement).classList.add(
                "d-none"
            );
            (this.d as Dynamic).cartLoader = false;
        });

        console.log((this.d as Dynamic).cart);
        console.log(this.$refs);
    }

    beforeMount() {}

    mounted() {
        this.d.lang = JSON.parse(this.getInpVal("xlang", true));

        // @ts-ignore
        // var channel = window.Echo.channel("my-channel");
        // channel.listen(".my-event", function(data) {
        //     console.log(data);
        // });
    }
}
