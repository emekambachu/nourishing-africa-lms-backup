<template>
    <div class="card p-5 margin-10px-top">
        <h6 class="yedp-begin-title">Login to Begin</h6>
        <div class="text-center" v-show="loading">
            <img :src="'/images/loaders/loading.gif'" width="100"/>
        </div>
        <form v-else @submit.prevent="login">
            <div v-if="errors" class="text-danger text-center">
                <span v-for="(error, index) in errors" :key="index">
                    {{ error.toString() }}<br>
                </span>
            </div>
            <label class="form-text">Email: <span class="text-danger">*</span>
                <input v-model="form.email"
                       class="form-control" type="email" placeholder="YEADP Email" required />
                <span class="feedback-custom"></span>
            </label>
            <label class="form-text">Password: <span class="text-danger">*</span>
                <input v-model="form.password"
                       class="form-control" type="Password" placeholder="YEADP Password" required />
                <span class="feedback-custom"></span>
            </label>
            <button type="submit" class="yedp-begin-btn btn active">Begin</button>
        </form>

        <div class="float-right" style="display: block;">
            <p class="text-center login-shortcut">
                <a class="na-text-dark-green"
                   :href="'/yaedp/forgot-password'">
                    Reset Password</a>
            </p>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                form: {
                    email: '',
                    password: ''
                },
                loading: false,
                errors: []
            }
        },

        methods: {
            login(){
                this.errors = [];
                this.loading = true;
                axios.post('/api/yaedp/export-diagnostic/login', this.form)
                    .then(response => {
                        console.log(response.data);
                        if(response.data.success === true){
                            window.location.href = '/yaedp/export-diagnostic/instructions';
                        }else{
                            this.errors = response.data.errors;
                        }
                    }).catch(error => {
                        console.log(error)
                    }).finally(() => {
                        this.loading = false;
                    });
            }
        },

        mounted(){

        }
    }
</script>

<style scoped>

</style>
