import Vue from 'vue';
import * as BSN from 'bootstrap.native/dist/bootstrap-native-v4';
import Axios from 'axios';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.config.productionTip = false

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});