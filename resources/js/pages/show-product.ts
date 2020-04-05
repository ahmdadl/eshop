import { Component } from 'vue-property-decorator';
import Super from './super';

@Component
export default class ShowProduct extends Super {
    public d = {};

    beforeMount() {
        this.attachToGlobal(this, []);
    }
}       