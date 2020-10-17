<template>
    <clientLayout>
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
                            <td>ID</td>
                            <td>Nome</td>
                            <td>E-mail</td>
                            <td>Sexo</td>
                            <td colspan=2>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="" method="post">

                                    <button class="btn btn-danger" type="submit">Delete</button>
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
        methods:{
            logout: function () {
                this.$store.commit('LOGOUT_USER');
                this.$router.push({name: 'login'});
            }
        }
    }
</script>
