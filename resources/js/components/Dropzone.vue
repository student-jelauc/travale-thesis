<template>
    <vue-dropzone ref="dropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
</template>
<script>
    import vue2Dropzone from 'vue2-dropzone';

    export default {
        components: {
            vueDropzone: vue2Dropzone
        },

        props: {
            url: null
        },

        computed: {
            dropzoneOptions() {
                let vm = this;

                return {
                    url: this.url,
                    addRemoveLinks: true,
                    dictDefaultMessage: "<i class='fas fa-cloud-upload'></i>Drop files here",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    init: function () {
                        this.on('removedfile', (file) => {
                            axios.delete(vm.url, {params: {file: file.name}});
                        })
                    }
                }
            }
        },

        mounted() {
            axios.get(this.url).then(response => {
                _.each(response.data || [], photo => {
                    this.$refs.dropzone.manuallyAddFile(photo, photo.url);
                })
            })
        }
    }
</script>
