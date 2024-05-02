<ul style="background-color:#181818" class="navbar-nav  sidebar sidebar-dark toggled" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('Dashboard') ?>">
    <div class="sidebar-brand-icon ">
       <!-- <img width="45px;" src="<?php echo base_url('assets/img/beacukai.png') ?>" alt=""> -->
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
</a>
<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('beranda') ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">


<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('tbl_barang') ?>">
    <i class="fas fa-file"></i>
        <span>Daftar Barang</span></a>
</li>


<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('tbl_suplier') ?>">
    <i class="fas fa-file"></i>
        <span>Daftar Supplier</span></a>
</li>


<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('tbl_hbeli') ?>">
    <i class="fas fa-file"></i>
        <span>Daftar Pembelian</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('welcome/logout') ?>">
    <i class="fas fa-user"></i>
        <span>Logout</span></a>
</li>

            </li>
<!-- Nav Item - Utilities Collapse Menu -->


<!-- Divider -->
<hr class="sidebar-divider">



<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->