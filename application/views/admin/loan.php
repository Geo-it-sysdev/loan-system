<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Loan</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Loan</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row g-3">

                <!-- ================= LEFT SIDE ================= -->
                <div class="col-12 col-lg-4">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <form id="BorrowerForm" enctype="multipart/form-data">

                                <input type="hidden" id="loan_id" name="loan_id">

                                <!-- Borrower Information -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-primary mb-3">
                                        <i class="ri-user-line me-1"></i> Borrower Information
                                    </h6>

                                    <div class="row g-3">

                                        <div class="col-md-6 position-relative">
                                            <label class="form-label">Borrower Name</label>

                                            <input type="text" id="borrower_search" class="form-control"
                                                placeholder="Search borrower..." autocomplete="off">

                                            <input type="hidden" name="borrower_id" id="borrower_id" required>

                                            <div id="borrower_list" class="list-group position-absolute w-100 shadow"
                                                style="z-index:999;max-height:220px;overflow-y:auto;display:none;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Loan Purpose</label>
                                            <select class="form-select" name="loan_purpose" required>
                                                <option value="">Select Purpose</option>
                                                <option>Business</option>
                                                <option>Personal</option>
                                                <option>Medical</option>
                                                <option>Education</option>
                                                <option>Agriculture</option>
                                                <option>House Repair</option>
                                                <option>Emergency</option>
                                                <option>Others</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Co-Maker Name</label>
                                            <input type="text" class="form-control" name="co_maker_name"
                                                placeholder="Co-Maker Full Name" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Co-Maker Contact</label>
                                            <input type="text" class="form-control" name="co_maker_contact"
                                                placeholder="09XXXXXXXXX" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Relationship</label>
                                            <input type="text" class="form-control" name="relationship"
                                                placeholder="Friend / Brother / Wife" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Collateral (Optional)</label>
                                            <input type="text" class="form-control" name="collateral"
                                                placeholder="Motorcycle, Land Title, etc.">
                                        </div>

                                    </div>
                                </div>

                                <!-- Loan Details -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-primary mb-3">
                                        <i class="ri-bank-card-line me-1"></i> Loan Details
                                    </h6>

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Loan Plan</label>
                                            <select name="loan_plan" class="form-select" required>
                                                <option value="">Select Loan Plan</option>
                                                <option value="1 month">1 Month</option>
                                                <option value="2 months">2 Months</option>
                                                <option value="3 months">3 Months</option>
                                                <option value="4 months">4 Months</option>
                                                <option value="5 months">5 Months</option>
                                                <option value="6 months">6 Months</option>
                                                <option value="7 months">7 Months</option>
                                                <option value="8 months">8 Months</option>
                                                <option value="9 months">9 Months</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Effective Date</label>
                                            <input type="date" name="effective_date" id="effective_date"
                                                class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Principal Amount</label>
                                            <input type="text" id="principal_amount" name="principal_amount"
                                                class="form-control" placeholder="0.00" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Interest Rate</label>
                                            <select name="interest_rate" id="interest_rate" class="form-select"
                                                required>
                                                <option value="">Select Interest Rate</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <!-- Loan Summary -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-primary mb-3">
                                        <i class="ri-calculator-line me-1"></i> Loan Summary
                                    </h6>

                                    <div class="row g-3">

                                        <div class="col-md-4">
                                            <label class="form-label">Monthly Payment</label>
                                            <input type="text" name="monthly_payment" class="form-control bg-light"
                                                readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Unearned Interest</label>
                                            <input type="text" name="unearned_interest" class="form-control bg-light"
                                                readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Total Balance</label>
                                            <input type="text" name="total_balance"
                                                class="form-control bg-light fw-bold" readonly>
                                        </div>

                                    </div>
                                </div>

                                <!-- Submit -->
                                <button type="submit" id="btnSave" class="btn btn-primary w-100">
                                    <i class="ri-add-line me-1"></i>
                                    Add Loan
                                </button>

                            </form>

                        </div>
                    </div>

                </div>

                <!-- ================= RIGHT SIDE ================= -->
                <div class="col-12 col-lg-8">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stock_filter" id="Pending"
                                        value="Pending" checked>
                                    <label class="form-check-label" for="Pending">Pending</label>
                                </div>


                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stock_filter" id="Released"
                                        value="Released">
                                    <label class="form-check-label" for="Released">Released</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stock_filter" id="partially_paid"
                                        value="partial">
                                    <label class="form-check-label" for="partially_paid">Partially Paid</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stock_filter" id="fully_paid"
                                        value="fully">
                                    <label class="form-check-label" for="fully_paid">Fully Paid</label>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">

                                <table class="table table-striped align-middle w-100 nowrap" id="LoanTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Reference No.</th>
                                            <th>Borrower Name</th>
                                            <th>Loan Purpose</th>
                                            <th>Co-Maker</th>
                                            <th>Relationship</th>
                                            <th>Collateral</th>
                                            <th>Loan Plan</th>
                                            <th>Loan Amount</th>
                                            <th>Interest Rate</th>
                                            <th>Total Amount</th>
                                            <th>Unearned Interest</th>
                                            <th>Date Loan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



    <script>
    let borrowers = [];
    let mode = "add";
    let loanTable;

    // NUMBER FORMAT HELPERS
    function formatNumber(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function unformatNumber(x) {
        return x ? x.toString().replace(/,/g, '') : '';
    }

    // BORROWER SEARCH LIST
    $(document).ready(function() {


        function loadBorrowers() {
            $.ajax({
                url: "<?= base_url('select_borrowers') ?>",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    borrowers = response;
                }
            });
        }

        loadBorrowers();

        function renderList(data) {
            let html = '';

            $.each(data, function(i, row) {
                html += `
                <a class="list-group-item list-group-item-action"
                   data-id="${row.id}"
                   data-name="${row.fullname}">
                   ${row.fullname}
                </a>`;
            });

            $('#borrower_list').html(html);
        }

        $('#borrower_search').on('focus', function() {
            renderList(borrowers);
            $('#borrower_list').show();
        });

        $('#borrower_search').on('keyup', function() {

            let search = $(this).val().toLowerCase();

            let filtered = borrowers.filter(b =>
                b.fullname.toLowerCase().includes(search)
            );

            renderList(filtered);
            $('#borrower_list').show();
        });

        $(document).on('click', '#borrower_list .list-group-item', function() {
            $('#borrower_search').val($(this).data('name'));
            $('#borrower_id').val($(this).data('id'));
            $('#borrower_list').hide();
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('#borrower_search, #borrower_list').length) {
                $('#borrower_list').hide();
            }
        });

        // INTEREST RATES
        function loadInterestRates() {
            $.ajax({
                url: "<?= base_url('get_interest_rates') ?>",
                type: "GET",
                dataType: "json",
                success: function(response) {

                    let options = '<option value="">-- Select Interest Rate --</option>';

                    $.each(response, function(index, row) {
                        options += `<option value="${row.interest_rate}">
                        ${row.interest_rate}%
                    </option>`;
                    });

                    $('#interest_rate').html(options);
                }
            });
        }

        loadInterestRates();

        // LOAN CALCULATION
        function getMonths(plan) {
            switch (plan) {
                case "1 month":
                    return 1;
                case "2 months":
                    return 2;
                case "3 months":
                    return 3;
                case "4 months":
                    return 4;
                case "5 months":
                    return 5;
                case "6 months":
                    return 6;
                case "7 months":
                    return 7;
                case "8 months":
                    return 8;
                case "9 months":
                    return 9;
                default:
                    return 0;
            }
        }

        function calculateLoan() {

            let principal = parseFloat(unformatNumber(
                $('input[name="principal_amount"]').val()
            )) || 0;

            let interestRate = parseFloat($('#interest_rate').val()) || 0;
            let plan = $('select[name="loan_plan"]').val();

            let months = getMonths(plan);

            if (principal > 0 && interestRate > 0 && months > 0) {

                let monthlyInterest = principal * (interestRate / 100);
                let totalInterest = monthlyInterest * months;
                let totalBalance = principal + totalInterest;
                let monthlyPayment = totalBalance / months;

                $('input[name="monthly_payment"]').val(monthlyPayment.toFixed(2));
                $('input[name="unearned_interest"]').val(totalInterest.toFixed(2));
                $('input[name="total_balance"]').val(totalBalance.toFixed(2));
            }
        }

        $('input[name="principal_amount"]').on('input', function() {

            let value = $(this).val().replace(/,/g, '');

            if (value === '' || isNaN(value)) {
                $(this).val('');
                calculateLoan();
                return;
            }

            $(this).val(formatNumber(value));
            calculateLoan();
        });

        $('#interest_rate').on('change', calculateLoan);
        $('select[name="loan_plan"]').on('change', calculateLoan);


        // LOAN TABLE

        loanTable = $('#LoanTable').DataTable({

            ajax: {
                url: "<?= base_url('get_loans') ?>",
                type: "GET",
                data: function(d) {
                    d.status = $('input[name="stock_filter"]:checked').val();
                },
                dataSrc: "data"
            },

            processing: true,
            responsive: true,
            destroy: true,
            autoWidth: false,

            order: [
                [0, 'desc']
            ],

            columns: [{
                    data: 'ref_no'
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'loan_purpose'
                },
                {
                    data: 'co_maker'
                },
                {
                    data: 'relationship'
                },
                {
                    data: 'collateral'
                },
                {
                    data: 'loan_plan'
                },

                {
                    data: 'loan_amount',
                    render: d => '₱ ' + parseFloat(d || 0).toLocaleString()
                },

                {
                    data: 'interest_rate',
                    render: d => d + '%'
                },

                {
                    data: 'total_balance',
                    render: d => '₱ ' + parseFloat(d || 0).toLocaleString()
                },

                {
                    data: 'unearned_interest',
                    render: d => '₱ ' + parseFloat(d || 0).toLocaleString()
                },

                {
                    data: 'date_created'
                },

                {
                    data: 'status',
                    render: function(data) {

                        if (data === 'Pending')
                            return '<span class="badge bg-danger">Pending</span>';
                        if (data === 'Released')
                            return '<span class="badge bg-secondary">Released</span>';
                        if (data === 'Partial')
                            return '<span class="badge bg-primary">Partial</span>';
                        if (data === 'Fully Paid')
                            return '<span class="badge bg-success">Fully Paid</span>';

                        return data;
                    }
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(id, type, row) {

                        let buttons = '';

                        // Only View for Released / Partial / Fully
                        if (
                            row.status === "Released" ||
                            row.status === "Partial" ||
                            row.status === "Fully"
                        ) {
                            buttons = `
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-success btn-sm btn-view" 
                                data-id="${id}"
                                data-interest_rate="${interest_rate}">
                                    <i class="ri-eye-fill"></i> View
                                </button>
                            </div>
                        `;
                        } else {
                            // Pending or others
                            buttons = `
                            <div class="d-flex">
                                <button class="btn btn-success btn-sm btn-released me-1" 
                                data-id="${row.id}"
                                data-ref-no="${row.ref_no}">
                                    <i class="ri-checkbox-circle-fill"></i> Released
                                </button>

                                <button class="btn btn-secondary btn-sm btn-edit me-1" data-id="${id}">
                                    <i class="ri-edit-2-fill"></i> Edit
                                </button>

                                <button class="btn btn-danger btn-sm btn-delete" 
                                data-id="${row.id}"
                                data-ref-no="${row.ref_no}">
                                    <i class="ri-delete-bin-2-fill"></i> Delete
                                </button>
                            </div>
                        `;
                        }

                        return buttons;
                    }
                }
            ],

            language: {
                emptyTable: "No loan records found",
                processing: "Loading loans..."
            }
        });

        $('input[name="stock_filter"]').on('change', function() {
            loanTable.ajax.reload();
        });


        $(document).on('click', '.btn-released', function() {

            let id = $(this).data('id');
            let ref_no = $(this).data('ref-no');

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to release this loan?\n' + ref_no,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Release',
                cancelButtonText: 'No'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('release_loan'); ?>",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.status == "success") {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Released!',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                $('#LoanTable').DataTable().ajax.reload(null,
                                    false);

                            } else {

                                Swal.fire(
                                    'Error',
                                    response.message,
                                    'error'
                                );

                            }

                        }

                    });

                }

            });

        });


        // FORM SUBMIT (ADD / EDIT / VIEW )
        // FORM SUBMIT (ADD / EDIT / VIEW)
        $(document).on('submit', '#BorrowerForm', function(e) {

            e.preventDefault();

            if (mode === "view") {

                $('#BorrowerForm')[0].reset();

                $('#loan_id').val('');
                $('#borrower_id').val('');

                $('#BorrowerForm input').prop('readonly', false);
                $('#BorrowerForm select').prop('disabled', false);

                $('[name="monthly_payment"]').prop('readonly', true);
                $('[name="unearned_interest"]').prop('readonly', true);
                $('[name="total_balance"]').prop('readonly', true);

                $('#btnSave')
                    .removeClass('btn-danger btn-success')
                    .addClass('btn-primary')
                    .html('<i class="ri-add-line me-1"></i> Add Loan');

                mode = "add";
                return false;
            }

            let url = (mode === "edit") ?
                "<?= base_url('update_loan') ?>" :
                "<?= base_url('save_loan') ?>";

            // Confirmation before saving
            Swal.fire({
                title: (mode === "edit") ?
                    "Are you sure you want to update this Loan?" :
                    "Are you sure you want to add this Loan?",
                text: "Please confirm your action.",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#0d6efd",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then((result) => {

                if (!result.isConfirmed) {
                    return;
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#BorrowerForm').serialize(),
                    dataType: "json",

                    success: function(res) {

                        if (res.status) {

                            Swal.fire({
                                icon: 'success',
                                title: (mode === "edit") ?
                                    'Loan Updated Successfully' :
                                    'Loan Added Successfully',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            setTimeout(function() {

                                $('#BorrowerForm')[0].reset();

                                $('#loan_id').val('');
                                $('#borrower_id').val('');

                                $('#BorrowerForm input').prop('readonly',
                                    false);
                                $('#BorrowerForm select').prop('disabled',
                                    false);

                                $('[name="monthly_payment"]').prop(
                                    'readonly', true);
                                $('[name="unearned_interest"]').prop(
                                    'readonly', true);
                                $('[name="total_balance"]').prop('readonly',
                                    true);

                                $('#btnSave')
                                    .removeClass('btn-danger btn-success')
                                    .addClass('btn-primary')
                                    .html(
                                        '<i class="ri-add-line me-1"></i> Add Loan'
                                        );

                                mode = "add";

                                $('#LoanTable').DataTable().ajax.reload(
                                    null, false);

                                refreshEffectiveDate();

                            }, 1500);

                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message || 'Something went wrong'
                            });

                        }

                    },

                    error: function() {

                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Please try again later'
                        });

                    }

                });

            });

        });



        // VIEW LOAN
        $(document).on('click', '.btn-view', function() {

            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('get_loan_for_details') ?>",
                type: "POST",
                data: {
                    id
                },
                dataType: "json",

                success: function(res) {

                    if (res.status) {

                        let d = res.data;

                        $('#loan_id').val(d.id);
                        $('#borrower_id').val(d.borrower_id);
                        $('#borrower_search').val(d.fullname);

                        $('[name="loan_purpose"]').val(d.loan_purpose);

                        $('[name="co_maker_name"]').val(d.co_maker);
                        $('[name="co_maker_contact"]').val(d.co_maker_contact);
                        $('[name="relationship"]').val(d.relationship);
                        $('[name="collateral"]').val(d.collateral);

                        $('[name="loan_plan"]').val(d.loan_plan);
                        $('[name="effective_date"]').val(d.effective_date);

                        $('#principal_amount').val(parseFloat(d.loan_amount)
                            .toLocaleString());

                        $('#interest_rate').val(d.interest_rate);

                        $('[name="monthly_payment"]').val(d.monthly_payment);
                        $('[name="unearned_interest"]').val(d.unearned_interest);
                        $('[name="total_balance"]').val(d.total_balance);

                        // $('#BorrowerForm input').prop('readonly', true);
                        // $('#BorrowerForm select').prop('disabled', true);

                        $('#btnSave')
                            .removeClass('btn-primary btn-success')
                            .addClass('btn-danger')
                            .html('<i class="ri-close-line me-1"></i> Close');

                        mode = "view";
                    }
                }
            });
        });

        // EDIT LOAN
        $(document).on('click', '.btn-edit', function() {

            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('get_loan_for_details') ?>",
                type: "POST",
                data: {
                    id
                },
                dataType: "json",

                success: function(res) {

                    if (res.status) {

                        let d = res.data;

                        $('#loan_id').val(d.id);
                        $('#borrower_id').val(d.borrower_id);
                        $('#borrower_search').val(d.fullname);

                        $('[name="loan_purpose"]').val(d.loan_purpose);

                        $('[name="co_maker_name"]').val(d.co_maker);
                        $('[name="co_maker_contact"]').val(d.co_maker_contact);
                        $('[name="relationship"]').val(d.relationship);
                        $('[name="collateral"]').val(d.collateral);

                        $('[name="loan_plan"]').val(d.loan_plan);
                        $('[name="effective_date"]').val(d.effective_date);

                        $('#principal_amount').val(d.loan_amount);

                        $('#interest_rate').val(d.interest_rate);

                        $('[name="monthly_payment"]').val(d.monthly_payment);
                        $('[name="unearned_interest"]').val(d.unearned_interest);
                        $('[name="total_balance"]').val(d.total_balance);

                        $('#btnSave')
                            .removeClass('btn-primary btn-danger')
                            .addClass('btn-success')
                            .html('<i class="ri-save-line me-1"></i> Update Loan');

                        mode = "edit";
                    }
                }
            });
        });

        // DELETE LOAN
        $(document).on('click', '.btn-delete', function() {

            let id = $(this).data('id');
            let ref_no = $(this).data('ref-no');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete this loan.\n' + ref_no,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'No'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('delete_loan'); ?>",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.status == "success") {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                $('#LoanTable').DataTable().ajax.reload(null,
                                    false);

                            } else {

                                Swal.fire(
                                    'Error',
                                    response.message,
                                    'error'
                                );

                            }

                        }

                    });

                }

            });

        });





    });




    document.addEventListener("DOMContentLoaded", function() {

        refreshEffectiveDate();

        const today = new Date();

        today.setMonth(today.getMonth() + 1);

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');

        document.getElementById("effective_date").value =
            `${year}-${month}-${day}`;
    });

    function refreshEffectiveDate() {
        const today = new Date();

        today.setMonth(today.getMonth() + 1);

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');

        $('#effective_date').val(`${year}-${month}-${day}`);
    }

    // document.addEventListener("DOMContentLoaded", function() {
    // });
    </script>