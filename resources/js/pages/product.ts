import { Component } from 'vue-property-decorator';
import Super from './super';

@Component
export default class Product extends Super {
    

    beforeCreate() {
        this._methods = [];
    }
}       