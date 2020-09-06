<template>
    <select :name="name" ref="select" class="filter-param form-control" :multiple="multiple">
        <template v-for="item in defaultSelected">
            <option v-if="!item.children" :value="item.id">{{ item.text }}</option>
            <optgroup :label="item.text">
                <option v-for="child in item.children" :value="child.id">{{ child.text }}</option>
            </optgroup>

        </template>

        <slot></slot>
    </select>
</template>

<script>
    export default {
        props: {
            value: null,
            routeName: null,
            ajax: null,
            multiple: false,
            placeholder: '',
            name: null,
            routeParams: null,
            dependsOn: {},
            taggable: false
        },

        data: () => ({
            defaultSelected: [],
            params: {},
        }),

        created() {
            this.params = this.routeParams;
            VueEvent.$on('select-params', (context) => {
                if (context.target.indexOf(this.name) < 0) {
                    return;
                }

                this.params = context.params || {};
            })
        },

        mounted() {
            if (this.multiple && this.value && this.value.length || !this.multiple && this.value) {
                let endpoint = this.ajax ? this.ajax.url : null;
                if (!endpoint) {
                    endpoint = this.route(this.routeName, {value: this.value});
                } else {
                    let parsed = queryString.parseUrl(endpoint);
                    endpoint = parsed.url + '?' + queryString.stringify({value: this.value, ...parsed.query}, {arrayFormat: 'bracket'})
                }

                axios
                    .get(endpoint)
                    .then(res => {
                        this.defaultSelected = res.data.results;
                    })
                    .then(() => {
                        this.initSelect()
                    })
            } else {
                this.initSelect()
            }
        },

        methods: {
            initSelect () {
                this.setDependencies();

                let vm = this;
                $(this.$refs.select)
                    .select2({
                        theme: 'bootstrap4' + (this.multiple ? ' select2-checkbox' : ''),
                        placeholder: this.placeholder,
                        allowClear: true,
                        ajax: this.getAjax(),
                        closeOnSelect: !this.multiple,
                        tags: this.taggable
                    })
                    .val(this.value)
                    .trigger('vselect.init')
                    // this is needed to refresh select visual aspect,
                    // without this - no values will show as selected on initial ajax (?value[]=1) (on multiple at least)
                    // that can be tested on descriptors / passwords
                    .trigger('change.select2')
                    .on('select2:unselect', function (e) {
                        let value = $(this).val();
                        if (_.isArray(value)) {
                            vm.$emit('input', _.filter(value, id => id != e.params.data.id));
                        } else {
                            vm.$emit('input', null);
                        }
                    })
                    .on('change', function() {
                        vm.$emit('input',  $(this).val());
                    })

                ;
            },

            setDependencies() {
                let vm = this;
                let params = {};
                _.each(this.dependsOn, (selector, parameter) => {
                    selector = $(selector);
                    selector.on('change', function () {
                        Vue.set(vm.params, parameter, $(this).val());
                        $(vm.$refs.select).val(null).trigger('change');
                    });

                    selector.on('vselect.init', function () {
                        Vue.set(vm.params, parameter, $(this).val());
                    });

                    params[parameter] = selector.val();
                });

                this.params = params;
            },

            getAjax() {
                if (!this.ajax && !this.routeName) {
                    return undefined;
                }

                let ajax = this.ajax || {
                    url: () => this.route(this.routeName, this.params),
                    dataType: 'json',
                    cache: true,
                };

                ajax['processResults'] = function (data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.results,
                        pagination: {
                            more: data.more !== undefined ? data.more : _.size(data.results) === 15,
                        }
                    };
                };

                return ajax;
            }
        },
        watch: {
            value: function (value) {
                // update value; skip trigger if is same value
                if ([...value].sort().join(",") !== [...$(this.$el).val()].sort().join(",")) {
                    $(this.$el).val(value).trigger('change');
                }
            },
        },
        destroyed: function () {
            $(this.$refs.select)
                .off()
                .select2("destroy");
        }
    }
</script>
