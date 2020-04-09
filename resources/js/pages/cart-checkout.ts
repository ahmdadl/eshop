import { Component } from 'vue-property-decorator';
import Super from './super';

@Component
export default class CartCheckout extends Super {
    public d = {};

    beforeMount() {
        this.attachToGlobal(this, []);
    }
}       