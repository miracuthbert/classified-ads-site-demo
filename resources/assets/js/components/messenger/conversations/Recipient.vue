<template>
    <a href="" class="list-group-item" :id="recipient.id" v-on:click="handleOnClickEvent">
        {{ recipient.name }}
    </a>
</template>

<script>
    import Bus from '../../../bus'

    export default {
        props: [
            'recipient',
            'index'
        ],
        methods: {
            handleOnClickEvent(e) {
                e.preventDefault();

                let selRecipent = this.recipient;
                let selIndex = this.index;

                this.conversationCreate(selRecipent, selIndex);
            },
            buildTempRecipient(selRecipient) {
                return selRecipient;
            },
            conversationCreate(selRecipient, selIndex) {

                //temp recipient
                let tempRecipient = this.buildTempRecipient(selRecipient);

                Bus.$emit('conversation.create', tempRecipient);

            }
        },
        mounted() {


        }
    }
</script>
