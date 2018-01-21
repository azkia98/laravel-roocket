
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('payment', require('./components/Payment.vue'));
Vue.component('form-ajax', require('./components/FormAjax.vue'));
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);


const app = new Vue({
    el: '#app'
});

// Echo.private('articles.admin')
//     .listen('ArticleEvent' , function (e) {
//        console.log(e);
//     });

$('#sendCommentModal').on('show.bs.modal' , function (event) {
    let button = $(event.relatedTarget);
    let parentId = button.data('parent');
    let modal = $(this);
    modal.find("[name='parent_id']").val(parentId);
});