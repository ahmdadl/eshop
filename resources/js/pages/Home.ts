import { Component, Prop } from 'vue-property-decorator';
import Super from './super';

@Component
export default class Home extends Super {
    name: string = 'asd';
    id: number = 5;

    public log() {
        console.log(this.name);
    }

    beforeCreate() {
        this._methods = ['log'];
    }
}
