<template>
    <div class="row p-4">
        <div class="col-12">
            <form @submit.prevent="submitAnswer">
                <div v-if="errors" class="text-danger text-center">
                    <span v-for="(error, index) in errors" :key="index">
                        {{ error.toString() }}<br>
                    </span>
                </div>
                <label v-if="question.type === 'radio'" class="form-text">
                    {{ question.question }}: <span class="text-danger">*</span>
                    <input class="form-control" type="radio" value="" v-model="form.answer" required />
                    <span class="feedback-custom"></span>
                </label>
                <label v-else-if="question.type === 'checkbox'" class="form-text">
                    {{ question.question }}: <span class="text-danger">*</span>
                   <select>

                   </select>
                    <span class="feedback-custom"></span>
                </label>
                <label v-else class="form-text">
                    {{ question.question }}: <span class="text-danger">*</span>
                    <input class="form-control" type="text" placeholder="YEADP Email" required />
                    <span class="feedback-custom"></span>
                </label>
                <button type="submit" class="yedp-begin-btn btn active">Next</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                form: {
                    answer: ''
                },
                loading: false,
                errors: [],
                question: '',
                options: []
            }
        },
        methods:{
            getQuestion(){
                axios.get('/api/yaedp/export-diagnostic/get-question')
                    .then(response => {
                        console.log(response.data);
                        if(response.data.success === true){
                            this.question = response.data.question;
                            this.options = response.data.question.export_diagnostic_options;
                        }else{
                            console.log(response.data.message);
                        }
                    }).catch(error => {
                        console.log(error)
                    }).finally(() => {

                    });
            },

            submitAnswer(){
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
            this.getQuestion();
        }
    }
</script>

<style scoped>

</style>
