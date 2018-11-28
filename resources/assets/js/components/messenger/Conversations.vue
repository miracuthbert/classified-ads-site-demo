<template>
    <div id="conversations-users-wrapper">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#tabThreads" aria-controls="tabThreads" role="tab" data-toggle="tab" aria-expanded="true"
                   title="Conversations">
                    <i class="fa fa-comments"></i>
                </a>
            </li>
            <li role="presentation">
                <a href="#tabCreateThread" aria-controls="tabCreateThreads" role="tab" data-toggle="tab"
                   title="Start new conversation">
                    <i class="fa fa-user-plus"></i>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tabThreads">
                <div class="list-group">
                    <a href="" class="list-group-item text-center" :class="{hidden: threadsRefreshHidden}"
                       v-on:click="handleOnClickEventThreads">
                        <i class="fa fa-refresh"></i> Refresh Conversations
                    </a>
                    <conversations-users v-for="thread in threads" :key="thread.id"
                                         :thread="thread"></conversations-users>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tabCreateThread">
                <div class="list-group">
                    <a href="" class="list-group-item text-center" :class="{hidden: recipientsRefreshHidden}"
                       v-on:click="handleOnClickEventRecipients">
                        <i class="fa fa-refresh"></i> Refresh Recipients
                    </a>
                    <conversations-recipients v-for="(recipient, i) in recipients" :key="recipient.id"
                                              :recipient="recipient" :index="i"></conversations-recipients>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Bus from '../../bus'

    export default {
        data() {
            return {
                recipients: [],
                threads: [],
                threadsRefreshHidden: true,
                recipientsRefreshHidden: true,
            }
        },
        methods: {
            handleOnClickEventRecipients(e) {
                e.preventDefault();

                this.recipientsRefreshHidden = true;

                axios.get('/messenger/messages/create').then((response) => {
                    this.recipients = response.data.data;
                }).catch((error) => {
                    this.recipientsRefreshHidden = false;
                });
            },
            handleOnClickEventThreads(e) {
                e.preventDefault();

                this.threadsRefreshHidden = true;

                axios.get('/messenger/messages').then((response) => {
                    this.threads = response.data.data;
                }).catch((error) => {
                    this.threadsRefreshHidden = false;
                });
            },
            removeRecipient(id) {
                this.recipients = this.recipients.filter((recipient) => {
                    return recipient.id !== id;
                })
            },
            addThread(thread) {
                this.threads.unshift(thread);
            }
        },
        mounted() {

            //get recipients list
            axios.get('/messenger/messages/create').then((response) => {
                this.recipients = response.data.data;

                if (this.recipients == null) {
                    this.recipientsRefreshHidden = false;
                }
            }).catch((error) => {
                console.log(error);
                this.recipientsRefreshHidden = false;
            });

            //get threads list
            axios.get('/messenger/messages').then((response) => {
                this.threads = response.data.data;

                if (this.threads == null) {
                    this.threadsRefreshHidden = false;
                }
            }).catch((error) => {
                console.log(error);
                this.threadsRefreshHidden = false;
            });

            Bus.$on('thread.added', (thread) => {
                this.addThread(thread);
            }).$on('recipients.remove', (recipient) => {
                this.removeRecipient(recipient.id);
            });

            if (this.recipients == null) {
                this.recipientsRefreshHidden = false;
            }

            if (this.threads == null) {
                this.threadsRefreshHidden = false;
            }
        }
    }
</script>
