<template>
    <form class="needs-validation" novalidate>
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="firstName">{{ $t('fields.name') }}</label>
                <input type="text" id="firstName" v-model="clientData.name"
                       :class="{ 'invalid': errors.name }"
                       class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="email">{{ $t('fields.email') }}</label>
                <input type="email" id="email" v-model="clientData.email"
                       :class="{ 'invalid': errors.email }"
                       class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="tags">{{ $t('fields.tags') }}</label>
                <tags-input
                        :existing-tags="this.tags"
                        :typeahead="true"
                        :placeholder="$t('fields.tags_placeholder')"
                        :typeahead-hide-discard="true"
                        v-model="clientData.selectedTags"
                ></tags-input>
            </div>
            <button v-if="this.$route.name == 'create'" type="button" v-on:click.prevent="callCreate"
                    class="btn btn-success"> Cadastrar
            </button>
            <button v-else type="button" v-on:click.prevent="callEdit"
                    class="btn btn-success"> Editar
            </button>
            <button type="button"
                    class="btn btn-primary ml-2"
            @click="$router.push({name: 'clients'})">
                <i class="fa fa-backward"></i> Voltar
            </button>
        </div>
    </form>
</template>

<script>
    import TagsInput from '@voerro/vue-tagsinput';

    export default {
        name: "Form",
        components: {TagsInput},
        props: ['clientData', 'errors'],
        data() {
            return {
                tags: []
            };
        },
        mounted() {
            this.getExistingTags();
        },
        methods: {
            callCreate() {
                this.$emit("callCreate")
            },
            callEdit() {
                this.$emit("callEdit")
            },
            getExistingTags() {
                let self = this;
                this.$http.get(this.$backendUrl + 'tags')
                    .then(function (response) {
                        self.tags = response.data.map(tag => {
                            tag['key'] = tag.id;
                            tag['value'] = tag.name;
                            delete tag.id;
                            delete tag.name;
                            return tag;
                        });
                    })
                    .catch(function (error) {
                        self.$refs.clientLayout.errorHandler(error, 'create');
                    });
            }
        }
    }
</script>

<style scoped>

</style>
