import { Vue, Component } from 'vue-property-decorator';
import Category from '../interfaces/category';
import Axios from 'axios';

@Component({
    template: require('./index-template.html')
})
export default class Super extends Vue {
    public d: any = {};
    public allData: Category[] = [];
    public formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    });

    /**
     * attach compoenent properties and methods to global d variable
     *
     * @param self current component instance
     * @param methods array of public methods
     */
    protected attachToGlobal(self: Super, methods: string[]) {
        for (const k in self.$data) {
            if (k === 'd') {
                continue;
            }
            this.d[k] = this.$data[k];
        }

        methods.map(x => {
            this.d[x] = self[x];
        });
    }

    public extractRoute(): string[] {
        let arr = document.location.pathname.split('/');

        return [arr[3], arr[5]];
    }
    beforeMount() {}
}
