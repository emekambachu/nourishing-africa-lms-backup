<template>

    <div v-if="products.length === 0" class="col-6 text-center">
        <img :src="'/images/icons/no-product.png'" width="300"/>
        <p>No product added</p>
    </div>

    <div class="col-12 text-center">
        <button @click="emitAddProductForm"
                class="module-btn-2 na-bg-dark-green text-white d-flex justify-content-center">
            <i class="fa fa-plus"></i> Add New Product</button>
    </div>

    <div v-for="(product, index) in products" :key="product.id" class="col-md-4">
        <div class="row m-1">
            <div class="col-12 card-header na-bg-lemon2">
                <div class="row">
                    <div class="col-8">
                        {{ product.type }}
                    </div>
                    <div class="col-4">
                        <span @click="deleteProduct(product.id, index)"
                              class="fa fa-trash-alt text-danger float-left"
                              title="delete"></span>
                        <span class="fa fa-pen-alt text-warning float-right"
                              title="edit"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 card-body">
                <h3>{{ product.title }}</h3>
                <p><strong>Weight:</strong> {{ product.weight_per_pack }}</p>
                <p><strong>Packaging Material:</strong> {{ product.source_of_material }}</p>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    emits: ['add-product-form'], // Always include emits
    props: {
        selected_user: Object,
    },
    data(){
        return {
            deleted: false,
            products: []
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
