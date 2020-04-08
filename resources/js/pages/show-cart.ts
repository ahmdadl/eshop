import { Component } from "vue-property-decorator";
import Super from "./super";

export interface Dynamic {
    price: string;
    priceInt: number;
}

@Component
export default class ShowCart extends Super {
    public d: Dynamic = {
        price: "",
        priceInt: 0
    };

    public formatPrice(p: number) {
        this.d.priceInt = p;
        return this.formatter.format(p);
    }

    public convertTo(currency: string = "EGP") {
        this.d.price = this.convertToNative(currency, this.d.priceInt);
    }

    beforeMount() {
        this.attachToGlobal(this, ["formatPrice", "convertTo"]);
    }
}
