/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//  ez nem a boostrap framework!!

require('./bootstrap');
//  ecmascript promises
require('es6-promise/auto');

// vue-select
import Vue from 'vue'
import vSelect from 'vue-select'
//  axios
import axios from 'axios';
import VueAxios from 'vue-axios';
import 'bootstrap-select';
import 'bootstrap-datepicker';
import 'datatables.net-dt';
import 'bootstrap-colorpicker';
import Sortable from 'sortablejs';

//  lazy loading
import VueLazyLoad  from 'vue-lazyload';

//  lightbox image gallery for vue:
import LightBox from 'vue-image-lightbox'

// own location, town, distric selector vue component:
import LocationSelector from "../components/LocationSelector";
import PartnerSelector from "../components/PartnerSelector";

//  Import TinyMCE https://www.tiny.cloud/docs/advanced/usage-with-module-loaders/ :
// Import TinyMCE
import 'tinymce';
import 'tinymce/themes/silver'; //  theme and plugins
import 'tinymce/plugins/paste';
import 'tinymce/plugins/link';
import 'tinymce/plugins/code';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/wordcount';

// Vue-select
import 'vue-select/dist/vue-select.css';
//  attach to window obj:
window.Vue = require('vue');
window.Sortable = Sortable;
// candlestick: "jQuery plugin selector between three options":
// NO LONGER SUPPORT!
window.candlestick = require('../global/candlestick/candlestick');
window.numeral = require('numeral');    //  szamok formazasa (normalisan)
require('../functions.js');     // urlap panelek nyitasa-zarasa
require('../formats.js');       // valos ideju szam-datum formazasok
//require('../tableFilter.js');   // lista szuro panel ertekeinek szoveges osszegzese - lehet egy kesobbi feature
require('../threeStateCheckbox.js');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VueAxios, axios);
Vue.use(VueLazyLoad);
Vue.component('v-select', vSelect)
Vue.component(
    LightBox
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if(document.getElementById("locationSelectorApp")) {
    let locationSelectorApp = new Vue({
        el: '#locationSelectorApp',
        components: {'location-selector': LocationSelector}
    });
}
if(document.getElementById("PartnerSelectorApp")) {
    let PartnerSelectorApp = new Vue({
        el: '#PartnerSelectorApp',
        components: {'partner-selector': PartnerSelector}
    });
}

/**
 * Tooltips
 */
$(function (){
    $('[data-toggle="tooltip"]').tooltip()
});

/**
 * Image gallery app:
 */
$(document).ready(function () {
    window.imageGalleryApp = new Vue({
        el: '#imageGalleryApp',
        components: {'lightbox': LightBox},
        data(){
            return{
                images : []
            }
        },
        methods: {
            showImage(index) {
                this.$refs.lightbox.showImage(index)
            }
        }
    });
});

require('../global/currencyUpdater.js');       // penznemek frissitese legordulo
