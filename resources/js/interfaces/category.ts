import Product from './product';
export default interface Category {
    id: number;
    name: string;
    slug?: string;
    category_id?: number;
    created_at: string;
    updated_at: string;
    supCate?: Category;
    products?: Product;
}