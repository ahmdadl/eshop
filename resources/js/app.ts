import { Vue } from "vue-property-decorator";
import Axios from "axios";
// import Echo from "laravel-echo";
import Home from "./pages/home";
import Product from './pages/product';
import StarRate from "./components/StarRate.vue";
// import XProduct from "./components/x-product.vue";
import Toastr from "./components/toast.vue";
import ShowProduct from './pages/show-product';
import ShowCart from './pages/show-cart';
import UserProfile from './pages/user-profile';
// import Clients from "./components/passport/Clients.vue";
import Console from './pages/console';

Axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
Axios.defaults.baseURL = `/api/`;

Vue.config.productionTip = false;

Vue.component("star-rate", StarRate);
// Vue.component("my-product", () => import("./components/x-product.vue"));
Vue.component("my-product", function(resolve) {
    // @ts-ignore
    require(["./components/x-product.vue"], resolve);
});
Vue.component("toast", Toastr);
Vue.component("passport-clients", function(resolve) {
    // @ts-ignore
    require(["./components/passport/Clients.vue"], resolve);
});

const app = new Vue({
    el: "#app",
    components: {
        Home,
        Product,
        ShowProduct,
        ShowCart,
        UserProfile,
        Console
    },
    mounted() {
        Axios.interceptors.response.use(
            response => {
                console.log(response.data);
                return response;
            },
            error => {
                // if (error.response) {
                //     // The request was made and the server responded with a status code
                //     // that falls out of the range of 2xx
                //     console.log(error.response.data);
                //     console.log(error.response.status);
                //     console.log(error.response.headers);
                // } else if (error.request) {
                //     // The request was made but no response was received
                //     // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                //     // http.ClientRequest in node.js
                //     console.log(error.request);
                // } else {
                //     // Something happened in setting up the request that triggered an Error
                //     console.log("Error", error.message);
                // }
                // console.log('I`m herererer');
                // console.log(error.response);

                // show error toast
                this.$refs.childCmp.showErrorToast();
            }
        );
        const splash = this.$refs.splashScreen;
        if (splash && splash.style) {
            splash.style.display = "none";
        }
    }
});
