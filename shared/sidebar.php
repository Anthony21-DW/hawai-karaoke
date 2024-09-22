  <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="~/../../index.php">
            <div class="sidebar-brand-icon">
                <img src="../assets/images/logo.png" alt="logo" width="80">
            </div>
            <div class="sidebar-brand-text mx-3">Hawai Karaoke</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0 mb-2">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="../dashboard/view.php">
                <i class="nav-icon fas fa-home"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../booking/view.php">
                    <i class="fas fa-shopping-cart"></i>
                <span>Booking</span></a>
        </li>

        <?php 
            if ($_SESSION['role_id'] != 3) { 
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="../customer/view.php">
                            <i class="fas fa-users"></i>
                        <span>Customer</span></a>
                </li>
                <?php 
            }
        ?>
        <li class="nav-item">
            <a class="nav-link" href="../about/view.php">
                <i class="fas fa-info-circle"></i>
                <span>Tentang Kami</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../contact/view.php">
                <i class="fas fa-address-book"></i>
                <span>Kontak</span></a>
        </li>
        

    </ul>
<!-- End of Sidebar -->