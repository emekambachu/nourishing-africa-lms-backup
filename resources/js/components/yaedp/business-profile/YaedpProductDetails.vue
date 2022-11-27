<template>

    <div v-if="products.length === 0" class="col-8 text-center">
        <img :src="'/images/icons/no-product.png'" width="500"/>
        <p>No product added</p>
        <button @click="emitAddProductForm"
                class="module-btn-2 na-bg-dark-green text-white d-flex justify-content-center">
            <i class="fa fa-plus"></i> Add New Product</button>
    </div>

    <div v-for="product in products" :key="product.id" class="col-md-6">
        <div class="row">
            <div class="col-12 card-header">
                <div class="row">
                    <div class="col-8">
                        {{ product.type }}
                    </div>
                    <div class="col-4">
                        <span class="fa fa-trash text-danger float-left"
                              title="delete"></span>
                        <span class="fa fa-pen-alt text-danger float-right"
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

    },

    mounted() {

    }
}
</script>

<style scoped>

</style>
