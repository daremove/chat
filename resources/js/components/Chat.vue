<template>
    <div class="chat">
        <transition-group
                name="fade"
                class="chat__view"
                tag="div">
            <Message
                    v-for="(message, index) in messages"
                    :key="index"
                    :message="message"
            />
        </transition-group>

        <div class="chat__actions">
            <Settings
                    :user="user"
                    @save-user="handleSaveUser"
            />

            <textarea
                    name="message"
                    class="chat__actions-input"
                    @keypress.enter="handleMessageSubmit"
                    v-model="message"
            ></textarea>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    import Settings from './Settings.vue';
    import Message from './Message.vue';

    export default {
        name: 'Chat',
        data() {
            return {
                message: '',
                messages: [],
                user: {
                    isAuthorized: false,
                    nickname: 'anonymous',
                    style: {color: 'black'}
                }
            }
        },
        components: { Message, Settings },
        methods: {
            handleSaveUser(user) {
                this.user.nickname = user.nickname;
                this.user.style = {color: user.style};
            },
            handleMessageSubmit() {
                if (!this.message) return;

                this.messages.push({
                    nickname: this.user.nickname,
                    style: this.user.style,
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
    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.3s;
    }

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
        position: relative;

        display: flex;
        flex-direction: column;
        padding: 0 10px 20px;
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
