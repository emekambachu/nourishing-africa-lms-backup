<template>
    <div class="row">

        <div class="col-12">
            <p v-for="(error, index) in errors" :key="index" class="text-danger"></p>
        </div>

        <div class="col-12">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body border-light-green">

                                <div v-for="(input, index) in formFields" :key="index" class="px-3 mb-2">
                                    <div class="row bg-grey-rounded mt-2 mb-2">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" placeholder="title*"
                                                       class="form-control" v-model="input.title" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Document</label>
                                                <input @change="uploadFile(input, event)"
                                                       type="file" class="form-control"/>
                                                <p v-if="input.validation_alert"
                                                   class="p-1 bg-danger text-center text-white">
                                                    {{ input.validation_alert }}</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button @click.prevent="removeField(index)" v-show="index !== 0"
                                                type="submit" class="btn btn-danger btn-sm">
                                            Remove field</button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="button" @click.prevent="addField"
                                            class="btn btn-primary btn-sm mr-2">Add field</button>
                                    <button type="button" @click.prevent="submitDocuments"
                                            class="btn btn-success btn-sm mr-2">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div v-if="documents.length > 0" class="col-12">
            <div v-for="(doc, index) in documents" :key="doc.id"
                 class="bg-white-radius-shadow border-light-green row mb-2">
                <div class="col-md-8">
                    {{ doc.title }}
                </div>
                <div class="col-md-4">
                    <a class="btn btn-sm btn-primary mr-1"
                       :download="'/documents/learning/yaedp/'+doc.document"
                       :href="'/documents/learning/yaedp/'+doc.document">
                        Download</a>
                    <a @click.prevent="deleteDocument(doc.id, index)" class="btn btn-sm btn-danger">
                        Delete</a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import {
    ContentLoader,
    ListLoader,
} from 'vue-content-loader';
export default {
    props: {
        auth: Object,
    },
    components: {
        ContentLoader,
        ListLoader,
    },
    data(){
        return {
            // for create form
            formFields: [
                {title: '', document: null, validation_alert: ''}
            ],
            documents: [],
            errors: [],
            dataLoaded: false,
        }
    },

    methods: {
        addField() {
            this.formFields.push({title: '', document: null, validation_alert: ''});
        },

        removeField(index) {
            this.formFields.splice(index, 1);
        },

        uploadFile: function (input){
            this.validateDocument(input, event.target.files[0]);
            //Assign image and path to this variable
            input.document = event.target.files[0];
        },

        validateDocument: function(input, file){
            let allowedExtensions = /(\.pdf|\.doc|\.docx|\.jpg|\.png|\.jpeg)$/i;
            if(!allowedExtensions.exec(file.name)){
                input.validation_alert = 'Invalid file format, only documents allowed';
                return false;
            }else{
                input.validation_alert = '';
            }

            if(file.size > 10000000){
                input.validation_alert = 'File too large, 5mb max.';
                return false;
            }else{
                input.validation_alert = '';
            }
        },

        getDocuments(){
            axios.get('/api/yaedp/upload/documents')
                .then((response) => {
                    if(response.data.success === true){
                        this.documents = response.data.documents;
                    }else{
                        console.log(response.data.message);
                    }
                }).catch((error) => {
                    console.log(error);
                });
        },

        submitDocuments(){
            console.log(this.formFields);
            this.formLoading();

            let formData = new FormData();
            this.formFields.forEach(function (item, index) {
                formData.append('inputs['+index+'][title]', item.title);
                if(item.document){
                    formData.append('inputs['+index+'][document]', item.document);
                }
            });

            let config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            axios.post('/api/yaedp/upload/document/create', formData, config)
                .then((response) => {
                    if(response.data.success === true){
                        this.formSuccess(response);
                        this.formEmpty();
                        this.getDocuments();
                    }else{
                        this.formError(response);
                    }
                }).catch((error) => {
                    console.log(error);
                });
        },

        deleteDocument(id, index){
            // Install sweetalert2 to use
            Swal.fire({
                title: 'Delete',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.formLoading();
                    axios.delete('/api/yaedp/upload/document/'+id+'/delete')
                        .then((response) => {
                            if(response.data.success === true){
                                this.documents.splice(index, 1);
                                this.formSuccess(response);
                            }else{
                                this.formError(response)
                            }
                        }).catch((error) => {
                            console.log(error);
                        });
                } else if (result.isDenied) {
                    return false;
                }
            });
        },

        formLoading(){
            // Install sweetalert2 to use
            // Loading
            Swal.fire({
                title: 'Please Wait !',
                html: 'Submitting',// add html attribute if you want or remove
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
        },

        formSuccess(response){
            this.errors = [];
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({
                icon: 'success',
                title: 'Submitted'
            });
        },

        formError(response){
            Swal.fire({
                icon: 'error',
                title: 'Error Occurred',
                showConfirmButton: false,
                timer: 2500
            });
            this.errors = response.data.errors;
            console.log(this.errors);
            console.log(response.data.message);
        },

        formEmpty(){
            this.formFields.forEach((item, index)=>{
                item.title = '';
                item.document = '';
            });
        }
    },

    mounted(){
        this.getDocuments();
    }
}
</script>

<style scoped>

</style>
