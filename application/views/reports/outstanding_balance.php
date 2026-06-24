<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Outstanding Balance Report</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Outstanding Balance Report</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row g-3">


                <!-- ================= RIGHT SIDE ================= -->
                <div class="col-12">

                    <div class="card shadow-sm">
                        <div class="card-body">


                            <div class="table-responsive">

                                <table class="table table-striped align-middle w-100 nowrap" id="OutstandingTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Reference No.</th>
                                            <th>Borrower Name</th>
                                            <th>Total Balance</th>
                                            <th>Total Paid</th>
                                            <th>Remaining Balance</th>
                                            <th>Next Due Date</th>
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
    $(document).ready(function() {

        $('#OutstandingTable').DataTable({
            processing: true,
            responsive: true,
            destroy: true,
            autoWidth: false,
            ordering: false,
            ajax: {
                url: "<?= base_url('outstanding_loans') ?>",
                type: "POST",
                dataSrc: "data"
            },
            columns: [{
                    data: "ref_no"
                },
                {
                    data: "borrower_name"
                },
                {
                    data: "total_balance",
                    render: function(data) {
                        return "₱ " + parseFloat(data).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                    }
                },
                {
                    data: "total_paid",
                    render: function(data) {
                        return "₱ " + parseFloat(data).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                    }
                },
                {
                    data: "remaining_balance",
                    render: function(data) {
                        return `<span class="badge bg-warning text-dark">
                        ₱ ${parseFloat(data).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        })}
                    </span>`;
                    }
                },
                {
                    data: "next_due_date"
                },
                {
                    data: "loan_id",
                    render: function(data, type, row) {
                        return `
                        <button type="button"
                            class="btn btn-primary btn-sm btn-view"
                            data-id="${row.loan_id}"
                            data-ref-no="${row.ref_no}"
                            data-full-name="${row.borrower_name}"
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
                }
            ]
        });

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