<template>
    <form action="#" class="form" autocomplete="off">
        <div class="form-group input-group">
            <input type="text" name="" id="messenger-search" class="form-control"
                   placeholder="Search messenger by name, conversation...">
            <span class="input-group-btn">
                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {
            console.log('Messenger Search Component mounted.')
        }
    }
</script>