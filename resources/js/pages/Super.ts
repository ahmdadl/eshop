import { Vue, Component, Prop } from 'vue-property-decorator';

@Component({
    template: require('./index-template.html')
})
export default class Super extends Vue {
    @Prop({ type: Object, required: true }) data: {}
    d = {};
    _methods: string[] = [];

    public attachToGlobal(methods: string[]) {
        for (const k in this.$data) {
            this.d[k] = this.$data[k];
        }

        methods.map(x => (this.d[x] = this[x]));

        // @ts-ignore
        this.$root.h = this.d;
    }

    mounted() {
        this.attachToGlobal(this._methods);
    }
}