<template>
    <div class="bg-white font-family-karla h-screen">
        <slot></slot>
    </div>
</template>

<script>
    import '@fortawesome/fontawesome-free/css/all.min.css'

    export default {
        name: "loginLayout",
        props: ['registerData', 'errors'],
        methods: {
            successHandler(message, redirectUrl) {
                let self = this;
                Object.keys(self.registerData).forEach(function (key) {
                    self.registerData[key] = ''
                });
                self.$notice['success']({
                    title: self.$t('success'),
                    description: self.$t(String(message))
                });
                setTimeout(() => self.$router.push({name: redirectUrl}), 3000)
            },
            errorHandler(error) {
                let self = this;
                var errors = error;
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
            }
        }
    }
</script>

<style>
    .login-form {
        width: 340px;
        margin: 50px auto;
        font-size: 15px;
    }

    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }

    .login-form h2 {
        margin: 0 0 15px;
    }

    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }

    .btn {
        font-size: 15px;
        font-weight: bold;
    }
</style>
