import { Component } from 'vue-property-decorator';
import Super from './super';
import Axios from 'axios';
import ProductInterface from '../interfaces/product';

export interface Dynamic {
    data: ProductInterface[];
    nextUrl: string;
    slug: string[];
    loadingPosts: boolean;
}

@Component
export default class Product extends Super {
    d: Dynamic = {
        data: [],
        nextUrl: '',
        slug: [],
        loadingPosts: false,
    };

    public foramtMony(n: number): any
    {
        return this.formatter.format(n);
    }

    public loadData(
        subSlug: string = this.d.slug[1],
        nextPath: string | null = null
    ): void {
        this.d.data = [];
        this.d.loadingPosts = true;
        const path = !nextPath ? `sub/${subSlug}` : nextPath;
        Axios.get(path).then((res: any) => {
            res = res.data;
            res.data.map((x: ProductInterface) => {
                x.youSave = this.foramtMony(x.price - x.savedPrice);
                x.price = this.foramtMony(x.price);
                x.savedPrice = this.foramtMony(x.savedPrice);
                return x;
            });
            this.d.data = res.data;
            this.d.nextUrl = res.next_page_url;
            this.d.loadingPosts = false;
        });
    }

    beforeMount() {
        this.attachToGlobal(this, ['foramtMony']);
        
        const [cat, sub] = this.extractRoute();
        this.d.slug = [cat, sub];

        this.loadData(sub);
    }

    mounted() {
    }
}
