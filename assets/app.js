/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import Vue from 'vue'
import Vuetify from 'vuetify'
import Router from './router.js'
import Layout from './js/layout/layout.vue'


Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify,
    router: Router,
    components: { Layout }
});

export default new Vuetify(app);
