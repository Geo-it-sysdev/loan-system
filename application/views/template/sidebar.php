<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
   
</div><!-- /.modal -->
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo base_url('Dashboard'); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo base_url('assets/images/logo-sm.png'); ?>" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url('assets/images/GeonLoan.png'); ?>" alt="Logo" height="50"
                    style="width: 180px;">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo base_url('Dashboard'); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo base_url('assets/images/logo-sm.png'); ?>" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url('assets/images/GeonLoan.png'); ?>" alt="" height="50"
                    style="width: 180px;" />
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu </span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= ($this->uri->segment(1) == 'Dashboard') ? 'text-secondary' : ''; ?>"
                        href="<?= base_url('Dashboard'); ?>">
                        <i class="ri-apps-2-fill"></i> Dashboard
                    </a>
                </li>

                <?php if ($this->session->userdata('role') == 'Admin') : ?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?= ($this->uri->segment(1) == 'Collector') ? 'text-secondary' : ''; ?>"
                        href="<?= base_url('Collector'); ?>">
                        <i class="ri-user-settings-fill"></i> Collector
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= ($this->uri->segment(1) == 'Interest-Rates') ? 'text-secondary' : ''; ?>"
                        href="<?= base_url('Interest-Rates'); ?>">
                        <i class="ri-percent-fill"></i> Interest Rates
                    </a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= ($this->uri->segment(1) == 'Borrowers') ? 'text-secondary' : ''; ?>"
                        href="<?= base_url('Borrowers'); ?>">
                        <i class="ri-group-fill"></i> Borrowers
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= ($this->uri->segment(1) == 'Loan') ? 'text-secondary' : ''; ?>"
                        href="<?= base_url('Loan'); ?>">
                        <i class="ri-hand-coin-line"></i> Loan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= ($this->uri->segment(1) == 'Payment') ? 'text-secondary' : ''; ?>"
                        href="<?= base_url('Payment'); ?>">
                        <i class="ri-secure-payment-line"></i> Payment
                    </a>
                </li>



                <?php
                    $current_page = $this->uri->segment(1);
                    $isActive = ($current_page == 'Overdue-Loans' || $current_page == 'Outstanding-Balance' 
                    || $current_page == 'Payment-Collection' || $current_page == 'Fully-Paid' || $current_page == 'Loan-Release' 
                    || $current_page == 'Monthly-Collection'
                    );
                    ?>

                <li class="nav-item">
                    <a class="nav-link menu-link <?= $isActive ? 'text-secondary' : '' ?>" href="#sidebarReports"
                        data-bs-toggle="collapse" role="button" aria-expanded="<?= $isActive ? 'true' : 'false' ?>"
                        aria-controls="sidebarReports">

                        <i class="ri-file-list-line"></i>
                        <span data-key="t-reports">Reports</span>
                    </a>

                    <div class="collapse menu-dropdown <?= $isActive ? 'show' : '' ?>" id="sidebarReports">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="<?= site_url('Overdue-Loans') ?>"
                                    class="nav-link <?= ($current_page == 'Overdue-Loans') ? 'text-secondary' : '' ?>">
                                    Overdue Loans
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('Outstanding-Balance') ?>"
                                    class="nav-link <?= ($current_page == 'Outstanding-Balance') ? 'text-secondary' : '' ?>">
                                    Outstanding Balance
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('Payment-Collection') ?>"
                                    class="nav-link <?= ($current_page == 'Payment-Collection') ? 'text-secondary' : '' ?>">
                                    Payment Collection
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('Fully-Paid') ?>"
                                    class="nav-link <?= ($current_page == 'Fully-Paid') ? 'text-secondary' : '' ?>">
                                    Fully Paid
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('Loan-Release') ?>"
                                    class="nav-link <?= ($current_page == 'Loan-Release') ? 'text-secondary' : '' ?>">
                                    Loan Release
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= site_url('Monthly-Collection') ?>"
                                    class="nav-link <?= ($current_page == 'Monthly-Collection') ? 'text-secondary' : '' ?>">
                                    Monthly Collection
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>