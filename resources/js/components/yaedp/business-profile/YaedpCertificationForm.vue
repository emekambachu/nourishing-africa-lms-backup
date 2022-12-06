<template>
    <div class="col-md-8">

        <div class="row">
            <div class="col-12">
                <button @click="emitShowCertifications"
                        class="module-btn-2 na-bg-dark-green text-white">
                    <i class="fa fa-lemon mr-1"></i> My Certifications</button>
            </div>
            <!--Error notifications-->
            <div v-if="errors.length > 0" class="col-12">
                <p class="text-danger" v-for="(error, index) in errors" :key="index">
                    {{ error }}</p>
            </div>
            <p v-if="messageAlert !== ''" class="text-danger text-center">{{ messageAlert }}</p>
        </div>

        <form @submit.prevent="submitCertification">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-input mb-2"
                                   v-model="form.name">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Certificate Number</label>
                            <input type="number" class="form-input mb-2"
                                   v-model="form.certificate_number">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Issuing Organisation</label>
                            <input type="text" class="form-input mb-2" v-model="form.issuing_organisation">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Date Issued</label>
                            <input type="date" class="form-input mb-2" v-model="form.date_issued">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Validity</label>
                            <input type="date" class="form-input mb-2" v-model="form.valid_to">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Upload Document</label>
                            <input @change="uploadDocument" class="form-control" type="file"/>
                        </div>

                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-center">
                <button style="width:150px;"
                        class="module-btn-2 na-bg-dark-green text-white">
                    Add</button>
            </div>

        </form>
    </div>
</template>

<script>
export default {
    props: {
        selected_user: Object
    },
    emits: ['show-certifications'],
    data(){
        return {
            form: {
                name: '',
                user_id: this.selected_user.id,
                certificate_number: '',
                issuing_organisation: '',
                date_issued: '',
                valid_to: '',
                document: null,
            },
            messageAlert: '',
            documentValidation: '',
            errors: []
        }
    },

    methods: {
        emitShowCertifications (event) {
            this.$emit('show-certifications', true);
        },

        // upload and preview image
        uploadDocument: function(event){
            this.form.document = event.target.files[0];
            this.validateDocument(this.form.document);
        },

        // Validate image
        validateDocument: function(file){
            let allowedExtensions = /(\.pdf|\.doc|\.docx|\.jpg|\.png|\.jpeg)$/i;
            if(!allowedExtensions.exec(file.name)){
                this.documentValidation = 'Invalid file format, only documents allowed';
                return false;
            }else{
                this.documentValidation = '';
            }

            if(file.size > 10000000){
                this.documentValidation = 'File too large, 10mb max.';
                return false;
            }else{
                this.documentValidation = '';
            }
        },

        submitCertification(){
            // Install sweetalert2 to use
            Swal.fire({
                html: "<p>"+'Once submitted, this action cannot be undone/modified unless contacting yaedp@afchub.org'+"</p>",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Continue?',
                denyButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.formLoading();
                    let formData = new FormData();
                    // iterate form object
                    let self = this; //you need this because *this* will refer to Object.keys below`
                    //Iterate through each object field, key is name of the object field`
                    Object.keys(this.form).forEach(function(key) {
                        console.log(key); // key
                        console.log(self.form[key]); // value
                        formData.append(key, self.form[key]);
                    });

                    axios.post('/api/yaedp/'+this.selected_user.id+'/certifications/add', formData)
                        .then((response) => {
                            if(response.data.success === true){
                                this.formSuccess(response);
                            }else{
                                this.formError(response);
                            }
                            console.log(response.data.message);
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
            this.messageAlert = '';
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
            this.errors = response.data.errors !== undefined ? response.data.errors : [];
            this.messageAlert = response.data.message !== undefined ? response.data.message : '';
            console.log(this.errors);
            console.log(response.data.message);
        },

        formEmpty(){
            let self = this; //you need this because *this* will refer to Object.keys below`
            //Iterate through each object field, key is name of the object field`
            Object.keys(this.form).forEach(function(key) {
                console.log(key); // key
                console.log(self.form[key]); // value
                self.form[key] = '';
            });
            this.images = [];
        }

    },

    mounted() {

    }
}
</script>

<style scoped>

</style>
