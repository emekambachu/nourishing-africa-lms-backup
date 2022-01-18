var grantsum = $("#grantee_amount").val() != "" ? "(NGN "+$("#grantee_amount").val()+")" : "";
var indicator1 = "<div id='indicator1' class=''>"
                +"<h6 class='brand-text'>Revenue Growth</h6>"
                +"<h6>Grant Sum "+grantsum+"</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Amount Invested <span class='text-success'>(NGN) *</span>"
                    +"<input class='form-control' name='amount_invested' id='amount_invested' type='number' value='{{ old('amount_invested') }}' >"
                    +"<span id='amount_invested-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Yield <span class='text-success'>(NGN) *</span>"
                    +"<input class='form-control' name='yield' id='yield' type='number' value='{{ old('yield') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Expenditures <span class='text-success'>(NGN) *</span>"
                    +"<input class='form-control' name='expenditure' id='expenditure' type='number' value='{{ old('expenditure') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6 d-none'>"
                    +"<label class='form-text'>Profit <span class='text-success'>(NGN) *</span>"
                    +"<input class='form-control' name='start_up_profit' id='start_up_profit' type='number' disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"<h6 class='mt-3'>Revenue Trend</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Previous Income <span class='text-success'>(NGN) *</span>"
                    +"<input class='form-control' name='prev_income' id='prev_income' type='number' value='{{ old('prev_income') }}'>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Current Income <span class='text-success'>(NGN) *</span>"
                    +"<input class='form-control' name='curr_income' id='curr_income' type='number' value='{{ old('curr_income') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>" 
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text'>Revenue Growth Rate (%)<span class='text-success'>*</span>"
                    +"<input class='form-control' id='rev_growth_rate' name='rev_growth_rate' type='number'  disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div id='purchaseDiv' class='col-md-6'>"
                    +"<label class='form-text text-truncate'>Please Upload Transaction Receipt<span class='text-success'>*</span>"
                    //+"<input class='form-control' name='financial_evidence' id='financial_evidence' type='file' >"
                    +"<br/><a class='esp-upload-btn' data-toggle='modal' data-target='#uploadPanel1'>Upload <i class='fas fa-upload'></i></a>"
                    +"<br/><span id='financial-evidence-fb' class='feedback-custom text-warning'></span>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"</div>";

var indicator2 = "<div id='indicator2' class='d-none'>"
                +"<h6 class='brand-text'>Job Creation</h6>"
                +"<h6>Number of new staff</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Number of Female <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='new_staff_female' id='new_staff_female' type='number' value='{{ old('new_staff_female') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Number of Male <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='new_staff_male' id='new_staff_male' type='number' value='{{ old('new_staff_male') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text'>Total <span class='text-success'>*</span>"
                    +"<input class='form-control' name='total_new_staff' id='total_new_staff' type='number' disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<hr/>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Number of Full-time <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='fulltime' id='fulltime' type='number' value='{{ old('fulltime') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Number of Part-time <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='parttime' id='parttime' type='number' value='{{ old('parttime') }}'>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text'>Total <span class='text-success'>*</span>"
                    +"<input class='form-control' name='total_ftpt' id='total_ftpt' type='number' disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"<h6 class='mt-3'>Indirect Employment Created</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>At Product Level<span class='text-danger'>*</span>"
                    +"<input class='form-control' name='product' id='product' type='number' value='{{ old('product') }}'>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>At Service Level <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='service' id='service' type='number' value='{{ old('service') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text'>Total <span class='text-success'>*</span>"
                    +"<input class='form-control' name='total_sp' id='total_sp' type='number' disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"</div>";

var indicator3 = "<div id='indicator3' class='d-none'>"
                +"<h6 class='brand-text'>Improving agribusiness education</h6>"
                +"<h6>Number of new staff & individuals who have benefitted from improved agribusiness education (Apprentice/'Intern', training)</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Number of Graduate <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='graduate' id='graduate' type='number' value='{{ old('graduate') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Number of Undergraduate <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='undergraduate' id='undergraduate' type='number' value='{{ old('undergraduate') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>No formal education <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='formal_education' id='formal_education' type='number' value='{{ old('formal_education') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text text-truncate' data-toggle='tooltip' data-placement='top' title='Total number of people receiving improved agribusiness education'>Total number of people receiving improved agribusiness education <span class='text-success'>*</span>"
                    +"<input class='form-control' name='total_edu' id='total_edu' type='number'  disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"</div><div class='row'>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Number of Female <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='female_edu' id='female_edu' type='number' value='{{ old('female_edu') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Number of Male <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='male_edu' id='male_edu' type='number' value='{{ old('male_edu') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text'>Total <span class='text-success'>*</span>"
                    +"<input class='form-control' name='total_fm_edu' id='total_fm_edu' type='number' disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"</div>";

var indicator4 = "<div id='indicator4' class='d-none'>"
                +"<h6 class='brand-text'>Market Expansion</h6>"
                +"<h6>Number of new customers reached</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Achieved(Current Month) <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='customer_achieved' id='customer_achieved' type='number' value='{{ old('customer_achieved') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Expected(Next Month) <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='customer_expected_next_month' id='customer_expected' type='number' value='{{ old('customer_expected') }}'>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text text-truncate'>% Achieved <span class='text-success'>*</span>"
                    +"<input class='form-control' name='customer_percentage' id='customer_percentage' type='number' disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"<h6 class='mt-3'>Number of new market location covered</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Achieved(Current Month) <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='market_achieved' id='market_achieved' type='number' value='{{ old('market_achieved') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Expected(Next Month) <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='market_expected_next_month' id='market_expected' type='number' value='{{ old('market_expected') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text text-truncate'>% Achieved <span class='text-success'>*</span>"
                    +"<input class='form-control' name='market_percentage' id='market_percentage' type='number' disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"<h6 class='mt-3'>Number of new Product launched</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Achieved(Current Month) <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='product_achieved' id='product_achieved' type='number' value='{{ old('product_achieved') }}'  >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Expected(Next Month) <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='product_expected_next_month' id='product_expected' type='number' value='{{ old('product_expected') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text text-truncate'>% Achieved <span class='text-success'>*</span>"
                    +"<input class='form-control' name='product_percentage' id='product_percentage' type='number' disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"<h6 class='mt-3'>Tools or machineries</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Any tools or machineries procured within the previos month? <span class='text-danger'>*</span>"
                    +"<select class='form-control' name='tools_machinery' id='tools_machinery' >"
                    +"<option value='null' selected> --Select a value-- </option>"
                    +"<option value='yes'> Yes </option>"
                    +"<option value='no'> No </option>"
                    +"</select>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div id='purchaseDiv' class='col-md-6'>"
                    +"<label class='form-text text-truncate'>Evidence of purchase<span class='text-success'>*</span>"
                    //+"<input class='form-control' name='purchase_evidence' id='purchase_evidence' type='file' >"
                    +"<br/><a class='esp-upload-btn' data-toggle='modal' data-target='#uploadPanel2'>Upload Evidence <i class='fas fa-upload'></i></a>"
                    +"<br/><span id='purchase-evidence-fb' class='feedback-custom text-warning'></span>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"<h6 class='mt-3'>Operational Efficiency and Innovations</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-12'>"
                    +"<label class='form-text text-truncate' data-toggle='tooltip' data-placement='top' title='Efforts towards improving production capacity.'>Efforts towards improving production capacity.<span class='text-danger'>*</span>"
                    +"<textarea class='form-control' name='efforts_towards_improvng_prod_cap' id='efforts_towards_improvng_prod_cap'></textarea>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"</div>";

var indicator5 = "<div id='indicator5' class='d-none'>"
                +"<h6 class='brand-text'>Sustainability</h6>"
                +"<div class='row pb-3'>"
                    +"<div id='bod' class='col-md-6'>"
                    +"<label class='form-text'>Do you have Board of Directors? <span class='text-danger'>*</span></label>"
                    +"<div class='form-check form-check-inline'>"
                    +"<input type='radio' name='board_of_directors' value='yes'/>"
                    +"<label class='form-check-label' for='defaultcheck1'>Yes</label>"
                    +"</div>"
                    +"<div class='form-check form-check-inline'>"
                    +"<input type='radio' name='board_of_directors' value='no'/>"
                    +"<label class='form-check-label' for='defaultcheck1'>No</label>"
                    +"</div>" 
                    +"</div>"

                    +"<div id='bmd' class='col-md-6'>"
                    +"<label class='form-text'>Date you held your board meeting within the last 6 months? <span class='text-danger'>*</span></label>"
                    +"<input id='bmdctrl' class='form-control' type='date' name='board_meeting_date' value=''/>"
                    +"</div>"

                    +"<div id='opm' class='col-md-6'>"
                    +"<label class='form-text'>Do you have Operational Manual? <span class='text-danger'>*</span></label>"
                    +"<div class='form-check form-check-inline'>"
                    +"<input type='radio' name='op_manual' value='yes'/>"
                    +"<label class='form-check-label' for='defaultcheck1'>Yes</label>"
                    +"</div>"
                    +"<div class='form-check form-check-inline'>"
                    +"<input type='radio' name='op_manual' value='no'/>"
                    +"<label class='form-check-label' for='defaultcheck1'>No</label>"
                    +"</div>" 
                    +"</div>"
                    
                +"</div>"
                +"<h6>Benchmark</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Expected Product Supply/Sales <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='expected_product_supply' id='expected_product_supply' type='number' value='{{ old('expected_product_supply') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-6'>"
                    +"<label class='form-text'>Actual Product Supply/Sales <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='actual_product_supply' id='actual_product_supply' type='number' value='{{ old('actual_product_supply') }}' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4 d-none'>"
                    +"<label class='form-text text-truncate'>% Yield <span class='text-success'>*</span>"
                    +"<input class='form-control' name='yield_percentage' id='yield_percentage' type='number' disabled>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"<h6 class='mt-3'>Valua Chain Impact Covered</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Production <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='production_vc' id='production_vc' type='text' value='' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Processing <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='processing_vc' id='processing_vc' type='text' value='' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text text-truncate'>Retail <span class='text-success'>*</span>"
                    +"<input class='form-control' name='retail_vc' id='retail_vc' type='text' value=''>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"<h6 class='mt-3'>Quality Assurance Test</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Process Checklists <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='process_checklist' id='process_checklist' type='text' value='' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Process Standard <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='process_standard' id='process_standard' type='text' value='' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Process Documentation/Audit <span class='text-success'>*</span>"
                    +"<input class='form-control' name='process_doc' id='process_doc' type='text' value=''>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"<h6 class='mt-3'>Report Completed By</h6>"
                +"<div class='row'>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Name <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='report_by' id='report_by' type='text' value='' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text'>Designation <span class='text-danger'>*</span>"
                    +"<input class='form-control' name='designation' id='designation' type='text' value='' >"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                    +"<div class='col-md-4'>"
                    +"<label class='form-text text-truncate'>Date <span class='text-success'>*</span>"
                    +"<input class='form-control' name='date' id='date' type='date' value=''>"
                    +"<span id='gender-part-1-fb' class='feedback-custom'></span>"
                    +"</label>"
                    +"</div>"
                +"</div>"
                +"</div>";

var indicator6 = "<h6 class='brand-text'>Submited Successfully !!!</h6>"
                +"<p class='text-center'>Thank you for taking  your time  to complete and submit the report. Cheers</p>"

const pages = [indicator1, indicator2, indicator3, indicator4, indicator5];
const pages_name =  ["indicator1", "indicator2", "indicator3", "indicator4", "indicator5"];
let _default = pages[0];
let activePageIndex = 0;
$("#indicator").append(indicator1);
$("#indicator").append(indicator2);
$("#indicator").append(indicator3);
$("#indicator").append(indicator4);
$("#indicator").append(indicator5);


document.getElementById("report-proceed").addEventListener("click", displayNextPage);
document.getElementById("report-next").addEventListener("click", displayNextPage);
document.getElementById("report-prev").addEventListener("click", displayPreviousPage);
document.getElementById("report-submit").addEventListener("click", submitReport);


function displayNextPage() {
    if(activePageIndex == 0){
        var check = validate(activePageIndex);
        if(check == 0){
            activePageIndex++;
            $("#report-proceed").addClass('d-none');
            $("#report-prev").removeClass('d-none');
            $("#report-next").removeClass('d-none');
            $("#"+pages_name[activePageIndex - 1]).addClass('d-none');
            $("#"+pages_name[activePageIndex]).removeClass('d-none');
        }
    }else if((pages.length - 1) == (activePageIndex + 1)){
        var check = validate(activePageIndex);
        if(check == 0){
            $("#report-submit").removeClass('d-none');
            $("#report-next").addClass('d-none');
            $("#"+pages_name[activePageIndex]).addClass('d-none');
            $("#"+pages_name[++activePageIndex]).removeClass('d-none');
        }    
    }else{
        var check = validate(activePageIndex);
        if(check == 0){
            activePageIndex++;
            $("#"+pages_name[activePageIndex - 1]).addClass('d-none');
            $("#"+pages_name[activePageIndex]).removeClass('d-none');      
        }
    }
    event.preventDefault();
}

function validate(index){
    var check = 0;
    if(pages_name[index] == "indicator1")
    {
        var val0 = $("#amount_invested").val();
        if(isEmpty(val0)){
            invalidFeedback("amount_invested");
            check ++;
        }else{
            validFeedback("amount_invested");
        }
        var val1 = $("#yield").val();
        if(isEmpty(val1)){
            invalidFeedback("yield");
            check ++;
        }else{
            validFeedback("yield");
        }
        var val2 = $("#expenditure").val();
        if(isEmpty(val2)){
            invalidFeedback("expenditure");
            check ++;
        }else{
            validFeedback("expenditure");
        }
        /*var val3 = $("#start_up_profit").val();
        if(isEmpty(val3)){
            invalidFeedback("start_up_profit");
            check ++;
        }else{
            validFeedback("start_up_profit");
        }*/
        var val4 = $("#curr_income").val();
        if(isEmpty(val4)){
            invalidFeedback("curr_income");
            check ++;
        }else{
            validFeedback("curr_income");
        }
        var val5 = $("#prev_income").val();
        if(isEmpty(val5)){
            invalidFeedback("prev_income");
            check ++;
        }else{
            validFeedback("prev_income");
        }
        /*var val6 = $("#rev_growth_rate").val();
        if(isEmpty(val6)){
            invalidFeedback("rev_growth_rate");
            check ++;
        }else{
            validFeedback("rev_growth_rate");
        }*/
        var val7 = $("[name='financial_evidence[]']").map(function () { return $(this).val(); }).get();
        if(val7.length == 0 || isEmpty(val7)){
            $("#financial-evidence-fb").text('Please upload at least a file.');
            check ++;
        }else{
            $("#financial-evidence-fb").text('Okay.');
        }
        return check;
    }
    else if(pages_name[index] == "indicator2")
    {
        var val0 = $("#new_staff_female").val();
        if(isEmpty(val0)){
            invalidFeedback("new_staff_female");
            check ++;
        }else{
            validFeedback("new_staff_female");
        }
        var val1 = $("#new_staff_male").val();
        if(isEmpty(val1)){
            invalidFeedback("new_staff_male");
            check ++;
        }else{
            validFeedback("new_staff_male");
        }
        /*var val2 = $("#total_new_staff").val();
        if(isEmpty(val2)){
            invalidFeedback("total_new_staff");
            check ++;
        }else{
            validFeedback("total_new_staff");
        }*/
        var val3 = $("#fulltime").val();
        if(isEmpty(val3)){
            invalidFeedback("fulltime");
            check ++;
        }else{
            validFeedback("fulltime");
        }
        var val04 = $("#parttime").val();
        if(isEmpty(val04)){
            invalidFeedback("parttime");
            check ++;
        }else{
            validFeedback("parttime");
        }
        /*var val4 = $("#total_ftpt").val();
        if(isEmpty(val4)){
            invalidFeedback("total_ftpt");
            check ++;
        }else{
            validFeedback("total_ftpt");
        }*/
        var val5 = $("#product").val();
        if(isEmpty(val5)){
            invalidFeedback("product");
            check ++;
        }else{
            validFeedback("product");
        }
        var val6 = $("#service").val();
        if(isEmpty(val6)){
            invalidFeedback("service");
            check ++;
        }else{
            validFeedback("service");
        }
        /*var val6 = $("#total_sp").val();
        if(isEmpty(val6)){
            invalidFeedback("total_sp");
            check ++;
        }else{
            validFeedback("total_sp");
        }*/
        return check;
    }
    else if(pages_name[index] == "indicator3")
    {
        var val0 = $("#graduate").val();
        if(isEmpty(val0)){
            invalidFeedback("graduate");
            check ++;
        }else{
            validFeedback("graduate");
        }
        var val1 = $("#undergraduate").val();
        if(isEmpty(val1)){
            invalidFeedback("undergraduate");
            check ++;
        }else{
            validFeedback("undergraduate");
        }
        
        var val3 = $("#formal_education").val();
        if(isEmpty(val3)){
            invalidFeedback("formal_education");
            check ++;
        }else{
            validFeedback("formal_education");
        }
        /*var val04 = $("#total_edu").val();
        if(isEmpty(val04)){
            invalidFeedback("total_edu");
            check ++;
        }else{
            validFeedback("total_edu");
        }*/
        var val4 = $("#female_edu").val();
        if(isEmpty(val4)){
            invalidFeedback("female_edu");
            check ++;
        }else{
            validFeedback("female_edu");
        }
        var val5 = $("#male_edu").val();
        if(isEmpty(val5)){
            invalidFeedback("male_edu");
            check ++;
        }else{
            validFeedback("male_edu");
        }
        /*var val6 = $("#total_fm_edu").val();
        if(isEmpty(val6)){
            invalidFeedback("total_fm_edu");
            check ++;
        }else{
            validFeedback("total_fm_edu");
        }*/
        return check;
    }
    else if(pages_name[index] == "indicator4")
    {
        var val0 = $("#customer_achieved").val();
        if(isEmpty(val0)){
            invalidFeedback("customer_achieved");
            check ++;
        }else{
            validFeedback("customer_achieved");
        }
        var val1 = $("#customer_expected").val();
        if(isEmpty(val1)){
            invalidFeedback("customer_expected");
            check ++;
        }else{
            validFeedback("customer_expected");
        } 

        var val2 = $("#market_expected").val();
        if(isEmpty(val2)){
            invalidFeedback("market_expected");
            check ++;
        }else{
            validFeedback("market_expected");
        }
        var val3 = $("#market_achieved").val();
        if(isEmpty(val3)){
            invalidFeedback("market_achieved");
            check ++;
        }else{
            validFeedback("market_achieved");
        }
        
        var val04 = $("#product_achieved").val();
        if(isEmpty(val04)){
            invalidFeedback("product_achieved");
            check ++;
        }else{
            validFeedback("product_achieved");
        }
        var val4 = $("#product_expected").val();
        if(isEmpty(val4)){
            invalidFeedback("product_expected");
            check ++;
        }else{
            validFeedback("product_expected");
        }

        var val6 = $("#tools_machinery").val();
        if(val6 == "null"){
            invalidFeedback("tools_machinery");
            check ++;
        }else{
            validFeedback("tools_machinery");
        }
        
        var val06 = $("[name='purchase_evidence[]']").map(function () { return $(this).val(); }).get();
        if(val6 == "yes"){
            if(val06.length == 0 || isEmpty(val06)){
                $("#purchase-evidence-fb").text('Please upload at least a file.');
                check ++;
            }else{
                $("#purchase-evidence-fb").text('Okay.');
            }
        }
        
        var val7 = $("#efforts_towards_improvng_prod_cap").val();
        if(isEmpty(val7)){
            invalidFeedback("efforts_towards_improvng_prod_cap");
            check ++;
        }else{
            validFeedback("efforts_towards_improvng_prod_cap");
        }

        if($("#board_of_directors").val() == "yes"){
            $("#bod").addClass('d-none');
        }
        if($("#board_meeting_date").val() != ""){
            $("#bmd").addClass('d-none');
        }
        if($("#op_manual").val()  == "yes"){
            $("#opm").addClass('d-none');
        }
        
    
        return check;
    }
    else if(pages_name[index] == "indicator5")
    {
        var val0 = $("#expected_product_supply").val();
        if(isEmpty(val0)){
            invalidFeedback("expected_product_supply");
            check ++;
        }else{
            validFeedback("expected_product_supply");
        }
        var val1 = $("#actual_product_supply").val();
        if(isEmpty(val1)){
            invalidFeedback("actual_product_supply");
            check ++;
        }else{
            validFeedback("actual_product_supply");
        }
        /*var val01 = $("#yield_percentage").val();
        if(isEmpty(val01)){
            invalidFeedback("yield_percentage");
            check ++;
        }else{
            validFeedback("yield_percentage");
        }*/

        var val2 = $("#production_vc").val();
        if(isEmpty(val2)){
            invalidFeedback("production_vc");
            check ++;
        }else{
            validFeedback("production_vc");
        }
        var val21 = $("#processing_vc").val();
        if(isEmpty(val21)){
            invalidFeedback("processing_vc");
            check ++;
        }else{
            validFeedback("processing_vc");
        }
        var val02 = $("#retail_vc").val();
        if(isEmpty(val02)){
            invalidFeedback("retail_vc");
            check ++;
        }else{
            validFeedback("retail_vc");
        }

        var val3 = $("#process_checklist").val();
        if(isEmpty(val3)){
            invalidFeedback("process_checklist");
            check ++;
        }else{
            validFeedback("process_checklist");
        }
        var val31 = $("#process_standard").val();
        if(isEmpty(val31)){
            invalidFeedback("process_standard");
            check ++;
        }else{
            validFeedback("process_standard");
        }
        var val03 = $("#process_doc").val();
        if(isEmpty(val03)){
            invalidFeedback("process_doc");
            check ++;
        }else{
            validFeedback("process_doc");
        }

        var val4 = $("#report_by").val();
        if(isEmpty(val4)){
            invalidFeedback("report_by");
            check ++;
        }else{
            validFeedback("report_by");
        }
        var val41 = $("#designation").val();
        if(isEmpty(val41)){
            invalidFeedback("designation");
            check ++;
        }else{
            validFeedback("designation");
        }
        var val04 = $("#date").val();
        if(isEmpty(val04)){
            invalidFeedback("date");
            check ++;
        }else{
            validFeedback("date");
        }

        return check;
    }
    else{

    }
}

function displayPreviousPage() {
    if(activePageIndex == 1){
        $("#"+pages_name[activePageIndex]).addClass('d-none');
        activePageIndex--;
        $("#report-proceed").removeClass('d-none');
        $("#report-prev").addClass('d-none');
        $("#report-next").addClass('d-none');
        $("#"+pages_name[activePageIndex]).removeClass('d-none');
    }else if(activePageIndex == 4){
        $("#"+pages_name[activePageIndex]).addClass('d-none');
        activePageIndex--;
        $("#report-proceed").addClass('d-none');
        $("#report-submit").addClass('d-none');
        $("#report-next").removeClass('d-none');
        $("#"+pages_name[activePageIndex]).removeClass('d-none');
    }else{
        $("#"+pages_name[activePageIndex]).addClass('d-none');
        activePageIndex--;
        $("#"+pages_name[activePageIndex]).removeClass('d-none');
    }
}

function submitReport(){
    var check = validate(4);
    if(check != 0){
        return false;
    }

    if(!confirm("Are you sure you would like to go ahead with the submission. Please note that you can not go back to edit this report once submitted.")){
        return false;
    }
    $('#espTemplateForm').submit();
}
/*
function startUp(){
    var val1 = $("#yield").val();
    var val2 = $("#expenditure").val();

    if(val1 != "" && val2 != ""){
        var sum = parseInt(val1) - parseInt(val2);
        $("#start_up_profit").val(sum);
    }
}

function revenueTrend(){
    var val1 = $("#curr_income").val();
    var val2 = $("#prev_income").val();

    if(val1 != "" && val2 != ""){
        var sum = ((parseInt(val1) - parseInt(val2))/parseInt(val1))*100;
        $("#rev_growth_rate").val(sum);
    }
}

function total_new_staff(){
    var val1 = $("#new_staff_female").val();
    var val2 = $("#new_staff_male").val();

    if(val1 != "" && val2 != ""){
        var sum = parseInt(val1) + parseInt(val2);
        $("#total_new_staff").val(sum);
    }
}

function total_ftpt(){
    var val1 = $("#fulltime").val();
    var val2 = $("#parttime").val();

    if(val1 != "" && val2 != ""){
        var sum = parseInt(val1) + parseInt(val2);
        $("#total_ftpt").val(sum);
    }
}

function total_sp(){
    var val1 = $("#product").val();
    var val2 = $("#service").val();

    if(val1 != "" && val2 != ""){
        var sum = parseInt(val1) + parseInt(val2);
        $("#total_sp").val(sum);
    }
}

function total_edu(){
    var val1 = $("#graduate").val();
    var val2 = $("#undergraduate").val();
    var val3 = $("#apprentice").val();
    var val4 = $("#formal_education").val();

    if(val1 != "" && val2 != "" && val3 != "" && val4 != ""){
        var sum = parseInt(val1) + parseInt(val2) + parseInt(val3) + parseInt(val4);
        $("#total_edu").val(sum);
    }
}

function total_fm_edu(){
    var val1 = $("#female_edu").val();
    var val2 = $("#male_edu").val();

    if(val1 != "" && val2 != ""){
        var sum = parseInt(val1) + parseInt(val2);
        $("#total_fm_edu").val(sum);
    }
}

function total_indirect_emp(){
    var val1 = $("#product_indirect").val();
    var val2 = $("#service_indirect").val();

    if(val1 != "" && val2 != ""){
        var sum = parseInt(val1) + parseInt(val2);
        $("#total_indirect_emp").val(sum);
    }
}

function customer_percentage(){
    var val1 = $("#customer_expected").val();
    var val2 = $("#customer_achieved").val();

    if(val1 != "" && val2 != ""){
        var sum = (parseInt(val2) / parseInt(val1)) * 100;
        $("#customer_percentage").val(sum);
    }
}

function market_percentage(){
    var val1 = $("#market_expected").val();
    var val2 = $("#market_achieved").val();

    if(val1 != "" && val2 != ""){
        var sum = (parseInt(val2) / parseInt(val1)) * 100;
        $("#market_percentage").val(sum);
    }
}

function product_percentage(){
    var val1 = $("#product_expected").val();
    var val2 = $("#product_achieved").val();

    if(val1 != "" && val2 != ""){
        var sum = (parseInt(val2) / parseInt(val1)) * 100;
        $("#product_percentage").val(sum);
    }
}

function yield_percentage(){
    var val1 = $("#expected_product_supply").val();
    var val2 = $("#actual_product_supply").val();

    if(val1 != "" && val2 != ""){
        var sum = (parseInt(val2) / parseInt(val1)) * 100;
        $("#yield_percentage").val(sum);
    }
}

function toolsMachinery(value){
    let val = value;
    if(!(isEmpty(val)))
    {
        if(val == 'yes'){
            $('#purchaseDiv').removeClass('d-none');
        }else{
            $('#purchaseDiv').addClass('d-none');
        }
    }else{
        $('#purchaseDiv').addClass('d-none');
    }
}*/

function invalidFeedback(id){
    $('#'+id).addClass('is-invalid');
    $('#'+id).removeClass('is-valid');
    $('#'+id+'-fb').addClass('invalid-feedback');
    $('#'+id+'-fb').removeClass('valid-feedback');
    //$('#'+id+'-part-'+part+'-fb').text(msg);
}

function validFeedback(id){
    $('#'+id).addClass('is-valid');
    $('#'+id).removeClass('is-invalid');
    $('#'+id+'-fb').addClass('valid-feedback');
    $('#'+id+'-fb').removeClass('invalid-feedback');
    //$('#'+id+'-part-'+part+'-fb').text('Looks good!');
}

function isEmpty(str) {
    return (!str || str.length === 0 || /^\s*$/.test(str));
}

function milestoneStatus(val, index){
    $("#"+val+"_"+index).modal();
}

function addmilestone(){
    var id = $("#mileTemp").val();
    id = id + 1;
    var template  = "<label class='form-text'>Milestone<span class='text-danger'>*</span>"
            +"<input class='form-control' name='milestone[]' id='mile"+id+"' type='text' value='' >"
            +"</label>";
    $("#mileTemp").val(id);
    $("#contrl-stage").append(template);
}