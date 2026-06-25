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

        $('#LoanReleaseTable').DataTable({
            ajax: {
                url: "<?= base_url('released_loans') ?>",
                type: "POST",
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
                        ${parseFloat(data).toLocaleString(undefined, {
                            minimumFractionDigits: 2
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
                        return data + '%';
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




    });
    </script>