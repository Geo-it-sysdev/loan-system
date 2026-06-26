<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Monthly Collection Report</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Monthly Collection Report</li>
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

                        <!-- Card Header -->
                        <div class="card-header py-3">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                <!-- Title -->
                                <div>
                                    <h4 class="card-title mb-0 fw-bold">
                                        Monthly Revenue
                                    </h4>
                                </div>

                                <!-- Right Controls -->
                                <div class="d-flex flex-wrap align-items-center gap-3">

                                    <!-- Year Filter -->
                                    <div class="dropdown">
                                        <a href="#" class="d-flex align-items-center text-decoration-none text-reset"
                                            data-bs-toggle="dropdown" aria-expanded="false">

                                            <span class="fw-semibold text-uppercase text-muted me-2">
                                                Filter by Year
                                            </span>

                                            <span class="badge bg-primary fs-6 px-3 py-2" id="selectedYear">
                                                <?= date('Y'); ?>
                                            </span>

                                            <i class="ri-arrow-down-s-line fs-5 ms-2"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" id="yearDropdown">
                                            <?php for ($year = date('Y'); $year >= 2025; $year--) : ?>
                                            <li>
                                                <a class="dropdown-item year-filter <?= $year == date('Y') ? 'active' : '' ?>"
                                                    href="#" data-year="<?= $year; ?>">
                                                    <?= $year; ?>
                                                </a>
                                            </li>
                                            <?php endfor; ?>
                                        </ul>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="btn-group" role="group">

                                        <button type="button" id="btnExcel" class="btn btn-success btn-sm me-2">
                                            <i class="ri-file-excel-2-fill me-2"></i>
                                            Generate Excel
                                        </button>

                                        <button type="button" id="btnPDF" class="btn btn-danger btn-sm">
                                            <i class="ri-file-pdf-2-fill me-1"></i>
                                            Generate PDF
                                        </button>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped align-middle w-100 nowrap"
                                    id="MonthlyCollectionTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Month</th>
                                            <th>Principal Collected</th>
                                            <th>Interest Collected</th>
                                            <th>Penalties Collected</th>
                                            <th>Total Collection</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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

        let selectedYear = "<?= date('Y'); ?>";

        var table = $('#MonthlyCollectionTable').DataTable({
            ajax: {
                url: "<?= base_url('monthly_collection') ?>",
                type: "POST",
                data: function(d) {
                    d.year = selectedYear;
                },
                dataSrc: "data"
            },

            order: [
                [0, "asc"]
            ],

            columns: [{
                    data: "month",
                    render: function(data, type) {

                        if (type === 'sort') {
                            const date = new Date('1 ' + data);
                            return date.getFullYear() * 100 + (date.getMonth() + 1);
                        }

                        return data;
                    }
                },
                {
                    data: "principal_collected",
                    render: function(data) {

                        let value = parseFloat(
                            String(data || 0).replace(/,/g, '')
                        );

                        return `<span class="fw-bold text-primary">
                            ₱${value.toLocaleString(undefined, {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            })}
                        </span>`;
                    }
                },
                {
                    data: "interest_collected",
                    render: function(data) {
                        return `<span class="fw-bold text-success">
                            ₱${parseFloat(data || 0).toLocaleString(undefined,{
                                minimumFractionDigits:2,
                                maximumFractionDigits:2
                            })}
                        </span>`;
                    }
                },
                {
                    data: "penalties_collected",
                    render: function(data) {
                        return `<span class="fw-bold text-danger">
                            ₱${parseFloat(data || 0).toLocaleString(undefined,{
                                minimumFractionDigits:2,
                                maximumFractionDigits:2
                            })}
                        </span>`;
                    }
                },
                {
                    data: "total_collection",
                    render: function(data) {
                        return `<span class="fw-bold">
                            ₱${parseFloat(data || 0).toLocaleString(undefined,{
                                minimumFractionDigits:2,
                                maximumFractionDigits:2
                            })}
                        </span>`;
                    }
                }
            ]
        });

        // Year Filter Click
        $(document).on('click', '.year-filter', function(e) {
            e.preventDefault();

            selectedYear = $(this).data('year');

            $('#selectedYear').text(selectedYear);

            $('.year-filter').removeClass('active');
            $(this).addClass('active');

            table.ajax.reload();
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

            let table = $('#MonthlyCollectionTable').DataTable();
            let rows = table.rows({
                search: 'applied'
            }).data().toArray();

            let body = [];

            let totalPrincipal = 0;
            let totalInterest = 0;
            let totalPenalty = 0;
            let grandTotal = 0;

            rows.forEach(function(r) {

                totalPrincipal += parseFloat(r.principal_collected || 0);
                totalInterest += parseFloat(r.interest_collected || 0);
                totalPenalty += parseFloat(r.penalties_collected || 0);
                grandTotal += parseFloat(r.total_collection || 0);

                body.push([
                    r.month,
                    "P " + parseFloat(r.principal_collected || 0).toLocaleString(
                        undefined, {
                            minimumFractionDigits: 2
                        }),
                    "P " + parseFloat(r.interest_collected || 0).toLocaleString(
                        undefined, {
                            minimumFractionDigits: 2
                        }),
                    "P " + parseFloat(r.penalties_collected || 0).toLocaleString(
                        undefined, {
                            minimumFractionDigits: 2
                        }),
                    "P " + parseFloat(r.total_collection || 0).toLocaleString(
                        undefined, {
                            minimumFractionDigits: 2
                        })
                ]);
            });

            body.push([{
                    content: "GRAND TOTAL",
                    styles: {
                        halign: 'right',
                        fontStyle: 'bold'
                    }
                },
                "P " + totalPrincipal.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                }),
                "P " + totalInterest.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                }),
                "P " + totalPenalty.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                }),
                "P " + grandTotal.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                })
            ]);

            doc.setFillColor(22, 55, 108);
            doc.rect(0, 0, 297, 25, 'F');

            doc.setTextColor(255, 255, 255);
            doc.setFontSize(18);
            doc.setFont(undefined, 'bold');
            doc.text("MONTHLY COLLECTION REPORT", 148, 10, {
                align: 'center'
            });

            doc.setFontSize(12);
            doc.text("LOAN MANAGEMENT SYSTEM", 148, 18, {
                align: 'center'
            });

            doc.setTextColor(0);

            doc.setFontSize(10);
            doc.text("Year : " + selectedYear, 14, 32);
            doc.text("Generated : " + new Date().toLocaleString(), 230, 32);

            doc.autoTable({

                startY: 38,

                head: [
                    [
                        "Month",
                        "Principal",
                        "Interest",
                        "Penalty",
                        "Total Collection"
                    ]
                ],

                body: body,

                theme: 'grid',

                headStyles: {
                    fillColor: [22, 55, 108],
                    textColor: 255,
                    halign: 'center',
                    fontStyle: 'bold'
                },

                bodyStyles: {
                    halign: 'right'
                },

                columnStyles: {
                    0: {
                        halign: 'left'
                    }
                },

                alternateRowStyles: {
                    fillColor: [245, 245, 245]
                },

                didDrawPage: function(data) {

                    doc.setFontSize(9);

                    doc.text(
                        "Page " + doc.internal.getNumberOfPages(),
                        data.settings.margin.left,
                        doc.internal.pageSize.height - 8
                    );

                }

            });

            const pdfBlob = doc.output("blob");
            const blobUrl = URL.createObjectURL(pdfBlob);
            console.log(blobUrl);
            window.open(blobUrl);

        });




        $('#btnExcel').click(function() {

            let table = $('#MonthlyCollectionTable').DataTable();
            let rows = table.rows({
                search: 'applied'
            }).data().toArray();

            let data = [];

            data.push([
                "MONTHLY COLLECTION REPORT "
            ]);

            data.push([
                "LOAN MANAGEMENT SYSTEM"
            ]);

            data.push([]);

            data.push([
                "Year",
                selectedYear
            ]);

            data.push([
                "Generated",
                new Date().toLocaleString()
            ]);

            data.push([]);

            data.push([
                "Month",
                "Principal",
                "Interest",
                "Penalty",
                "Total Collection"
            ]);

            let totalPrincipal = 0;
            let totalInterest = 0;
            let totalPenalty = 0;
            let grandTotal = 0;

            rows.forEach(function(r) {

                totalPrincipal += parseFloat(r.principal_collected || 0);
                totalInterest += parseFloat(r.interest_collected || 0);
                totalPenalty += parseFloat(r.penalties_collected || 0);
                grandTotal += parseFloat(r.total_collection || 0);

                data.push([
                    r.month,
                    parseFloat(r.principal_collected || 0),
                    parseFloat(r.interest_collected || 0),
                    parseFloat(r.penalties_collected || 0),
                    parseFloat(r.total_collection || 0)
                ]);

            });

            data.push([
                "GRAND TOTAL",
                totalPrincipal,
                totalInterest,
                totalPenalty,
                grandTotal
            ]);

            let ws = XLSX.utils.aoa_to_sheet(data);

            ws['!cols'] = [{
                    wch: 20
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
                    wch: 20
                }
            ];

            const currency = '#,##0.00';

            for (let r = 8; r <= rows.length + 8; r++) {

                ['B', 'C', 'D', 'E'].forEach(function(col) {

                    let cell = ws[col + r];

                    if (cell) {

                        cell.z = currency;

                    }

                });

            }

            ws['A1'].s = {
                font: {
                    bold: true,
                    sz: 18,
                    color: {
                        rgb: "FFFFFF"
                    }
                },
                fill: {
                    fgColor: {
                        rgb: "1F4E78"
                    }
                },
                alignment: {
                    horizontal: "center"
                }
            };

            ws['A2'].s = {
                font: {
                    bold: true,
                    sz: 14
                },
                alignment: {
                    horizontal: "center"
                }
            };

            ['A7', 'B7', 'C7', 'D7', 'E7'].forEach(function(c) {

                ws[c].s = {

                    font: {
                        bold: true,
                        color: {
                            rgb: "FFFFFF"
                        }
                    },

                    fill: {
                        fgColor: {
                            rgb: "1F4E78"
                        }
                    },

                    alignment: {
                        horizontal: "center"
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

            let last = rows.length + 8;

            ['A' + last, 'B' + last, 'C' + last, 'D' + last, 'E' + last].forEach(function(c) {

                if (ws[c]) {

                    ws[c].s = {

                        font: {
                            bold: true
                        },
                        font: {
                            bold: true,
                            color: {
                                rgb: "FFFFFF"
                            }
                        },

                        fill: {
                            fgColor: {
                                rgb: "1F4E78"
                            }
                        }

                    };

                }

            });

            ws['!merges'] = [

                {
                    s: {
                        r: 0,
                        c: 0
                    },
                    e: {
                        r: 0,
                        c: 4
                    }
                },
                {
                    s: {
                        r: 1,
                        c: 0
                    },
                    e: {
                        r: 1,
                        c: 4
                    }
                }

            ];

            let wb = XLSX.utils.book_new();

            XLSX.utils.book_append_sheet(wb, ws, "Monthly Collection");

            XLSX.writeFile(
                wb,
                "Monthly_Collection_Report_" + selectedYear + ".xlsx"
            );

        });

    });
    </script>