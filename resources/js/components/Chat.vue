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
          ip: null,
          nickname: 'anonymous',
          style: {color: '#000'}
        },
        connect: null
      }
    },
    mounted() {
      // axios.post('push')
      //   .then(res => {
      //     console.log(res);
      //   })
      //   .catch(err => {
      //     console.log(err);
      //   });
      this.connect = new WebSocket('ws://192.168.1.8:8080');

      this.connect.onopen = function(e) {
        alert("Соединение установлено.");
      };

      this.connect.onclose = function(event) {
        if (event.wasClean) {
          alert('Соединение закрыто чисто');
        } else {
          alert('Обрыв соединения'); // например, "убит" процесс сервера
        }
        alert('Код: ' + event.code + ' причина: ' + event.reason);
      };

      this.connect.onmessage = event => {
        this.handleGetMessage(event.data);
      };

      this.connect.onerror = function(error) {
        alert("Ошибка " + error.message);
      };
    },
    methods: {
      handleSaveUser(user) {
        this.user.nickname = user.nickname;
        this.user.style = {color: user.style};
      },
      handleMessageSubmit() {
        if (!this.message) return;

        const data = {
          nickname: this.user.nickname,
          color: this.user.style.color,
          text: this.message,
          date: this.getDateCreated()
        };

        this.connect.send(JSON.stringify(data));
        this.message = '';
        this.messages.push(data);
        this.$nextTick(() => {
          this.$refs.view.$el.scrollTop = this.$refs.view.$el.scrollHeight;
        });
      },
      handleGetMessage(data) {
        const parseData = JSON.parse(data);

        if (parseData.hasOwnProperty('ip')) {
          this.user.ip = parseData.ip;
        } else {
          this.messages.push(parseData);
          this.$nextTick(() => {
            this.$refs.view.$el.scrollTop = this.$refs.view.$el.scrollHeight;
          });
        }
      },
      getDateCreated() {
        const date = new Date();
        const hours = date.getHours() > 9 ? date.getHours() : `0${date.getHours()}`;
        const minutes = date.getMinutes() > 9 ? date.getMinutes() : `0${date.getMinutes()}`;
        const seconds = date.getSeconds() > 9 ? date.getSeconds() : `0${date.getSeconds()}`;

        return `${hours}:${minutes}:${seconds}`;
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
