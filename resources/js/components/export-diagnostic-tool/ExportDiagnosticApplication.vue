<template>
    <div class="row p-4">
        <div v-if="dataLoaded" class="col-12">
            <form @submit.prevent="submitAnswer">

                <div v-if="errors" class="text-danger text-center">
                    <span v-for="(error, index) in errors" :key="index">
                        {{ error.toString() }}<br>
                    </span>
                </div>

                <div v-if="question.type === 'radio'" class="">
                    <p class="custom-font1 text-large brand-text-brown">
                        {{ question.question }}: <span class="text-danger">*</span>
                    </p>
                    <label v-for="(option, index) in options" :key="option.id"
                           class="radio-container">{{ option.option }}
                        <input type="radio" @change="selectOption"
                               v-model="form.option_id"
                               :value="option.id">
                        <span class="checkmark"></span>
                    </label>
                    <span class="feedback-custom"></span>
                </div>

                <label v-if="question.type === 'checkbox'" class="form-text">
                    {{ question.question }}: <span class="text-danger">*</span>
                    <select class="form-control" required @change="selectOption($event)">
                        <option value="" selected>Select answer</option>
                        <option v-for="(option, index) in options" :key="option.id"
                                :value="option.option">{{ option.option }}</option>
                    </select>
                    <span class="feedback-custom"></span>
                </label>

                <label v-if="question.type === 'freetext'" class="form-text">
                    {{ question.question }}: <span class="text-danger">*</span>
                    <input class="form-control" type="text" placeholder="YEADP Email" required />
                    <span class="feedback-custom"></span>
                </label>

                <button v-if="!loading" type="submit" class="yedp-begin-btn btn active">Next</button>
                <button v-else disabled class="yedp-begin-btn btn active">
                    <i class="fa fa-circle-o-notch fa-spin"></i>
                </button>
            </form>
        </div>
        <div class="col-12" v-else>
            <ContentLoader viewBox="0 0 400 150" height={130} width={400}>
                <circle cx="10" cy="20" r="8" />
                <rect x="25" y="15" rx="5" ry="5" width="300" height="10" />
                <rect x="25" y="45" rx="5" ry="5" width="220" height="10" />
                <circle cx="34" cy="80" r="8" />
                <rect x="51" y="75" rx="5" ry="5" width="90" height="8" />
                <circle cx="34" cy="110" r="8" />
                <rect x="50" y="106" rx="5" ry="5" width="100" height="8" />
            </ContentLoader>
        </div>

    </div>
</template>

<script>
    import {
        ContentLoader,
        CodeLoader,
        BulletListLoader,
        ListLoader,
    } from 'vue-content-loader';

    export default {
        components: {
            ContentLoader,
            CodeLoader,
            BulletListLoader,
            ListLoader,
        },
        data(){
            return {
                form: {
                    answer: '',
                    points: '',
                    option_Id: ''
                },
                loading: false,
                errors: [],
                question: '',
                options: [],
                dataLoaded: false
            }
        },
        methods:{
            selectOption(e){
                console.log(e);
                console.log(e.target);
                console.log(e.target.value);
            },
            getQuestion(){
                this.dataLoaded = false;
                axios.get('/api/yaedp/export-diagnostic/get-question')
                    .then(response => {
                        console.log(response.data);
                        if(response.data.success === true){
                            this.question = response.data.question;
                            this.options = response.data.question.export_diagnostic_options;
                            this.dataLoaded = true;
                            console.log(this.options);
                        }else{
                            console.log(response.data.message);
                        }
                    }).catch(error => {
                        console.log(error)
                    }).finally(() => {

                    });
            },

            submitAnswer(){
                this.loading = true;
                axios.post('/api/yaedp/export-diagnostic/question/'+this.question.id+'/answer/store', this.form)
                    .then(response => {
                        console.log(response.data);
                        if(response.data.success === true){
                            this.getQuestion();
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
