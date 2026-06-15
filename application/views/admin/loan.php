<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                <div class="col-12 col-lg-5">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <form id="BorrowerForm" enctype="multipart/form-data">

                                <label class="form-label">
                                    <i class="ri-file-add-line me-1"></i>
                                    Apply for a New Loan
                                </label>


                                <div class="row g-2 mt-1">

                                    <!-- BORROWER SEARCH -->
                                    <div class="col-12 col-md-6 position-relative">
                                        <label class="form-label">Borrower Name</label>

                                        <input type="text" id="borrower_search" class="form-select"
                                            placeholder="Select borrower..." autocomplete="off">

                                        <input type="hidden" name="borrower_id" id="borrower_id">

                                        <div id="borrower_list" class="list-group position-absolute w-100"
                                            style="z-index:999; max-height:200px; overflow-y:auto; display:none;">
                                        </div>
                                    </div>

                                    <!-- CO MAKER -->
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Co-Maker (Full Name)</label>
                                        <input type="text" name="co_maker_name" class="form-control"
                                            placeholder="Enter Co-Maker name" required>
                                    </div>

                                </div>

                                <div class="row g-2 mt-1">

                                    <!-- LOAN PLAN -->
                                    <div class="col-12 col-md-6">
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

                                    <!-- EFFECTIVE DATE -->
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Effective Date</label>
                                        <input type="date" name="effective_date" class="form-control" required>
                                    </div>



                                </div>

                                <div class="row g-2 mt-1">

                                    <!-- PRINCIPAL -->
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Principal Amount</label>
                                        <input type="text" id="principal_amount" name="principal_amount"
                                            class="form-control" required>
                                    </div>

                                    <!-- INTEREST -->
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Interest Rate</label>
                                        <select name="interest_rate" id="interest_rate" class="form-control" required>
                                            <option value="">-- Select Interest Rate --</option>
                                        </select>
                                    </div>



                                </div>

                                <div class="row g-2 mt-1">

                                    <!-- MONTHLY PAYMENT -->
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Monthly Payment</label>
                                        <input type="text" name="monthly_payment" class="form-control" readonly
                                            style="cursor: not-allowed;">
                                    </div>


                                    <!-- UNEARNED -->
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Unearned Interest</label>
                                        <input type="number" name="unearned_interest" class="form-control" readonly
                                            style="cursor: not-allowed;">
                                    </div>

                                    <!-- TOTAL -->
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Total Balance</label>
                                        <input type="number" name="total_balance" class="form-control" readonly
                                            style="cursor: not-allowed;">
                                    </div>
                                </div>



                                <input type="hidden" id="loan_id" name="loan_id">

                                <button type="submit" id="btnSave" class="btn btn-primary w-100 mt-3">
                                    <i class="ri-add-line me-1"></i> Add Loan
                                </button>


                            </form>

                        </div>
                    </div>

                </div>

                <!-- ================= RIGHT SIDE ================= -->
                <div class="col-12 col-lg-7">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stock_filter" id="pending"
                                        value="pending" checked>
                                    <label class="form-check-label" for="pending">Pending</label>
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
                                            <th>Co-Maker</th>
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

    // =========================
    // NUMBER FORMAT HELPERS
    // =========================
    function formatNumber(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function unformatNumber(x) {
        return x ? x.toString().replace(/,/g, '') : '';
    }

    // =========================
    // BORROWER SEARCH LIST
    // =========================
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

        // =========================
        // INTEREST RATES
        // =========================
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

        // =========================
        // LOAN CALCULATION
        // =========================
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

    });

    // =========================
    // LOAN TABLE
    // =========================
    $(document).ready(function() {

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
                [0, 'asc']
            ],

            columns: [{
                    data: 'ref_no'
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'co_maker'
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
                    render: function(id) {

                        return `
                        <div class="d-flex">
                            <button class="btn btn-success btn-sm btn-view me-1" data-id="${id}">
                                <i class="ri-eye-fill"></i> View
                            </button>

                            <button class="btn btn-primary btn-sm btn-edit me-1" data-id="${id}">
                                <i class="ri-edit-2-fill"></i> Edit
                            </button>

                            <button class="btn btn-danger btn-sm btn-delete" data-id="${id}">
                                <i class="ri-delete-bin-2-fill"></i>
                            </button>
                        </div>
                    `;
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

    });

    // =========================
    // FORM SUBMIT (ADD / EDIT / VIEW LOGIC PRESERVED)
    // =========================
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

        $.ajax({
            url: url,
            type: "POST",
            data: $(this).serialize(),
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

                    $('#BorrowerForm')[0].reset();

                    $('#loan_id').val('');
                    $('#borrower_id').val('');

                    $('#btnSave')
                        .removeClass('btn-success btn-danger')
                        .addClass('btn-primary')
                        .html('<i class="ri-add-line me-1"></i> Add Loan');

                    mode = "add";

                    loanTable.ajax.reload(null, false);
                }
            }
        });
    });

    // =========================
    // VIEW LOAN
    // =========================
    $(document).on('click', '.btn-view', function() {

        let id = $(this).data('id');

        $.ajax({
            url: "<?= base_url('get_loan_details') ?>",
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

                    $('[name="co_maker_name"]').val(d.co_maker);
                    $('[name="loan_plan"]').val(d.loan_plan);
                    $('[name="effective_date"]').val(d.effective_date);

                    $('#principal_amount').val(parseFloat(d.loan_amount).toLocaleString());
                    $('#interest_rate').val(d.interest_rate);

                    $('[name="monthly_payment"]').val(d.monthly_payment);
                    $('[name="unearned_interest"]').val(d.unearned_interest);
                    $('[name="total_balance"]').val(d.total_balance);

                    $('#BorrowerForm input').prop('readonly', true);
                    $('#BorrowerForm select').prop('disabled', true);

                    $('#btnSave')
                        .removeClass('btn-primary btn-success')
                        .addClass('btn-danger')
                        .html('<i class="ri-close-line me-1"></i> Close');

                    mode = "view";
                }
            }
        });
    });

    // =========================
    // EDIT LOAN
    // =========================
    $(document).on('click', '.btn-edit', function() {

        let id = $(this).data('id');

        $.ajax({
            url: "<?= base_url('get_loan_details') ?>",
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

                    $('[name="co_maker_name"]').val(d.co_maker);
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

    // =========================
    // DELETE LOAN
    // =========================
    $(document).on('click', '.btn-delete', function() {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This loan record will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "<?= base_url('delete_loan') ?>",
                    type: "POST",
                    data: {
                        id
                    },
                    dataType: "json",

                    success: function(res) {

                        if (res.status) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted Successfully',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            loanTable.ajax.reload(null, false);
                        }
                    }
                });
            }
        });
    });
    </script>