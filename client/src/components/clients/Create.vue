<template>
    <clientLayout ref="clientLayout" :clientData="this.clientData" :errors="this.errors">
        <div class="container">
            <h1 class="display-4">{{ $t('client.create') }}</h1>
            <Form :clientData="this.clientData" :errors="this.errors" @callCreate="create"></Form>
        </div>
    </clientLayout>
</template>

<script>
    import Form from "./Form";

    export default {
        name: "Create",
        components: {Form},
        metaInfo: function () {
            return {
                title: this.$t('client.create'),
            }
        },
        data() {
            return {
                clientData: {
                    name: '',
                    email: '',
                    selectedTags: []
                },
                errors: {
                    name: false,
                    email: false,
                    selectedTags: false,
                }
            }
        },

        methods: {
            create: function () {
                let self = this;
                Object.keys(self.errors).forEach(function (key) {
                    self.errors[key] = false
                });

                self.clientData.selectedTags = self.clientData.selectedTags.map(tag => {
                    tag['id'] = tag.key;
                    tag['name'] = tag.value;
                    return tag;
                });

                this.$http.post(this.$backendUrl + 'clientes', self.clientData)
                    .then(function (response) {
                        self.$refs.clientLayout.successHandler(response.data.message, 'clients');
                    })
                    .catch(function (error) {
                        self.$refs.clientLayout.errorHandler(error);
                    });
            }
        },
    }
</script>
