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
                                            <th>Loan Amount</th>
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Loan Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Loan Summary -->
                    <div class="row g-3">

                        <div class="col-md-3">
                            <label class="form-label">Borrower Name</label>
                            <input type="text" id="view_fullname" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Loan Amount</label>
                            <input type="text" id="view_loan_amount" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Interest Rate</label>
                            <input type="text" id="view_interest_rate" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Effective Date</label>
                            <input type="text" id="view_effective_date" class="form-control" readonly>
                        </div>

                    </div>

                    <!-- Payment History Table -->
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="PaymentHistoryTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Date Payment</th>
                                    <th>Collector</th>
                                    <th>Payment Method</th>
                                    <th>Amount Paid</th>
                                    <th>Remaining Balance</th>
                                    <th>Penalty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Total Balance</label>
                            <input type="text" id="view_total_balance" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Total Amount Paid</label>
                            <input type="text" id="view_total_paid" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Total Remaining Balance</label>
                            <input type="text" id="view_total_remaining" class="form-control" readonly>
                        </div>
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
                    data: "loan_amount",
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

        window.currentRefNo = ref_no;
        window.currentBorrower = $(this).data('full-name');
        window.currentLoanAmount = parseFloat($(this).data('loan-amount')) || 0;

        let loan_amount = parseFloat($(this).data('loan-amount')) || 0;
        let total_paid = parseFloat($(this).data('total-paid')) || 0;
        let remaining = parseFloat($(this).data('remaining-balance')) || 0;

        $('#view_fullname').val($(this).data('full-name'));

        $('#view_effective_date').val($(this).data('effective-date'));

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

        $('#view_total_paid').val(
            "₱ " + total_paid.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })
        );

        $('#view_total_remaining').val(
            "₱ " + remaining.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })
        );

        if ($.fn.DataTable.isDataTable('#PaymentHistoryTable')) {
            $('#PaymentHistoryTable').DataTable().destroy();
        }

        $('#PaymentHistoryTable').DataTable({
            processing: true,
            responsive: true,
            destroy: true,
            autoWidth: false,
            ordering: false,

            ajax: {
                url: "<?= base_url('get_payment_history') ?>",
                type: "POST",
                data: {
                    loan_id: loan_id,
                    ref_no: ref_no
                }
            },

            columns: [

                {
                    data: "date_payment"
                },
                {
                    data: "collector"
                },
                {
                    data: "payment_method"
                },

                {
                    data: "payment_amount",
                    className: "text-end",
                    render: function(data) {
                        return "₱ " + parseFloat(data || 0)
                            .toLocaleString('en-PH', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                    }
                },

                {
                    data: "remaining_balance",
                    className: "text-end",
                    render: function(data) {
                        return "₱ " + parseFloat(data || 0)
                            .toLocaleString('en-PH', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                    }
                },

                {
                    data: "penalty",
                    className: "text-end",
                    render: function(data) {
                        return "₱ " + parseFloat(data || 0)
                            .toLocaleString('en-PH', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                    }
                },

                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                    render: function(data, type, row) {

                        console.log(row.remaining_balance);

                        return `
            <button type="button"
                class="btn btn-success btn-sm btn-print-receipt"
                data-date="${row.date_payment}"
                data-collector="${row.collector}"
                data-method="${row.payment_method}"
                data-amount="${row.payment_amount}"
                data-total-overall-paid="${row.total_overall_paid || 0}"
                data-balance="${row.remaining_balance || 0}"
                data-penalty="${row.penalty || 0}">
                <i class="ri-printer-line"></i> Print
            </button>
        `;
                    }
                }

            ]
        });

        new bootstrap.Modal(
            document.getElementById('ViewLoanModal')
        ).show();

    });

    $(document).on('click', '.btn-print-receipt', function() {

        let remainingBalance = $(this).attr('data-balance');
        let totalPaid = parseFloat($(this).attr('data-total-overall-paid') || 0);

        console.log('Remaining:', remainingBalance);
        console.log('Total Paid:', totalPaid);

        printReceipt(
            window.currentRefNo,
            window.currentBorrower,
            window.currentLoanAmount,
            remainingBalance,
            $(this).attr('data-penalty'),
            $(this).attr('data-amount'),
            $(this).attr('data-method'),
            $(this).attr('data-collector'),
            $(this).attr('data-date'),
            totalPaid
        );

    });


    function printReceipt(
        refNo,
        borrower,
        loanAmount,
        remainingBalance,
        penalty,
        amountPaid,
        paymentMethod,
        collector,
        paymentDate,
        totalPaid
    ) {

        let receipt = `
    <html>
    <head>
        <title>Receipt</title>

        <style>
            @page {
                size: 100mm 150mm;
                margin: 0;
            }

            html, body {
                margin: 0;
                padding: 0;
                font-family: Arial;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .box {
                width: 100%;
                height: 100%;
                box-sizing: border-box;
                padding: 8mm;
                border: 2px solid #000;
            }

            h2 {
                text-align: center;
                margin: 0 0 10px 0;
                font-size: 14px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
            }

            td {
                padding: 3px 0;
            }

            .right {
                text-align: right;
            }

            .line {
                border-top: 1px dashed #000;
                margin: 8px 0;
            }

            .signature {
                text-align: center;
                margin-top: 15px;
                font-size: 12px;
            }
        </style>
    </head>

    <body onload="window.print()">

    <div class="box">

        <h2>LOAN RECEIPT</h2>

        <table>
            <tr><td>Reference Number</td><td class="right">${refNo}</td></tr>
            <tr><td>Borrower</td><td class="right">${borrower}</td></tr>
            <tr><td>Date Payment</td><td class="right">${paymentDate}</td></tr>
            <tr><td>Collected By</td><td class="right">${collector}</td></tr>
            <tr><td>Payment Method</td><td class="right">${paymentMethod}</td></tr>
        </table>

        <div class="line"></div>

        <table>
            <tr>
                <td>Loan Amount</td>
                <td class="right">₱ ${parseFloat(loanAmount || 0).toFixed(2)}</td>
            </tr>
            <tr>
                <td>Penalty</td>
                <td class="right">₱ ${parseFloat(penalty || 0).toFixed(2)}</td>
            </tr>
            <tr>
                <td>Amount Paid</td>
                <td class="right">₱ ${parseFloat(amountPaid || 0).toFixed(2)}</td>
            </tr>
        </table>

        <div class="line"></div>

        <table>
            <tr>
                <td><b>Total Paid</b></td>
                <td class="right"><b>₱ ${parseFloat(totalPaid || 0).toFixed(2)}</b></td>
            </tr>
            <tr>
                <td><b>Remaining</b></td>
                <td class="right"><b>₱ ${parseFloat(remainingBalance || 0).toFixed(2)}</b></td>
            </tr>
        </table>

        <div class="line"></div>

        <div class="signature">
            _______________________<br>
            Authorized Signature
        </div>

    </div>

    </body>
    </html>
    `;

        let win = window.open('', '', 'width=400,height=600');
        win.document.write(receipt);
        win.document.close();
    }
    </script>