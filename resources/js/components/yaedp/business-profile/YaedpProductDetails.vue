<template>
    <div v-if="dataLoaded && products.length === 0" class="col-4 text-center">
        <img :src="'/images/icons/no-product.png'" width="300"/>
        <p>No product added</p>
    </div>

    <div class="col-12 text-center">
        <button @click="emitAddProductForm"
                class="module-btn-2 na-bg-dark-green text-white d-flex justify-content-center">
            <i class="fa fa-plus"></i> Add New Product</button>
    </div>

    <template v-if="dataLoaded">
        <div v-for="(product, index) in products" :key="product.id" class="col-md-5">
            <div class="row m-1">
                <div class="col-12 card-header na-bg-lemon2">
                    <div class="row">
                        <div class="col-8">
                            {{ product.type }}
                        </div>
                        <div class="col-4">
                            <span class="na-text-dark-green float-right border-rounded-green"
                                  title="edit">Edit</span>
                            <span @click="deleteProduct(product.id, index)"
                                  class="fa fa-trash-alt text-danger float-right mr-2 mt-1"
                                  title="delete"></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 yaedp-card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="na-text-dark-green">{{ product.name }}</h4>
                        </div>
                        <div class="col-md-6">
                            <p v-if="product.weight_per_pack !== null">
                                <strong class="text-dark">Weight per pack:</strong><br>
                                {{ product.weight_per_pack }}
                            </p>
                            <p v-else>
                                <strong class="text-dark">Weight per bag:</strong><br>
                                {{ product.weight_per_bag }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <strong class="text-dark">Packaging Material:</strong><br>
                                {{ product.source_of_material }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <ContentLoader v-else
                   viewBox="0 0 340 84"
                   :speed="1"
                   primaryColor="#eaeaea"
                   secondaryColor="#ecebeb"
                   height={130}
                   width={400}
    >
        <rect x="15" y="15" rx="4" ry="4" width="350" height="25" />
        <rect x="15" y="50" rx="2" ry="2" width="350" height="150" />
        <rect x="15" y="230" rx="2" ry="2" width="170" height="20" />
        <rect x="60" y="230" rx="2" ry="2" width="170" height="20" />
    </ContentLoader>

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
    emits: [
        'add-product-form'
    ], // Always include emits
    props: {
        selected_user: Object,
    },
    data(){
        return {
            deleted: false,
            products: [],
            dataLoaded: false
        }
    },

    methods: {
        emitAddProductForm (event) {
            this.$emit('add-product-form', true);
        },

        getProducts(){
            console.log(this.selected_user.id);
            axios.get('/api/yaedp/'+this.selected_user.id+'/products')
                .then((response) => {
                    if(response.data.success === true){
                        this.products = response.data.products;
                    }else{
                        console.log(response.data.message);
                    }
                    this.dataLoaded = true;
                }).catch((error) => {
                    console.log(error);
                });
        },

        deleteProduct(id, index){
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
                    axios.delete('/api/yaedp/'+this.selected_user.id+'/products/'+id+'/delete')
                        .then((response) => {
                            if(response.data.success === true){
                                this.products.splice(index, 1);
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

    },

    mounted() {
        this.getProducts();
    }
}
</script>

<style scoped>

</style>
