<template>
    <div class="conversation-messages" ref="messages" v-chat-scroll="{always: autoScroll}">
        <conversation-message v-for="message in messages" :key="message.id" :message="message"></conversation-message>
    </div>
</template>

<script>
    import Bus from '../../../bus'
    import VueChatScroll from 'vue-chat-scroll'

    export default {
        data() {
            return {
                messages: [],
                autoScroll : false,
            }
        },
        methods: {
            removeMessage(id) {
                this.messages = this.messages.filter((message) => {
                    return this.messages.id !== id;
                })
            },
        },
        mounted() {
            Bus.$on('conversation.create', (recipient) => {
                //clear current messages
                this.messages = [];
            }).$on('conversation.show', (thread) => {
                this.messages = [];
                this.messages = thread.messages.data;
            }).$on('messages.added', (message) => {
                this.messages.push(message);

                if (message.selfOwned) {
                    this.autoScroll = true;
                }

                this.autoScroll = false;
            }).$on('messages.remove', (message) => {
                this.removeMessage(message.id);
            });
        }
    }
</script>
