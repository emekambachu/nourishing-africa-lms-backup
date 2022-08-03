<template>
    <div class="row p-4">

        <div class="col-12">
            <div class="progress margin-3px-bottom">
                <div class="progress-bar progress-bar-striped bg-warning padding-2px-tb"
                     role="progressbar" :style="'width: '+progress+'%'"
                     :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{ progress }}</div>
            </div>
        </div>

        <!--If assessment progress is less than 100 percent-->
        <div class="row justify-content-center d-flex" v-if="progress < 100">

            <div v-if="dataLoaded" class="col-12">
                <!--Question category name-->
                <h5 v-if="question.export_diagnostic_category" class="custom-font2 na-text-dark-green">
                    {{ question.export_diagnostic_category.name }}</h5>

                <form @submit.prevent="submitAnswer">
                    <div v-if="errors" class="text-danger text-center">
                        <span v-for="(error, index) in errors" :key="index">
                            {{ error.toString() }}<br>
                        </span>
                    </div>

                    <!--If question type is radio-->
                    <div v-if="question.type === 'radio'">
                        <p class="custom-font1 text-large brand-text-brown">
                            {{ question.question }}: <span class="text-danger">*</span>
                        </p>
                        <label v-for="(option, index) in options" :key="option.id"
                               class="radio-container ml-5">{{ option.option }}
                            <input type="radio" @change="selectOption"
                                   v-model="form.option_id"
                                   :value="option.id">
                            <span class="checkmark"></span>
                        </label>
                        <span class="feedback-custom"></span>
                    </div>

                    <!--If question type is checkbox-->
                    <div v-if="question.type === 'checkbox'">
                        <p class="custom-font1 text-large brand-text-brown">
                            {{ question.question }}: <span class="text-danger">*</span>
                        </p>
                        <div v-for="(option, index) in options" :key="option.id"
                             class="form-group form-check ml-5">
                            <input type="checkbox" class="form-check-input"
                                   :id="'checkbox'+option.id" :value="option.id"
                                   v-model="form.option_ids" @change="selectOption">
                            <label class="" :for="'checkbox'+option.id">
                                {{ option.option }}
                            </label>
                        </div>
                    </div>

                    <!--If question type is freetext-->
                    <div  v-if="question.type === 'freetext'">
                        <p class="custom-font1 text-large brand-text-brown">
                            {{ question.question }}: <span class="text-danger">*</span>
                        </p>
                        <input class="input-bg ml-3" type="text" v-model="form.answer" required />
                        <span class="feedback-custom"></span>
                    </div>

                    <div class="justify-content-center d-flex">
                        <button v-if="!loading" type="submit" class="yedp-begin-btn btn active">Next</button>
                        <button v-else disabled class="yedp-begin-btn btn active">
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!--Show loader when question is loading-->
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
        <!--If assessment progress is 100 percent-->
        <div class="row justify-content-center d-flex" v-else>
            <h5 class="na-text-dark-green">Assessment Complete</h5>
            <p>Thank you for completing your assessment, we will contact you for further steps</p>
            <p>yaedp@nourishingafrica.com</p>
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
                    option_id: '',
                    option_ids: []
                },
                loading: false,
                errors: [],
                question: '',
                options: [],
                dataLoaded: false,
                progress: 0
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
                            console.log(response.data.question.export_diagnostic_options);
                        }else{
                            console.log(response.data.message);
                        }
                    }).catch(error => {
                        console.log(error)
                    }).finally(() => {

                    });
            },

            submitAnswer(){
                console.log(this.form.option_ids);
                this.loading = true;
                axios.post('/api/yaedp/export-diagnostic/question/'+this.question.id+'/answer/store', this.form)
                    .then(response => {
                        console.log(response.data);
                        if(response.data.success === true){
                            this.getQuestion();
                            this.getApplicationProgress();
                        }else{
                            this.errors = response.data.errors;
                        }
                    }).catch(error => {
                        console.log(error)
                    }).finally(() => {
                        this.loading = false;
                    });
            },

            getApplicationProgress(){
                axios.get('/api/yaedp/export-diagnostic/application/progress')
                    .then(response => {
                        if(response.data.success === true){
                            this.progress = response.data.progress;
                            console.log(response.data.progress);
                        }else{
                            console.log(response.data.message);
                        }
                    }).catch(error => {
                    console.log(error)
                }).finally(() => {

                });
            }
        },

        mounted(){
            this.getQuestion();
            this.getApplicationProgress();
        }
    }
</script>

<style scoped>

</style>
