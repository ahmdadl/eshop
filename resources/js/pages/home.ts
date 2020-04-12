import { Component, Prop } from 'vue-property-decorator';
import Super from './super';

@Component
export default class Home extends Super {
    public d = {
       
    };

    beforeMount() {
        this.attachToGlobal(this, []);
    }

    mounted() {
    }
}
