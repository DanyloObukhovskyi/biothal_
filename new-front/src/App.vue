<template>
    <div id="app">
        <router-view/>
    </div>
</template>

<script>

    export default {
        name: 'App'
    }
</script>

<style lang="scss">

    .base-page-wrapper {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .default-cursor {
        cursor: default;
    }

    div::-webkit-scrollbar-track
    {
        color: #EAEAEA;
        border-radius: 10px;
    }

    div::-webkit-scrollbar
    {
        width: 7px;
    }

    div::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        background-color: #EAEAEA;
    }
</style>
