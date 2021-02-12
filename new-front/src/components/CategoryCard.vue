<template>
    <div class="category-card">
        <div class="category-card__title">
            Косметика по уходу за лицом
        </div>
    </div>
</template>

<script>
    export default {
        name: "CategoryCard"
    }
</script>

<style scoped lang="scss">
    .category-card {
        width: 100%;
        height: 250px;
        border-radius: 0px 0px 4px 4px;
        position: relative;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        background: url("../../public/face.svg");
        background-size: cover;

        &:hover {
            cursor: pointer;

            .category-card__title {
                height: 100%;
                transition: .3s;
            }
        }

        &__title {
            transition: .3s;
            background-color: #2F7484;
            opacity: 0.5;
            color: #fff;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 58px;
            font-weight: 200;
            font-size: 19px;
            padding: 20px;
            border-radius: 0px 0px 4px 4px;
        }
    }
</style>
