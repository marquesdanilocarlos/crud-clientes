<template>
    <clientLayout ref="clientLayout">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="display-4">{{ $t('client.index') }}</h1>
                        <div class="d-flex">
                            <button class="btn btn-success mr-3" @click="createClient">
                                <i class="fas fa-plus "></i> {{ $t('client.create') }}
                            </button>
                            <button class="btn btn-danger" @click="logout">
                                <i class="fas fa-sign-out-alt mr-3"></i> {{ $t('logout.title') }}
                            </button>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>Nome</td>
                            <td>E-mail</td>
                            <td colspan=2>Ações</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="client in clients" :key="client.id">
                            <td>{{client.name}}</td>
                            <td>{{client.email}}</td>
                            <td colspan="2" class="d-flex justify-content-start align-items-center">
                                <button type="button" class="btn btn-primary mr-2" @click="editClient(client.id)"><i
                                        class="fas fa-edit "></i> Editar
                                </button>
                                <form action="" method="post">
                                    <button class="btn btn-danger" type="button" @click="deleteClient(client.id)">
                                        <i class="fas fa-times "></i> Deletar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </clientLayout>
</template>

<script>
    export default {
        data() {
            return {
                clients: {}
            }
        },
        methods: {
            createClient() {
                this.$router.push({name: 'create'});
            },
            editClient(id) {
                this.$router.push({name: 'edit', params: {id: id}});
            },
            deleteClient(id) {
                let confirm = window.confirm('Deseja realmente deletar este cliente?');
                if (confirm) {
                    let self = this;
                    this.$http.delete(`${this.$backendUrl}clientes/${id}`)
                        .then(function (response) {
                            self.$refs.clientLayout.successHandler(response.data.message, 'clients')
                        })
                        .catch(function (error) {
                            self.$refs.clientLayout.errorHandler(error);
                        });
                }
            },
            logout: function () {
                this.$store.commit('LOGOUT_USER');
                this.$router.push({name: 'login'});
            }
        },
        mounted() {
            let self = this;
            this.$http.get(this.$backendUrl + 'clientes')
                .then(function (response) {
                    self.clients = response.data;
                })
                .catch(function (error) {
                    self.$refs.clientLayout.errorHandler(error);
                });
        }
    }
</script>
