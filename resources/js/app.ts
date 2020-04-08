import { Vue } from "vue-property-decorator";
import Axios from "axios";
import Echo from "laravel-echo";
import Home from "./pages/home";
import Product from "./pages/product";
import StarRate from "./components/StarRate.vue";
import XProduct from "./components/x-product.vue";
import Toastr from "./components/toast.vue";
import ShowProduct from "./pages/show-product";
import ShowCart from './pages/show-cart';

Axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
Axios.defaults.baseURL = `/api/`;
Axios.interceptors.response.use(
    function(response) {
        // TODO show loader
        console.log(response.data);
        return response;
    },
    function(error) {
        // TODO hide loader
        if (error.response) {
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            console.log(error.response.data);
            console.log(error.response.status);
            console.log(error.response.headers);
        } else if (error.request) {
            // The request was made but no response was received
            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
            // http.ClientRequest in node.js
            console.log(error.request);
        } else {
            // Something happened in setting up the request that triggered an Error
            console.log("Error", error.message);
        }
        console.log(error.config);
    }
);

// @ts-ignore
// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: "ccaa79127d69aae057ea",
//     cluster: "eu",
//     forceTLS: true
// });

Vue.config.productionTip = false;

Vue.component("star-rate", StarRate);
Vue.component("my-product", XProduct);
Vue.component("toast", Toastr);

const app = new Vue({
    el: "#app",
    components: {
        Home,
        Product,
        ShowProduct,
        ShowCart
    }
});
