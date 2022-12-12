<template>
    <div class="col-md-8">

        <div class="row">
            <div class="col-12">
                <button @click="emitShowProducts"
                        class="module-btn-2 na-bg-dark-green text-white">
                    <i class="fa fa-lemon mr-1"></i> My Products</button>
            </div>
            <div v-if="errors.length > 0" class="col-12">
                <p class="text-danger" v-for="(error, index) in errors" :key="index">
                    {{ error }}
                </p>
            </div>
        </div>

        <form @submit.prevent="submitProduct">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label text-dark">Product Name</label>
                            <input type="text" class="form-input mb-2"
                                   v-model="form.name">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="form-label text-dark">Product Description</label>
                            <textarea class="form-input mb-2" v-model="form.description"></textarea>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <p class="text-dark">Type of Product</p>
                                <select class="form-control form-input-select"
                                        v-model="form.type" required>
                                    <option value="">Select</option>
                                    <option value="Raw Commodities">Raw Commodities</option>
                                    <option value="Processed Food">Processed Food</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-2" v-if="form.type === 'Raw Commodities'">
                            <label class="form-label text-dark">Source of Raw Material</label>
                            <input type="text" class="form-input mb-2"
                                   v-model="form.source_of_material">
                        </div>

                        <div v-if="form.type === 'Processed Food'" class="col-md-12 mb-2">
                            <div class="form-group">
                                <p class="text-dark">Organically Produced</p>
                                <div class="form-check">
                                    <input v-model="form.organically_produced" :value="1"
                                           class="form-check-input" type="radio" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Yes</label>
                                </div>

                                <div class="form-check">
                                    <input v-model="form.organically_produced" :value="0"
                                           class="form-check-input" type="radio" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        No</label>
                                </div>
                            </div>
                        </div>

                        <div v-if="form.type === 'Processed Food'" class="col-md-12 mb-2">
                            <div class="form-group">
                                <p class="text-dark">Nutritional Information Provided</p>
                                <div class="form-check">
                                    <input v-model="form.nutrition_information_provided" :value="1"
                                           class="form-check-input" type="radio" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Yes</label>
                                </div>

                                <div class="form-check">
                                    <input v-model="form.nutrition_information_provided" :value="0"
                                           class="form-check-input" type="radio" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        No</label>
                                </div>
                            </div>
                        </div>

                        <div v-if="form.type === 'Processed Food'" class="col-md-12 mb-2">
                            <div class="form-group">
                                <p class="text-dark">How to prepare provided on the packaging</p>
                                <div class="form-check">
                                    <input v-model="form.how_to_prepare" :value="1"
                                           class="form-check-input" type="radio" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Yes</label>
                                </div>

                                <div class="form-check">
                                    <input v-model="form.how_to_prepare" :value="0"
                                           class="form-check-input" type="radio" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        No</label>
                                </div>
                            </div>
                        </div>

                        <div v-if="form.type === 'Raw Commodities'" class="col-md-12 mb-2">
                            <label class="form-label text-dark">Product Weight Per Bag (KG)</label>
                            <input type="number" class="form-input mb-2" v-model="form.weight_per_bag">
                        </div>

                        <div v-if="form.type === 'Processed Food'" class="col-md-12 mb-2">
                            <label class="form-label text-dark">Product Weight Per Pack (G/KG)</label>
                            <input type="number" class="form-input mb-2" v-model="form.weight_per_pack">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label v-if="form.type === 'Processed Food'"
                                   class="form-label text-dark">Production Capacity Per Month (KG)</label>
                            <label v-else
                                   class="form-label text-dark">Production Capacity Per Month (Metric Ton)</label>
                            <input type="text" class="form-input mb-2" v-model="form.capacity">
                        </div>

                        <div v-if="form.type === 'Raw Commodities'" class="col-md-12 mb-2">
                            <label class="form-label text-dark">Packaging Material</label>
                            <select class="form-control form-input-select"
                                    v-model="form.packaging_method">
                                <option value="">Select</option>
                                <option value="Jute Bag">Jute Bag</option>
                                <option value="Polypropylene Sacks">Polypropylene Sacks</option>
                            </select>
                        </div>

                        <div v-if="form.type === 'Processed Food'" class="col-md-12 mb-2">
                            <label class="form-label text-dark">Packaging Material</label>
                            <select class="form-control form-input-select"
                                    v-model="form.packaging_method" required>
                                <option value="">Select</option>
                                <option value="Plastic Bag">Plastic Bag</option>
                                <option value="Foil Sealed bag">Foil Sealed bag</option>
                                <option value="Glass Bottle">Glass Bottle</option>
                                <option value="Plastic Bottle">Plastic Bottle</option>
                                <option value="Pouch">Pouch</option>
                                <option value="Paper Box">Paper Box</option>
                                <option value="Plastic Jar">Plastic Jar</option>
                                <option value="Glass Jar">Glass Jar</option>
                                <option value="Aluminium Foil">Aluminium Foil</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="form-label text-dark">Quantity Available</label>
                            <input type="text" class="form-input mb-2" v-model="form.quantity_available">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label class="form-label text-dark">Value Chain</label>
                            <select class="form-control form-input-select"
                                    v-model="form.yaedp_value_chain_id" required>
                                <option value="">Select</option>
                                <option v-for="value in valueChains"
                                        :key="value.id"
                                        :value="value.id">{{ value.name }}</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <!--Numbers gotten from value chain array index-->
                            <TransitionGroup name="bounce">
                                <div v-if="form.yaedp_value_chain_id !== ''" class="row">
                                    <div class="col-12">
                                        <h6 class="text-dark d-block">Product Parameters</h6>
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 1 || form.yaedp_value_chain_id === 2 || form.yaedp_value_chain_id === 5 || form.yaedp_value_chain_id === 6"
                                         class="col-md-4">
                                        <label class="form-label">Moisture Content</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.moisture_content">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 1" class="col-md-4">
                                        <label class="form-label">Extraneous Matter</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.extraneous_matter">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 1" class="col-md-4">
                                        <label class="form-label">Total Defective Grains</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.total_defective_grains">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 1" class="col-md-4">
                                        <label class="form-label">Split Beans</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.split_beans">
                                    </div>

                                    <div v-if="form.yaedp_value_chain_id === 2 || form.yaedp_value_chain_id === 3" class="col-md-4">
                                        <label class="form-label">Oil Content</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.oil_content">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 2 || form.yaedp_value_chain_id === 5" class="col-md-4">
                                        <label class="form-label">Admixture</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.admixture">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 2" class="col-md-4">
                                        <label class="form-label">FFA</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.ffa">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 2 || form.yaedp_value_chain_id === 5" class="col-md-4">
                                        <label class="form-label">Foreign Matters</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.foreign_matters">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 3" class="col-md-4">
                                        <label class="form-label">Fibre Content</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.fibre_content">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 3" class="col-md-4">
                                        <label class="form-label">Volatile Oil Content</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.volatile_oil_content">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 3" class="col-md-4">
                                        <label class="form-label">Non-volatile Ether Extract</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.non_volatile_ether_extract">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 4" class="col-md-4">
                                        <label class="form-label">Proximate Content</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.proximate_content">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 4" class="col-md-4">
                                        <label class="form-label">Color</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.color">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 4" class="col-md-4">
                                        <label class="form-label">Dry Matter</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.dry_matter">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 4" class="col-md-4">
                                        <label class="form-label">Starch Yield</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.starch_yield">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 4" class="col-md-4">
                                        <label class="form-label">Amylose Content</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.amylose_content">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 4" class="col-md-4">
                                        <label class="form-label">Cynanide Content</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.cynanide_content">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 4" class="col-md-4">
                                        <label class="form-label">Flour Particle Size</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.flour_particle_size">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 5" class="col-md-4">
                                        <label class="form-label">Nut Count</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.nut_count">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 5" class="col-md-4">
                                        <label class="form-label">Kernel Out-turn Ratio (KOR)</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.kor">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 5" class="col-md-4">
                                        <label class="form-label">Defective Nuts</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.defective_nuts">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 5" class="col-md-4">
                                        <label class="form-label">Float Rate</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.float_rate">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 5 || form.yaedp_value_chain_id === 6" class="col-md-4">
                                        <label class="form-label">Slaty</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.slaty">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 6" class="col-md-4">
                                        <label class="form-label">Bean Count</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.bean_count">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 6" class="col-md-4">
                                        <label class="form-label">Mould</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.mould">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 6 || form.yaedp_value_chain_id === 3"
                                         class="col-md-4">
                                        <label class="form-label">Impurity</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.impurity">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 6" class="col-md-4">
                                        <label class="form-label">Cluster Bean</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.cluster_bean">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 6" class="col-md-4">
                                        <label class="form-label">Broken Beans</label>
                                        <input type="text" class="form-input mb-2"
                                               v-model="form.broken_beans">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 3"
                                         class="col-md-4">
                                        <label class="form-label">Microbes</label>
                                        <input type="text" class="form-input mb-2" v-model="form.microbes">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 3"
                                         class="col-md-4">
                                        <label class="form-label">Aflatoxin</label>
                                        <input type="text" class="form-input mb-2" v-model="form.aflatoxin">
                                    </div>
                                    <div v-if="form.yaedp_value_chain_id === 7"
                                         class="col-md-4">
                                        <label class="form-label">Others</label>
                                        <input type="text" class="form-input mb-2" v-model="form.others">
                                    </div>
                                </div>
                            </TransitionGroup>
                        </div>

                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-12">
                                    <ul>
                                        <li class="brand-text-orange">Upload a maximum of 3 images</li>
                                        <li class="brand-text-orange">Kindly upload clear professional picture(s) of your product showing front and back view</li>
                                        <li class="brand-text-orange">Only jpeg and png are required with a maximum of 5mb</li>
                                    </ul>
                                </div>
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
                        class="module-btn-2 na-bg-dark-green text-white d-flex justify-content-center">
                    Add</button>
            </div>

        </form>
    </div>
</template>

<script>
export default {
    props: {
        yaedp_user: Object,
        selected_user: Object
    },
    emits: [
        'show-products'
    ],
    data(){
        return {
            form: {
                name: '',
                description: '',
                user_id: this.selected_user.id,
                type: '',
                yaedp_value_chain_id: '',
                source_of_material: '',
                organically_produced: '',
                nutrition_information_provided: '',
                how_to_prepare: '',
                weight_per_pack: '',
                weight_per_bag: '',
                capacity: '',
                packaging_method: '',
                quantity_available: '',

                moisture_content: '',
                oil_content: '',
                admixture: '',
                ffa: '',
                foreign_matters: '',
                fibre_content: '',
                volatile_oil_content: '',
                non_volatile_ether_extract: '',
                proximate_content: '',
                color: '',
                dry_matter: '',
                starch_yield: '',
                amylose_content: '',
                cynanide_content: '',
                flour_particle_size: '',
                nut_count: '',
                kor: '',
                defective_nuts: '',
                slaty: '',
                bean_count: '',
                mould: '',
                impurity: '',
                cluster_bean: '',
                broken_beans: '',
                float_rate: '',
                total_defective_grains: '',
                split_beans: '',
                extraneous_matter: '',
                microbes: '',
                aflatoxin: '',
                others: '',
            },
            valueChains: [],
            images: [],
            errorAlert: false,
            messageAlert: '',
            imageValidation: '',
            errors: []
        }
    },

    methods: {
        emitShowProducts (event) {
            this.$emit('show-products', true);
        },

        getValueChains(){
            console.log('getting value chains...')
            axios.get('/api/yaedp/value-chains')
                .then((response) => {
                    if(response.data.success === true){
                        this.valueChains = response.data.value_chains;
                    }else{
                        console.log(response.data.message);
                    }
                }).catch((error) => {
                console.log(error);
            });
        },

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

        submitProduct: function(){
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

            axios.post('/api/yaedp/'+this.selected_user.id+'/products/add', formData, config)
                .then((response) => {
                    if(response.data.success === true){
                        this.formSuccess(response);
                        this.formEmpty();
                    }else{
                        this.formError(response);
                    }
                    this.messageAlert = response.data.message;
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
        this.getValueChains();
    }
}
</script>

<style scoped>
/* Bounce transition */
.bounce-enter-active {
    animation: bounce-in 0.5s;
}
.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.25);
    }
    100% {
        transform: scale(1);
    }
}

/* Fade transition */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Zoom Transition */
.zoom-enter-active, .zoom-leave-active {
    transition: all .5s;
}
.zoom-enter, .zoom-leave-to {
    transform: scale(0.5);
}
</style>
