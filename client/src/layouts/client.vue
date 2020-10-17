<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>

import '@fortawesome/fontawesome-free/css/all.min.css'

export default {
    name: "clientLayout",
    props: ['registerData', 'errors'],
    methods: {
        successHandler(message, redirectUrl){
            Object.keys(self.registerData).forEach(function (key) {
                self.registerData[key] = ''
            });
            self.$notice['success']({
                title: self.$t('success'),
                description: self.$t(String(message))
            });
            setTimeout(() => self.$router.push({name: redirectUrl}), 3000)
        },
        errorHandler(error){
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
