<template>

    <div v-if="certifications.length === 0" class="col-6 text-center">
        <img :src="'/images/icons/no-certificates.png'" width="300"/>
        <p>No Certification added</p>
    </div>

    <div class="col-12 text-center">
        <button @click="emitAddCertificationForm"
                class="module-btn-2 na-bg-dark-green text-white">
            <i class="fa fa-plus"></i> Add New Certification</button>
    </div>

    <div v-for="(cert, index) in certifications" :key="cert.id" class="col-md-4">
        <div class="row m-1">
            <div class="col-12 card-header">
                <div class="row">
                    <div class="col-10">
                        {{ cert.name }}
                    </div>
                    <div class="col-2">
                        <span @click="deleteCertification(cert.id, index)"
                              class="fa fa-trash-alt text-danger float-left"
                              title="delete"></span>
                        <span class="fa fa-pen-alt text-warning float-right"
                              title="edit"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 card-body">
                <div class="row">
                    <div class="col-6">
                        <strong>Certificate Number:</strong>
                    </div>
                    <div class="col-6">
                        <p>{{ cert.cartificate_number }}</p>
                    </div>
                    <div class="col-6">
                        <strong>Issuing Organisation:</strong>
                    </div>
                    <div class="col-6">
                        <p>{{ cert.issuing_organisation }}</p>
                    </div>
                    <div class="col-6">
                        <strong>Date Issued:</strong>
                    </div>
                    <div class="col-6">
                        <p>{{ cert.date_issued }}</p>
                    </div>
                    <div class="col-6">
                        <strong>Validity:</strong>
                    </div>
                    <div class="col-6">
                        <p>{{ cert.valid_to }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    emits: ['add-certification-form'], // Always include emits
    props: {
        selected_user: Object,
    },
    data(){
        return {
            deleted: false,
            certifications: []
        }
    },

    methods: {
        emitAddCertificationForm (event) {
            this.$emit('add-certification-form', true);
        },

        getCertifications(){
            console.log(this.selected_user.id);
            axios.get('/api/yaedp/'+this.selected_user.id+'/certifications')
                .then((response) => {
                    if(response.data.success === true){
                        this.certifications = response.data.certifications;
                    }else{
                        console.log(response.data.message);
                    }
                }).catch((error) => {
                console.log(error);
            });
        },

        deleteCertification(id, index){
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
                    axios.delete('/api/yaedp/'+this.selected_user.id+'/certifications/'+id+'/delete')
                        .then((response) => {
                            if(response.data.success === true){
                                this.certifications.splice(index, 1);
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
        this.getCertifications();
    }
}
</script>

<style scoped>

</style>
