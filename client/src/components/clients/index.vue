<template>
    <clientLayout ref="clientLayout">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="display-3">Clientes</h1>
                        <button class="btn btn-danger" @click="logout">
                            <i class="fas fa-sign-out-alt mr-3"></i> {{ $t('logout.title') }}
                        </button>
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
                                <a href="" class="btn btn-primary mr-2">Editar</a>
                                <form action="" method="post">
                                    <button class="btn btn-danger" type="submit">Deletar</button>
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
                clients: {

                }
            }
        },
        methods:{
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
                    self.$refs.clientLayout.errorHandler(error, 'clients');
                });
        }
    }
</script>
