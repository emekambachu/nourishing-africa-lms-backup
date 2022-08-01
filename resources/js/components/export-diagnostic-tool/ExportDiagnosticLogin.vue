<template>
    <div class="card p-5 margin-10px-top">
        <h6 class="yedp-begin-title">Login to Begin</h6>
        <form>
            <label class="form-text">Email: <span class="text-danger">*</span>
                <input class="form-control" type="email" placeholder="YEADP Email" required />
                <span class="feedback-custom"></span>
            </label>
            <label class="form-text">Password: <span class="text-danger">*</span>
                <input class="form-control" type="Password" placeholder="YEADP Password" required />
                <span class="feedback-custom"></span>
            </label>
            <button class="yedp-begin-btn btn active text-center">Begin</button>
        </form>

        <div class="float-right" style="display: block;">
            <p class="text-center login-shortcut">
                <a class="na-text-dark-green"
                   :href="'/yaedp/forgot-password'">
                    Reset Password</a>
            </p>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ExportDiagnosticLogin"
    }
</script>

<style scoped>

</style>
