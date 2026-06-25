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
                        <div class="card-header">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <h4 class="card-title mb-0">Monthly Revenue</h4>

                                <div class="dropdown">
                                    <a class="text-reset dropdown-btn d-flex align-items-center gap-1 text-decoration-none"
                                        href="#" data-bs-toggle="dropdown" aria-expanded="false">

                                        <span class="fw-semibold text-uppercase fs-12">
                                            Filter By Year:
                                        </span>

                                        <span class="text-muted" id="selectedYear">
                                            <?= date('Y'); ?>
                                        </span>

                                        <i class="ri-arrow-down-s-line"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end" id="yearDropdown">
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

    });
    </script>