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
                <div class="col-12 col-lg-4">
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
                                <h6 class="fw-semibold text-primary mb-3">Personal Information</h6>
                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="fullname" class="form-control"
                                        placeholder="Enter full name" required>
                                </div>

                                <!-- Username & Collector Type -->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="Enter username" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Collector Type</label>
                                        <select name="collector_type" class="form-select" required>
                                            <option value="">Select Collector Type</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="mt-3">
                                    <h6 class="fw-semibold text-primary mb-3">Address Information</h6>

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Province</label>
                                            <input type="text" class="form-control" value="Bohol" readonly
                                                style="cursor:not-allowed;">
                                            <input type="hidden" name="Province" value="Bohol">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Municipality</label>
                                            <select id="municipality" class="form-select" required>
                                                <option value="">Select Municipality</option>
                                            </select>
                                            <input type="hidden" name="municipalities" id="municipality_name">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Barangay</label>
                                            <select name="baranggay" id="barangay" class="form-select" required>
                                                <option value="">Select Barangay</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Purok</label>
                                            <select name="Purok" class="form-select" required>
                                                <option value="">Select Purok</option>
                                                <option value="Purok 1">Purok 1</option>
                                                <option value="Purok 2">Purok 2</option>
                                                <option value="Purok 3">Purok 3</option>
                                                <option value="Purok 4">Purok 4</option>
                                                <option value="Purok 5">Purok 5</option>
                                                <option value="Purok 6">Purok 6</option>
                                                <option value="Purok 7">Purok 7</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="mt-4">
                                    <h6 class="fw-semibold text-primary mb-3">Contact Information</h6>

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter email address" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Contact Number</label>
                                            <input type="text" name="contact" class="form-control"
                                                placeholder="Enter contact number" required>
                                        </div>

                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ri-add-line me-1"></i> Add Collector
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- ================= RIGHT SIDE ================= -->
                <div class="col-12 col-lg-8">

                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped align-middle w-100 nowrap" id="CollectorTable">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Collector Type</th>
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
                        let photo = data ? data : "<?= base_url('assets/images/user.png') ?>";

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
                    data: "username"
                },
                {
                    data: "collector_type"
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
                    data: "date_created",
                    visible: false,
                    searchable: false
                },

                {
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                    <button type="button"
                        class="btn btn-sm btn-primary btn-edit me-1"
                        data-id="${row.id}"
                        data-fullname="${row.fullname}"
                        data-username="${row.username}"
                        data-collector_type="${row.collector_type}"
                        data-address="${row.address}"
                        data-email="${row.email}"
                        data-contact="${row.contact_no}"
                        data-photo="${row.photo}">
                        <i class="ri-edit-line me-2"></i> Edit
                    </button>

                    <button type="button"
                        class="btn btn-sm btn-danger btn-delete"
                        data-id="${row.id}"
                        data-photo="${row.photo}">
                        <i class="ri-delete-bin-line me-2"></i> Delete
                    </button>
                `;
                    }
                }
            ],

            order: [
                [7, "asc"]
            ]
        });


        // EDIT COLLECTOR
        $(document).on('click', '.btn-edit', function() {

            let id = $(this).data('id');
            let fullname = $(this).data('fullname');
            let username = $(this).data('username');
            let collector_type = $(this).data('collector_type');
            let address = $(this).data('address');
            let email = $(this).data('email');
            let contact = $(this).data('contact');
            let photo = $(this).data('photo');

            $('#collector_id').val(id);

            $('input[name="fullname"]').val(fullname);
            $('input[name="username"]').val(username);
            $('select[name="collector_type"]').val(collector_type);
            $('input[name="email"]').val(email);
            $('input[name="contact"]').val(contact);


            if (address) {

                let parts = address.split(',');

                let purok = $.trim(parts[0]);
                let barangay = $.trim(parts[1]);
                let municipality = $.trim(parts[2]);

                $('select[name="Purok"]').val(purok);

                // Municipality
                $('#municipality option').each(function() {

                    if ($(this).data('name') == municipality) {

                        $(this).prop('selected', true);

                        $('#municipality_name').val(municipality);

                        let municipality_id = $(this).val();

                        // Load barangays
                        $.ajax({

                            url: "<?= base_url('get_barangays') ?>",
                            type: "POST",
                            data: {
                                municipality_id: municipality_id
                            },
                            dataType: "json",

                            success: function(res) {

                                let html =
                                    '<option value="">Select Barangay</option>';

                                $.each(res, function(i, row) {

                                    html += `
                                <option value="${row.name}">
                                    ${row.name}
                                </option>`;
                                });

                                $('#barangay').html(html);

                                $('#barangay').val(barangay);

                            }

                        });

                    }

                });

            }

            if (photo && photo != '') {

                $('#photoPreview').attr('src', photo);

            } else {

                $('#photoPreview').attr(
                    'src',
                    "<?= base_url('assets/images/user.png') ?>"
                );

            }

            $('button[type="submit"]')
                .removeClass('btn-primary')
                .addClass('btn-success')
                .html('<i class="ri-save-line me-1"></i> Update Collector');

            $('html,body').animate({
                scrollTop: $('#collectorForm').offset().top - 100
            }, 500);

        });


        // FORM SUBMIT (ADD / UPDATE)
        $('#collectorForm').submit(function(e) {

            e.preventDefault();

            let collector_id = $('#collector_id').val();

            let url = collector_id ?
                "<?= site_url('update_collector') ?>" :
                "<?= site_url('add_collector') ?>";

            let formData = new FormData(this);

            $.ajax({

                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",

                beforeSend: function() {

                    $('button[type="submit"]')
                        .prop('disabled', true)
                        .html('<i class="ri-loader-4-line ri-spin"></i> Saving...');

                },

                success: function(res) {

                    if (res.status == "success") {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $('#collectorForm')[0].reset();

                        $('#collector_id').val('');

                        $('#municipality_name').val('');

                        $('#barangay').html('<option value="">Select Barangay</option>');

                        $('#photo').val('');

                        $('#photoPreview').attr(
                            'src',
                            "<?= base_url('assets/images/user.png')?>"
                        );

                        $('button[type="submit"]')
                            .removeClass('btn-success')
                            .addClass('btn-primary')
                            .html('<i class="ri-add-line"></i> Add Collector');

                        table.ajax.reload(null, false);

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message
                        });

                    }

                },

                error: function(xhr) {

                    console.log(xhr.responseText);

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong.'
                    });

                },

                complete: function() {

                    $('button[type="submit"]')
                        .prop('disabled', false);

                    if ($('#collector_id').val()) {

                        $('button[type="submit"]').html(
                            '<i class="ri-save-line"></i> Update Collector');

                    } else {

                        $('button[type="submit"]').html(
                            '<i class="ri-add-line"></i> Add Collector');

                    }

                }

            });

        });


        $(document).ready(function() {

            $.ajax({
                url: "<?= site_url('get_municipalities') ?>",
                type: "GET",
                dataType: "json",

                success: function(res) {

                    console.log(res); 

                    let html = '<option value="">Select Municipality</option>';

                    $.each(res, function(i, row) {

                        html += `
                    <option value="${row.id}" data-name="${row.name}">
                        ${row.name}
                    </option>
                `;

                    });

                    $('#municipality').html(html);

                },

                error: function(xhr) {

                    console.log(xhr.responseText);

                }

            });

        });


        $('#municipality').change(function() {

            let municipality_id = $(this).val();

            let municipality_name = $(this).find(':selected').data('name');

            $('#municipality_name').val(municipality_name);

            $.ajax({

                url: "<?= site_url('get_barangays') ?>",

                type: "POST",

                data: {
                    municipality_id: municipality_id
                },

                dataType: "json",

                success: function(res) {

                    console.log(res); 

                    let html = '<option value="">Select Barangay</option>';

                    $.each(res, function(i, row) {

                        html += `
                    <option value="${row.name}">
                        ${row.name}
                    </option>
                `;

                    });

                    $('#barangay').html(html);

                },

                error: function(xhr) {

                    console.log(xhr.responseText);

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