import Vue from 'vue'
import Axios from 'axios';

require('./bootstrap');

Vue.prototype.$http = Axios
Vue.component('score-component', require('./Components/Score.vue').default);

const app = new Vue({
    el: '#app',
    model: 'history'
});