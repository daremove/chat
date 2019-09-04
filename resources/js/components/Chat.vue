<template>
  <div class="chat">
    <transition-group
      ref="view"
      name="fade"
      class="chat__view"
      tag="div"
    >
      <ChatMessage
        v-for="(messageItem, index) in messages"
        :key="index"
        :message="messageItem"
      />
    </transition-group>

    <div class="chat__actions">
      <ChatSettings
        :user="user"
        @save-user="handleSaveUser"
      />

      <ChatInput
        v-model.trim="message"
        @send-message="handleMessageSubmit"
      />
    </div>
  </div>
</template>

<script>
  import axios from 'axios';

  import ChatSettings from './ChatSettings.vue';
  import ChatMessage from './ChatMessage.vue';
  import ChatInput from "./ChatInput.vue";

  export default {
    name: 'Chat',
    components: {
      ChatMessage,
      ChatSettings,
      ChatInput
    },
    data() {
      return {
        message: '',
        messages: [],
        user: {
          isAuthorized: false,
          nickname: 'anonymous',
          style: {color: '#000'}
        }
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
    },
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

        this.$nextTick(() => {

          this.$refs.view.$el.scrollTop = this.$refs.view.$el.scrollHeight;
        });
      }
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

    scroll-behavior: smooth;
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
</style>
