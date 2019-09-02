<template>
    <div class="chat">
        <div class="chat__view">
            <Message
                    v-for="(message, index) in messages"
                    :key="index"
                    :message="message"
            />
        </div>
        <div class="chat__actions">
            <textarea
                    name="message"
                    class="chat__actions-input"
                    @keypress.enter="handleMessageSubmit"
                    v-model.trim="message"
            ></textarea>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    import Message from '../components/Message.vue';

    export default {
        name: 'Chat',
        data() {
            return {
                message: '',
                messages: []
            }
        },
        components: { Message },
        methods: {
            handleMessageSubmit() {
                if (!this.message) return;

                this.messages.push({
                    nickname: 'anonymous',
                    text: this.message
                });

                this.message = '';
            }
        },
        mounted() {
            axios.post('push')
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
        padding: 10px;
        margin: 0 auto;
    }

    .chat__view {
        width: 100%;
        height: 100%;
        overflow-y: auto;

        border: 1px solid #e3e4e8;
        border-bottom: none;
    }

    .chat__actions {
        display: flex;
        padding: 20px 10px;
        justify-content: center;
        align-items: center;
        width: 100%;

        background-color: #fafbfc;
        border-radius: 0 0 6px 6px;
        border: 1px solid #e3e4e8;
    }

    .chat__actions-input {
        width: 100%;
        max-width: 500px;
        height: 60px;
        padding: 9px 106px 10px 13px;

        background-color: #fff;
        border: solid 1px #d3d9de;
        border-radius: 6px;
        outline: none;

        resize: none;
    }
</style>
