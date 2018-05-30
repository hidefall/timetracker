
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('login', require('./components/Login'));
Vue.component('register', require('./components/Register'));
Vue.component('register-chooser', require('./components/RegisterChooser'));
Vue.component('projects', require('./components/Projects'));
Vue.component('tasks', require('./components/Tasks'));
Vue.component('timeframes', require('./components/TimeFrames'));
Vue.component('timer', require('./components/Timer'));
Vue.component('change-avatarka', require('./components/ChangeAvatarka'));

// REGISTER FORM //
Vue.component('register-handler', require('./components/RegisterForm/RegisterFormHandler'));
Vue.component('choose-plan', require('./components/RegisterForm/ChoosePlan'));
Vue.component('payment', require('./components/RegisterForm/Payment'));
Vue.component('finish-registration', require('./components/RegisterForm/FinishRegistration'));
Vue.component('register-company', require('./components/CompanyRegister'));
Vue.component('create-element', require('./components/CreateElement'));
Vue.component('add-project-form', require('./components/AddProjectForm'));
// ------------- //

const EventBus = new Vue();

export default EventBus;

const app = new Vue({
    el: '#app'
});
















