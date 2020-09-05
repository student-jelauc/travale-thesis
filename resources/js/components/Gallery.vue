<template>
    <div>
        <vue-gallery :images="images" :index="index" @close="index = null"></vue-gallery>
        <img :src="images[0]" @click="index = 0" class="img-thumbnail align-bottom"/>
    </div>
</template>

<script>
    import VueGallery from 'vue-gallery';

    export default {
        props: {
            images: null,
        },

        data: () => ({
            index: null,
        }),

        components: {
            'vue-gallery': VueGallery
        },
    }
</script>
