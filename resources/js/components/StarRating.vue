<template>
    <div>
        <vue-star-rating v-model="rating" :rating="rating" :star-size="size || 25" :show-rating="false"></vue-star-rating>
        <input type="hidden" :name="name" :value="rating">
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating'
    export default {
        name: "StarRating",
        components: {
            'vue-star-rating': StarRating
        },
        props: ['name', 'value', 'size'],
        data: () => ({
            rating: 0,
        }),
        mounted() {
           this.rating = this.value || 0;
        }
    }
</script>
