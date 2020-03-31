import ProductInfo from './product-info';
import Rates from './rates';
export default interface Product
{
    id: number;
    user_id: number;
    name: string;
    slug?: string;
    info?: string;
    price: number;
    save?: number | 0;
    amount: number;
    is_used: boolean | false;
    color: string[];
    img: string[];
    pi?: ProductInfo;
    pivot?: {category_id: number, product_id: number};
    rates?: Rates;
    created_at: string;
    updated_at: string;
}