import { Component } from 'vue-property-decorator';
import Super from './super';

@Component
export default class Console extends Super {
    public d = {};

    beforeMount() {
        this.attachToGlobal(this, []);
    }
}       