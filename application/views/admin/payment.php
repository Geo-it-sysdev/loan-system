<style>
.bg-warning {
    background-color: #fff3cd !important;
    border: 1px solid #ffc107 !important;
}
</style>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Payment</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Payment</li>
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
                                <input type="hidden" id="borrower_id" name="borrower_id">
                                <input type="hidden" id="total_overall_paid">

                                <!-- Loan Information -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-primary mb-3">
                                        <i class="ri-file-list-3-line me-1"></i>
                                        Loan Information
                                    </h6>

                                    <div class="row g-3">

                                        <div class="col-md-4">
                                            <label class="form-label">Reference Number</label>
                                            <input type="text" id="reference_number" name="reference_number"
                                                class="form-control" placeholder="Reference no." required>
                                        </div>

                                        <div class="col-md-8">
                                            <label class="form-label">Borrower Name</label>
                                            <input type="text" id="borrower_name" class="form-control bg-light"
                                                readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Monthly Payment</label>
                                            <input type="text" id="monthly_payment" class="form-control bg-light"
                                                readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Remaining Balance</label>
                                            <input type="text" id="remaining_balance" class="form-control bg-light"
                                                readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Due Date</label>
                                            <input type="text" id="due_date" class="form-control bg-light" readonly>
                                        </div>

                                    </div>
                                </div>

                                <!-- Payment Details -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-primary mb-3">
                                        <i class="ri-money-dollar-circle-line me-1"></i>
                                        Payment Details
                                    </h6>

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Paid Cycles</label>
                                            <input type="text" id="paid_cycles" class="form-control bg-light" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Penalty (₱1/day)</label>
                                            <input type="text" id="penalty_amount" name="penalty_amount"
                                                class="form-control bg-light" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Amount Paid</label>
                                            <input type="text" id="amount_paid" name="amount_paid" class="form-control"
                                                placeholder="Enter payment amount" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Total Payment</label>
                                            <input type="text" id="total_payment" name="total_payment"
                                                class="form-control bg-light" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Payment Date</label>
                                            <input type="text" name="payment_date" class="form-control bg-light"
                                                value="<?= date('Y-m-d') ?>" readonly>
                                        </div>



                                    </div>
                                </div>

                                <!-- Collection Information -->
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-primary mb-3">
                                        <i class="ri-user-received-line me-1"></i>
                                        Collection Information
                                    </h6>

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Payment Method</label>
                                            <select name="payment_method" class="form-select" required>
                                                <option value="">Select Payment Method</option>
                                                <option value="Cash">Cash</option>
                                                <option value="GCash">GCash</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                                <option value="Maya">Maya</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Collected By</label>

                                            <input type="text" id="collector" class="form-control"
                                                value="<?= $this->session->userdata('fullname'); ?>" readonly>

                                            <input type="hidden" name="collector"
                                                value="<?= $this->session->userdata('fullname'); ?>">
                                        </div>

                                    </div>
                                </div>

                                <!-- Payment Summary -->
                                <div class="alert alert-info border-0 mb-4">
                                    <div class="d-flex align-items-center">
                                        <i class="ri-information-line fs-5 me-2"></i>
                                        <div>
                                            <strong>Payment Summary</strong><br>
                                            <small>
                                                The payment amount, penalty, remaining balance, and paid cycles
                                                will automatically update after the payment is processed.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <button type="submit" id="btnSave" class="btn btn-primary w-100">
                                    <i class="ri-save-line me-1"></i>
                                    Save Payment
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
                                    <input class="form-check-input" type="radio" name="stock_filter" id="Released"
                                        value="Released" checked>
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

                                <table class="table table-striped align-middle w-100 nowrap" id="PaymentTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Reference No.</th>
                                            <th>Borrower Name</th>
                                            <th>Loan Amount</th>
                                            <th>Interest Rate</th>
                                            <th>Total Amount</th>
                                            <th>Total Paid</th>
                                            <th>Remaining Balance</th>
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


    <div class="modal fade" id="ViewLoanModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" style="max-width: 85%;">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Loan Summary -->
                    <div class="row g-2 align-items-end flex-nowrap overflow-auto">

                        <div class="col">
                            <label class="form-label">Borrower Name</label>
                            <input type="text" id="view_fullname" class="form-control" readonly>
                        </div>

                        <div class="col">
                            <label class="form-label">Reference No</label>
                            <input type="text" id="view_ref_no" class="form-control" readonly>
                        </div>

                        <div class="col">
                            <label class="form-label">Loan Amount</label>
                            <input type="text" id="view_loan_amount" class="form-control" readonly>
                        </div>

                        <div class="col">
                            <label class="form-label">Interest Rate</label>
                            <input type="text" id="view_interest_rate" class="form-control" readonly>
                        </div>

                        <div class="col">
                            <label class="form-label">Total Balance</label>
                            <input type="text" id="view_total_balance" class="form-control" readonly>
                        </div>

                        <div class="col">
                            <label class="form-label">Effective Date</label>
                            <input type="text" id="view_effective_date" class="form-control" readonly>
                        </div>

                    </div>

                    <!-- Payment History Table -->
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle w-100 nowrap table-sm" id="PaymentHistoryTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Payment No</th>
                                    <th>Date Payment</th>
                                    <th>Collector</th>
                                    <th>Payment Method</th>
                                    <th>Amount Paid</th>
                                    <th>Remaining Balance</th>
                                    <th>Penalty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody></tbody>

                            <tfoot class="table-light">
                                <tr class="text-center fw-bold">
                                    <td colspan="4" class="text-end">TOTAL PAID</td>

                                    <td id="tfoot_total_paid"></td>
                                    <td></td>
                                    <td id="tfoot_total_penalty"></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>




                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>




    <script>
    window.currentRefNo = '';
    window.currentBorrower = '';
    window.currentLoanAmount = 0;


    $(document).ready(function() {

        let table = $('#PaymentTable').DataTable({
            ajax: {
                url: "<?= base_url('get_loans_payments') ?>",
                type: "GET",
                data: function(d) {
                    d.filter = $('input[name="stock_filter"]:checked').val();
                }
            },

            processing: true,
            responsive: true,
            destroy: true,
            autoWidth: false,

            columns: [{
                    data: 'id'
                },
                {
                    data: 'ref_no'
                },
                {
                    data: 'fullname'
                },

                {
                    data: 'loan_amount',
                    render: function(data) {
                        return parseFloat(data).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                },

                {
                    data: 'interest_rate',
                    render: function(data) {
                        return data + '%';
                    }
                },

                {
                    data: 'total_balance',
                    render: function(data) {
                        return parseFloat(data).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                },

                {
                    data: 'total_paid',
                    render: function(data) {
                        return parseFloat(data).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                },

                {
                    data: 'remaining_balance',
                    render: function(data) {
                        return parseFloat(data).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                },

                {
                    data: "status",
                    render: function(data, type, row) {

                        if (data === "Pending") {
                            return '<span class="badge bg-danger">Pending</span>';
                        }

                        if (data === "Fully") {
                            return '<span class="badge bg-success">Fully Paid</span>';
                        }

                        if (data === "Partial") {
                            return '<span class="badge bg-primary">Partially Paid</span>';
                        }

                        return '<span class="badge bg-secondary">Released</span>';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data, type, row) {

                        let viewButton = '';
                        let payButton = '';
                        let releasedButton = '';


                        // VIEW BUTTON
                        if (
                            row.status === "Released" ||
                            row.status === "Partial" ||
                            row.status === "Paid" ||
                            row.status === "Fully"
                        ) {
                            viewButton = `
                <button type="button"
                    class="btn btn-primary btn-sm btn-view"
                    data-id="${row.id}"
                    data-ref-no="${row.ref_no}"
                    data-full-name="${row.fullname}"
                    data-effective-date="${row.effective_date}"
                    data-loan-amount="${row.loan_amount}"
                    data-interest-rate="${row.interest_rate}"
                    data-total-balance="${row.total_balance}"
                    data-total-paid="${row.total_paid}"
                    data-remaining-balance="${row.remaining_balance}">
                    <i class="ri-eye-fill me-1"></i> View
                </button>
            `;
                        }

                        // PAY BUTTON
                        if (
                            row.status === "Released" ||
                            row.status === "Partial"
                        ) {
                            payButton = `
                            <button type="button"
                                class="btn btn-success btn-sm btn-pay"
                                data-id="${row.id}"
                                data-ref-no="${row.ref_no}">
                                <i class="ri-bill-line me-1"></i> Pay
                            </button>
                        `;
                        }

                        return `
                        ${viewButton}
                        ${payButton}
                    `;
                    }
                }
            ],

            order: [
                [0, 'asc']
            ]
        });

        $('input[name="stock_filter"]').on('change', function() {
            table.ajax.reload();
        });







        // CLICK PAY BUTTON
        $(document).on('click', '.btn-pay', function() {

            let ref_no = $(this).data('ref-no');

            $('#reference_number').val(ref_no);

            $('#reference_number').trigger('keyup');
        });

        function loadLoanByRef(ref_no) {

            if (ref_no.length < 6) return;

            $.ajax({
                url: "<?= base_url('get_loan_by_refno') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    ref_no: ref_no,
                    payment_date: $('input[name="payment_date"]').val()
                },
                success: function(res) {}
            });
        }


        $('#reference_number').on('keyup', function() {
            loadLoanByRef($(this).val());
        });

        $(document).on('click', '.btn-pay', function() {
            let ref_no = $(this).data('ref-no');
            $('#reference_number').val(ref_no);
            loadLoanByRef(ref_no);
        });


        $(document).on('click', '.btn-view', function() {

            let loan_id = $(this).data('id');
            let ref_no = $(this).data('ref-no');

            $('#view_fullname').val($(this).data('full-name'));
            $('#view_ref_no').val($(this).data('ref-no'));
            $('#view_effective_date').val($(this).data('effective-date'));

            let loan_amount = parseFloat($(this).data('loan-amount')) || 0;

            $('#view_loan_amount').val(
                loan_amount.toLocaleString('en-US', {
                    minimumFractionDigits: 2
                })
            );

            $('#view_interest_rate').val($(this).data('interest-rate') + '%');

            $('#view_total_balance').val(
                parseFloat($(this).data('total-balance') || 0)
                .toLocaleString('en-US', {
                    minimumFractionDigits: 2
                })
            );

            // destroy old table
            if ($.fn.DataTable.isDataTable('#PaymentHistoryTable')) {
                $('#PaymentHistoryTable').DataTable().destroy();
            }

            // init table
            $('#PaymentHistoryTable').DataTable({
                processing: true,
                responsive: true,
                autoWidth: false,
                ordering: false,
                searching: false,

                ajax: {
                    url: "<?= base_url('get_payment_history') ?>",
                    type: "POST",
                    data: {
                        loan_id,
                        ref_no
                    }
                },

                columns: [

                    {
                        data: "payment_no"
                    },
                    {
                        data: "date_payment"
                    },

                    {
                        data: "collector",
                        render: (d, t, r) =>
                            `<span class="collector-text">${d}</span>`
                    },

                    {
                        data: "payment_method",
                        render: (d) =>
                            `<span class="method-text">${d}</span>`
                    },

                    {
                        data: "payment_amount",
                        className: "text-end",
                        render: function(data) {
                            let amount = parseFloat(data) || 0;
                            return `<span class="amount-text">${amount.toLocaleString('en-PH', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })}</span>`;
                        }
                    },

                    {
                        data: "remaining_balance",
                        className: "text-end",
                        render: d =>
                            (parseFloat(d) || 0).toLocaleString('en-PH', {
                                minimumFractionDigits: 2
                            })
                    },

                    {
                        data: "penalty",
                        className: "text-end",
                        render: d =>
                            (parseFloat(d) || 0).toLocaleString('en-PH', {
                                minimumFractionDigits: 2
                            })
                    },

                    {
                        data: null,
                        className: "text-center",
                        render: (d, t, r) => `
                            <button class="btn btn-primary btn-sm btn-edit-receipt"
                                data-id="${r.id}">
                                <i class="ri-edit-line"></i> Edit
                            </button>

                            <button class="btn btn-success btn-sm btn-print-receipt"
                                data-payment-no="${r.payment_no}"
                                data-date-payment="${r.date_payment}"
                                data-collector="${r.collector}"
                                data-payment-method="${r.payment_method}"
                                data-payment-amount="${r.payment_amount}"
                                data-remaining-balance="${r.remaining_balance}"
                                data-penalty="${r.penalty}">
                                <i class="ri-printer-line"></i> Print
                            </button>
                        `
                    }
                ],

                initComplete: function() {

                    let api = this.api();

                    const sum = (i) =>
                        api.column(i, {
                            page: 'all'
                        }).data()
                        .reduce((a, b) => (parseFloat(a) || 0) + (parseFloat(b) || 0), 0);

                    let totalPaid = sum(4);
                    let totalPenalty = sum(6);

                    $('#tfoot_total_paid').html(
                        "₱ " + totalPaid.toLocaleString('en-PH', {
                            minimumFractionDigits: 2
                        })
                    );

                    $('#tfoot_total_penalty').html(
                        "₱ " + totalPenalty.toLocaleString('en-PH', {
                            minimumFractionDigits: 2
                        })
                    );
                }
            });

            new bootstrap.Modal(document.getElementById('ViewLoanModal')).show();
        });


        $(document).on('hidden.bs.modal', '#ViewLoanModal', function() {

            editingId = null;

            $('#PaymentHistoryTable tbody tr').data('editing', false);

            $('#ViewLoanModal').find('input').val('');

            if ($.fn.DataTable.isDataTable('#PaymentHistoryTable')) {
                $('#PaymentHistoryTable').DataTable().clear().destroy();
            }

            $('#PaymentHistoryTable tbody').empty();

        });

        // EDIT / SAVE
        $(document).on('click', '.btn-edit-receipt', function() {

            let id = $(this).data('id');
            let row = $(this).closest('tr');
            let btn = $(this);

            let isEditing = row.data('editing') === true;

            // ================= SAVE =================
            if (isEditing) {

                let collector = row.find('.collector-input').val();
                let method = row.find('.method-input').val();

                let amount = parseFloat(
                    row.find('.amount-input').val()
                ) || 0;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update this payment?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {

                    if (!result.isConfirmed) return;

                    $.ajax({
                        url: "<?= base_url('update_payment') ?>",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id,
                            collector,
                            payment_method: method,
                            payment_amount: amount
                        },

                        success: function(res) {

                            if (!res.success) {
                                return Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Update failed'
                                });
                            }

                            // back to text
                            row.find('.collector-input').replaceWith(
                                `<span class="collector-text">${collector}</span>`
                            );

                            row.find('.method-input').replaceWith(
                                `<span class="method-text">${method}</span>`
                            );

                            row.find('.amount-input').replaceWith(
                                `<span class="amount-text">${amount.toLocaleString('en-PH', {
                    minimumFractionDigits: 2
                })}</span>`
                            );

                            row.data('editing', false);

                            btn.removeClass('btn-success')
                                .addClass('btn-primary')
                                .text('Edit');

                            // success alert
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: 'Payment updated successfully',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            $('#PaymentHistoryTable').DataTable().ajax.reload();
                        }
                    });
                });
                return;
            }

            // ================= CANCEL OTHER EDITS =================
            $('#PaymentHistoryTable tbody tr').each(function() {

                let tr = $(this);

                if (tr.data('editing')) {

                    tr.find('.collector-input').replaceWith(
                        `<span class="collector-text">${tr.find('.collector-input').val()}</span>`
                    );

                    tr.find('.method-input').replaceWith(
                        `<span class="method-text">${tr.find('.method-input').val()}</span>`
                    );

                    tr.find('.amount-input').replaceWith(
                        `<span class="amount-text">${tr.find('.amount-input').val()}</span>`
                    );

                    tr.data('editing', false);

                    tr.find('.btn-edit-receipt')
                        .removeClass('btn-success')
                        .addClass('btn-primary')
                        .html('<i class="ri-edit-line"></i> Edit');
                }
            });

            // ================= ENTER EDIT MODE =================
            row.data('editing', true);

            let collectorText = row.find('.collector-text').text().trim();
            let methodText = row.find('.method-text').text().trim();

            let amountText = row.find('.amount-text').text().replace(/[₱,\s]/g, '');

            row.find('.collector-text').replaceWith(
                `<input class="form-control collector-input bg-warning text-dark"
        value="${collectorText}">`
            );

            row.find('.method-text').replaceWith(
                `<input class="form-control method-input bg-warning text-dark"
        value="${methodText}">`
            );

            row.find('.amount-text').replaceWith(
                `<input type="number" step="0.01"
        class="form-control amount-input bg-warning text-dark text-end"
        value="${amountText}">`
            );

            btn.removeClass('btn-primary')
                .addClass('btn-success')
                .html('<i class="ri-save-line"></i> Save');
        });






        let loadedRefNo = '';

        $('#reference_number').on('keyup', function() {

            let ref_no = $(this).val().trim();

            if (loadedRefNo && ref_no !== loadedRefNo) {

                $('#loan_id').val('');
                $('#borrower_id').val('');
                $('#borrower_name').val('');

                $('#monthly_payment').val('');
                $('#remaining_balance').val('');
                $('#effective_date').val('');
                $('#due_date').val('');
                $('#expected_cycles').val('');
                $('#paid_cycles').val('');
                $('#overdue_cycles').val('');
                $('#penalty_amount').val('');

                $('#view_total_paid').val('');
                $('#view_total_remaining').val('');
                $('#amount_paid').val('');
                $('#amount_paid').hide();

                window.currentTotalPaid = 0;
                loadedRefNo = '';
            }

            if (!ref_no) {

                $('#amount_paid').val('');
                $('#amount_paid').hide();

                return;
            }

            $.ajax({
                url: "<?= base_url('get_loan_by_refno') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    ref_no: ref_no,
                    payment_date: $('input[name="payment_date"]').val()
                },

                success: function(res) {

                    if (res.status == 'fully_paid') {

                        Swal.fire('Fully Paid', res.message, 'warning');

                        $('#loan_id').val('');
                        $('#borrower_id').val('');
                        $('#borrower_name').val('');

                        $('#monthly_payment').val('');
                        $('#remaining_balance').val('');
                        $('#effective_date').val('');
                        $('#due_date').val('');
                        $('#expected_cycles').val('');
                        $('#paid_cycles').val('');
                        $('#overdue_cycles').val('');
                        $('#penalty_amount').val('');

                        $('#view_total_paid').val('');
                        $('#view_total_remaining').val('');

                        $('#amount_paid').val('');
                        $('#amount_paid').hide();

                        window.currentTotalPaid = 0;
                        loadedRefNo = '';

                        return;
                    }

                    if (res.status == 'success') {

                        loadedRefNo = ref_no;

                        let d = res.data || {};

                        // BASIC INFO
                        $('#loan_id').val(d.id);
                        $('#borrower_id').val(d.borrower_id);
                        $('#borrower_name').val(d.borrower_name);

                        // LOAN INFO
                        $('#monthly_payment').val(d.monthly_payment);
                        $('#remaining_balance').val(d.remaining_balance);
                        $('#effective_date').val(d.effective_date);
                        $('#due_date').val(d.next_due_date);
                        $('#expected_cycles').val(d.expected_cycles || '');
                        $('#paid_cycles').val(d.paid_cycles);
                        $('#overdue_cycles').val(d.overdue_cycles);
                        $('#penalty_amount').val(d.penalty);

                        // SHOW AMOUNT PAID
                        $('#amount_paid').show();


                        let totalPayment = parseFloat(d.amount_due || 0);

                        let penalty = parseFloat(d.penalty || 0);

                        // base payment = total - penalty (safe extraction)
                        let basePayment = totalPayment - penalty;
                        if (basePayment < 0) basePayment = 0;

                        $('#amount_paid').val(basePayment.toFixed(2));
                        $('#penalty_amount').val(penalty.toFixed(2));
                        $('#total_payment').val(totalPayment.toFixed(2));





                        window.currentTotalPaid = d.total_overall_paid || 0;

                        $('#view_total_paid').val(
                            "₱ " + parseFloat(d.total_overall_paid || 0)
                            .toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            })
                        );

                        $('#view_total_remaining').val(
                            "₱ " + parseFloat(d.remaining_balance || 0)
                            .toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            })
                        );

                    } else {

                        $('#loan_id').val('');
                        $('#borrower_id').val('');
                        $('#borrower_name').val('');

                        $('#monthly_payment').val('');
                        $('#remaining_balance').val('');
                        $('#effective_date').val('');
                        $('#due_date').val('');
                        $('#expected_cycles').val('');
                        $('#paid_cycles').val('');
                        $('#overdue_cycles').val('');
                        $('#penalty_amount').val('');

                        $('#view_total_paid').val('');
                        $('#view_total_remaining').val('');

                        // HIDE AMOUNT PAID
                        $('#amount_paid').val('');
                        $('#amount_paid').hide();

                        window.currentTotalPaid = 0;
                        loadedRefNo = '';
                    }
                },

                error: function(xhr, status, error) {
                    console.error("Loan fetch error:", error);
                    Swal.fire('Error', 'Failed to load loan data.', 'error');

                    // HIDE AMOUNT PAID ON ERROR
                    $('#amount_paid').val('');
                    $('#amount_paid').hide();
                }
            });
        });

        $('#amount_paid').on('input', function() {
            let value = $(this).val().replace(/,/g, '');

            if (value === '') return;

            if (!isNaN(value)) {
                $(this).val(parseFloat(value).toFixed(2));
            }
        });

        $('#amount_paid, #penalty_amount').on('input', function() {

            let amount = parseFloat($('#amount_paid').val()) || 0;
            let penalty = parseFloat($('#penalty_amount').val()) || 0;

            let total = amount + penalty;

            $('#total_payment').val(total.toFixed(2));
        });

        // SAVE PAYMENT
        $('#BorrowerForm').submit(function(e) {

            e.preventDefault();

            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: 'You want to pay this loan?',
                showCancelButton: true,
                confirmButtonText: 'Yes, Pay Now',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({
                    url: "<?= base_url('add_payment') ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",

                    beforeSend: function() {
                        $('#btnSave')
                            .prop('disabled', true)
                            .html(
                                '<i class="ri-loader-4-line ri-spin"></i> Saving...'
                            );
                    },

                    success: function(response) {

                        if (response.status === 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Payment Saved',
                                text: response.message,
                                confirmButtonText: 'Close'
                            });

                            $('#BorrowerForm')[0].reset();
                            $('#PaymentTable').DataTable().ajax.reload(null, false);

                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Payment Failed',
                                text: response.message ||
                                    'Something went wrong'
                            });

                        }
                    },

                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'An unexpected error occurred.'
                        });
                        console.error(xhr.responseText);
                    },

                    complete: function() {
                        $('#btnSave')
                            .prop('disabled', false)
                            .html('<i class="ri-add-line me-1"></i> Add Payment');
                    }

                });

            });
        });


        loadCollectors();

        function loadCollectors() {
            $.ajax({

                url: "<?= base_url('fetch_the_collectors') ?>",
                type: "GET",
                dataType: "json",

                success: function(response) {
                    let html =
                        '<option value="">Select Collector</option>';

                    $.each(response, function(index, row) {

                        html += `
                    <option value="${row.fullname}">
                        ${row.fullname}
                    </option>
                `;

                    });

                    $('#collector').html(html);
                }

            });
        }




    }); // End Document 





    $(document).on('click', '.btn-print-receipt', function() {

        let fullname = $('#view_fullname').val();
        let refNo = $('#view_ref_no').val();

        let paymentNo = $(this).data('payment-no');
        let datePayment = $(this).data('date-payment');
        let collector = $(this).data('collector');
        let paymentMethod = $(this).data('payment-method');
        let amountPaid = parseFloat($(this).data('payment-amount') || 0);
        let remainingBalance = parseFloat($(this).data('remaining-balance') || 0);
        let penalty = parseFloat($(this).data('penalty') || 0);

        let win = window.open('', '', 'width=500,height=600');

        win.document.write(`
        <html>
        <head>
            <title>Payment Receipt</title>

             <style>

                @page{
                    size:80mm 100mm;
                    margin:3mm;
                }

                body{
                    font-family:Arial,sans-serif;
                    margin:0;
                    padding:0;
                }

                .receipt{
                    width:100%;
                    border:1px solid #000;
                    padding:5mm;
                    box-sizing:border-box;
                    page-break-after:always;
                }

                h3{
                    text-align:center;
                    margin:0 0 5px;
                    font-size:12px;
                }

                table{
                    width:100%;
                    border-collapse:collapse;
                    font-size:10px;
                }

                td{
                    padding:2px 0;
                }

                .right{
                    text-align:right;
                }

                .line{
                    border-top:1px dashed #000;
                    margin:5px 0;
                }

                .signature{
                    text-align:center;
                    margin-top:10px;
                    font-size:10px;
                }

            </style>
        </head>

        <body>

            <div class="receipt">

                <h3>PAYMENT RECEIPT</h3>

                <table>
                    <tr>
                        <td>Borrower</td>
                        <td class="right">${fullname}</td>
                    </tr>

                    <tr>
                        <td>Reference No</td>
                        <td class="right">${refNo}</td>
                    </tr>

                    <tr>
                        <td>Payment No</td>
                        <td class="right">${paymentNo}</td>
                    </tr>

                    <tr>
                        <td>Date Payment</td>
                        <td class="right">${datePayment}</td>
                    </tr>

                    <tr>
                        <td>Collector</td>
                        <td class="right">${collector}</td>
                    </tr>

                    <tr>
                        <td>Method</td>
                        <td class="right">${paymentMethod}</td>
                    </tr>
                </table>

                <div class="line"></div>

                <table>
                    <tr>
                        <td>Amount Paid</td>
                        <td class="right">
                            ₱ ${amountPaid.toLocaleString('en-PH', {
                                minimumFractionDigits: 2
                            })}
                        </td>
                    </tr>

                    <tr>
                        <td>Penalty</td>
                        <td class="right">
                            ₱ ${penalty.toLocaleString('en-PH', {
                                minimumFractionDigits: 2
                            })}
                        </td>
                    </tr>

                    <tr>
                        <td>Remaining</td>
                        <td class="right">
                            ₱ ${remainingBalance.toLocaleString('en-PH', {
                                minimumFractionDigits: 2
                            })}
                        </td>
                    </tr>
                </table>

                <div class="line"></div>

                <div class="signature">
                     <center>
                    ___________________<br>
                    Authorized Signature
                </center>
                </div>

            </div>

        </body>
        </html>
    `);

        win.document.close();

        setTimeout(() => {
            win.print();
            // win.close();
        }, 500);

    });
    </script>