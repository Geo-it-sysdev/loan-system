<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home </a></li>
                                <li class="breadcrumb-item active">Dashboard </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="d-flex flex-column h-100">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <a href="<?= base_url('Borrowers') ?>" class="text-decoration-none">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="fw-medium text-muted mb-0">Total Borrowers </p>
                                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                        data-target-borrowers>0</span>
                                                </h2>
                                                <p class="mb-0 text-muted"><span
                                                        class="badge bg-light text-primary mb-0"><i
                                                            class="ri-arrow-up-line align-middle"></i>total active
                                                        borrowers
                                                    </span> </p>
                                            </div>
                                            <div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded-circle fs-2">
                                                        <i class="ri-group-fill text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium text-muted mb-0">Total Loan Release</p>
                                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                    data-target-release>0</span>
                                            </h2>
                                            <p class="mb-0 text-muted"><span class="badge bg-light text-secondary mb-0">
                                                    <i class="ri-line-chart-line align-middle"></i> total loan release
                                                </span></p>
                                        </div>
                                        <div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-secondary-subtle rounded-circle fs-2">
                                                    <i class="ri-hand-coin-line text-secondary"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <a href="<?= base_url('Outstanding-Balance') ?>" class="text-decoration-none">

                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="fw-medium text-muted mb-0">Total Outstanding Balance</p>

                                                <h2 class="mt-4 ff-secondary fw-semibold">
                                                    <span class="counter-value" data-target-remaining="0">0</span>
                                                </h2>

                                                <p class="mb-0 text-muted">
                                                    <span class="badge bg-light text-info mb-0">
                                                        <i class="ri-stock-line align-middle"></i>
                                                        total outstanding balance
                                                    </span>
                                                </p>
                                            </div>

                                            <div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-warning-subtle rounded-circle fs-2">
                                                        <i class="ri-wallet-3-line text-warning"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <a href="<?= base_url('Fully-Paid') ?>" class="text-decoration-none">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="fw-medium text-muted mb-0">Total Paid </p>
                                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                        data-target-paid>0</span>
                                                </h2>
                                                <p class="mb-0 text-muted"><span
                                                        class="badge bg-light text-success mb-0">
                                                        <i class="ri-bar-chart-grouped-line align-middle"></i> total
                                                        loan
                                                        paid
                                                    </span> </p>
                                            </div>
                                            <div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-success-subtle rounded-circle fs-2">
                                                        <i class="ri-money-dollar-circle-line text-success"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div><!-- end card body -->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div> <!-- end col-->
                </div> <!-- end row-->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <script>
        $(document).ready(function() {

            function loadDashboardStats() {
                $.ajax({
                    url: "<?= base_url('get_dashboard_stats') ?>",
                    type: "GET",
                    dataType: "json",
                    success: function(res) {
                        if (res.status) {

                            $('[data-target-borrowers]').text(res.total_borrowers);

                            $('[data-target-release]').text(res.total_release);

                            $('[data-target-remaining]').text(res.remaining_balance);

                            $('[data-target-paid]').text(res.total_paid);
                        }
                    }
                });
            }

            loadDashboardStats();

        });
        </script>