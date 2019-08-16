/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Cities components
 */
Vue.component('city-component', require('./components/cities/CityComponent.vue').default);
Vue.component('city-create', require('./components/cities/CityCreate.vue').default);
Vue.component('city-edit', require('./components/cities/CityEdit.vue').default);

/**
 * Neighbourhoods components
 */
Vue.component('neighbour-component', require('./components/neighbourhoods/NeighbourComponent.vue').default);
Vue.component('neighbour-create', require('./components/neighbourhoods/NeighbourCreate.vue').default);
Vue.component('neighbour-edit', require('./components/neighbourhoods/NeighbourEdit.vue').default);

/**
 * Types components
 */
Vue.component('type-component', require('./components/types/TypeComponent.vue').default);
Vue.component('type-create', require('./components/types/TypeCreate.vue').default);
Vue.component('type-edit', require('./components/types/TypeEdit.vue').default);

/**
 * Contracts components
 */
Vue.component('contract-component', require('./components/contracts/ContractComponent.vue').default);
Vue.component('contract-create', require('./components/contracts/ContractCreate.vue').default);
Vue.component('contract-edit', require('./components/contracts/ContractEdit.vue').default);

/**
 * Finishes components
 */
Vue.component('finish-component', require('./components/finishes/FinishComponent.vue').default);
Vue.component('finish-create', require('./components/finishes/FinishCreate.vue').default);
Vue.component('finish-edit', require('./components/finishes/FinishEdit.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
