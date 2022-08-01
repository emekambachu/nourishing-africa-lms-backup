<template>
    <div class="row p-4">
        <div class="col-md-12">
            <form>
<!--                <div v-if="errors" class="text-danger text-center">-->
<!--                    <span v-for="(error, index) in errors" :key="index">-->
<!--                        {{ error.toString() }}<br>-->
<!--                    </span>-->
<!--                </div>-->
                <label class="form-text">Email: <span class="text-danger">*</span>
                    <input class="form-control" type="email" placeholder="YEADP Email" required />
                    <span class="feedback-custom"></span>
                </label>
                <button type="submit" class="yedp-begin-btn btn active">Next</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExportDiagnosticQuestion"
    }
</script>

<style scoped>

</style>
