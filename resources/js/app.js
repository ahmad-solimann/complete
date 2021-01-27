require('./bootstrap');
import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// import PrettyCheckbox from 'pretty-checkbox-vue';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'



import MenuIcon from 'vue-material-design-icons/Menu.vue';
import Vuetify from 'vuetify/lib'
import 'v-title/lib/element-ui';
import VTitle from 'v-title';
import VTooltip from 'v-tooltip'
import VueI18n from 'vue-i18n'
Vue.use(VueI18n);

Vue.use(VTooltip);
Vue.use(VTitle);
Vue.use(Vuetify);
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.mixin(require('./trans'))
export default new Vuetify({
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },
})
window.Vue = require('vue');
// Vue.use(PrettyCheckbox);
Vue.use(MenuIcon);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('multi-step', require('./components/ProjectComponent.vue').default);

const app = new Vue({
    el: '#app',
});

