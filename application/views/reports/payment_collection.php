<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Payment Collection Report</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Payment Collection Report</li>
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
                                    <label class="fw-bold">FILTER DATE PAYMENT</label>
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
                                <table class="table table-striped align-middle w-100 nowrap"
                                    id="PaymentCollectionTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Receipt No.</th>
                                            <th>Date Payment</th>
                                            <th>Reference No.</th>
                                            <th>Borrower Name</th>
                                            <th>Amount Paid</th>
                                            <!-- <th>Principal Paid</th>
                                            <th>Interest Paid</th> -->
                                            <th>Penalty Paid</th>
                                            <th>Collected By</th>
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
    $(document).ready(function() {

        var table = $('#PaymentCollectionTable').DataTable({
            ajax: {
                url: "<?= base_url('payment_collection') ?>",
                type: "POST",
                data: function(d) {
                    d.startDate = $('#startDate').val();
                    d.endDate = $('#endDate').val();
                },
                dataSrc: "data"
            },

            order: [
                [1, "desc"]
            ],

            columns: [{
                    data: "receipt_no",
                    render: function(data) {
                        return data ? `<span class="fw-bold"># ${data}</span>` : "-";
                    }
                },
                {
                    data: "date_payment"
                },
                {
                    data: "ref_no"
                },
                {
                    data: "borrower_name"
                },
                {
                    data: "payment_amount",
                    render: function(data) {
                        return `<span class="text-success fw-bold">
                    ${parseFloat(data).toLocaleString(undefined,{minimumFractionDigits:2})}
                </span>`;
                    }
                },
                // {
                //     data: "principal_paid",
                //     render: function(data) {
                //         return parseFloat(data).toLocaleString(undefined, {
                //             minimumFractionDigits: 2
                //         });
                //     }
                // },
                // {
                //     data: "interest_paid",
                //     render: function(data) {
                //         return parseFloat(data).toFixed(2);
                //     }
                // },
                {
                    data: "penalty",
                    render: function(data) {
                        return `<span class="text-danger fw-bold">
                    ${parseFloat(data).toLocaleString(undefined,{minimumFractionDigits:2})}
                </span>`;
                    }
                },
                {
                    data: "collector"
                }
            ]
        });

        $('#startDate, #endDate').on('change', function() {
            table.ajax.reload();
        });





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

            let rows = [];
            let totalPayment = 0;
            let totalPrincipal = 0;
            let totalInterest = 0;
            let totalPenalty = 0;

            table.rows({
                search: 'applied'
            }).every(function() {

                let d = this.data();

                totalPayment += parseFloat(d.payment_amount || 0);
                totalPrincipal += parseFloat(d.principal_paid || 0);
                totalInterest += parseFloat(d.interest_paid || 0);
                totalPenalty += parseFloat(d.penalty || 0);

                rows.push([
                    d.receipt_no,
                    d.date_payment,
                    d.ref_no,
                    d.borrower_name,
                    parseFloat(d.payment_amount).toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }),
                    parseFloat(d.principal_paid).toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }),
                    parseFloat(d.interest_paid).toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }),
                    parseFloat(d.penalty).toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }),
                    d.collector
                ]);
            });

            // HEADER
            doc.setFont("helvetica", "bold");
            doc.setFontSize(18);
            doc.text("PAYMENT COLLECTION REPORT", 148, 15, {
                align: "center"
            });

            doc.setFontSize(11);
            doc.setFont("helvetica", "normal");

            doc.text("Loan Management System", 148, 22, {
                align: "center"
            });

            doc.text("Generated : " + new Date().toLocaleString(), 8, 34);

            if (startDate && endDate) {
                doc.text("Payment Date : " + startDate + " to " + endDate, 8, 40);
            }

            // TABLE
            doc.autoTable({

                startY: 42,

                head: [
                    [
                        "Receipt #",
                        "Payment Date",
                        "Reference No.",
                        "Borrower",
                        "Payment",
                        "Principal",
                        "Interest",
                        "Penalty",
                        "Collector"
                    ]
                ],

                body: rows,



                theme: 'grid',

                headStyles: {
                    fillColor: [33, 37, 41],
                    textColor: 255,
                    halign: 'center',
                    fontStyle: 'bold'
                },

                footStyles: {
                    fillColor: [240, 240, 240],
                    textColor: 0,
                    fontStyle: 'bold'
                },

                styles: {
                    fontSize: 9,
                    cellPadding: 2,
                    valign: 'middle'
                },

                columnStyles: {
                    4: {
                        halign: 'right'
                    },
                    5: {
                        halign: 'right'
                    },
                    6: {
                        halign: 'right'
                    },
                    7: {
                        halign: 'right'
                    }
                },

                didDrawPage: function() {

                    let pageSize = doc.internal.pageSize;

                    let pageHeight = pageSize.height || pageSize.getHeight();

                    doc.setFontSize(9);

                    doc.text(
                        "Page " + doc.internal.getNumberOfPages(),
                        pageSize.width - 25,
                        pageHeight - 5
                    );
                }

            });

            const pdfBlob = doc.output("blob");
            const blobUrl = URL.createObjectURL(pdfBlob);
            window.open(blobUrl, "_blank");

        });



        $('#btnExcel').on('click', function() {

            let wb = XLSX.utils.book_new();
            let ws = {};

            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();

            let row = 0;

            // HEADER

            ws["A1"] = {
                t: "s",
                v: "PAYMENT COLLECTION REPORT",
                s: {
                    font: {
                        bold: true,
                        sz: 18
                    },
                    alignment: {
                        horizontal: "center",
                        vertical: "center"
                    }
                }
            };
            ws["A2"] = {
                t: "s",
                v: "Loan Management System",
                s: {
                    font: {
                        sz: 12
                    },
                    alignment: {
                        horizontal: "center",
                        vertical: "center"
                    }
                }
            };
            ws["A3"] = {
                t: "s",
                v: "Generated : " + new Date().toLocaleString(),
                s: {
                    alignment: {
                        horizontal: "left"
                    }
                }
            };

            if (startDate && endDate) {

                ws["A4"] = {
                    t: "s",
                    v: "Payment Date : " + startDate + " to " + endDate,
                    s: {
                        alignment: {
                            horizontal: "left"
                        }
                    }
                };

            }

            row = 6;

            // TABLE HEADER

            let headers = [
                "Receipt #",
                "Payment Date",
                "Reference No.",
                "Borrower",
                "Payment",
                "Principal",
                "Interest",
                "Penalty",
                "Collector"
            ];

            headers.forEach((h, i) => {

                let cell = XLSX.utils.encode_cell({
                    r: row,
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
                    }
                };

            });

            row++;

            // DATA

            let totalPayment = 0;
            let totalPrincipal = 0;
            let totalInterest = 0;
            let totalPenalty = 0;

            table.rows({
                search: 'applied'
            }).every(function() {

                let d = this.data();

                totalPayment += parseFloat(d.payment_amount || 0);
                totalPrincipal += parseFloat(d.principal_paid || 0);
                totalInterest += parseFloat(d.interest_paid || 0);
                totalPenalty += parseFloat(d.penalty || 0);

                let values = [
                    d.receipt_no,
                    d.date_payment,
                    d.ref_no,
                    d.borrower_name,
                    parseFloat(d.payment_amount),
                    parseFloat(d.principal_paid),
                    parseFloat(d.interest_paid),
                    parseFloat(d.penalty),
                    d.collector
                ];

                values.forEach((v, i) => {

                    let cell = XLSX.utils.encode_cell({
                        r: row,
                        c: i
                    });

                    ws[cell] = {
                        t: i >= 4 && i <= 7 ? "n" : "s",
                        v: v,
                        s: {
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
                                horizontal: i >= 4 ? "right" : "left"
                            }
                        }
                    };

                    if (i >= 4 && i <= 7) {
                        ws[cell].z = '#,##0.00';
                    }

                });

                row++;

            });



            // MERGE HEADER

            ws["!merges"] = [
                XLSX.utils.decode_range("A1:I1"),
                XLSX.utils.decode_range("A2:I2"),
                XLSX.utils.decode_range("A3:I3"),
                XLSX.utils.decode_range("A4:I4")
            ];

            // COLUMN WIDTH

            ws["!cols"] = [{
                    wch: 15
                },
                {
                    wch: 20
                },
                {
                    wch: 18
                },
                {
                    wch: 30
                },
                {
                    wch: 15
                },
                {
                    wch: 15
                },
                {
                    wch: 15
                },
                {
                    wch: 15
                },
                {
                    wch: 24
                }
            ];

            // FREEZE HEADER

            ws["!freeze"] = {
                xSplit: 0,
                ySplit: 7
            };

            // PRINT SETTINGS

            ws["!pageSetup"] = {
                orientation: "landscape",
                fitToWidth: 1
            };

            // RANGE

            ws["!ref"] = XLSX.utils.encode_range({
                s: {
                    r: 0,
                    c: 0
                },
                e: {
                    r: row,
                    c: 8
                }
            });

            XLSX.utils.book_append_sheet(wb, ws, "Payment Collection");

            XLSX.writeFile(wb, "Payment_Collection_Report.xlsx");

        });



    });
    </script>