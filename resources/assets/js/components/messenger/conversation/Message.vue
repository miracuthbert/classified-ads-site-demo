<template>
    <div class="conversation-message">
        <div class="media" :class="{creator: selfOwned}">
            <div class="media-body">
                <h4 class="media-heading">
                    {{ messageSender }}
                </h4>
                <div class="message">
                    {{ message.body }}
                </div>
                <div class="time">
                    <small class="text-muted">{{ message.created_at != null ? message.created_at : message.date }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Bus from '../../../bus'
    import moment from 'moment'

    export default {
        props: ['message'],
        data() {
            return {
                messageSender: null,
                selfOwned: false,
            }
        },
        mounted() {

            this.selfOwned = this.message.user.data != null ? this.message.user.data.id === Laravel.user.id : this.message.selfOwned;

            //Use line below to indicate who sent the message
            this.messageSender = this.selfOwned ? 'Me' : this.message.user.data != null ? this.message.user.data.name : this.message.user.name;
        }
    }
</script>
