/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


// 勤務地チェックボックス　
Vue.component('cheakbox-location-component', require('./components/CheakboxLocationComponent.vue').default);

// 職種チェックボックス
Vue.component('cheakbox-industry-component', require('./components/ChakboxIndustryComponent.vue').default);

// 業種チェックボックス
Vue.component('cheakbox-occupation-component', require('./components/ChakboxOccupationComponent.vue').default);

// 駅(路線)チェックボックス
Vue.component('cheakbox-train-component', require('./components/ChakboxTrainComponent.vue').default);

// その他条件チェックボックス
Vue.component('cheakbox-other-component', require('./components/ChakboxOtherComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
