import ProductInfo from "./product-info";
import Rates from "./rates";
import Category from './category';
export default interface ProductInterface {
    id: number;
    user_id: number;
    category_slug?: string;
    name: string;
    slug?: string;
    info?: string;
    price: string | number; // will hold formated number as currency
    savedPrice: string | number;
    priceInt: number;
    savedPriceInt: number;
    youSave?: number;
    rateAvg?: number;
    save?: number | 0;
    amount: number;
    is_used: boolean | false;
    color: string[];
    img: string[];
    brand?: string;
    p_cat: Category;
    pi?: ProductInfo;
    pivot?: { category_id: number; product_id: number };
    rates: Rates[];
    created_at: string;
    updated_at: string;
}
