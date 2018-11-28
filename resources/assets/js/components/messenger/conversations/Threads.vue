<template>
    <conversations-user :thread="thread"></conversations-user>
</template>

<script>
    import Bus from '../../../bus'

    export default {
        props: ['thread'],
        mounted() {
        }
    }
</script>
