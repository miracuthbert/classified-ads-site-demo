
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

Vue.component('listing-search', require('./components/listings/Search.vue'));
Vue.component('messenger-conversations', require('./components/messenger/Conversations.vue'));
Vue.component('conversations-recipients', require('./components/messenger/conversations/Recipients.vue'));
Vue.component('conversations-recipient', require('./components/messenger/conversations/Recipient.vue'));
Vue.component('conversations-users', require('./components/messenger/conversations/Threads.vue'));
Vue.component('conversations-user', require('./components/messenger/conversations/Thread.vue'));
Vue.component('messenger-conversation', require('./components/messenger/Conversation.vue'));
Vue.component('conversation-header', require('./components/messenger/conversation/Header.vue'));
Vue.component('conversation-messages', require('./components/messenger/conversation/Messages.vue'));
Vue.component('conversation-message', require('./components/messenger/conversation/Message.vue'));
Vue.component('messenger-search', require('./components/messenger/Search.vue'));
Vue.component('messenger-editor', require('./components/messenger/Editor.vue'));

const app = new Vue({
    el: '#app'
});
