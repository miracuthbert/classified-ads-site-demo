<template>
    <div class="conversation-heading">
        <h4>{{ recipientName }}
            <!--<div class="btn-group pull-right">-->
            <!--<span role="button" class="dropdown-toggle" data-toggle="dropdown">-->
            <!--<span class="fa fa-ellipsis-v"></span>-->
            <!--</span>-->
            <!--<ul class="dropdown-menu slidedown">-->
            <!--<li><a href="#"><span class="fa fa-refresh"></span> Refresh</a></li>-->
            <!--<li><a href="#"><span class="fa fa-volume-off"></span> Mute</a></li>-->
            <!--<li><a href="#"><span class="fa fa-archive"></span> Archive</a></li>-->
            <!--<li><a href="#"><span class="fa fa-user-plus"></span> Add participant</a></li>-->
            <!--<li class="divider"></li>-->
            <!--<li><a href="#"><span class="fa fa-sign-out"></span>Leave conversation</a></li>-->
            <!--</ul>-->
            <!--</div>-->
        </h4>
    </div>
</template>

<script>
    import Bus from '../../../bus'

    export default {
        data() {
            return {
                recipient: null,
                creator: null,
                recipientId: null,
                recipientName: "Choose an exiting (or start a new) conversation",
            }
        },
        mounted() {

            Bus.$on('conversation.create', (recipient) => {

                this.recipient = recipient;

                this.recipientId = recipient.id;
                this.recipientName = recipient.name;
            }).$on('conversation.show', (thread) => {

                this.recipient = thread.recipient.data;
                this.creator = thread.creator.data;

                this.recipientId = this.creator.id === Laravel.user.id ? this.recipient.id : this.creator.id;
                this.recipientName = this.creator.id === Laravel.user.id ? this.recipient.name : this.creator.name;
            });
        }
    }
</script>
