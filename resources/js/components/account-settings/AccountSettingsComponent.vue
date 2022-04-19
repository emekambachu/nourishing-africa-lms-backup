<template>
    <div class="row">
        <div class="col-12">

            <div class="panel panel-primary tabs-style-2">

                <div v-if="formLoading" class="text-center">
                    <i class="fa fa-spin fa-spinner text-light-brown fa-3x text-center"></i><br>
                    <p class="text-center">Please wait......</p>
                </div>

                <div v-if="formSuccessful" class="alert alert-success" role="alert">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong class="text-center">{{ alertMessage }}</strong>
                </div>

                <div v-if="formError" class="alert alert-danger" role="alert">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ alertMessage }}</strong>
                </div>

                <div class="tab-menu-heading">
                    <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs main-nav-line">
                            <li><a href="#tab1" class="nav-link active" data-toggle="tab">Profile</a></li>
                            <li><a href="#tab2" class="nav-link" data-toggle="tab">Update your email</a></li>
                            <li><a href="#tab3" class="nav-link" data-toggle="tab">Reset your password</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body main-content-body-right border">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="row">
                                <div v-if="!formLoading" class="col-12">
                                    <strong class="mb-3">Profile details</strong>
                                    <p>Request to update any field by inserting the new data</p>
                                    <div v-if="requestUpdateStatus" class="bg-badge-warning p-2 text-center w-auto">
                                        Your update request is being reviewed
                                    </div>
                                    <form id="" method="post" enctype="multipart/form-data"
                                    @submit.prevent="submitProfileUpdateRequest">

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <label class="form-label">Surname</label>
                                                        <input type="text" class="form-input mb-2" name="surname"
                                                               :placeholder="profile.surname" v-model="form.surname">

                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-input mb-2" name="first_name"
                                                               :placeholder="profile.first_name" v-model="form.first_name">

                                                        <label class="form-label">Mobile</label>
                                                        <input type="tel" class="form-input mb-2" name="mobile"
                                                               v-model="form.mobile" :placeholder="profile.mobile">

                                                        <label class="form-label">State Residence</label>
                                                        <input type="text" class="form-input" name="state_residence"
                                                               v-model="form.state_residence" :placeholder="profile.state_residence">

                                                        <label class="form-label">Business Address</label>
                                                        <input type="text" class="form-input" name="business_address"
                                                               v-model="form.business_address" :placeholder="profile.business_address">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Focus Area</label>
                                                        <select name="focus_area" class="form-control form-select"
                                                                v-model="form.focus_area">
                                                            <option v-for="focus in focusAreas"
                                                                    :key="focus.value"
                                                                    :value="focus.value"
                                                                    :selected="focus.value === form.focus_area">
                                                                {{ focus.name }}
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Value Chain</label>
                                                        <select name="value_chain" class="form-control form-select"
                                                                v-model="form.value_chain">
                                                            <option v-for="value in valueChains"
                                                                    :key="value.value"
                                                                    :value="value.value"
                                                                    :selected="value.value === profile.value_chain">
                                                                {{ value.name }}
                                                            </option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label">Website</label>
                                                        <input type="text" class="form-input" name="website"
                                                               v-model="form.website" :placeholder="profile.website">

                                                        <label class="form-label">Facebook</label>
                                                        <input type="text" class="form-input" name="facebook"
                                                               v-model="form.facebook" :placeholder="profile.facebook">

                                                        <label class="form-label">Instagram</label>
                                                        <input type="text" class="form-input" name="instagram"
                                                               v-model="form.instagram" :placeholder="profile.instagram">

                                                        <label class="form-label">LinkedIn</label>
                                                        <input type="text" class="form-input" name="linkedin"
                                                               v-model="form.linkedin" :placeholder="profile.linkedin">

                                                        <label class="form-label">Twitter</label>
                                                        <input type="text" class="form-input" name="twitter"
                                                               v-model="form.twitter" :placeholder="profile.twitter">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Update Reason<i class="text-danger">*</i></label>
                                                <textarea class="form-control" v-model="form.reason" required></textarea>
                                            </div>
                                        </div>

<!--                                        <div class="row">-->
<!--                                            <div class="col-6">-->
<!--                                                <div class="row">-->
<!--                                                    <div class="col-md-12">-->
<!--                                                        <label class="form-label">Surname-->
<!--                                                            <i class="text-danger">*</i></label>-->
<!--                                                        <input type="text" class="form-input" name="surname"-->
<!--                                                               required v-model="form.surname" disabled>-->
<!--                                                        <p class="text-danger font-weight-bold tx-8"-->
<!--                                                            v-if="errors.surname">{{ errors.surname }}</p>-->

<!--                                                        <label class="form-label">First Name-->
<!--                                                            <i class="text-danger">*</i></label>-->
<!--                                                        <input type="text" class="form-input" name="first_name"-->
<!--                                                               required v-model="form.first_name" disabled>-->
<!--                                                        <p class="text-danger font-weight-bold tx-8"-->
<!--                                                           v-if="errors.first_name">{{ errors.first_name }}</p>-->

<!--                                                        <label class="form-label">Mobile</label>-->
<!--                                                        <input type="tel" class="form-input" name="mobile"-->
<!--                                                               v-model="form.mobile" disabled>-->
<!--                                                        <p class="text-danger font-weight-bold tx-8"-->
<!--                                                           v-if="errors.mobile">{{ errors.mobile }}</p>-->

<!--                                                        <label class="form-label">State Residence-->
<!--                                                            <i class="text-danger">*</i></label>-->
<!--                                                        <input type="text" class="form-input" name="state_residence" required-->
<!--                                                               v-model="form.state_residence" disabled>-->
<!--                                                        <p class="text-danger font-weight-bold tx-8"-->
<!--                                                           v-if="errors.state_residence">{{ errors.state_residence }}</p>-->

<!--                                                        <label class="form-label">Business Address-->
<!--                                                            <i class="text-danger">*</i></label>-->
<!--                                                        <input type="text" class="form-input" name="business_address" required-->
<!--                                                               v-model="form.business_address" disabled>-->
<!--                                                        <p class="text-danger font-weight-bold tx-8"-->
<!--                                                           v-if="errors.business_address">{{ errors.business_address }}</p>-->
<!--                                                    </div>-->

<!--                                                    <div class="col-md-6">-->
<!--                                                        <label class="form-label">Focus Area-->
<!--                                                            <i class="na-intern-form-required">*</i></label>-->
<!--                                                        <select name="focus_area" class="form-control form-select" required-->
<!--                                                                v-model="form.focus_area" disabled>-->
<!--                                                            <option v-for="focus in focusAreas"-->
<!--                                                                    :key="focus.value"-->
<!--                                                                    :value="focus.value"-->
<!--                                                                    :selected="focus.value === form.focus_area">-->
<!--                                                                {{ focus.name }}-->
<!--                                                            </option>-->
<!--                                                        </select>-->
<!--                                                        <p class="text-danger font-weight-bold tx-8"-->
<!--                                                           v-if="errors.focus_area">{{ errors.focus_area }}</p>-->
<!--                                                    </div>-->

<!--                                                    <div class="col-md-6">-->
<!--                                                        <label class="form-label">Value Chain-->
<!--                                                            <i class="na-intern-form-required">*</i></label>-->
<!--                                                        <select name="value_chain" class="form-control form-select"-->
<!--                                                                v-model="form.value_chain" disabled>-->
<!--                                                            <option v-for="value in valueChains"-->
<!--                                                                    :key="value.value"-->
<!--                                                                    :value="value.value"-->
<!--                                                                    :selected="value.value === form.value_chain">-->
<!--                                                                {{ value.name }}-->
<!--                                                            </option>-->
<!--                                                        </select>-->
<!--                                                        <p class="text-danger font-weight-bold tx-8"-->
<!--                                                           v-if="errors.value_chain">{{ errors.value_chain }}</p>-->
<!--                                                    </div>-->

<!--                                                </div>-->
<!--                                            </div>-->

<!--                                            <div class="col-md-6">-->
<!--                                               <div class="row">-->
<!--                                                   <div class="col-12">-->
<!--                                                       <label class="form-label">Website</label>-->
<!--                                                       <input type="text" class="form-input" name="website"-->
<!--                                                              v-model="form.website" disabled>-->

<!--                                                       <label class="form-label">Facebook</label>-->
<!--                                                       <input type="text" class="form-input" name="facebook"-->
<!--                                                              v-model="form.facebook" disabled>-->

<!--                                                       <label class="form-label">Instagram</label>-->
<!--                                                       <input type="text" class="form-input" name="instagram"-->
<!--                                                              v-model="form.instagram" disabled>-->

<!--                                                       <label class="form-label">LinkedIn</label>-->
<!--                                                       <input type="text" class="form-input" name="linkedin"-->
<!--                                                              v-model="form.linkedin" disabled>-->

<!--                                                       <label class="form-label">Twitter</label>-->
<!--                                                       <input type="text" class="form-input" name="twitter"-->
<!--                                                              v-model="form.twitter" disabled>-->
<!--                                                   </div>-->
<!--                                               </div>-->

<!--                                            </div>-->
<!--                                        </div>-->

                                        <div v-if="!requestUpdateStatus" class="d-flex justify-content-center">
                                            <button style="width:150px;"
                                                    class="module-btn bg-light-brown d-flex justify-content-center"
                                                    :disabled="disableBtnOnLoad">
                                                Request to edit Profile</button>
                                        </div>
                                        <div v-else class="d-flex justify-content-center">
                                            <button style="width:150px;"
                                                    class="module-btn bg-light-brown d-flex justify-content-center"
                                                    disabled>
                                                Pending Request</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab2">
                            <form @submit.prevent="updateEmail">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Current Email</label>
                                        <input readonly type="email" class="form-input" name="old_email"
                                               v-model="formEmail.old_email">
                                        <p class="text-danger font-weight-bold tx-8"
                                           v-if="errors.old_email">{{ errors.old_email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">New Email</label>
                                        <input type="email" class="form-input" name="new_email"
                                               v-model="formEmail.new_email" required>
                                        <p class="text-danger font-weight-bold tx-8"
                                           v-if="errors.new_email">{{ errors.new_email }}</p>
                                    </div>
                                    <div class="col-12">
                                        <button style="width:150px;"
                                                class="module-btn bg-light-brown d-flex justify-content-center"
                                                :disabled="disableBtnOnLoad">Update Email</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="tab3">
                            <form @submit.prevent="updatePassword">
                                <div class="row">
<!--                                    <div class="col-12">-->
<!--                                        <label class="form-label">Old Password</label>-->
<!--                                        <input type="text" class="form-input" name="old_password"-->
<!--                                               v-model="formPassword.old_password" required>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <label class="form-label">New Password</label>-->
<!--                                        <input type="text" class="form-input" name="new_password"-->
<!--                                               v-model="formPassword.new_password" required>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <label class="form-label">Confirm New Password</label>-->
<!--                                        <input type="text" class="form-input" name="new_password_confirmation"-->
<!--                                               v-model="formPassword.new_password_confirmation" required>-->
<!--                                    </div>-->
                                    <div class="col-11">
                                        <label class="form-label">Old Password</label>
                                        <input :type="typeOldPassword" class="form-input" name="old_password"
                                               v-model="formPassword.old_password" required>
                                    </div>
                                    <div class="col-1" style="padding-top: 35px;">
                                        <i @click="passwordVisibility('old')"
                                           :class="[typeOldPassword === 'password' ? 'fa fa-eye-slash' : 'fa fa-eye']"></i>
                                    </div>

                                    <div class="col-md-5">
                                        <label class="form-label">New Password</label>
                                        <input :type="typeNewPassword" class="form-input" name="new_password"
                                               v-model="formPassword.new_password" required>
                                    </div>
                                    <div class="col-1" style="padding-top: 35px;">
                                        <i @click="passwordVisibility('new')"
                                           :class="[typeNewPassword === 'password' ? 'fa fa-eye-slash' : 'fa fa-eye']"></i>
                                    </div>

                                    <div class="col-md-5">
                                        <label class="form-label">Confirm New Password</label>
                                        <input :type="typeNewPasswordConfirm" class="form-input"
                                               name="new_password_confirmation"
                                               v-model="formPassword.new_password_confirmation" required>
                                    </div>
                                    <div class="col-1" style="padding-top: 35px;">
                                        <i @click="passwordVisibility('new-confirm')"
                                           :class="[typeNewPasswordConfirm === 'password' ? 'fa fa-eye-slash' : 'fa fa-eye']"></i>
                                    </div>
                                    <div class="col-12">
                                        <button style="width:150px;"
                                                class="module-btn bg-light-brown d-flex justify-content-center"
                                        :disabled="disableBtnOnLoad">
                                            Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        components: {},
        props: {
            profile: Object
        },
        data(){
            return {
                form: {
                    surname: this.profile.surname,
                    first_name: this.profile.first_name,
                    mobile: this.profile.mobile,
                    state_residence: this.profile.state_residence,
                    business_address: this.profile.business_address,
                    focus_area: this.profile.focus_area,
                    value_chain: this.profile.value_chain,
                    website: this.profile.website,
                    facebook: this.profile.facebook,
                    instagram: this.profile.instagram,
                    linkedin: this.profile.linkedin,
                    twitter: this.profile.twitter,
                    reason: '',
                },

                formPassword: {
                    old_password: '',
                    new_password: '',
                    new_password_confirmation: '',
                },
                formEmail: {
                    old_email: this.profile.email,
                    new_email: '',
                },
                focusAreas: [
                    { value: 'Farming', name: 'Farming' },
                    { value: 'Processing', name: 'Processing' },
                    { value: 'Aggregation and commodity exchange', name: 'Aggregation and commodity exchange' },
                    { value: 'Sales and export', name: 'Sales and export' },
                ],
                valueChains: [
                    { value: 'Cocoa', name: 'Cocoa' },
                    { value: 'Sesame', name: 'Sesame' },
                    { value: 'Shea butter', name: 'Shea butter' },
                    { value: 'Cashew', name: 'Cashew' },
                    { value: 'Cassava', name: 'Cassava' },
                    { value: 'Soybean', name: 'Soybean' },
                    { value: 'Rubber', name: 'Rubber' },
                    { value: 'Others', name: 'Others' },
                ],
                errors:[],
                formLoading: false,
                formSuccessful: false,
                formError: false,
                alertMessage: '',
                typeOldPassword: 'password',
                typeNewPassword: 'password',
                typeNewPasswordConfirm: 'password',

                requestUpdateStatus: null,
            }
        },
        methods: {
            // Install laravel sanctum for axios authentication to work
            // in config/sanctum.php, add guard to 'guards' array
            // update env domain and session_domain
            // go to config/cors.php and allow credentials

            getProfile(){
                axios.get('/api/yaedp/authenticate').then((response) => {
                    this.form = response.data;
                    this.formEmail.old_email = response.data.email;
                });
            },

            submitForm: function(url, form){
                this.formLoading = true;
                axios.post(url, form)
                    .then(response => {
                        console.log(response.data);
                        this.formSuccessful = response.data.success === true;
                        this.formError = response.data.success === false;
                        this.alertMessage = response.data.message;
                        this.formLoading = false;
                    }).catch((error) => {
                        console.log(error.response.data.errors);
                    }).finally(() => {

                    });
            },

            updateProfile: function(){
                this.submitForm('/api/yaedp/update-profile', this.form);
            },

            getProfileUpdateRequest(){
                axios.get('/api/yaedp/get/update-request').then((response) => {
                    response.data.success === true ? this.requestUpdateStatus = true : this.requestUpdateStatus = false;
                });
            },

            submitProfileUpdateRequest: function(){
                this.submitForm('/api/yaedp/submit/update-request', this.form);
                this.requestUpdateStatus = true;
            },

            updateEmail: function(){
                this.submitForm('/api/yaedp/update-email', this.formEmail);
            },

            updatePassword(){
                if(this.formPassword.new_password !== this.formPassword.new_password_confirmation){
                    this.formError = true;
                    this.alertMessage = 'password and password confirmation are not the same';
                    return false;
                }
                this.submitForm('/api/yaedp/update-password', this.formPassword);
            },

            passwordVisibility(input){
                if(input === 'old'){
                    this.typeOldPassword === 'password' ? this.typeOldPassword = 'text' : this.typeOldPassword = 'password';
                }
                if(input === 'new'){
                    this.typeNewPassword === 'password' ? this.typeNewPassword = 'text' : this.typeNewPassword = 'password';
                }
                if(input === 'new-confirm'){
                    this.typeNewPasswordConfirm === 'password' ? this.typeNewPasswordConfirm = 'text' : this.typeNewPasswordConfirm = 'password';
                }
            }
        },
        computed: {
            disableBtnOnLoad(){
               return this.formLoading === true;
            }
        },
        watch: {

        },

        mounted(){
            this.getProfileUpdateRequest();
            // this.getProfile();
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
