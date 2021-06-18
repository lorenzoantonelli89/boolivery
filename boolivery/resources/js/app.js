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

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

document.addEventListener('DOMContentLoaded', function () {

    new Vue({
        el: '#app',
        data: {
            restaurants: '',
            activeRestaurant: '',
            categories: '',
            plates: '',
        },
        mounted() {
            // chiamata axio che ritorna array di tutti i ristoranti
            axios.get('/api/restaurants')
                .then(res => {
                    this.restaurants = res.data;
                    console.log(this.restaurants);
                })
            // chiamata axio che ritorna array di tutte le categorie
            axios.get('/api/categories')
                .then(res => {
                    this.categories = res.data;
                    console.log(this.categories);
                })
        },
        methods: {
            // funzione che valora il dato active restaurant al click del ristorante selezionato
            getActiveRestaurant: function(elem){
                this.activeRestaurant = elem.id;
            },
            // funzione che al click fa una chiamata axios per avere array di piatti
            getActivePlates: function(){
                // chiamata axio che ritorna array di tutti i piatti del ristorante cliccato
                axios.get('/api/plates/' + this.activeRestaurant)
                    .then(res => {
                        this.plates = res.data;
                        console.log(this.plates);
                    })
            }
           
        },
        computed: {
            // funzione per creare href da inserire nel link ristorante come rotta che porta al dettaglio del ristorante cliccato
            getHref: function(){
                return '/restaurant-details/' + this.activeRestaurant;
            }
        }
    });
});

