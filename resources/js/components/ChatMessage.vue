<template>
  <div class="message">
    <div class="message__inner">
      <div class="message__inner-row">
        <span
          class="message__nickname"
          :style="message.style"
        >
          {{ message.nickname }}
        </span>
        <span class="message__date">
          {{ message.date }}
        </span>
      </div>
      <span class="message__text">
        {{ message.text }}
      </span>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'Message',
    props: {
      message: {
        type: Object,
        default: () => {}
      }
    }
  }
</script>

<style lang="scss">
  .message__inner {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin: 0 auto;
    padding: 5px 10px;
  }

  .message__inner-row {
    display: flex;
    align-items: center;
  }

  .message__nickname {
    margin-right: 10px;

    color: #42648b;
    font-size: 13px;
    font-weight: 700;
  }

  .message__date {
    font-size: 12px;
    color: hsla(220,8%,51%,.6);
  }

  .message__text {
    font-size: 13px;
  }
</style>
