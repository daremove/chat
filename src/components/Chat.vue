<template>
    <div class="chat">
        <div class="chat__view"></div>
        <div class="chat__actions">
            <input type="text">
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'Chat',
        mounted() {
            axios.post('push.php')
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
</script>

<style lang="scss">
    .chat {
        width: 600px;
        height: 400px;
        margin: 0 auto;
    }

    .chat__view {
        width: 100%;
        height: 100%;

        box-shadow: 0 1px 0 0 #d7d8db,
                    0 0 0 1px #e3e4e8;
    }

    .chat__actions {
        display: flex;
        width: 100%;

        input {
            width: 100%;
        }
    }
</style>
