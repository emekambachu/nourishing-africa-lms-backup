/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Default
require('./bootstrap');
import {
    createApp
} from 'vue';
import router from './routes';
import axios from 'axios';
import VueAxios from 'vue-axios';

// Sweet Alert
import Swal from 'sweetalert2';
window.Swal = Swal;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// YAEDP Account
import AccountSettingsComponent from './components/account-settings/AccountSettingsComponent';
import DocumentUploads from './components/document-uploads/DocumentUploads';

// Export Diagnostic Tool
import ExportDiagnosticLogin from './components/export-diagnostic-tool/ExportDiagnosticLogin';
import ExportDiagnosticApplication from './components/export-diagnostic-tool/ExportDiagnosticApplication';

// Selected YAEDP Users
import YaedpBusinessProfile from './components/yaedp/business-profile/YaedpBusinessProfile';
import YaedpExportResources from './components/yaedp/export-resources/YaedpExportResources';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const App = createApp({
    components: {
        AccountSettingsComponent,
        DocumentUploads,

        YaedpBusinessProfile,
        YaedpExportResources,

        ExportDiagnosticLogin,
        ExportDiagnosticApplication,
    },
})

// Check if application is in production, switch to live url
// Else use local/development url
App.config.globalProperties.appUrl = 'https://afchub.org';
// App.config.globalProperties.appUrl = 'http://127.0.0.1:8000';
App.use(router, axios, VueAxios).mount('#app');
