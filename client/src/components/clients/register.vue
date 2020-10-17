<template>
    <loginLayout ref="loginLayout" :registerData="this.registerData" :errors="this.errors">
        <div class="register-form">
            <h2>{{ $t('register.title') }}</h2>
            <Form :registerData="this.registerData" :errors="this.errors" @callRegister="register"></Form>
            <div class="text-center pt-12 pb-12">
                <p>{{ $t('register.login_info') }}
                    <router-link class="underline font-semibold" :to="{ name: 'login' }">{{ $t('login.title')
                        }}
                    </router-link>
                    .
                </p>
            </div>
        </div>

    </loginLayout>
</template>

<script>
    import Form from "./Form";
    export default {
        components: {Form},
        metaInfo: function () {
            return {
                title: this.$t('register.title'),
            }
        },
        data() {
            return {
                registerData: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                    gender: ''
                },
                errors: {
                    first_name: false,
                    last_name: false,
                    email: false,
                    password: false,
                }
            }
        },
        methods: {
            // Store a new user
            register: function () {
                var self = this
                // Clear Errors
                Object.keys(self.errors).forEach(function (key) {
                    self.errors[key] = false
                });

                // Ajax Request
                this.$http.post(this.$backendUrl + 'register', self.registerData)
                    .then(function (response) {
                        self.$refs.loginLayout.successHandler(response.data.message, 'login');
                    })
                    .catch(function (error) {
                        self.$refs.loginLayout.errorHandler(error, 'login');
                    });
            }
        },
    }
</script>

<style>
    .register-form {
        width: 800px;
        margin: 50px auto;
        font-size: 15px;
    }
</style>
