export default interface Rates {
    id: number;
    user_id: number;
    product_id: number;
    rate: number | 0;
    message?: string;
    created_at: string;
    updated_at: string;
    updated: string; // formated date with carbon
}
