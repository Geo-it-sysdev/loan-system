<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Collector</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Collector</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row g-3">
                <!-- ================= LEFT SIDE ================= -->
                <div class="col-12 col-lg-3">
                    <!-- PHOTO CARD -->
                    <div class="card mb-3">

                        <div class="card-body text-center p-4">

                            <div class="position-relative d-inline-block">
                                <img id="photoPreview" src="<?= base_url('assets/images/user.png') ?>"
                                    class="rounded-circle img-thumbnail"
                                    style="width:150px;height:150px;object-fit:cover;" alt="photo">

                                <button type="button" class="btn btn-primary btn-sm position-absolute"
                                    style="bottom:5px;right:5px;width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;"
                                    onclick="document.getElementById('photo').click();">

                                    <i class="ri-camera-line"></i>
                                </button>
                            </div>

                            <h6 class="mt-3 mb-0">Collector Photo</h6>
                            <small class="text-muted">Click camera to upload</small>

                        </div>
                    </div>

                    <!-- FORM CARD -->
                    <div class="card">
                        <div class="card-body">

                            <form id="collectorForm" enctype="multipart/form-data">

                                <input type="file" id="photo" name="photo" accept="image/*" hidden>
                                <input type="hidden" name="collector_id" id="collector_id">

                                <div class="mb-2">
                                    <label>Full Name</label>
                                    <input type="text" name="fullname" class="form-control "
                                        placeholder="Enter full name" required>
                                </div>

                                <div class="mb-2">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control " placeholder="Enter complete address"
                                        rows="3" required></textarea>
                                </div>

                                <div class="mb-2">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control "
                                        placeholder="Enter email address" required>
                                </div>

                                <div class="mb-3">
                                    <label>Contact No.</label>
                                    <input type="text" name="contact" class="form-control "
                                        placeholder="Enter contact number" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm w-100">
                                    <i class="ri-add-line"></i> Add Collector
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
                                <table class="table table-striped align-middle" id="CollectorTable">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Contact No.</th>
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

        $('#photo').on('change', function(e) {

            const file = e.target.files[0];

            if (!file) return;

            if (!file.type.match('image.*')) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid File',
                    text: 'Please select an image file only.'
                });

                $('#photo').val('');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                $('#photoPreview').attr('src', e.target.result);
            };

            reader.readAsDataURL(file);
        });


        let table = $('#CollectorTable').DataTable({
            processing: true,
            responsive: true,
            pageLength: 10,
            destroy: true,
            autoWidth: false,

            ajax: {
                url: "<?= base_url('get_collectors') ?>",
                type: "GET",
                dataSrc: ""
            },

            columns: [{
                    data: "photo",
                    render: function(data) {

                        let photo = data ?
                            data :
                            "<?= base_url('assets/images/user.png') ?>";

                        return `
                        <img src="${photo}"
                            width="45"
                            height="45"
                            class="rounded-circle border"
                            style="object-fit:cover;">
                    `;
                    }
                },
                {
                    data: "fullname"
                },
                {
                    data: "address"
                },
                {
                    data: "email"
                },
                {
                    data: "contact_no"
                },
                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {

                        return `
                        <button type="button"
                            class="btn btn-sm btn-primary btn-edit"
                            data-id="${row.id}"
                            data-fullname="${row.fullname}"
                            data-address="${row.address}"
                            data-email="${row.email}"
                            data-contact="${row.contact_no}"
                            data-photo="${row.photo}">
                            <i class="ri-edit-line me-1"></i> Edit
                        </button>

                        <button type="button"
                            class="btn btn-sm btn-danger btn-delete"
                            data-id="${row.id}"
                            data-photo="${row.photo}">
                            <i class="ri-delete-bin-line me-1"></i> Delete
                        </button>
                    `;
                    }
                }
            ]
        });


        // EDIT COLLECTOR
        $(document).on('click', '.btn-edit', function() {

            let id = $(this).data('id');
            let fullname = $(this).data('fullname');
            let address = $(this).data('address');
            let email = $(this).data('email');
            let contact = $(this).data('contact');
            let photo = $(this).data('photo');

            $('#collector_id').val(id);

            $('input[name="fullname"]').val(fullname);
            $('textarea[name="address"]').val(address);
            $('input[name="email"]').val(email);
            $('input[name="contact"]').val(contact);

            if (photo && photo !== '') {
                $('#photoPreview').attr('src', photo);
            } else {
                $('#photoPreview').attr(
                    'src',
                    '<?= base_url("assets/images/user.png") ?>'
                );
            }

            $('button[type="submit"]')
                .removeClass('btn-primary')
                .addClass('btn-success')
                .html('<i class="ri-save-line me-1"></i> Update Collector');

            $('html, body').animate({
                scrollTop: $("#collectorForm").offset().top - 100
            }, 500);
        });


        // FORM SUBMIT (ADD / UPDATE)
        $('#collectorForm').on('submit', function(e) {

            e.preventDefault();

            let collector_id = $('#collector_id').val();

            let url = collector_id ?
                "<?= site_url('update_collector') ?>" :
                "<?= site_url('add_collector') ?>";

            let formData = new FormData(this);

            let photoFile = $('#photo')[0].files[0];

            if (photoFile) {
                formData.append('photo', photoFile);
            }

            $.ajax({

                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                dataType: "json",

                beforeSend: function() {

                    $('button[type="submit"]')
                        .prop('disabled', true)
                        .html(
                            '<i class="ri-loader-4-line ri-spin me-1"></i> Saving...'
                        );
                },

                success: function(response) {

                    if (response.status === 'success') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $('#collectorForm')[0].reset();

                        $('#collector_id').val('');

                        $('#photo').val('');

                        $('#photoPreview').attr(
                            'src',
                            '<?= base_url("assets/images/user.png") ?>'
                        );

                        $('button[type="submit"]')
                            .removeClass('btn-success')
                            .addClass('btn-primary')
                            .html(
                                '<i class="ri-add-line me-1"></i> Add Collector'
                            );

                        table.ajax.reload(null, false);

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },

                error: function(xhr) {

                    console.log(xhr.responseText);

                    Swal.fire({
                        icon: 'error',
                        title: 'Request Failed',
                        text: 'Something went wrong.'
                    });
                },

                complete: function() {

                    let isEdit = $('#collector_id').val() !== '';

                    if (isEdit) {

                        $('button[type="submit"]')
                            .prop('disabled', false)
                            .html(
                                '<i class="ri-save-line me-1"></i> Update Collector'
                            );

                    } else {

                        $('button[type="submit"]')
                            .prop('disabled', false)
                            .html(
                                '<i class="ri-add-line me-1"></i> Add Collector'
                            );
                    }
                }
            });

        });


        // CANCEL EDIT
        $('#btnCancelEdit').on('click', function() {

            $('#collectorForm')[0].reset();

            $('#collector_id').val('');

            $('#photo').val('');

            $('#photoPreview').attr(
                'src',
                '<?= base_url("assets/images/user.png") ?>'
            );

            $('button[type="submit"]')
                .removeClass('btn-success')
                .addClass('btn-primary')
                .html('<i class="ri-add-line me-1"></i> Add Collector');
        });


        // DELETE COLLECTOR
        $(document).on('click', '.btn-delete', function() {

            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this Collector?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= site_url('delete_collector') ?>",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "json",

                        success: function(response) {

                            if (response.status === 'success') {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                table.ajax.reload(null, false);

                                $('#collectorForm')[0].reset();
                                $('#collector_id').val('');
                                $('#photo').val('');

                                $('#photoPreview').attr(
                                    'src',
                                    '<?= base_url("assets/images/user.png") ?>'
                                );

                                $('button[type="submit"]')
                                    .removeClass('btn-success')
                                    .addClass('btn-primary')
                                    .html(
                                        '<i class="ri-add-line me-1"></i> Add Collector'
                                    );

                            } else {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message
                                });
                            }
                        },

                        error: function() {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Unable to delete collector.'
                            });
                        }
                    });

                }

            });

        });



    });
    </script>