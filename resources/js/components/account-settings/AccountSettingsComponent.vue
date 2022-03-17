<template>
    <div class="row">
        <div class="col-12">

            <div class="panel panel-primary tabs-style-2">
                <div class="tab-menu-heading">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs main-nav-line">
                            <li><a href="#tab1" class="nav-link active" data-toggle="tab">Profile</a></li>
                            <li><a href="#tab2" class="nav-link" data-toggle="tab">Email</a></li>
                            <li><a href="#tab3" class="nav-link" data-toggle="tab">Password</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body main-content-body-right border">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="row">
                                <div v-if="showProfile" class="col-12">
                                    <strong class="mb-3">Profile details</strong>
                                    <form id="" method="post" enctype="multipart/form-data" action="">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label">Surname
                                                    <i class="text-danger">*</i></label>
                                                <input disabled type="text" class="form-input" name="surname"
                                                       value="" required>

                                                <label class="form-label">First Name
                                                    <i class="text-danger">*</i></label>
                                                <input type="text" class="form-input" name="first_name" required>

                                                <label class="form-label">Mobile</label>
                                                <input type="tel" class="form-input" name="mobile">

                                                <label class="form-label">State Residence
                                                    <i class="text-danger">*</i></label>
                                                <input type="text" class="form-input" name="state_residence" required>

                                                <label class="form-label">Business Address
                                                    <i class="text-danger">*</i></label>
                                                <input type="text" class="form-input" name="business_address" required>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Focus Area
                                                    <i class="na-intern-form-required">*</i></label>
                                                <select name="focus_area" class="form-control form-select">
                                                    <option value="" selected>- Select -</option>
                                                    <option value="Farming">Farming</option>
                                                    <option value="Processing">Processing</option>
                                                    <option value="Aggregation and commodity exchange">
                                                        Aggregation and commodity exchange</option>
                                                    <option value="Sales and exports">Sales and exports</option>
                                                    <option value="Others">Others</option>
                                                </select>

                                                <label class="form-label">Value Chain
                                                    <i class="na-intern-form-required">*</i></label>
                                                <select name="value_chain" class="form-control form-select">
                                                    <option value="" selected>- Select -</option>
                                                    <option value="Cocoa">Cocoa</option>
                                                    <option value="Spices">Spices</option>
                                                    <option value="Sesame">Sesame</option>
                                                    <option value="Shea butter">Shea butter</option>
                                                    <option value="Cashew">Cashew</option>
                                                    <option value="Cassava">Cassava</option>
                                                    <option value="Soybean">Soybean</option>
                                                    <option value="Rubber">Rubber</option>
                                                    <option value="Ginger">Ginger</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>

                                            <div class="col-12">
                                                <button style="width:150px;" class="module-btn bg-light-brown d-flex justify-content-center">
                                                    Edit Profile</button>
                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-12">
                                    Email
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="row">
                                <div class="col-12">
                                    Password
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                profile: [],
                showProfile: true,
                showEmail: true,
                showPassword: true,
                showEditProfile: false,
                showEditEmail: false,
                showEditPassword: false
            }
        },
        created() {
            this.axios
                .get('api/yaedp/get-profile')
                .then(response => {
                    this.profile = response.data;
                }).catch((err) => console.error(err));
        },
        methods: {

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
