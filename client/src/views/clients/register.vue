<template>
    <loginLayout>
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
                })

                // Ajax Request
                this.$http.post(this.$backendUrl + 'register', self.registerData)
                    .then(function (response) {
                        Object.keys(self.registerData).forEach(function (key) {
                            self.registerData[key] = ''
                        })
                        self.$notice['success']({
                            title: self.$t('success'),
                            description: self.$t(String(response.data.message))
                        })
                        setTimeout(() => self.$router.push({name: 'login'}), 3000)
                    })
                    .catch(function (error) {
                        var errors = error
                        try {
                            if (error.response.status == 422) {
                                errors = '';
                                for (var errorKey in error.response.data.errors) {
                                    if (errorKey in self.errors) {
                                        self.errors[errorKey] = true
                                    }
                                    for (var i = 0; i < error.response.data.errors[errorKey].length; i++) {
                                        errors += (String(error.response.data.errors[errorKey][i])) + '<br>'
                                    }
                                }
                            }
                            if (error.response.status == 500) {
                                errors = error.response.data.message
                            }
                        } catch (e) {
                            console.log(e)
                        }
                        self.$notice['error']({
                            title: self.$t('error'),
                            description: String(errors)
                        })
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
