<template>
	<loginLayout>
        <div class="login-form">
            <form action="#" method="post">
                <h2 class="text-center">{{ $t('login.title') }}</h2>
                <div class="form-group">
                    <input type="text" v-model="loginData.email" :class="{ 'invalid': errors.email }" class="form-control" placeholder="E-mail" required="required">
                </div>
                <div class="form-group">
                    <input type="password" v-model="loginData.password" :class="{ 'invalid': errors.password }" class="form-control" placeholder="Senha" required="required">
                </div>
                <div class="form-group">
                    <button v-on:click.prevent="login()" type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>
            </form>
            <div class="text-center pt-12 pb-12">
                <p>{{ $t('register.register_info') }}
                    <router-link class="underline font-semibold" :to="{ name: 'cadastro' }">{{ $t('register.register_now')
                        }}
                    </router-link>
                    .
                </p>
            </div>
        </div>
	</loginLayout>
</template>

<script>
export default {
	metaInfo: function() {
		return {
			title: this.$t('login.title'),
		}
	},
	data() {
		return {
			loginData: {
				email: '',
				password: '',
			},
			errors: {
				email: false,
				password: false,
			}
		}
	},
    methods: {
        login: function() {
			var self = this

            Object.keys(this.errors).forEach(function(key) {
                self.errors[key] = false
            });

			this.$http.post(this.$backendUrl + 'login', self.loginData)
			.then(function(response) {
				self.$store.commit('LOGIN_USER', response)

				self.$router.push({ name: 'clients' })
			})
			.catch(function(error) {
				var errors = error

				try {
					if(error.response.status == 422) {
						errors = '';
						for(var errorKey in error.response.data.errors) {
							if(errorKey in self.errors) {
                                self.errors[errorKey] = true
                            }

							for(var i = 0; i < error.response.data.errors[errorKey].length; i++) {
								errors += (String(error.response.data.errors[errorKey][i])) + '<br>'
							}
						}
					}

					if(error.response.status == 500) {
						errors = error.response.data.message
					}
				} catch(e) {
					console.log(e)
				}

				self.$notice['error']({
					title: self.$t('error'),
					description: String(errors)
				})
			})
        }
	},
}
</script>
