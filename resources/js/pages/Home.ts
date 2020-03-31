import { Component, Prop } from 'vue-property-decorator';
import Super from './super';

@Component
export default class Home extends Super {
    public d = {
        name: '',
        id: 0,
        test: [''],
    };

    public log() {
        console.log(this.d.name);
    }

    beforeMount() {
        this.attachToGlobal(this, ['log']);
    }

    mounted() {
        setTimeout(_ => this.d.test = ['wsd', 'ers', 'qsf'], 1200);
    }
}
