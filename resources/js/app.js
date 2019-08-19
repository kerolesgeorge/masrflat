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

/**
 * All application components array
 */
const components = [
    // Cities components
    {'name' : 'city-component', 'location' : 'cities/CityComponent.vue'},

    // Neighbourhoods components
    {'name' : 'neighbourhood-component', 'location' : 'neighbourhoods/NeighbourhoodComponent.vue'},

    // Types components
    {'name' : 'type-component', 'location' : 'types/TypeComponent.vue'},

    // Contracts components
    {'name' : 'contract-component', 'location' : 'contracts/ContractComponent.vue'},

    // Finishes components
    {'name' : 'finish-component', 'location' : 'finishes/FinishComponent.vue'},

    // Views components
    {'name' : 'view-component', 'location' : 'views/ViewComponent.vue'},

    // Estates components
    {'name': 'estate-component', 'location' : 'estates/EstateComponent.vue'}
];

// Include all components
components.forEach(component => {
    Vue.component(component.name, require(`./components/${component.location}`).default);
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
