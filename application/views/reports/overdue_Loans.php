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


                            <div class="table-responsive">

                                <table class="table table-striped align-middle w-100 nowrap" id="OverdueTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Reference Number</th>
                                            <th>Borrower Name</th>
                                            <th>Due Date</th>
                                            <th>Days Overdue</th>
                                            <th>Monthly Amortization</th>
                                            <th>Penalty</th>
                                            <th>Total Due</th>
                                            <!-- <th>Action</th> -->
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

        $('#OverdueTable').DataTable({
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

    });
    </script>