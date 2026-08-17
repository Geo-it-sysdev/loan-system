<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">

</div>
<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="<?php echo base_url('Dashboard'); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo base_url('assets/images/GeonLoan.png'); ?>" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url('assets/images/GeonLoan.png'); ?>" alt="Logo" height="50"
                    style="width: 180px;">
            </span>
        </a>
        <a href="<?php echo base_url('Dashboard'); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo base_url('assets/images/GeonLoan.png'); ?>" alt="" height="22" />
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
                    <a class="nav-link menu-link <?php echo (uri_string() === 'Dashboard') ? 'active' : ''; ?>"
                        href="<?php echo base_url('Dashboard'); ?>">
                        <i class="ri-apps-2-fill"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-sm flex-column">
                        </ul>
                    </div>
                </li>

                <?php if ($this->session->userdata('role') == 'Admin') : ?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'Collector') ? 'active' : ''; ?>"
                        href="<?php echo base_url('Collector'); ?>">
                        <i class="ri-user-settings-fill"></i> <span data-key="t-dashboards">Collector</span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-sm flex-column">
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'Interest-Rates') ? 'active' : ''; ?>"
                        href="<?php echo base_url('Interest-Rates'); ?>">
                        <i class="ri-percent-fill"></i> <span data-key="t-dashboards">Interest Rates</span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-sm flex-column">
                        </ul>
                    </div>
                </li>
                <?php endif; ?>



                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'Borrowers') ? 'active' : ''; ?>"
                        href="<?php echo base_url('Borrowers'); ?>">
                        <i class="ri-group-fill"></i> <span data-key="t-dashboards">Borrowers</span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-sm flex-column">
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'Loan') ? 'active' : ''; ?>"
                        href="<?php echo base_url('Loan'); ?>">
                        <i class="ri-hand-coin-line"></i> <span data-key="t-dashboards">Loan</span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-sm flex-column">
                        </ul>
                    </div>
                </li>



                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'Payment') ? 'active' : ''; ?>"
                        href="<?php echo base_url('Payment'); ?>">
                        <i class="ri-secure-payment-line"></i> <span data-key="t-dashboards">Payment</span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-sm flex-column">
                        </ul>
                    </div>
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

                                    <span class="badge bg-danger"
                                        style="display: inline-block !important; visibility: visible !important; opacity: 1 !important;">
                                        +<?= (int)$overdue_count ?>
                                    </span>

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

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo (uri_string() === 'VanManifest/about_us') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('VanManifest/about_us'); ?>">
                                    <i class="ri-information-fill"></i> <span data-key="t-dashboards">About Us </span>
                                </a>
                                <div class="collapse" id="users">
                                    <ul class="nav nav-sm flex-column">
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>