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
                            <div class="d-flex justify-content-end mb-3 gap-2">
                                <button type="button" id="btnExcel" class="btn btn-success btn-sm">
                                    <i class="ri-file-excel-2-fill me-1"></i> Generate Excel
                                </button>

                                <button type="button" id="btnPDF" class="btn btn-danger btn-sm">
                                    <i class="ri-file-pdf-2-fill me-1"></i> Generate PDF
                                </button>
                            </div>

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

        var outstandingTable = $('#OutstandingTable').DataTable({
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
                        return `<span class="text-danger fw-bold">
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




        // PDF
        $('#btnPDF').on('click', function() {

            const {
                jsPDF
            } = window.jspdf;

            const doc = new jsPDF({
                orientation: "landscape",
                unit: "mm",
                format: [330.2, 215.9]
            });

            // HEADER
            doc.setFont("helvetica", "bold");
            doc.setFontSize(22);
            doc.text("OUTSTANDING LOANS REPORT", 165, 15, {
                align: "center"
            });

            doc.setFont("helvetica", "normal");
            doc.setFontSize(12);
            doc.text("Loan Management System", 165, 22, {
                align: "center"
            });

            doc.line(8, 28, 322, 28);

            doc.setFontSize(9);
            doc.text("Generated : " + new Date().toLocaleString(), 8, 34);

            // DATA
            let rows = [];

            let totalBalance = 0;
            let totalPaid = 0;
            let totalRemaining = 0;

            outstandingTable.rows().every(function() {

                let d = this.data();

                totalBalance += parseFloat(d.total_balance) || 0;
                totalPaid += parseFloat(d.total_paid) || 0;
                totalRemaining += parseFloat(d.remaining_balance) || 0;

                rows.push([
                    d.ref_no,
                    d.borrower_name,
                    "P " + (parseFloat(d.total_balance) || 0).toLocaleString(
                        undefined, {
                            minimumFractionDigits: 2
                        }),
                    "P " + (parseFloat(d.total_paid) || 0).toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }),
                    "P " + (parseFloat(d.remaining_balance) || 0).toLocaleString(
                        undefined, {
                            minimumFractionDigits: 2
                        }),
                    d.next_due_date
                ]);

            });

            // MAIN TABLE
            doc.autoTable({

                startY: 40,

                head: [
                    [
                        "Reference No.",
                        "Borrower Name",
                        "Total Balance",
                        "Total Paid",
                        "Remaining Balance",
                        "Next Due Date"
                    ]
                ],

                body: rows,



                theme: "grid",

                showFoot: "lastPage",

                margin: {
                    left: 8,
                    right: 8
                },

                styles: {
                    fontSize: 9,
                    cellPadding: 2.5
                },

                headStyles: {
                    fillColor: [33, 37, 41],
                    textColor: 255,
                    fontStyle: "bold",
                    halign: "center"
                },

                footStyles: {
                    fillColor: [255, 255, 255],
                    textColor: [0, 0, 0],
                    fontStyle: "bold",
                    halign: "center",
                    lineWidth: 0
                },

                alternateRowStyles: {
                    fillColor: [245, 245, 245]
                },

                columnStyles: {
                    0: {
                        halign: "center"
                    },
                    1: {
                        halign: "left"
                    },
                    2: {
                        halign: "right"
                    },
                    3: {
                        halign: "right"
                    },
                    4: {
                        halign: "right"
                    },
                    5: {
                        halign: "center"
                    }
                }

            });


            // OPEN PDF
            const blob = doc.output("blob");
            window.open(URL.createObjectURL(blob));

        });


        // Excel
        $('#btnExcel').on('click', function() {

            let wb = XLSX.utils.book_new();

            let ws_data = [];

            // HEADER
            ws_data.push(["OUTSTANDING LOANS REPORT"]);
            ws_data.push(["Loan Management System"]);
            ws_data.push(["Generated : " + new Date().toLocaleString()]);
            ws_data.push([]);

            // COLUMN HEADERS
            ws_data.push([
                "Reference No.",
                "Borrower Name",
                "Total Balance",
                "Total Paid",
                "Remaining Balance",
                "Next Due Date"
            ]);

            let totalBalance = 0;
            let totalPaid = 0;
            let totalRemaining = 0;

            // DATA
            outstandingTable.rows().every(function() {

                let d = this.data();

                totalBalance += parseFloat(d.total_balance) || 0;
                totalPaid += parseFloat(d.total_paid) || 0;
                totalRemaining += parseFloat(d.remaining_balance) || 0;

                ws_data.push([
                    d.ref_no,
                    d.borrower_name,
                    parseFloat(d.total_balance),
                    parseFloat(d.total_paid),
                    parseFloat(d.remaining_balance),
                    d.next_due_date
                ]);

            });

            let ws = XLSX.utils.aoa_to_sheet(ws_data);
            let lastRow = ws_data.length;

            // MERGED CELLS
            ws["!merges"] = [{
                    s: {
                        r: 0,
                        c: 0
                    },
                    e: {
                        r: 0,
                        c: 5
                    }
                },
                {
                    s: {
                        r: 1,
                        c: 0
                    },
                    e: {
                        r: 1,
                        c: 5
                    }
                },
                {
                    s: {
                        r: 2,
                        c: 0
                    },
                    e: {
                        r: 2,
                        c: 5
                    }
                }
            ];

            // COLUMN WIDTHS
            ws["!cols"] = [{
                    wch: 20
                },
                {
                    wch: 35
                },
                {
                    wch: 18
                },
                {
                    wch: 18
                },
                {
                    wch: 20
                },
                {
                    wch: 18
                }
            ];

            // TITLE STYLE
            ws["A1"].s = {
                font: {
                    bold: true,
                    sz: 18
                },
                alignment: {
                    horizontal: "center"
                }
            };

            ws["A2"].s = {
                font: {
                    bold: true,
                    sz: 12
                },
                alignment: {
                    horizontal: "center"
                }
            };

            ws["A3"].s = {
                font: {
                    italic: true
                }
            };

            // HEADER STYLE
            for (let c = 0; c <= 5; c++) {

                let cell = XLSX.utils.encode_cell({
                    r: 4,
                    c: c
                });

                if (ws[cell]) {

                    ws[cell].s = {

                        font: {
                            bold: true,
                            color: {
                                rgb: "FFFFFF"
                            }
                        },

                        fill: {
                            fgColor: {
                                rgb: "212529"
                            }
                        },

                        alignment: {
                            horizontal: "center",
                            vertical: "center"
                        },

                        border: {
                            top: {
                                style: "thin"
                            },
                            bottom: {
                                style: "thin"
                            },
                            left: {
                                style: "thin"
                            },
                            right: {
                                style: "thin"
                            }
                        }

                    };

                }

            }


            // BODY STYLE
            for (let r = 5; r < lastRow; r++) {

                for (let c = 0; c <= 5; c++) {

                    let ref = XLSX.utils.encode_cell({
                        r: r,
                        c: c
                    });

                    if (ws[ref]) {

                        ws[ref].s = {
                            border: {
                                top: {
                                    style: "thin"
                                },
                                bottom: {
                                    style: "thin"
                                },
                                left: {
                                    style: "thin"
                                },
                                right: {
                                    style: "thin"
                                }
                            },
                            alignment: {
                                vertical: "center",
                                horizontal: (c >= 2 && c <= 4) ? "right" : "center"
                            }
                        };

                    }

                }

            }

            // CURRENCY FORMAT
            for (let r = 5; r < lastRow; r++) {

                [2, 3, 4].forEach(function(col) {

                    let ref = XLSX.utils.encode_cell({
                        r: r,
                        c: col
                    });

                    if (ws[ref]) {

                        ws[ref].z = '"₱" #,##0.00';

                    }

                });

            }



            // EXPORT
            XLSX.utils.book_append_sheet(wb, ws, "Outstanding Loans");

            XLSX.writeFile(wb, "Outstanding_Loans_Report.xlsx");

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

        let htmlContent = `
    <html>
    <head>
        <title>Payment Receipt</title>

        <style>
            @page {
                size: 80mm 100mm;
                margin: 3mm;
            }

            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .receipt {
                width: 100%;
                border: 1px solid #000;
                padding: 5mm;
                box-sizing: border-box;
            }

            h3 {
                text-align: center;
                margin: 0 0 5px;
                font-size: 12px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px;
            }

            td {
                padding: 2px 0;
            }

            .right {
                text-align: right;
            }

            .line {
                border-top: 1px dashed #000;
                margin: 5px 0;
            }

            .signature {
                text-align: center;
                margin-top: 10px;
                font-size: 10px;
            }
        </style>
    </head>

    <body>
        <div class="receipt">

            <h3>PAYMENT RECEIPT</h3>

            <table>
                <tr><td>Borrower</td><td class="right">${fullname}</td></tr>
                <tr><td>Reference No</td><td class="right">${refNo}</td></tr>
                <tr><td>Payment No</td><td class="right">${paymentNo}</td></tr>
                <tr><td>Date Payment</td><td class="right">${datePayment}</td></tr>
                <tr><td>Collector</td><td class="right">${collector}</td></tr>
                <tr><td>Method</td><td class="right">${paymentMethod}</td></tr>
            </table>

            <div class="line"></div>

            <table>
                <tr>
                    <td>Amount Paid</td>
                    <td class="right">P ${amountPaid.toLocaleString('en-PH', { minimumFractionDigits: 2 })}</td>
                </tr>
                <tr>
                    <td>Penalty</td>
                    <td class="right">P ${penalty.toLocaleString('en-PH', { minimumFractionDigits: 2 })}</td>
                </tr>
                <tr>
                    <td>Remaining</td>
                    <td class="right">P ${remainingBalance.toLocaleString('en-PH', { minimumFractionDigits: 2 })}</td>
                </tr>
            </table>

            <div class="line"></div>

            <div class="signature">
                ___________________<br>
                Authorized Signature
            </div>

        </div>
    </body>
    </html>
    `;

        let blob = new Blob([htmlContent], {
            type: 'text/html'
        });
        let blobUrl = URL.createObjectURL(blob);

        let win = window.open(blobUrl, '_blank');

        win.onload = function() {
            win.focus();
            win.print();
        };

        setTimeout(() => {
            URL.revokeObjectURL(blobUrl);
        }, 10000);
    });
    </script>