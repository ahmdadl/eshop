import { Component, Prop } from 'vue-property-decorator';
import Super from './Super';

@Component
export default class Home extends Super {
    name: string = 'asd';
    id: number = 5;

    public log() {
        console.log(this.name);
    }

    created() {
        this._methods = ['log'];
    }
}
