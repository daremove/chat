<template>
  <div id="app">
    <h1>Welcome to Chat room</h1>
    <Chat />
  </div>
</template>

<script>
  import Chat from './components/Chat.vue';

  export default {
    name: 'App',
    components: {
      Chat
    }
  }
</script>

<style>
  * {
    box-sizing: border-box;
  }

  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
</style>
