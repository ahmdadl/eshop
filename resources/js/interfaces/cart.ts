import ProductInterface from './product';
export default interface Cart {
    id: number;
    product: ProductInterface;
    amount: number;
    total: any | string | number;
    totalInt?: number;
}