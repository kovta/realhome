/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//  ez nem a boostrap framework!!
import Vue from "vue";

require('./bootstrap');
//  ecmascript promises
require('es6-promise/auto');

import axios from 'axios'
import VueAxios from 'vue-axios'
import 'bootstrap-select';
import 'bootstrap-datepicker';

//  lazy loading
import VueLazyLoad  from 'vue-lazyload';

//  lightbox image gallery for vue:
import LightBox from "vue-image-lightbox";

// own location, town, distric selector vue component:
import LocationSelector from "../components/LocationSelector";

window.Vue = require('vue');
Vue.use(VueAxios, axios);
Vue.use(VueLazyLoad);
Vue.component(
    LightBox
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if(document.getElementById("locationSelectorApp")) {
    window.locationSelectorApp = new Vue({
        el: '#locationSelectorApp',
        components: {'location-selector': LocationSelector}
    });
}

/**
 * Image gallery app:
 */
$(document).ready(function () {
    window.imageGalleryApp = new Vue({
        el: '#imageGalleryApp',
        components: {'lightbox': LightBox},
        data(){
            return {
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

// candlestick: "jQuery plugin selector between three options":
// NO LONGER SUPPORT!
window.candlestick = require('../global/candlestick/candlestick');
window.numeral = require('numeral');        //  szamok formazasa (normalisan)
require('../formats.js');                   //  valos ideju szam-datum formazasok
require('../threeStateCheckbox.js');        //  haromallasu checkbox-ok
require('../global/currencyUpdater.js');    //  penznemek frissitese legordulo
