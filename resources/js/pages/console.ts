import { Component } from "vue-property-decorator";
import Super from "./super";

export interface Param {
    key: string;
    info: string;
    req: boolean;
    default?: string;
}

export interface Doc {
    route: string;
    method: string | "GET" | "POST";
    info: string;
    url_with_params: string;
    test_curl: string;
    response: string;
    headers: Param[];
    res_doc: [number, string];
    url_params: Param[];
    query: Param[];
    parent: string;
}

export interface Dynamic {
    data: Doc[];
    doc: Doc;
}

@Component
export default class Console extends Super {
    public d: Dynamic = {
        data: [],
        doc: {
            route: "",
            method: "GET",
            info: "",
            url_with_params: "",
            test_curl: "",
            response: "",
            res_doc: [200, ""],
            headers: [],
            url_params: [],
            query: [],
            parent: ""
        }
    };

    public setDoc(inx: number) {
        // console.log(this.d.data[inx]);
        this.d.doc = this.d.data[inx];
    }

    public copyCurl()
    {
        const el = document.createElement('textarea');
        el.value = this.d.doc.test_curl;
        el.style.height = '0';
        el.style.width = '0';
        document.body.appendChild(el);
        el.select();
        el.setSelectionRange(0, 9999);
        document.execCommand('copy');
        document.body.removeChild(el);
        this.showToast('copied to clipboard', 'Copied', 'success');
    }

    beforeMount() {
        this.attachToGlobal(this, ['setDoc', 'copyCurl']);
    }

    mounted() {
        const data =
            (document.querySelector("#vxdata") as HTMLInputElement).value ??
            "[]";

        if (!data.length) {
            setTimeout(() => {
                const data =
                    (document.querySelector("#vxdata") as HTMLInputElement)
                        .value ?? "[]";
                this.d.data = JSON.parse(data);
                this.d.doc = this.d.data[0];
            }, 500);
        } else {
            this.d.data = JSON.parse(data);
            this.d.doc = this.d.data[0];
            console.log(this.d.doc);
        }
    }
}
