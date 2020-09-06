<template></template>
<script>
    export default {
        mounted () {
            VueEvent.$on('query-filters', options => {
                let current = queryString.parse(location.search, {arrayFormat: 'bracket'});

                if (options.method === 'clear') {
                    current = options.params;
                } else {
                    current = {...current, ...options.params};
                }

                if (_.size(options.clear)) {
                    current = _.omit(current, options.clear);
                }

                location.search = queryString.stringify(current, {arrayFormat: 'bracket'});
            })
        },


    }
</script>