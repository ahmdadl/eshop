import { Vue, Component } from "vue-property-decorator";
import Category from "../interfaces/category";
import Axios from "axios";

@Component({
    template: require("./index-template.html")
})
export default class Super extends Vue {
    public d: any = {
        toast: {
            show: false,
            type: "",
            title: "",
            message: ""
        },
        lang: []
    };
    public allData: Category[] = [];
    public formatter = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD"
    });

    /**
     * attach compoenent properties and methods to global d variable
     *
     * @param self current component instance
     * @param methods array of public methods
     */
    protected attachToGlobal(self: Super, methods: string[]) {
        for (const k in self.$data) {
            if (k === "d") {
                continue;
            }
            this.d[k] = this.$data[k];
        }

        methods.map(x => {
            this.d[x] = self[x];
        });
    }

    protected showToast(
        message: string,
        title: string = "",
        type: string = "primary"
    ) {
        this.d.toast.title = title;
        this.d.toast.type = type;
        this.d.toast.message = message;
        (this.$refs.xToast as any).show();
    }

    public showErrorToast(message?: string) {
        this.showToast(
            message || this.getLang(0),
            this.getLang(3),
            'danger'
        );
    }

    protected getInpVal(id: string, asArr: boolean = false): any {
        const el = document.getElementById(id) as HTMLInputElement;

        if (el) {
            return el.value;
        }

        return asArr ? "[]" : null;
    }

    /**
     * 
     * @param inx 
     * @tutorial 0 => error message
     * @tutorial 1 => success message
     * @tutorial 2 => alert title
     * @tutorial 3 => error title
     * @tutorial 4 => success title
     */
    protected getLang(inx: number): string {
        return this.d.lang[inx] || null;
    }

    public extractRoute(): string[] {
        let arr = document.location.pathname.split("/");

        return [arr[3], arr[5]];
    }

    beforeMount() {}

    mounted() {
        this.d.lang = JSON.parse(this.getInpVal("xlang", true));
    }
}
