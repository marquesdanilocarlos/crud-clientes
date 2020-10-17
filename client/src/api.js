export default {
    get(){

    },

    post(resource, data){
        return this.$http.post(this.$backendUrl + resource, data)
            .then(function (response) {
                Object.keys(data).forEach(function (key) {
                    data[key] = ''
                });
                self.$notice['success']({
                    title: self.$t('success'),
                    description: self.$t(String(response.data.message))
                });
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
    },

    put(){

    },

    delete(){

    }
}
