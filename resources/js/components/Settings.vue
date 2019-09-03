<template>
    <div class="settings">
        <span class="settings__nickname" :style="{color: currentColor}">
            {{ user.nickname }}
        </span>
        <svg
            class="settings__icon"
            @click="toggleEdit"
        >
            <use xlink:href="#icon-wrench" />
        </svg>

        <transition name="fade">
            <div
                    class="settings__popup"
                    v-if="isEdit"
            >
                <div class="settings__inner">
                    <div class="settings__inner-column settings__inner-column--first">
                        <label class="label">
                            <span class="label__text">
                                Введите никнейм
                            </span>
                            <input
                                    type="text"
                                    class="label__input settings__popup-nickname"
                                    v-model="currentNickname"
                                    maxlength="20"
                            >
                        </label>
                    </div>

                    <div class="settings__inner-column settings__inner-column--second">
                        <label class="label">
                            <span class="label__text">
                                Выберите цвет
                            </span>
                            <select
                                    class="label__input"
                                    v-model="currentColor"
                                    :style="{color: currentColor}"
                            >
                                <option
                                        v-for="color in colors"
                                        :value="color"
                                        :style="{color: `${color}`}"
                                >
                                    {{ currentNickname }}
                                </option>
                            </select>
                        </label>
                    </div>

                    <svg
                        class="settings__save"
                        @click="saveUser"
                    >
                        <use xlink:href="#icon-save" />
                    </svg>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        name: 'Settings',
        data() {
            return {
                isEdit: false,
                currentNickname: this.user.nickname,
                currentColor: '#000',
                colors: ['#000', '#FFFF00', '#FF0000', '#CC6633', '#FF0066', '#FF33CC', '#6600FF', '#00CCFF', '#339900', '#CCFF00']
            }
        },
        methods: {
            toggleEdit() {
                this.isEdit = true;
            },
            saveUser() {
                this.$emit('save-user', {
                    nickname: this.currentNickname,
                    style: this.currentColor
                });

                this.isEdit = false;
            }
        }
    }
</script>

<style lang="scss">
    .settings {
        position: relative;

        display: flex;
        align-items: center;
        width: 100%;
        max-width: 500px;
        margin: 10px 0 0;
    }

    .settings__nickname {
        margin-right: 5px;

        font-size: 13px;
        font-style: italic;
    }

    .settings__icon {
        width: 20px;
        height: 15px;

        fill: #B7BBC5;
        cursor: pointer;

        transition: fill 0.3s;

        &:hover,
        &:focus {
            fill: #8E919B;
        }
    }

    .settings__popup {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;

        height: 76px;

        background-color: #fff;
        border-radius: 6px;
        border: solid 1px #d3d9de;
    }

    .settings__inner {
        position: relative;

        display: flex;
        width: 100%;
        height: 100%;
        padding: 10px 20px;
    }

    .settings__inner-column--first {
        margin-right: 20px;
    }

    .settings__save {
        position: absolute;
        top: 50%;
        right: 20px;

        width: 40px;
        height: 40px;

        fill: #B7BBC5;
        cursor: pointer;

        transition: fill 0.3s;

        &:hover,
        &:focus {
            fill: #8E919B;
        }

        transform: translateY(-50%);
    }

    .label {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .label__text {
        margin-bottom: 5px;

        font-size: 13px;
    }

    .label__input {
        padding: 3px 5px;

        background-color: #fff;
        border: solid 1px #d3d9de;
        border-radius: 6px;
        outline: none;
    }
</style>