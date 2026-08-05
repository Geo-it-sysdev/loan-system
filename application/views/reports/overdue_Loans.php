<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Overdue Loan Report</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Overdue Loan Report</li>
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
                                    <i class="ri-file-excel-2-fill me-1"></i>Generate Excel
                                </button>

                                <button type="button" id="btnPDF" class="btn btn-danger btn-sm">
                                    <i class="ri-file-pdf-2-fill me-1"></i>Generate PDF
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped align-middle w-100 nowrap" id="OverdueTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Reference Number</th>
                                            <th>Borrower Name</th>
                                            <th>Contact No.</th>
                                            <th>Due Date</th>
                                            <th>Days Overdue</th>
                                            <th>Monthly Amortization</th>
                                            <th>Penalty</th>
                                            <th>Total Due</th>
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

        var overdueTable = $('#OverdueTable').DataTable({
            processing: true,
            responsive: true,
            destroy: true,
            autoWidth: false,
            ordering: false,
            ajax: {
                url: "<?= base_url('overdue_loans') ?>",
                type: "GET",
                dataSrc: "data"
            },
            columns: [{
                    data: "ref_no"
                },
                {
                    data: "borrower_name"
                },
                {
                    data: "contact_no"
                },
                {
                    data: "due_date",
                    render: function(data) {
                        return '<span class="text-danger">' + (data ?? '') + '</span>';
                    }
                },
                {
                    data: "days_overdue"
                },
                {
                    data: "monthly_payment",
                    render: function(data) {
                        return "₱ " + parseFloat(data).toFixed(2);
                    }
                },
                {
                    data: "penalty",
                    render: function(data) {
                        return "₱ " + parseFloat(data).toFixed(2);
                    }
                },
                {
                    data: "total_due",
                    render: function(data) {
                        return "₱ " + parseFloat(data).toFixed(2);
                    }
                }
                // ,
                // {
                //     data: null,
                //     render: function(row) {
                //         return `
                //         <button class="btn btn-sm btn-success btn-pay"
                //             data-id="${row.id}">
                //            <i class="ri-printer-fill"></i> Print
                //         </button>
                //     `;
                //     }
                // }
            ]
        });


        // GENERATE PDF
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
            doc.text("OVERDUE LOANS REPORT", 165, 15, {
                align: "center"
            });

            doc.setFontSize(12);
            doc.setFont("helvetica", "normal");
            doc.text("Loan Management System", 165, 22, {
                align: "center"
            });

            doc.setDrawColor(100);
            doc.setLineWidth(0.5);
            doc.line(8, 28, 322, 28);

            doc.setFontSize(9);
            doc.text("Generated : " + new Date().toLocaleString(), 8, 34);

            // DATA
            let rows = [];
            let grandTotal = 0;

            overdueTable.rows().every(function() {

                let d = this.data();

                grandTotal += parseFloat(d.total_due);

                rows.push([
                    d.ref_no,
                    d.borrower_name,
                    d.contact_no,
                    d.due_date,
                    d.days_overdue,
                    "P " + parseFloat(d.monthly_payment).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }),
                    "P " + parseFloat(d.penalty).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }),
                    "P " + parseFloat(d.total_due).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })
                ]);

            });

            // TABLE
            doc.autoTable({

                startY: 40,

                head: [
                    [
                        "Reference No.",
                        "Borrower Name",
                        "Contact No",
                        "Due Date",
                        "Days Overdue",
                        "Monthly Payment",
                        "Penalty",
                        "Total Due"
                    ]
                ],

                body: rows,

                foot: [
                    [
                        "",
                        "",
                        "",
                        "",
                        "",
                        "",
                        "GRAND TOTAL",
                        "P " + grandTotal.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })
                    ]
                ],

                theme: "grid",

                margin: {
                    left: 8,
                    right: 8
                },

                tableWidth: "auto",

                styles: {
                    font: "helvetica",
                    fontSize: 9,
                    cellPadding: 2.5,
                    overflow: "linebreak",
                    valign: "middle",
                    lineWidth: 0.1
                },

                headStyles: {
                    fillColor: [33, 37, 41],
                    textColor: 255,
                    fontStyle: "bold",
                    halign: "center",
                    valign: "middle",
                    fontSize: 10
                },

                bodyStyles: {
                    textColor: 0
                },

                alternateRowStyles: {
                    fillColor: [245, 245, 245]
                },

                footStyles: {
                    fillColor: [33, 37, 41],
                    textColor: 255,
                    fontStyle: "bold",
                    fontSize: 10,
                    halign: "right"
                },

                columnStyles: {

                    0: {
                        cellWidth: 38
                    },

                    1: {
                        cellWidth: 67
                    },

                    2: {
                        cellWidth: 30
                    },

                    3: {
                        cellWidth: 32,
                        halign: "center"
                    },

                    4: {
                        cellWidth: 30,
                        halign: "center"
                    },

                    5: {
                        cellWidth: 40,
                        halign: "right"
                    },

                    6: {
                        cellWidth: 35,
                        halign: "right"
                    },

                    7: {
                        cellWidth: 40,
                        halign: "right"
                    }

                }

            });

            // FOOTER
            const pages = doc.internal.getNumberOfPages();

            for (let i = 1; i <= pages; i++) {

                doc.setPage(i);

                doc.setFontSize(8);

                doc.text(
                    "Page " + i + " of " + pages,
                    312,
                    208
                );

            }

            // OPEN PDF (BLOB)
            const blob = doc.output("blob");
            const url = URL.createObjectURL(blob);

            window.open(url, "_blank");

            setTimeout(function() {
                URL.revokeObjectURL(url);
            }, 60000);

        });



        // GENERATE EXCEL
        $('#btnExcel').on('click', function() {

            let wb = XLSX.utils.book_new();
            let ws_data = [];

            // ==========================
            // REPORT HEADER
            // ==========================
            ws_data.push(["OVERDUE LOANS REPORT"]);
            ws_data.push(["Loan Management System"]);
            ws_data.push(["Generated: " + new Date().toLocaleString()]);
            ws_data.push([]);

            // ==========================
            // COLUMN HEADERS
            // ==========================
            ws_data.push([
                "Reference No.",
                "Borrower Name",
                "Contact No.",
                "Due Date",
                "Days Overdue",
                "Monthly Payment",
                "Penalty",
                "Total Due"
            ]);

            let grandTotal = 0;

            // ==========================
            // TABLE DATA
            // ==========================
            overdueTable.rows().every(function() {

                let d = this.data();

                let monthlyPayment = parseFloat(d.monthly_payment) || 0;
                let penalty = parseFloat(d.penalty) || 0;
                let totalDue = parseFloat(d.total_due) || 0;

                grandTotal += totalDue;

                ws_data.push([
                    d.ref_no,
                    d.borrower_name,
                    d.contact_no,
                    d.due_date,
                    d.days_overdue,
                    monthlyPayment,
                    penalty,
                    totalDue
                ]);

            });

            // ==========================
            // FOOTER
            // ==========================
            ws_data.push([
                "",
                "",
                "",
                "",
                "",
                "",
                "GRAND TOTAL",
                grandTotal
            ]);

            // Create worksheet
            let ws = XLSX.utils.aoa_to_sheet(ws_data);

            // ==========================
            // MERGE TITLE CELLS
            // ==========================
            ws["!merges"] = [{
                    s: {
                        r: 0,
                        c: 0
                    },
                    e: {
                        r: 0,
                        c: 7
                    }
                },
                {
                    s: {
                        r: 1,
                        c: 0
                    },
                    e: {
                        r: 1,
                        c: 7
                    }
                },
                {
                    s: {
                        r: 2,
                        c: 0
                    },
                    e: {
                        r: 2,
                        c: 7
                    }
                }
            ];

            // ==========================
            // COLUMN WIDTHS
            // ==========================
            ws["!cols"] = [{
                    wch: 20
                }, // Reference
                {
                    wch: 30
                }, // Borrower
                {
                    wch: 18
                }, // Contact
                {
                    wch: 18
                }, // Due Date
                {
                    wch: 15
                }, // Days Overdue
                {
                    wch: 18
                }, // Monthly Payment
                {
                    wch: 18
                }, // Penalty
                {
                    wch: 18
                } // Total Due
            ];

            // ==========================
            // TITLE STYLE
            // ==========================
            if (ws["A1"]) {
                ws["A1"].s = {
                    font: {
                        bold: true,
                        sz: 18
                    },
                    alignment: {
                        horizontal: "center"
                    }
                };
            }

            if (ws["A2"]) {
                ws["A2"].s = {
                    font: {
                        bold: true,
                        sz: 12
                    },
                    alignment: {
                        horizontal: "center"
                    }
                };
            }

            if (ws["A3"]) {
                ws["A3"].s = {
                    font: {
                        italic: true
                    }
                };
            }

            // ==========================
            // HEADER STYLE
            // ==========================
            for (let c = 0; c <= 7; c++) {

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

            // ==========================
            // BODY STYLE
            // ==========================
            let lastRow = ws_data.length;

            for (let r = 5; r < lastRow; r++) {

                for (let c = 0; c <= 7; c++) {

                    let ref = XLSX.utils.encode_cell({
                        r: r,
                        c: c
                    });

                    if (!ws[ref]) continue;

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
                            horizontal: (c >= 4 ? "right" : "left")
                        }
                    };

                }

            }

            // ==========================
            // CURRENCY FORMAT
            // F = Monthly Payment
            // G = Penalty
            // H = Total Due
            // ==========================
            for (let r = 5; r < lastRow; r++) {

                [5, 6, 7].forEach(function(col) {

                    let ref = XLSX.utils.encode_cell({
                        r: r,
                        c: col
                    });

                    if (ws[ref]) {
                        ws[ref].z = '"₱" #,##0.00';
                    }

                });

            }

            // ==========================
            // GRAND TOTAL STYLE
            // ==========================
            let totalRow = lastRow - 1;

            ["G", "H"].forEach(function(col) {

                let ref = col + (totalRow + 1);

                if (!ws[ref]) return;

                ws[ref].s = {
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
                        horizontal: "right"
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

            });

            if (ws["H" + (totalRow + 1)]) {
                ws["H" + (totalRow + 1)].z = '"₱" #,##0.00';
            }

            // ==========================
            // EXPORT
            // ==========================
            XLSX.utils.book_append_sheet(wb, ws, "Overdue Loans");

            XLSX.writeFile(wb, "Overdue_Loans_Report.xlsx");

        });



    });
    </script>