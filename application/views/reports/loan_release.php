<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Loan Release Report</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Loan Release Report</li>
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
                                    <label class="fw-bold">FILTER DATE RELEASED</label>
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

                                <table class="table table-striped align-middle w-100 nowrap" id="LoanReleaseTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Release Date</th>
                                            <th>Reference No.</th>
                                            <th>Borrower Name</th>
                                            <th>Loan Amount</th>
                                            <th>Loan Term</th>
                                            <th>Interest Rate</th>
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



    <div class="modal fade" id="loanDetailsModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Loan Released Details
                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <!-- Borrower Information -->
                        <div class="col-md-6">
                            <div class="card border">
                                <div class="card-header">
                                    <strong>Borrower Information</strong>
                                </div>

                                <div class="card-body">

                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Reference No</th>
                                            <td id="v_ref_no"></td>
                                        </tr>

                                        <tr>
                                            <th>Full Name</th>
                                            <td id="v_name"></td>
                                        </tr>

                                        <tr>
                                            <th>Address</th>
                                            <td id="v_address"></td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td id="v_email"></td>
                                        </tr>

                                        <tr>
                                            <th>Contact No</th>
                                            <td id="v_contact"></td>
                                        </tr>

                                        <tr>
                                            <th>Valid ID</th>
                                            <td id="v_valid_id"></td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                        </div>

                        <!-- Loan Information -->
                        <div class="col-md-6">
                            <div class="card border">
                                <div class="card-header">
                                    <strong>Loan Information</strong>
                                </div>

                                <div class="card-body">

                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Purpose</th>
                                            <td id="v_purpose"></td>
                                        </tr>

                                        <tr>
                                            <th>Loan Plan</th>
                                            <td id="v_plan"></td>
                                        </tr>

                                        <tr>
                                            <th>Effective Date</th>
                                            <td id="v_effective_date"></td>
                                        </tr>

                                        <tr>
                                            <th>Status</th>
                                            <td id="v_status"></td>
                                        </tr>

                                        <tr>
                                            <th>Release Date</th>
                                            <td id="v_release_date"></td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                        </div>

                        <!-- Co Maker -->
                        <div class="col-md-6 mt-3">
                            <div class="card border">
                                <div class="card-header">
                                    <strong>Co-Maker Information</strong>
                                </div>

                                <div class="card-body">

                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Co-Maker</th>
                                            <td id="v_comaker"></td>
                                        </tr>

                                        <tr>
                                            <th>Contact</th>
                                            <td id="v_comaker_contact"></td>
                                        </tr>

                                        <tr>
                                            <th>Relationship</th>
                                            <td id="v_relationship"></td>
                                        </tr>

                                        <tr>
                                            <th>Collateral</th>
                                            <td id="v_collateral"></td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <!-- Financial -->
                        <div class="col-md-6 mt-3">
                            <div class="card border">
                                <div class="card-header">
                                    <strong>Financial Details</strong>
                                </div>

                                <div class="card-body">

                                    <table class="table table-sm">
                                        <tr>
                                            <th width="40%">Loan Amount</th>
                                            <td id="v_amount"></td>
                                        </tr>

                                        <tr>
                                            <th>Interest Rate</th>
                                            <td id="v_interest"></td>
                                        </tr>

                                        <tr>
                                            <th>Monthly Payment</th>
                                            <td id="v_monthly"></td>
                                        </tr>

                                        <tr>
                                            <th>Unearned Interest</th>
                                            <td id="v_unearned"></td>
                                        </tr>

                                        <tr>
                                            <th>Total Balance</th>
                                            <td id="v_balance"></td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

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

        var table = $('#LoanReleaseTable').DataTable({
            ajax: {
                url: "<?= base_url('released_loans') ?>",
                type: "POST",
                data: function(d) {
                    d.startDate = $('#startDate').val();
                    d.endDate = $('#endDate').val();
                },
                dataSrc: "data"
            },

            order: [
                [0, "desc"]
            ],

            columns: [{
                    data: "release_date",
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "ref_no",
                    render: function(data) {
                        return data ? `<span class="fw-bold">${data}</span>` : '-';
                    }
                },
                {
                    data: "borrower_name"
                },
                {
                    data: "loan_amount",
                    render: function(data) {
                        return `<span class="text-success fw-bold">
                    ${parseFloat(data).toLocaleString(undefined,{
                        minimumFractionDigits:2
                    })}
                </span>`;
                    }
                },
                {
                    data: "loan_plan"
                },
                {
                    data: "interest_rate",
                    render: function(data) {
                        return data + "%";
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                    <button class="btn btn-sm btn-primary viewLoan"
                        data-id="${row.loan_id}">
                        <i class="ri-eye-line"></i> View
                    </button>
                `;
                    }
                }
            ]
        });


        $('#startDate, #endDate').on('change', function() {
            table.ajax.reload();
        });



        $(document).on('click', '.viewLoan', function() {

            let loan_id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('get_loan_details') ?>",
                type: "POST",
                data: {
                    loan_id: loan_id
                },
                dataType: "json",
                success: function(data) {

                    $('#v_ref_no').text(
                        'RN-' + String(data.id).padStart(6, '0')
                    );

                    $('#v_name').text(
                        data.firstname + ' ' +
                        (data.middlename ?? '') + ' ' +
                        data.lastname
                    );

                    $('#v_address').text(data.address);
                    $('#v_email').text(data.email);
                    $('#v_contact').text(data.contact_no);
                    $('#v_valid_id').text(data.valid_id_no);

                    $('#v_purpose').text(data.loan_purpose);
                    $('#v_plan').text(data.loan_plan);
                    $('#v_effective_date').text(data.effective_date);
                    $('#v_status').text(data.status);
                    $('#v_release_date').text(data.date_created);

                    $('#v_comaker').text(data.co_maker);
                    $('#v_comaker_contact').text(data.co_maker_contact);
                    $('#v_relationship').text(data.relationship);
                    $('#v_collateral').text(data.collateral);

                    $('#v_amount').text(
                        parseFloat(data.loan_amount).toLocaleString()
                    );

                    $('#v_interest').text(
                        data.interest_rate + '%'
                    );

                    $('#v_monthly').text(
                        parseFloat(data.monthly_payment).toLocaleString()
                    );

                    $('#v_unearned').text(
                        parseFloat(data.unearned_interest).toLocaleString()
                    );

                    $('#v_balance').text(
                        parseFloat(data.total_balance).toLocaleString()
                    );

                    $('#loanDetailsModal').modal('show');
                }
            });

        });





        $('#btnPDF').click(function() {

            const {
                jsPDF
            } = window.jspdf;

            const doc = new jsPDF({
                orientation: "landscape",
                unit: "mm",
                format: "a4"
            });

            let startDate = $('#startDate').val() || "All";
            let endDate = $('#endDate').val() || "All";

            let rows = [];

            let totalAmount = 0;

            table.rows({
                search: 'applied'
            }).every(function(index) {

                let d = this.data();

                totalAmount += parseFloat(d.loan_amount);

                rows.push([
                    index + 1,
                    d.release_date,
                    d.ref_no,
                    d.borrower_name,
                    "P " + parseFloat(d.loan_amount).toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }),
                    d.loan_plan,
                    d.interest_rate + "%"
                ]);

            });

            //================ Header =================//

            doc.setFillColor(22, 55, 108);
            doc.rect(0, 0, 297, 24, "F");

            doc.setTextColor(255);

            doc.setFont("helvetica", "bold");
            doc.setFontSize(18);
            doc.text("RELEASED LOANS REPORT", 148, 10, {
                align: "center"
            });

            doc.setFontSize(13);
            doc.text("LOAN MANAGEMENT SYSTEM", 148, 18, {
                align: "center"
            });

            doc.setTextColor(0);

            doc.setFontSize(10);

            let y = 33;

            doc.setFont(undefined, "bold");
            doc.text("Generated :", 14, y);
            doc.setFont(undefined, "normal");
            doc.text(new Date().toLocaleString(), 40, y);

            y += 6;

            doc.setFont(undefined, "bold");
            doc.text("Release Date :", 14, y);
            doc.setFont(undefined, "normal");
            doc.text(startDate + "  to  " + endDate, 40, y);

            y += 10;

            //============= Summary Boxes =============//

            doc.setFillColor(245, 245, 245);

            doc.roundedRect(14, y, 70, 18, 2, 2, "F");
            doc.roundedRect(90, y, 70, 18, 2, 2, "F");

            doc.setFont(undefined, "bold");
            doc.text("Total Loans", 20, y + 7);

            doc.setFontSize(15);
            doc.setTextColor(0, 102, 204);
            doc.text(rows.length.toString(), 20, y + 15);

            doc.setTextColor(0);

            doc.setFontSize(10);

            doc.setFont(undefined, "bold");
            doc.text("Total Released Amount", 96, y + 7);

            doc.setFontSize(15);
            doc.setTextColor(0, 150, 0);
            doc.text("P " + totalAmount.toLocaleString(undefined, {
                minimumFractionDigits: 2
            }), 96, y + 15);

            doc.setTextColor(0);

            y += 28;

            //================ Table =================//

            doc.autoTable({

                startY: y,

                head: [
                    [
                        "#",
                        "Release Date",
                        "Reference No",
                        "Borrower",
                        "Loan Amount",
                        "Plan",
                        "Interest"
                    ]
                ],

                body: rows,

                theme: 'grid',

                styles: {
                    fontSize: 9,
                    cellPadding: 3,
                    valign: 'middle'
                },

                headStyles: {
                    fillColor: [22, 55, 108],
                    textColor: 255,
                    halign: 'center'
                },

                columnStyles: {
                    0: {
                        halign: 'center',
                        cellWidth: 12
                    },
                    4: {
                        halign: 'right'
                    }
                },

                didDrawPage: function(data) {

                    let page = doc.internal.getNumberOfPages();

                    doc.setFontSize(9);

                    doc.text(
                        "Page " + page,
                        285,
                        205, {
                            align: 'right'
                        }
                    );

                }

            });

            //=========== Footer ===========//

            let lastY = doc.lastAutoTable.finalY + 18;

            doc.line(14, lastY, 90, lastY);

            doc.text("Prepared by", 14, lastY + 5);
            const pdfBlob = doc.output("blob");
            const blobUrl = URL.createObjectURL(pdfBlob);
            window.open(blobUrl, "_blank");
        });







        $('#btnExcel').click(function() {

            let startDate = $('#startDate').val() || "All";
            let endDate = $('#endDate').val() || "All";

            let totalAmount = 0;
            let rows = [];

            table.rows({
                search: 'applied'
            }).every(function(index) {

                let d = this.data();

                totalAmount += parseFloat(d.loan_amount);

                rows.push([
                    index + 1,
                    d.release_date,
                    d.ref_no,
                    d.borrower_name,
                    parseFloat(d.loan_amount),
                    d.loan_plan,
                    d.interest_rate + "%"
                ]);

            });

            var wb = XLSX.utils.book_new();

            var ws = {};

            // Title
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
                }
            ];

            ws["A1"] = {
                t: "s",
                v: "RELEASED LOANS REPORT",
                s: {
                    font: {
                        bold: true,
                        sz: 18,
                        color: {
                            rgb: "FFFFFF"
                        }
                    },
                    alignment: {
                        horizontal: "center",
                        vertical: "center"
                    },
                    fill: {
                        fgColor: {
                            rgb: "16376C"
                        }
                    }
                }
            };

            ws["A2"] = {
                t: "s",
                v: "LOAN MANAGEMENT SYSTEM",
                s: {
                    font: {
                        bold: true,
                        sz: 13,
                        color: {
                            rgb: "FFFFFF"
                        }
                    },
                    alignment: {
                        horizontal: "center"
                    },
                    fill: {
                        fgColor: {
                            rgb: "16376C"
                        }
                    }
                }
            };

            // Report Info
            ws["A4"] = {
                t: "s",
                v: "Generated :",
                s: {
                    font: {
                        bold: true
                    }
                }
            };
            ws["B4"] = {
                t: "s",
                v: new Date().toLocaleString()
            };

            ws["A5"] = {
                t: "s",
                v: "Release Date :",
                s: {
                    font: {
                        bold: true
                    }
                }
            };
            ws["B5"] = {
                t: "s",
                v: startDate + "  to  " + endDate
            };

            // Summary
            ws["A7"] = {
                t: "s",
                v: "Total Loans",
                s: {
                    font: {
                        bold: true
                    }
                }
            };

            ws["B7"] = {
                t: "n",
                v: rows.length,
                s: {
                    font: {
                        bold: true,
                        sz: 14,
                        color: {
                            rgb: "0066CC"
                        }
                    }
                }
            };

            ws["D7"] = {
                t: "s",
                v: "Total Released Amount",
                s: {
                    font: {
                        bold: true
                    }
                }
            };

            ws["E7"] = {
                t: "n",
                v: totalAmount,
                z: '₱#,##0.00',
                s: {
                    font: {
                        bold: true,
                        sz: 14,
                        color: {
                            rgb: "009900"
                        }
                    }
                }
            };

            // Header Row
            let headerRow = 9;

            let headers = [
                "#",
                "Release Date",
                "Reference No",
                "Borrower",
                "Loan Amount",
                "Plan",
                "Interest"
            ];

            headers.forEach(function(h, i) {

                let cell = XLSX.utils.encode_cell({
                    r: headerRow - 1,
                    c: i
                });

                ws[cell] = {
                    t: "s",
                    v: h,
                    s: {
                        font: {
                            bold: true,
                            color: {
                                rgb: "FFFFFF"
                            }
                        },
                        alignment: {
                            horizontal: "center",
                            vertical: "center"
                        },
                        fill: {
                            fgColor: {
                                rgb: "16376C"
                            }
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
                    }
                };

            });

            // Data
            rows.forEach(function(r, index) {

                let rowIndex = headerRow + index;

                r.forEach(function(value, col) {

                    let cell = XLSX.utils.encode_cell({
                        r: rowIndex,
                        c: col
                    });

                    let style = {
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
                            vertical: "center"
                        }
                    };

                    if (col == 4) {

                        ws[cell] = {
                            t: "n",
                            v: value,
                            z: '₱#,##0.00',
                            s: style
                        };

                    } else {

                        ws[cell] = {
                            t: "s",
                            v: value.toString(),
                            s: style
                        };

                    }

                });

            });

            // Column Width
            ws["!cols"] = [{
                    wch: 8
                },
                {
                    wch: 18
                },
                {
                    wch: 22
                },
                {
                    wch: 35
                },
                {
                    wch: 18
                },
                {
                    wch: 20
                },
                {
                    wch: 12
                }
            ];

            // Row Height
            ws["!rows"] = [{
                    hpt: 28
                },
                {
                    hpt: 22
                }
            ];

            // Worksheet Range
            ws["!ref"] = XLSX.utils.encode_range({
                s: {
                    r: 0,
                    c: 0
                },
                e: {
                    r: headerRow + rows.length,
                    c: 6
                }
            });

            XLSX.utils.book_append_sheet(wb, ws, "Released Loans");

            // Download
            let excelBuffer = XLSX.write(wb, {
                bookType: 'xlsx',
                type: 'array'
            });

            saveAs(
                new Blob([excelBuffer], {
                    type: "application/octet-stream"
                }),
                "Released_Loans_Report.xlsx"
            );

        });













    });
    </script>