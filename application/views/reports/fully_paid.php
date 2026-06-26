<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Fully Paid Report</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Fully Paid Report</li>
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

                            <!-- Date Filter -->
                            <div class="row mb-3">
                                <div class="col-12 mb-2">
                                    <label class="fw-bold">FILTER DATE FULLY PAID</label>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label fw-bold">Start Date</label>
                                    <input type="date" class="form-control form-control-md" id="startDate">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label fw-bold">End Date</label>
                                    <input type="date" class="form-control form-control-md" id="endDate">
                                </div>

                                <div class="col-md-8 d-flex justify-content-end align-items-end gap-2">
                                    <button type="button" id="btnExcel" class="btn btn-success btn-sm">
                                        <i class="ri-file-excel-2-fill me-1"></i> Generate Excel
                                    </button>

                                    <button type="button" id="btnPDF" class="btn btn-danger btn-sm">
                                        <i class="ri-file-pdf-2-fill me-1"></i> Generate PDF
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped align-middle w-100 nowrap" id="FullyPaidTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Reference No.</th>
                                            <th>Borrower Name</th>
                                            <th>Loan Amount</th>
                                            <th>Total Interest Earned</th>
                                            <th>Date Released</th>
                                            <th>Date Fully Paid</th>
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

        var fullyPaidTable = $('#FullyPaidTable').DataTable({
            processing: true,
            responsive: true,
            destroy: true,
            autoWidth: false,
            ordering: false,
            ajax: {
                url: "<?= base_url('fully_paid_loans') ?>",
                type: "POST",
                data: function(d) {
                    d.startDate = $('#startDate').val();
                    d.endDate = $('#endDate').val();
                },
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
                        return '₱ ' + parseFloat(data).toLocaleString('en-PH', {
                            minimumFractionDigits: 2
                        });
                    }
                },
                {
                    data: "total_interest_earned",
                    render: function(data) {
                        return '₱ ' + parseFloat(data).toLocaleString('en-PH', {
                            minimumFractionDigits: 2
                        });
                    }
                },
                {
                    data: "date_released",
                    render: function(data) {
                        return data ?
                            new Date(data).toLocaleDateString('en-PH') :
                            '';
                    }
                },
                {
                    data: "date_fully_paid",
                    render: function(data) {

                        if (!data) {
                            return '';
                        }

                        let date = new Date(data).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });

                        return `
                        <span class="text-success">
                            ${date}
                        </span>
                    `;
                    }
                },
                {
                    data: null,
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

        $('#startDate, #endDate').on('change', function() {
            fullyPaidTable.ajax.reload();
        });

        // ==================  PDF ================ \\
        $('#btnPDF').on('click', function() {

            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF({
                orientation: "landscape",
                unit: "mm",
                format: "a4"
            });

            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();

            let table = $('#FullyPaidTable').DataTable();
            let data = table.rows({
                search: 'applied'
            }).data().toArray();

            let body = [];

            data.forEach(function(row, index) {

                body.push([
                    index + 1,
                    row.ref_no,
                    row.borrower_name,
                    "P " + Number(row.loan_amount).toLocaleString('en-PH', {
                        minimumFractionDigits: 2
                    }),
                    "P " + Number(row.total_interest_earned).toLocaleString('en-PH', {
                        minimumFractionDigits: 2
                    }),
                    row.date_released ?
                    new Date(row.date_released).toLocaleDateString('en-US') : '',
                    row.date_fully_paid ?
                    new Date(row.date_fully_paid).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }) : ''
                ]);

            });

            //================ HEADER =================//
            const pageWidth = doc.internal.pageSize.getWidth();

            doc.setFont("helvetica", "bold");
            doc.setFontSize(22);
            doc.text("FULLY PAID LOANS REPORT", pageWidth / 2, 15, {
                align: "center"
            });

            doc.setFont("helvetica", "normal");
            doc.setFontSize(12);
            doc.text("Loan Management System", pageWidth / 2, 22, {
                align: "center"
            });

            doc.line(10, 28, pageWidth - 10, 28);

            doc.setFontSize(9);

            doc.text(
                "Generated : " + new Date().toLocaleString(),
                10,
                34
            );

            doc.text(
                "Payment Date : " + startDate + " To " + endDate,
                pageWidth - 10,
                34, {
                    align: "right"
                }
            );

            //================ TABLE =================//
            doc.autoTable({
                startY: 42,

                tableWidth: 277,

                margin: {
                    left: 10,
                    right: 10,
                    top: 42,
                    bottom: 15
                },

                head: [
                    [
                        "#",
                        "Reference No.",
                        "Borrower",
                        "Loan Amount",
                        "Interest Earned",
                        "Release Date",
                        "Date Fully Paid"
                    ]
                ],

                body: body,

                theme: "grid",

                styles: {
                    font: "helvetica",
                    fontSize: 9,
                    cellPadding: 2.8,
                    overflow: "linebreak",
                    valign: "middle",
                    lineWidth: 0.1,
                    lineColor: [210, 210, 210]
                },

                headStyles: {
                    fillColor: [33, 37, 41],
                    textColor: 255,
                    fontStyle: "bold",
                    halign: "center",
                    valign: "middle"
                },

                bodyStyles: {
                    halign: "left"
                },

                columnStyles: {


                    0: {
                        cellWidth: 12,
                        halign: "center"
                    },

                    1: {
                        cellWidth: 35
                    },

                    2: {
                        cellWidth: 78
                    },

                    3: {
                        cellWidth: 38,
                        halign: "right"
                    },

                    4: {
                        cellWidth: 40,
                        halign: "right"
                    },

                    5: {
                        cellWidth: 34,
                        halign: "center"
                    },

                    6: {
                        cellWidth: 40,
                        halign: "center"
                    }

                },

                didDrawPage: function() {

                    doc.setFontSize(9);

                    doc.text(
                        "Total Fully Paid Loans : " + body.length,
                        10,
                        doc.internal.pageSize.height - 8
                    );

                    doc.text(
                        "Page " + doc.internal.getNumberOfPages(),
                        287,
                        doc.internal.pageSize.height - 8, {
                            align: "right"
                        }
                    );
                }

            });

            //================ OPEN PDF =================//
            const blob = doc.output('blob');
            const url = URL.createObjectURL(blob);

            window.open(url);

        });





        // excel
        $('#btnExcel').on('click', function() {

            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();

            let table = $('#FullyPaidTable').DataTable();
            let data = table.rows({
                search: 'applied'
            }).data().toArray();

            let sheetData = [];

            // REPORT HEADER
            sheetData.push(["FULLY PAID LOANS REPORT"]);
            sheetData.push(["Loan Management System"]);
            sheetData.push([]);
            sheetData.push([
                "Generated : " + new Date().toLocaleString()
            ]);
            sheetData.push([
                "Payment Date : " + startDate + " To " + endDate
            ]);
            sheetData.push([]);

            // TABLE HEADER
            sheetData.push([
                "#",
                "Reference No.",
                "Borrower",
                "Loan Amount",
                "Interest Earned",
                "Release Date",
                "Date Fully Paid"
            ]);

            // TABLE BODY
            data.forEach(function(row, index) {

                sheetData.push([
                    index + 1,
                    row.ref_no,
                    row.borrower_name,
                    Number(row.loan_amount),
                    Number(row.total_interest_earned),
                    row.date_released ?
                    new Date(row.date_released).toLocaleDateString('en-US') : '',
                    row.date_fully_paid ?
                    new Date(row.date_fully_paid).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }) : ''
                ]);

            });

            // CREATE WORKBOOK
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(sheetData);

            // MERGE CELLS
            ws["!merges"] = [{
                    s: {
                        r: 0,
                        c: 0
                    },
                    e: {
                        r: 0,
                        c: 6
                    }
                },
                {
                    s: {
                        r: 1,
                        c: 0
                    },
                    e: {
                        r: 1,
                        c: 6
                    }
                },
                {
                    s: {
                        r: 3,
                        c: 0
                    },
                    e: {
                        r: 3,
                        c: 6
                    }
                },
                {
                    s: {
                        r: 4,
                        c: 0
                    },
                    e: {
                        r: 4,
                        c: 6
                    }
                }
            ];

            // COLUMN WIDTHS
            ws["!cols"] = [{
                    wch: 6
                },
                {
                    wch: 18
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
                    wch: 18
                },
                {
                    wch: 22
                }
            ];

            // PAGE SETUP
            ws["!pageSetup"] = {
                orientation: "landscape",
                paperSize: 9,
                fitToPage: true,
                fitToWidth: 1,
                fitToHeight: 0
            };

            ws["!margins"] = {
                left: 0.3,
                right: 0.3,
                top: 0.5,
                bottom: 0.5,
                header: 0.2,
                footer: 0.2
            };

            // STYLES
            const range = XLSX.utils.decode_range(ws['!ref']);

            for (let R = 0; R <= range.e.r; R++) {

                for (let C = 0; C <= range.e.c; C++) {

                    let cell = XLSX.utils.encode_cell({
                        r: R,
                        c: C
                    });

                    if (!ws[cell]) continue;

                    ws[cell].s = {

                        font: {
                            name: "Calibri",
                            sz: 11
                        },

                        alignment: {
                            vertical: "center",
                            horizontal: "left"
                        },

                        border: {
                            top: {
                                style: "thin",
                                color: {
                                    rgb: "D9D9D9"
                                }
                            },
                            bottom: {
                                style: "thin",
                                color: {
                                    rgb: "D9D9D9"
                                }
                            },
                            left: {
                                style: "thin",
                                color: {
                                    rgb: "D9D9D9"
                                }
                            },
                            right: {
                                style: "thin",
                                color: {
                                    rgb: "D9D9D9"
                                }
                            }
                        }

                    };

                }

            }

            // TITLE
            ws["A1"].s = {
                font: {
                    bold: true,
                    sz: 20,
                    color: {
                        rgb: "1F4E78"
                    }
                },
                alignment: {
                    horizontal: "center"
                }
            };

            ws["A2"].s = {
                font: {
                    bold: true,
                    sz: 13
                },
                alignment: {
                    horizontal: "center"
                }
            };

            ws["A4"].s = {
                font: {
                    italic: true
                }
            };

            ws["A5"].s = {
                font: {
                    italic: true
                }
            };

            // HEADER STYLE
            for (let c = 0; c < 7; c++) {

                let cell = XLSX.utils.encode_cell({
                    r: 6,
                    c: c
                });

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

            // MONEY FORMAT
            for (let r = 7; r < sheetData.length; r++) {

                ["D", "E"].forEach(function(col) {

                    let cell = col + (r + 1);

                    if (ws[cell]) {

                        ws[cell].z = '"₱"#,##0.00';

                        ws[cell].s.alignment = {
                            horizontal: "right"
                        };

                    }

                });

            }

            // FREEZE HEADER
            ws["!freeze"] = {
                xSplit: 0,
                ySplit: 7
            };

            XLSX.utils.book_append_sheet(wb, ws, "Fully Paid Loans");

            XLSX.writeFile(
                wb,
                "Fully_Paid_Loans_Report.xlsx"
            );

        });



        $('#btnExcel').click(async function () {

    let startDate = $('#startDate').val() || "All";
    let endDate = $('#endDate').val() || "All";

    let workbook = new ExcelJS.Workbook();
    workbook.creator = "Loan Management System";
    workbook.created = new Date();

    let sheet = workbook.addWorksheet("Released Loans");

    //==========================================
    // Page Setup
    //==========================================
    sheet.pageSetup = {
        orientation: "landscape",
        paperSize: 9,
        fitToPage: true,
        fitToWidth: 1
    };

    //==========================================
    // Title
    //==========================================
    sheet.mergeCells('A1:G1');
    sheet.getCell('A1').value = "RELEASED LOANS REPORT";
    sheet.getCell('A1').font = {
        size: 20,
        bold: true,
        color: { argb: 'FFFFFFFF' }
    };
    sheet.getCell('A1').alignment = {
        horizontal: 'center',
        vertical: 'middle'
    };
    sheet.getCell('A1').fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: { argb: '16376C' }
    };
    sheet.getRow(1).height = 30;

    sheet.mergeCells('A2:G2');
    sheet.getCell('A2').value = "LOAN MANAGEMENT SYSTEM";
    sheet.getCell('A2').font = {
        size: 14,
        bold: true,
        color: { argb: 'FFFFFFFF' }
    };
    sheet.getCell('A2').alignment = {
        horizontal: 'center'
    };
    sheet.getCell('A2').fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: { argb: '16376C' }
    };
    sheet.getRow(2).height = 24;

    //==========================================
    // Report Information
    //==========================================
    sheet.getCell('A4').value = "Generated:";
    sheet.getCell('B4').value = new Date().toLocaleString();

    sheet.getCell('A5').value = "Release Date:";
    sheet.getCell('B5').value = startDate + " to " + endDate;

    sheet.getCell('A4').font = { bold: true };
    sheet.getCell('A5').font = { bold: true };

    //==========================================
    // Get Data
    //==========================================
    let totalAmount = 0;
    let totalLoans = 0;

    table.rows({ search: 'applied' }).every(function () {

        let d = this.data();

        totalLoans++;

        totalAmount += parseFloat(d.loan_amount);

    });

    //==========================================
    // Summary
    //==========================================
    sheet.getCell('A7').value = "Total Loans";
    sheet.getCell('B7').value = totalLoans;

    sheet.getCell('D7').value = "Total Released Amount";
    sheet.getCell('E7').value = totalAmount;

    sheet.getCell('E7').numFmt = '"₱"#,##0.00';

    sheet.getCell('A7').font = { bold: true };
    sheet.getCell('D7').font = { bold: true };

    //==========================================
    // Table Header
    //==========================================
    let headerRow = 9;

    sheet.addRow([]);

    sheet.getRow(headerRow).values = [
        "#",
        "Release Date",
        "Reference No",
        "Borrower",
        "Loan Amount",
        "Loan Plan",
        "Interest"
    ];

    let header = sheet.getRow(headerRow);

    header.font = {
        bold: true,
        color: { argb: 'FFFFFFFF' }
    };

    header.alignment = {
        horizontal: 'center',
        vertical: 'middle'
    };

    header.fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: { argb: '16376C' }
    };

    //==========================================
    // Table Data
    //==========================================
    let rowNo = 1;

    table.rows({ search: 'applied' }).every(function () {

        let d = this.data();

        let row = sheet.addRow([
            rowNo++,
            d.release_date,
            d.ref_no,
            d.borrower_name,
            parseFloat(d.loan_amount),
            d.loan_plan,
            d.interest_rate + "%"
        ]);

        row.getCell(5).numFmt = '"₱"#,##0.00';

    });

    //==========================================
    // Borders
    //==========================================
    sheet.eachRow(function (row) {

        row.eachCell(function (cell) {

            cell.border = {
                top: {
                    style: 'thin'
                },
                left: {
                    style: 'thin'
                },
                bottom: {
                    style: 'thin'
                },
                right: {
                    style: 'thin'
                }
            };

        });

    });

    //==========================================
    // Auto Width
    //==========================================
    sheet.columns.forEach(column => {

        let maxLength = 15;

        column.eachCell({ includeEmpty: true }, cell => {

            let value = cell.value ? cell.value.toString() : "";

            if (value.length > maxLength)
                maxLength = value.length;

        });

        column.width = maxLength + 5;

    });

    //==========================================
    // Freeze Header
    //==========================================
    sheet.views = [{
        state: 'frozen',
        ySplit: headerRow
    }];

    //==========================================
    // Download
    //==========================================
    let buffer = await workbook.xlsx.writeBuffer();

    saveAs(
        new Blob([buffer], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        }),
        "Released_Loans_Report.xlsx"
    );

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