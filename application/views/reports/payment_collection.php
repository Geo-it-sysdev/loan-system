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


                            <div class="table-responsive">

                                <table class="table table-striped align-middle w-100 nowrap"
                                    id="PaymentCollectionTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Receipt No.</th>
                                            <th>Payment Date</th>
                                            <th>Reference No.</th>
                                            <th>Borrower Name</th>
                                            <th>Amount Paid</th>
                                            <th>Principal Paid</th>
                                            <th>Interest Paid</th>
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

        $('#PaymentCollectionTable').DataTable({
            ajax: {
                url: "<?= base_url('payment_collection') ?>",
                type: "POST",
                dataSrc: "data"
            },

            order: [
                [1, "desc"]
            ],

            columns: [{
                    data: "receipt_no",
                    render: function(data) {
                        return data ? `<span class="fw-bold"> # ${data}</span>` : '-';
                    }
                },
                {
                    data: "date_payment",
                    render: function(data) {
                        return data ? data : '-';
                    }
                },
                {
                    data: "reference_no"
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
                {
                    data: "principal_paid",
                    render: function(data) {
                        return parseFloat(data).toLocaleString(undefined, {
                            minimumFractionDigits: 2
                        });
                    }
                },
                {
                    data: "interest_paid",
                    render: function(data) {
                        return parseFloat(data || 0).toFixed(2);
                    }
                },
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

    });
    </script>