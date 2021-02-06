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
    padding: 18px 45px;
}

</style>
