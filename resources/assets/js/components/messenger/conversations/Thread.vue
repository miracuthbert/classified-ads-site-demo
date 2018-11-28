<template>
    <a href="" class="list-group-item" :class="{active: isActive, disabled: isDisabled}" :id="thread.id"
       v-on:click="handleOnClickEvent">
        <h4 class="list-group-item-heading">
            {{ threadRecipient }}
            <sup class="badge">{{ thread.unread_count > 1 ? thread.unread_count : '' }}</sup></h4>
        <div class="list-group-item-text">
            <div class="message">{{ thread.latest_message }}</div>
            <div class="time">
                <small class="text-muted">{{ thread.updated_at_human }}</small>
            </div>
        </div>
    </a>
</template>

<script>
    import Bus from '../../../bus'
    import {itemToggleClass, itemRemoveSiblingsClass, itemToggleSiblingsClass} from '../../../helpers/messenger'

    export default {
        props: [
            'thread'
        ],
        data() {
            return {
                threadRecipient: null,
                responseData: null,
                isActive: false,
                isDisabled: false,
            }
        },
        methods: {
            handleOnClickEvent(e) {
                e.preventDefault();

                this.isActive = true;
                this.isDisabled = true;

                let selThread = this.thread;

                this.buildTempThread(selThread);

                //disable siblings
                itemToggleSiblingsClass('#tabThreads .list-group .list-group-item', '#' + this.thread.id, 'disabled');

                //remove active from siblings
                itemRemoveSiblingsClass('#tabThreads .list-group .list-group-item', '#' + this.thread.id, 'active');
            },
            buildTempThread(selThread) {
                axios.get('/messenger/messages/' + selThread.id).then((response) => {
                    this.conversationShow(response.data.data);
                });
            },
            conversationShow(selThread) {
                Bus.$emit('conversation.show', selThread);
                this.isDisabled = false;

                //remove disable from siblings
                itemToggleSiblingsClass('#tabThreads .list-group .list-group-item', '#' + this.thread.id, 'disabled');
            }
        },
        mounted() {
            this.threadRecipient = this.thread.creator.data.id === Laravel.user.id ? this.thread.recipient.data.name : this.thread.creator.data.name;

            //listen to user events here
        }
    }
</script>
