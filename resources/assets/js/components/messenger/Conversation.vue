<template>
    <div class="row">
        <div class="col-sm-8">
            <div class="messenger-conversation-wrapper">
                <conversation-header></conversation-header>
                <hr>

                <conversation-messages></conversation-messages>

            </div><!-- /.messenger-conversation-wrapper -->
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'recipient'
        ],
        mounted() {
            console.log('Messenger Conversation Component mounted.')
        }
    }
</script>
