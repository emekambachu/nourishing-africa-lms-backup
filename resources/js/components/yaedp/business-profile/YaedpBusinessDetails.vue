<template>
    <div class="col-md-8">

        <div class="row justify-content-center">
            <div v-if="errors.length > 0" class="col-12">
                <p class="text-danger" v-for="(error, index) in errors" :key="index">
                    {{ error }}</p>
            </div>
        </div>

        <div v-if="selected_user.business" class="row justify-content-center">
            <div class="col-12 card-header">
                <div class="row">
                    <div class="col-10">
                        Business Details
                    </div>
                    <div class="col-2">
                        <span class="fa fa-pen-alt text-danger float-right"
                              title="edit"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 card-body">
                <p>
                    <strong class="na-text-dark-green">Name:</strong><br>
                    {{ selected_user.business.name }}
                </p>
                <p>
                    <strong class="na-text-dark-green">Date of Establishment:</strong><br>
                    {{ selected_user.date_of_establishment }}
                </p>
                <p>
                    <strong class="na-text-dark-green">Years of Operation:</strong><br>
                    {{ selected_user.years_of_operation }}
                </p>
                <p>
                    <strong class="na-text-dark-green">Physical Address:</strong><br>
                    {{ selected_user.physical_address }}
                </p>
                <p>
                    <strong class="na-text-dark-green">Online Address:</strong><br>
                    {{ selected_user.online_address }}
                </p>
                <p>
                    <strong class="na-text-dark-green">Staff Size:</strong><br>
                    {{ selected_user.staff_size }}
                </p>
                <p>
                    <strong class="na-text-dark-green">Business Description:</strong><br>
                    {{ selected_user.business_description }}
                </p>
            </div>
        </div>

        <form v-else @submit.prevent="submitBusiness">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Business Name</label>
                            <input type="text" class="form-input mb-2"
                                   v-model="form.name">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Date of Establishment</label>
                            <input type="text" class="form-input mb-2"
                                   v-model="form.date_of_establishment">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Years of Operation</label>
                            <input type="text" class="form-input mb-2"
                                   v-model="form.years_of_operation">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Physical Address</label>
                            <input type="text" class="form-input mb-2"
                                   v-model="form.physical_address">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Online Address</label>
                            <input type="text" class="form-input mb-2"
                                   v-model="form.online_address">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Staff Size</label>
                            <input type="text" class="form-input mb-2"
                                   v-model="form.staff_size">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Business Description</label>
                            <textarea class="form-input mb-2"
                                      v-model="form.business_description"></textarea>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div v-for="(image, index) in images" :key="index"
                                     class="col-md-3">
                                    <img :src="image.src" :alt="image.file.name"
                                         :title="image.file.name"/><br>
                                    <i @click.prevent="removeImage(index)"
                                       class="fa fa-times bg-danger text-white p-1"
                                       title="remove"></i>
                                </div>
                                <div class="col-md-3">
                                    <label for="file-input">
                                        <img :src="'/images/icons/yaedp-add-product.png'" width="400"/>
                                    </label>

                                    <input @change="uploadImages" class="d-none"
                                           id="file-input" type="file" multiple/>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-center">
                <button style="width:150px;"
                        class="module-btn bg-light-brown d-flex justify-content-center">
                    Submit</button>
            </div>

        </form>
    </div>
</template>

<script>
export default {
    props: {
        selected_user: Object
    },
    data(){
        return {
            form: {
                name: this.selected_user.name,
                user_id: this.selected_user.id,
                date_of_establishment: '',
                years_of_operation: '',
                physical_address: '',
                online_address: '',
                staff_size: '',
                business_description: '',
            },
            images: [],
            errorAlert: false,
            messageAlert: '',
            imageValidation: '',
            errors: []
        }
    },

    methods: {
        // upload and preview image
        uploadImages: function(event){
            // assign selected files to event array
            // loop through files and validate
            // Add to img object and push to images array
            let selectedFiles = event.target.files;
            for (let i = 0; i < selectedFiles.length; i++){
                if(i === 4 || this.images.length > 3){// 15 images max
                    this.messageAlert = "3 images max";
                    return false;
                }
                this.validateImage(selectedFiles[i]);
                let img = {
                    src: URL.createObjectURL(selectedFiles[i]),
                    file: selectedFiles[i],
                }
                this.images.push(img);
            }
        },

        // Validate image
        validateImage: function(file){
            console.log(file.type +' - '+ file.size);
            let fileType = ['image/png', 'image/jpg', 'image/jpeg']
            if(fileType.includes(file.type) === false){
                this.errorAlert = true;
                this.messageAlert = "Incorrect format for "+file.name;
                return false;
            }else{
                this.errorAlert = false;
                this.messageAlert = '';
            }

            if(file.size > 5000000){
                this.errorAlert = true;
                this.messageAlert = "Image can't be greater than 5mb for"+file.name;
                return false;
            }else{
                this.errorAlert = false;
                this.messageAlert = '';
            }
        },

        removeImage(index){
            this.images.splice(index, 1);
        },

        submitBusiness: function(){
            // Install sweetalert2 to use
            // Loading
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

            for (let i = 0; i < this.images.length; i++) {
                formData.append("images[]", this.images[i].file);
            }

            let config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            axios.post('/api/yaedp/'+this.selected_user.id+'/business/add', formData, config)
                .then((response) => {
                    if(response.data.success === true){
                        this.formSuccess(response)
                    }else{
                        this.formError(response)
                    }
                    console.log(response.data.message);
                }).catch((error) => {
                    console.log(error);
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
