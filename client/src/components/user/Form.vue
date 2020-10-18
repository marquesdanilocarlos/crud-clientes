<template>
    <form class="needs-validation" novalidate>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="firstName">{{ $t('fields.first_name') }}</label>
                <input type="text" id="firstName" v-model="registerData.first_name"
                       :class="{ 'border-pink-400': errors.first_name }"
                       class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName">{{ $t('fields.last_name') }}</label>
                <input type="text" id="lastName" v-model="registerData.last_name"
                       :class="{ 'border-pink-400': errors.last_name }"
                       class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="email">{{ $t('fields.email') }}</label>
                <input type="email" id="email" v-model="registerData.email"
                       :class="{ 'border-pink-400': errors.email }"
                       class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="gender">Sexo</label>
                <select v-model="registerData.gender"
                        :class="{ 'border-pink-400': errors.email }" class="custom-select" id="gender" required>
                    <option selected value="m">Masculino</option>
                    <option value="f">Feminino</option>
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="password">{{ $t('fields.password') }}</label>
                <input type="password" id="password" v-model="registerData.password"
                       :class="{ 'border-pink-400': errors.password }"
                       class="form-control">
            </div>
            <button type="submit" v-on:click.prevent="register()"
                    class="btn btn-primary"> Cadastrar
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "Form",
        props: ['registerData', 'errors'],
        methods: {
            register(){
                this.$emit("callRegister")
            }
        }
    }
</script>

<style scoped>

</style>
