   <div class="main-content">

       <div class="page-content">
           <div class="container-fluid">

               <div class="position-relative mx-n4 mt-n4">
                   <div class="profile-wid-bg profile-setting-img">
                       <img src="<?= base_url('assets/images/geonproject.png'); ?>" class="profile-wid-img"
                           alt="Profile Background">
                       <div class="overlay-content">
                           <div class="text-end p-3">
                               <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                   <input id="profile-foreground-img-file-input" type="file"
                                       class="profile-foreground-img-file-input" />
                                   <label for="profile-foreground-img-file-input"
                                       class="profile-photo-edit btn btn-light">
                                       <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                   </label>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="row">
                   <div class="col-xxl-3">
                       <div class="card mt-n5">
                           <div class="card-body p-4">
                               <div class="text-center">
                                   <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                       <img src="<?= base_url($this->session->userdata('photo') ?: 'assets/images/users/avatar-1.jpg'); ?>"
                                           class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                           alt="User Profile Image"
                                           onerror="this.src='<?= base_url('assets/images/users/avatar-1.jpg'); ?>'">
                                       <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                           <input id="profile-img-file-input" type="file"
                                               class="profile-img-file-input" />
                                           <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                               <span class="avatar-title rounded-circle bg-light text-body">
                                                   <i class="ri-camera-fill"></i>
                                               </span>
                                           </label>
                                       </div>
                                   </div>
                                   <h5 class="fs-16 mb-1">
                                       <?= htmlspecialchars($this->session->userdata('fullname')); ?>
                                   </h5>
                                   <p class="text-muted mb-0">
                                       <?= htmlspecialchars($this->session->userdata('role')); ?>
                                   </p>
                               </div>
                           </div>
                       </div>
                       <!--end card-->


                   </div>
                   <!--end col-->
                   <div class="col-xxl-9">
                       <div class="card mt-xxl-n5">
                           <div class="card-header">
                               <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                   <li class="nav-item">
                                       <a class="nav-link text-body active" data-bs-toggle="tab" href="#personalDetails"
                                           role="tab">
                                           <i class="fas fa-home"></i>
                                           Personal
                                       </a>
                                   </li>
                                   <li class="nav-item">
                                       <a class="nav-link text-body" data-bs-toggle="tab" href="#changeUsernamePassword"
                                           role="tab">
                                           <i class="far fa-user"></i>
                                           Change Username / Password
                                       </a>
                                   </li>

                               </ul>
                           </div>
                           <div class="card-body p-4">
                               <div class="tab-content">
                                   <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                       <form action="javascript:void(0);">
                                           <div class="row">

                                               <div class="col-lg-6">
                                                   <div class="mb-3">
                                                       <label for="fullname" class="form-label">Fullname</label>
                                                       <input type="text" class="form-control" id="fullname"
                                                           value="<?= htmlspecialchars($this->session->userdata('fullname')); ?>"
                                                           readonly />
                                                   </div>
                                               </div>

                                               <div class="col-lg-6">
                                                   <div class="mb-3">
                                                       <label for="username" class="form-label">Username</label>
                                                       <input type="text" class="form-control" id="username"
                                                           value="<?= htmlspecialchars($this->session->userdata('username')); ?>"
                                                           readonly />
                                                   </div>
                                               </div>

                                               <div class="col-lg-6">
                                                   <div class="mb-3">
                                                       <label for="collector_type" class="form-label">User Type</label>
                                                       <input type="text" class="form-control" id="collector_type"
                                                           value="<?= htmlspecialchars($this->session->userdata('role')); ?>"
                                                           readonly />
                                                   </div>
                                               </div>


                                               <div class="col-lg-6">
                                                   <div class="mb-3">
                                                       <label class="form-label">Email</label>
                                                       <input type="email" class="form-control"
                                                           value="<?= $this->session->userdata('email'); ?>" readonly>
                                                   </div>
                                               </div>

                                               <div class="col-lg-6">
                                                   <div class="mb-3">
                                                       <label class="form-label">Contact No.</label>
                                                       <input type="text" class="form-control"
                                                           value="<?= $this->session->userdata('contact_no'); ?>"
                                                           readonly>
                                                   </div>
                                               </div>


                                               <div class="col-lg-6">
                                                   <div class="mb-3">
                                                       <label class="form-label">Status</label>
                                                       <input type="text" class="form-control" value="Active" readonly>
                                                   </div>
                                               </div>


                                           </div>
                                       </form>
                                   </div>
                                   <!--end tab-pane-->
                                   <div class="tab-pane" id="changeUsernamePassword" role="tabpanel">
                                       <form action="javascript:void(0);">
                                           <div class="row g-2">
                                               <div class="col-lg-4">
                                                   <div>
                                                       <label for="username" class="form-label">Username
                                                       </label>
                                                       <input type="text" class="form-control" id="username"
                                                           value="<?= $this->session->userdata('username'); ?>" />
                                                   </div>
                                               </div>
                                               <!--end col-->
                                               <div class="col-lg-4">
                                                   <div>
                                                       <label for="newpasswordInput" class="form-label">New
                                                           Password</label>
                                                       <input type="password" class="form-control" id="newpasswordInput"
                                                           placeholder="Enter new password" />
                                                   </div>
                                               </div>
                                               <!--end col-->
                                               <div class="col-lg-4">
                                                   <div>
                                                       <label for="confirmpasswordInput" class="form-label">Confirm
                                                           Password</label>
                                                       <input type="password" class="form-control"
                                                           id="confirmpasswordInput" placeholder="Confirm password" />
                                                   </div>
                                               </div>
                                               <!--end col-->

                                               <!--end col-->
                                               <div class="col-lg-12">
                                                   <div class="text-end">
                                                       <button type="submit" class="btn btn-success">Save & Change
                                                       </button>
                                                   </div>
                                               </div>
                                               <!--end col-->
                                           </div>
                                           <!--end row-->
                                       </form>

                                   </div>
                                   <!--end tab-pane-->

                               </div>
                           </div>
                       </div>
                   </div>
                   <!--end col-->
               </div>
               <!--end row-->

           </div>
           <!-- container-fluid -->
       </div><!-- End Page-content -->