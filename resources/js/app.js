require('./bootstrap');
import VcSlide from './Component/Slide.vue';
import VcFormSlide from './Component/FormSlide.vue';
import * as Vue from 'vue'
import CKEditor from 'ckeditor4-vue';


window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');

Vue.createApp({
    components: {
        VcSlide,
        VcFormSlide
    }
})
.mount("#content");
