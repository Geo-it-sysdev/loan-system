<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <h4 class="mb-0">Borrowers</h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                <li class="breadcrumb-item active">Borrowers</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row g-3">

                <!-- ================= LEFT SIDE ================= -->
                <div class="col-12 col-lg-5">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <form id="BorrowerForm" enctype="multipart/form-data">

                                <!-- PHOTO -->
                                <div class="card mb-3">
                                    <div class="card-body text-center p-4">

                                        <div class="position-relative d-inline-block">

                                            <img id="photoPreview" src="<?= base_url('assets/images/user.png') ?>"
                                                class="rounded-circle img-thumbnail"
                                                style="width:140px;height:140px;object-fit:cover;" alt="photo">

                                            <button type="button" class="btn btn-primary btn-sm position-absolute"
                                                style="bottom:6px;right:6px;width:32px;height:32px;
                                                    border-radius:50%;display:flex;align-items:center;justify-content:center;"
                                                onclick="document.getElementById('photo').click();">

                                                <i class="ri-camera-line"></i>
                                            </button>

                                        </div>

                                        <h6 class="mt-3 mb-0">Borrower Photo</h6>
                                        <small class="text-muted">Click camera to upload</small>

                                        <input type="file" id="photo" name="photo" hidden>
                                    </div>
                                </div>

                                <!-- NAME -->
                                <div class="row g-2">

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control"
                                            placeholder="First name" required>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Last name"
                                            required>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" name="middle_name" class="form-control"
                                            placeholder="Middle name" required>
                                    </div>

                                </div>



                                <div class="row g-2 mt-1">

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Province</label>

                                        <input type="text" class="form-control" value="Bohol" readonly
                                            style="cursor: not-allowed">

                                        <input type="hidden" name="Province" value="Bohol">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Municipality</label>

                                        <select id="municipality" class="form-select" required>
                                            <option value="">Select Municipality</option>
                                        </select>

                                        <input type="hidden" name="municipalities" id="municipality_name">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Barangay</label>
                                        <select name="baranggay" id="barangay" class="form-select" required>
                                            <option value="">Select Barangay</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Purok</label>
                                        <select name="Purok" class="form-select" required>
                                            <option value="" selected>Select Purok</option>
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

                                <!-- CONTACT -->
                                <div class="row g-2 mt-1">

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Email address" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Contact No.</label>
                                        <input type="number" name="contact" class="form-control"
                                            placeholder="Contact number" required>
                                    </div>

                                </div>

                                <!-- ID TYPE -->
                                <div class="row g-2 mt-1">

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Type of ID</label>
                                        <select name="id_type" class="form-select" required>
                                            <option value="">-- Select ID Type --</option>
                                            <option value="Philippine National ID">Philippine National ID</option>
                                            <option value="Driver's License">Driver's License</option>
                                            <option value="Passport">Passport</option>
                                            <option value="UMID">UMID</option>
                                            <option value="SSS ID">SSS ID</option>
                                            <option value="GSIS ID">GSIS ID</option>
                                            <option value="Postal ID">Postal ID</option>
                                            <option value="Voter's ID">Voter's ID</option>
                                            <option value="PRC ID">PRC ID</option>
                                            <option value="TIN ID">TIN ID</option>
                                            <option value="Senior Citizen ID">Senior Citizen ID</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Valid ID No.</label>
                                        <input type="text" name="valid_id" class="form-control"
                                            placeholder="Enter ID number" required>
                                    </div>

                                </div>

                                <!-- BUTTON -->
                                <button type="submit" class="btn btn-primary w-100 mt-3">
                                    <i class="ri-add-line me-1"></i> Add Borrower
                                </button>

                            </form>

                        </div>
                    </div>

                </div>

                <!-- ================= RIGHT SIDE ================= -->
                <div class="col-12 col-lg-7">

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped align-middle w-100 nowrap" id="BorrowerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Photo</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Contact</th>
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



    <script>
    let borrowerTable;
    let isEdit = false;
    let editId = null;

    // PHOTO PREVIEW
    $('#photo').on('change', function(e) {

        const file = e.target.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#photoPreview').attr('src', e.target.result);
            };

            reader.readAsDataURL(file);
        }
    });

    $(document).ready(function() {

        // =========================
        // SAVE / UPDATE BORROWER
        // =========================
        $('#BorrowerForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            let url = isEdit ?
                "<?= base_url('update_borrower') ?>" :
                "<?= base_url('add_borrower') ?>";

            if (isEdit) {
                formData.append("id", editId);
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,

                beforeSend: function() {
                    Swal.fire({
                        title: 'Saving...',
                        text: 'Please wait',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
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

                        $('#BorrowerForm')[0].reset();

                        $('#photoPreview').attr(
                            'src',
                            "<?= base_url('assets/images/user.png') ?>"
                        );

                        if (borrowerTable) {
                            borrowerTable.ajax.reload(null, false);
                        }

                        isEdit = false;
                        editId = null;

                        $('button[type="submit"]').html(
                            '<i class="ri-add-line me-1"></i> Add Borrower'
                        );

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: res.message
                        });
                    }
                },

                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Please try again later'
                    });
                }
            });
        });

        // =========================
        // BORROWER DATATABLE
        // =========================
        borrowerTable = $('#BorrowerTable').DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            destroy: true,
            autoWidth: false,

            ajax: {
                url: "<?= base_url('borrower_list') ?>",
                type: "POST"
            },

            columns: [{
                    data: "photo",
                    render: function(data) {

                        let imgSrc;

                        if (!data || data === "assets/borrower/default.png" || data === "") {
                            imgSrc = "<?= base_url('assets/images/user.png') ?>";
                        } else {
                            imgSrc = "<?= base_url() ?>" + data;
                        }

                        return `<img src="${imgSrc}" class="rounded-circle" style="width:45px;height:45px;object-fit:cover;">`;
                    }
                },
                {
                    data: null,
                    render: function(row) {
                        return `${row.firstname} ${row.middlename ? row.middlename + ' ' : ''}${row.lastname}`;
                    }
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
                    data: "id",
                    orderable: false,
                    render: function(id) {
                        return `
                        <button class="btn btn-sm btn-primary btn-edit" data-id="${id}">
                            <i class="ri-edit-line me-1"></i> Edit
                        </button>

                        <button class="btn btn-sm btn-danger btn-delete" data-id="${id}">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    `;
                    }
                }
            ]
        });

        // =========================
        // LOAD MUNICIPALITIES
        // =========================
        $.ajax({
            url: "<?= base_url('get_municipalities') ?>",
            type: "GET",
            dataType: "json",
            success: function(res) {

                let html = '<option value="">Select Municipality</option>';

                $.each(res, function(i, row) {
                    html += `
                    <option value="${row.id}" data-name="${row.name}">
                        ${row.name}
                    </option>
                `;
                });

                $('#municipality').html(html);
            }
        });

    });

    // =========================
    // MUNICIPALITY CHANGE
    // =========================
    $('#municipality').on('change', function() {

        let municipality_id = $(this).val();

        let municipality_name = $(this).find(':selected').data('name');

        $('#municipality_name').val(municipality_name);

        $.ajax({
            url: "<?= base_url('get_barangays') ?>",
            type: "POST",
            data: {
                municipality_id: municipality_id
            },
            dataType: "json",

            success: function(res) {

                let html = '<option value="">Select Barangay</option>';

                $.each(res, function(i, row) {
                    html += `
                    <option value="${row.name}">
                        ${row.name}
                    </option>
                `;
                });

                $('#barangay').html(html);
            }
        });
    });

    // =========================
    // EDIT BORROWER
    // =========================
    $(document).on('click', '.btn-edit', function() {

        let id = $(this).data('id');

        $.ajax({
            url: "<?= base_url('get_borrower') ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "json",

            success: function(res) {

                if (res.status) {

                    let data = res.data;

                    $('[name="first_name"]').val(data.firstname);
                    $('[name="last_name"]').val(data.lastname);
                    $('[name="middle_name"]').val(data.middlename);
                    $('[name="email"]').val(data.email);
                    $('[name="contact"]').val(data.contact_no);
                    $('[name="id_type"]').val(data.type_of_id);
                    $('[name="valid_id"]').val(data.valid_id_no);

                    // ADDRESS SAFE SPLIT
                    let addressParts = (data.address || "").split(',');

                    let purok = $.trim(addressParts[0] || '');
                    let barangay = $.trim(addressParts[1] || '');
                    let municipality = $.trim(addressParts[2] || '');

                    $('[name="Purok"]').val(purok);
                    $('#municipality_name').val(municipality);

                    $('#municipality option').each(function() {

                        if ($(this).data('name') == municipality) {

                            $(this).prop('selected', true);

                            let municipality_id = $(this).val();

                            $.ajax({
                                url: "<?= base_url('get_barangays') ?>",
                                type: "POST",
                                data: {
                                    municipality_id
                                },
                                dataType: "json",

                                success: function(res) {

                                    let html =
                                        '<option value="">Select Barangay</option>';

                                    $.each(res, function(i, row) {

                                        let selected = row.name ==
                                            barangay ? 'selected' : '';

                                        html += `
                                        <option value="${row.name}" ${selected}>
                                            ${row.name}
                                        </option>
                                    `;
                                    });

                                    $('#barangay').html(html);
                                }
                            });

                            return false;
                        }
                    });

                    let photoUrl;

                    if (data.photo === 'assets/borrower/default.png' || !data.photo) {
                        photoUrl = "<?= base_url('assets/images/user.png') ?>";
                    } else {
                        photoUrl = "<?= base_url() ?>" + data.photo;
                    }

                    $('#photoPreview').attr('src', photoUrl);

                    isEdit = true;
                    editId = data.id;
                }
            }
        });
    });

    // =========================
    // DELETE BORROWER
    // =========================
    $(document).on('click', '.btn-delete', function() {

        let id = $(this).data('id');

        Swal.fire({
            title: "Are you sure?",
            text: "This borrower will be deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "<?= base_url('delete_borrower') ?>",
                    type: "POST",
                    data: {
                        id
                    },
                    dataType: "json",

                    success: function(res) {

                        if (res.status) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: res.message,
                                timer: 1200,
                                showConfirmButton: false
                            });

                            if (borrowerTable) {
                                borrowerTable.ajax.reload(null, false);
                            }

                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message
                            });
                        }
                    }
                });
            }
        });
    });
    </script>