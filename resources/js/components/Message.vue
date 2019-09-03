<template>
    <div class="message">
        <div class="message__inner">
            <div class="message__inner-row">
                <span class="message__nickname">
                    {{ message.nickname }}
                </span>
                <span class="message__date">
                    {{ getDateCreated }}
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
        props: ['message'],
        computed: {
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
        margin-bottom: 5px;
    }

    .message__nickname {
        margin-right: 10px;

        font-size: 14px;
    }

    .message__date {
        font-size: 12px;
        font-weight: bold;
    }

    .message__text {
        font-size: 14px;
        font-style: italic;
    }
</style>
