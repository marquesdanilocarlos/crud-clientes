<template>
    <clientLayout ref="clientLayout" :clientData="this.clientData" :selectedTags="this.selectedTags" :errors="this.errors">
        <div class="container">
            <h1 class="display-4">{{ $t('client.edit') }}</h1>
            <Form :clientData="this.clientData" :errors="this.errors" @callEdit="edit"></Form>
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
                    id: '',
                    name: '',
                    email: '',
                    selectedTags: []
                },
                errors: {
                    name: false,
                    email: false,
                    tags: false,
                }
            }
        },
        mounted(){
            let self = this;

            this.$http.get(`${this.$backendUrl}clientes/${this.$route.params.id}`, self.clientData)
                .then(function (response) {
                    self.clientData.id = response.data.client.id;
                    self.clientData.name = response.data.client.name;
                    self.clientData.email = response.data.client.email;
                    self.clientData.selectedTags = response.data.client.tags.map(tag => {
                        tag['key'] = tag.id;
                        tag['value'] = tag.name;
                        return tag;
                    });
                })
                .catch(function (error) {
                    self.$refs.clientLayout.errorHandler(error);
                });
        },
        methods: {
            edit: function () {
                let self = this;
                Object.keys(self.errors).forEach(function (key) {
                    self.errors[key] = false
                });

                self.clientData.selectedTags = self.clientData.selectedTags.map(tag => {
                    tag['id'] = tag.key;
                    tag['name'] = tag.value;
                    return tag;
                });

                this.$http.put(`${this.$backendUrl}clientes/${self.clientData.id}`, self.clientData)
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
