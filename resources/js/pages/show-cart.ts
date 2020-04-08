import { Component } from 'vue-property-decorator';
import Super from './super';

export interface Dynamic {

}

@Component
export default class ShowCart extends Super {
    public d: Dynamic = {};

    beforeMount() {
        this.attachToGlobal(this, []);
    }
}       