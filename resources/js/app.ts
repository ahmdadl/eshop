import { Vue } from 'vue-property-decorator';
import Axios from 'axios';
import Home from './pages/home';
import Product from './pages/product';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Axios.interceptors.response.use(
    function(response) {
        // TODO show loader
        console.log(response.data);
        return response;
    },
    function(error) {
        // TODO hide loader
        console.log(error);
        return Promise.reject(error);
    }
);

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
    components: {
        Home,
        Product
    }
});
