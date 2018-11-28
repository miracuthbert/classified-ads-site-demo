<template>
    <conversations-recipient :recipient="recipient" :index="index"></conversations-recipient>
</template>

<script>
    export default {
        props: [
            'recipient',
            'index',
        ],
        mounted() {
        }
    }
</script>
