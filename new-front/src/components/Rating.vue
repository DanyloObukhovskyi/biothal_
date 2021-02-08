<template>
    <v-rating
        color="#000"
        background-color="#000"
        hover
        length="5"
        :value="3">
        <template v-slot:item="props">
            <v-icon
                class="icon-star"
                color="#000"
                size="13"
                @click="props.click">
                {{ props.isFilled ? 'mdi-star' : 'mdi-star-outline' }}
            </v-icon>
        </template>
    </v-rating>
</template>

<script>
  export default {
    name: "Rating"
  }
</script>

<style scoped lang="scss">
    .icon-star {
        padding: 1.5px !important;
    }
</style>
