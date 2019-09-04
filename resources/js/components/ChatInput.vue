<template>
  <!-- eslint-disable-next-line -->
  <textarea
    name="message"
    class="chat__actions-input"
    :value="value"
    @input="$emit('input', $event.target.value)"
    @keydown.prevent.enter="$emit('send-message')"
  ></textarea>
</template>

<script>
  export default {
    name: 'ChatInput',
    props: {
      value: {
        type: String,
        default: ''
      }
    }
  }
</script>

<style lang="scss">
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