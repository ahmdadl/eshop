import Product from '../pages/product';
export default interface Cart {
    id: number;
    product: Product;
    amount: number;
    total: number;
}