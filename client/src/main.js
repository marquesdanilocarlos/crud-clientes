import Vue from 'vue';
import App from './App.vue';
import axios from 'axios';
import router from './router';
import i18n from './plugins/i18n';
import CripNotice from 'crip-vue-notice';
import VueMeta from 'vue-meta';
import store from './store';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

const loginLayout = () => import('./layouts/login');
const clientLayout = () => import('./layouts/client');
Vue.component('loginLayout', loginLayout);
Vue.component('clientLayout', clientLayout);


Vue.config.productionTip = false;
Vue.prototype.$backendUrl = process.env.VUE_APP_BACKEND_URL;
Vue.prototype.$appName = process.env.VUE_APP_NAME;
Vue.use(CripNotice);
Vue.use(VueMeta);
if(store.getters.isLogged) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.token
}
Vue.prototype.$http = axios;

new Vue({
    el: '#app',
    router,
    i18n,
    store,
    render: h => h(App)
}).$mount('#app');
