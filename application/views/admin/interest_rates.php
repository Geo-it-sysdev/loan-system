<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Interest Rates</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Interest Rates</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row g-5">
                <!-- ================= LEFT SIDE ================= -->
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body">

                            <form id="InterestRateForm" enctype="multipart/form-data">
                                <div class="mb-2">
                                    <label>Interest Rate</label>
                                    <input type="number" name="interest_rate" class="form-control "
                                        placeholder="Enter interest rate" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm w-100">
                                    <i class="ri-add-line"></i> Add Interest Rate
                                </button>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- ================= RIGHT SIDE ================= -->
                <div class="col-12 col-lg-9">

                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped align-middle" id="InterestRateTable">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Interest Rate No.</th>
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
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    
    <script>
    $(document).ready(function() {

        var InterestRateTable = $('#InterestRateTable').DataTable({
            processing: true,
            responsive: true,
            destroy: true,
            scrollX: false,
            autoWidth: false,
            ajax: {
                url: "<?= base_url('fetch_interest_rate'); ?>",
                type: "GET",
                dataSrc: "data"
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: "interest_rate",
                    render: function(data) {
                        return data + "%";
                    }
                },
                {
                    data: "id",
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                    render: function(data) {
                        return `
                        <button type="button"
                            class="btn btn-danger btn-sm deleteInterest"
                            data-id="${data}">
                            <i class="ri-delete-bin-line me-1"></i> Delete
                        </button>
                    `;
                    }
                }
            ]
        });

        $('#InterestRateForm').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                url: "<?= base_url('add_interest_rate'); ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {

                    $('#InterestRateForm button[type="submit"]')
                        .prop('disabled', true)
                        .html('<i class="ri-loader-4-line ri-spin"></i> Saving...');
                },
                success: function(res) {

                    if (res.status) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $('#InterestRateForm')[0].reset();
                        InterestRateTable.ajax.reload(null, false);

                    } else {

                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: res.message
                        });
                    }
                },
                error: function() {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Server error occurred.'
                    });
                },
                complete: function() {

                    $('#InterestRateForm button[type="submit"]')
                        .prop('disabled', false)
                        .html('<i class="ri-add-line"></i> Add Interest Rate');
                }
            });

        });

        $(document).on('click', '.deleteInterest', function() {

            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this Interest Rate?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('delete_interest_rate'); ?>",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(res) {

                            if (res.status) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted',
                                    text: 'Interest Rate Deleted Successfully',
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                InterestRateTable.ajax.reload(null, false);

                            } else {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Delete failed.'
                                });
                            }
                        },
                        error: function() {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Server error occurred.'
                            });
                        }
                    });

                }

            });

        });

    });
    </script>