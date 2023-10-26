require('./bootstrap');
import VcSlide from './Component/Slide.vue';
import * as Vue from 'vue'

window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');

Vue.createApp({
    components: {
        VcSlide
    }
}).mount("#content");
  