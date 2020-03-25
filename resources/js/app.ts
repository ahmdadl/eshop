import { Vue } from 'vue-property-decorator';
import Axios from 'axios';
import Home from './pages/Home';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
    components: {
        Home,
    },
    data: {
        h: {}
    }
});
