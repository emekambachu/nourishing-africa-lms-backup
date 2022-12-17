<template>
    <div class="row">
        <div class="col-12">

            <div class="panel panel-primary tabs-style-2">

                <div class="tab-menu-heading">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs main-nav-line">

                            <li @click="getResources()">
                                <a href="#tab1" class="nav-link active"
                                   data-toggle="tab">All</a>
                            </li>

                            <li v-for="(category, index) in categories"
                                @click="getResourcesFromCategoryId(1, category.id)">
                                <a :href="'#'+category.name"
                                   class="nav-link"
                                   :class="{active : selectedCategoryId === category.id}"
                                   data-toggle="tab">{{ category.name }}</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="panel-body tabs-menu-body main-content-body-right border">
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab1">
                            <div class="row justify-content-center">
                                <div v-for="resource in resources.data" class="col-md-5 bg-white-radius-shadow p-2 m-2">
                                    <div class="row m-1">
                                        <div class="col-12 border-black-light">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h3 class="text-center text-orange">
                                                        {{ resource.name }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 float-left text-left">
                                                    <div>
                                                        <strong class="na-text-dark-green">
                                                            Services:</strong><br>
                                                        <p>{{ resource.services }}</p>
                                                    </div>
                                                    <div>
                                                        <strong class="na-text-dark-green">
                                                            Website:</strong><br>
                                                        <a :href="resource.website">
                                                            {{ resource.website }}</a>
                                                    </div>
                                                </div>
                                                <div class="col-6 float-right text-left">
                                                    <div>
                                                        <strong class="na-text-dark-green">
                                                            Locations Shipped To:</strong><br>
                                                        <p>{{ resource.locations }}</p>
                                                    </div>
                                                    <div>
                                                        <strong class="na-text-dark-green">
                                                            Email:</strong><br>
                                                        <p>{{ resource.email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <laravel-vue-pagination class="justify-content-center"
                                                    :limit="3"
                                                    :data="resources"
                                                    @pagination-change-page="getResourcesFromCategoryId(1,selectedCategoryId)"
                            >
                                <template #prev-nav>
                                    <span>&lt; Previous</span>
                                </template>
                                <template #next-nav>
                                    <span>Next &gt;</span>
                                </template>
                            </laravel-vue-pagination>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
    components: {
        LaravelVuePagination,
    },

    data(){
        return {
            resources: [],
            categories: [],
            total: 0,
            dataLoaded: false,
            selectedCategoryId: 0
        }
    },
    methods: {
        getResources(page = 1){
            this.searchActive = false;
            this.dataLoaded = false;
            axios.get(this.appUrl+'/api/yaedp/export-resources?page=' + page, {
                headers: {
                    'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            }).then((response) => {
                if(response.data.success === true){
                    this.resources = response.data.resources;
                    this.total = response.data.total;
                    console.log(response.data.resources);
                }else{
                    console.log(response.data.message);
                }
                this.dataLoaded = true;
                console.log(this.resources);
            }).catch((error) => {
                console.log(error);
            });
        },

        getResourcesFromCategoryId(page = 1, category_id){
            this.searchActive = false;
            this.dataLoaded = false;
            this.selectedCategoryId = category_id;
            console.log(category_id);
            axios.get(this.appUrl+'/api/yaedp/export-resource/'+category_id+'/categories?page=' + page, {
                headers: {
                    'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
                }
            }).then((response) => {
                    if(response.data.success === true){
                        this.resources = response.data.resources;
                        this.total = response.data.total;
                        console.log(response.data.resources);
                    }else{
                        console.log(response.data.message);
                    }
                    this.dataLoaded = true;
                    console.log(this.resources);
                }).catch((error) => {
                console.log(error);
            });
        },

        getCategories(){
            // $appUrl is a global variable from the app.js file
            axios.get(this.appUrl+'/api/yaedp/export-resource/categories', {
                    headers: {
                        'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
                    }
                }).then((response) => {
                    if(response.data.success === true){
                        this.categories = response.data.categories;
                        console.log(this.categories);
                    }else{
                        console.log(response.data.message);
                    }
                }).catch((error) => {
                    console.log(error);
                });
        },
    },

    computed: {

    },

    mounted(){
        this.getCategories();
        this.getResources();
        console.log(this.categories);
        // on load, get first category id
        // this.getResourcesFromCategoryId(this.categories[0].id);
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
