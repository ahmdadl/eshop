import { Vue } from 'vue-property-decorator';
import Axios from 'axios';
import Home from './pages/home';
import Product from './pages/product';
import StarRate from './components/StarRate.vue';
import XProduct from './components/x-product.vue';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
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
            console.log('Error', error.message);
        }
        console.log(error.config);
    }
);

Vue.config.productionTip = false;

Vue.component('star-rate', StarRate);
Vue.component('my-product', XProduct);

const app = new Vue({
    el: '#app',
    components: {
        Home,
        Product
    }
});
