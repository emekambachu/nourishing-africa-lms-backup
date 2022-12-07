<template>
    <div class="row">
        <div class="col-12">

            <div class="panel panel-primary tabs-style-2">

                <div class="tab-menu-heading">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs main-nav-line">
                            <li>
                                <a href="#tab1" class="nav-link active"
                                   data-toggle="tab">Product Details</a>
                            </li>
                            <li>
                                <a href="#tab2" class="nav-link"
                                   data-toggle="tab">Business Details</a>
                            </li>
                            <li><a href="#tab3" class="nav-link"
                                   data-toggle="tab">Certification</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body tabs-menu-body main-content-body-right border">
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab1">
                            <div v-if="getProductsComponent" class="row justify-content-center">
                                <yaedp-product-details
                                    @add-product-form="addProductForm"
                                    :selected_user="selected_user"
                                ></yaedp-product-details>
                            </div>

                            <div v-if="addProductComponent" class="row justify-content-center">
                                <yaedp-add-product
                                    @show-products="showProducts"
                                    :yaedp_user="yaedp_user"
                                    :selected_user="selected_user"
                                ></yaedp-add-product>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab2">
                            <div class="row justify-content-center">
                                <yaedp-business-details
                                    :selected_user="selected_user"
                                ></yaedp-business-details>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab3">
                            <div class="row justify-content-center">
                                <yaedp-certifications v-if="showCertificationsComponent === true"
                                    @add-certification-form="addCertificationForm"
                                    :selected_user="selected_user"
                                ></yaedp-certifications>
                                <yaedp-certification-form v-if="showCertificationFormComponent === true"
                                    @show-certifications="showCertifications"
                                    :selected_user="selected_user"
                                ></yaedp-certification-form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import YaedpAddProduct from "./YaedpAddProduct";
import YaedpProductDetails from "./YaedpProductDetails";
import YaedpBusinessDetails from "./YaedpBusinessDetails";
import YaedpCertifications from "./YaedpCertifications";
import YaedpCertificationForm from "./YaedpCertificationForm";

export default {
    components: {
        YaedpAddProduct,
        YaedpProductDetails,
        YaedpBusinessDetails,
        YaedpCertifications,
        YaedpCertificationForm
    },
    props: {
        yaedp_user: Object,
        selected_user: Object
    },

    data(){
        return {
            products: [],
            certificates: [],
            addProductComponent: false,
            getProductsComponent: true,
            showCertificationsComponent: true,
            showCertificationFormComponent: false,
        }
    },

    methods: {
        addProductForm(value){
            if(value === true){
                this.addProductComponent = true;
                this.getProductsComponent = false;
            }
        },

        showProducts(value){
            console.log(value);
            if(value === true){
                this.addProductComponent = false;
                this.getProductsComponent = true;
            }
        },

        addCertificationForm(value){
            if(value === true){
                this.showCertificationsComponent = false;
                this.showCertificationFormComponent = true;
            }
        },

        showCertifications(value){
            console.log(value);
            if(value === true){
                this.showCertificationsComponent = true;
                this.showCertificationFormComponent = false;
            }
        },

    },
    computed: {

    },
    watch: {

    },

    mounted(){

    }
}
</script>

<style scoped>
input[type=file]::file-selector-button {
    content: 'Choose file';
    padding: .2em .4em;
    background: #E9FEE9;
    border: 1px solid #979191;
    box-sizing: border-box;
    border-radius: 5px;
    transition: 1s;
}

input[type=file]::file-selector-button:hover {
    background-color: #c0f8c0;
    border: 1px solid #979191;
}
</style>
