<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <style>
          .treeActive{
  
    color:#dd4b39 !important;
}
.forDash{
    display: block !important;
}
table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
    background-color: #dd4b39 !important;
}
#logoText{
    font-size: 24px;
    color: black;
    font-style: italic;
}
.page-link {
    color: #dd4b39;
}
.page-item.active .page-link {

    background-color: #dd4b39;
    border-color: #dd4b39;
}
    </style>
    <div class="sidebar">
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!--<img src="dist/img/logo.png" class="elevation-2" alt="User Image">-->
                    </div>
                    <div class="info">
                        <a href="#" id="logoText" class="d--block">Helping Hands</a>
                    </div>
                </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           
                <li class="nav-item menu-open">

                    <ul class="nav nav-treeview forDash">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link active">
                             <i class="fa fa-solid fa-chart-pie nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                    </ul>
                </li>

                      <li class="nav-item forActive">
                    <a href="#" class="nav-link subActive">
                        <i class="nav-icon fa fa-child"></i>
                        <p>
                            Orphans
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="orphans.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        
                           <li class="nav-item">
                            <a href="view_orphans.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>View</p>
                            </a>
                        </li>
                        

                    </ul>
                </li>
                
              <li class="nav-item forActive">
                    <a href="#" class="nav-link subActive">
                        <i class="nav-icon fa fa-hand-holding-heart"></i>
                        <p>
                            Donors
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="donors.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        
                           <li class="nav-item">
                            <a href="view_donors.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>View</p>
                            </a>
                        </li>
                        
                           </ul>
                           </li>
                           <li class="nav-item forActive">
                    <a href="#" class="nav-link subActive">
                        <i class="nav-icon fa fa-gift"></i>
                        <p>
                            Donations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="donations.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        
                           <li class="nav-item">
                            <a href="view_donations.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>View</p>
                            </a>
                        </li>
                      
                    </ul>
                </li>
                      <li class="nav-item forActive">
                    <a href="#" class="nav-link subActive">
                        <i class="nav-icon fa fa-user-shield"></i>
                        <p>
                            Staff
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="staff.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        
                           <li class="nav-item">
                            <a href="view_staff.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>View</p>
                            </a>
                        </li>
                      
                    </ul>
                </li>
 <li class="nav-item forActive">
                    <a href="#" class="nav-link subActive">
                        <i class="nav-icon fa fa-user-tie"></i>
                        <p>
                            Staff Roles
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="staff_roles.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        
                           <li class="nav-item">
                            <a href="view_staff_roles.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>View</p>
                            </a>
                        </li>
                      
                    </ul>
                </li>
                 <li class="nav-item forActive">
                    <a href="#" class="nav-link subActive">
                        <i class="nav-icon fa fa-heart"></i>
                        <p>
                            Adoptions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="adoptions.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        
                           <li class="nav-item">
                            <a href="view_adoptions.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>All Adoptions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pending_adoptions.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Pending Adoptions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="approved_adoptions.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Approved Adoptions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="rejected_adoptions.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Rejected Adoptions</p>
                            </a>
                        </li>
                      
                    </ul>
                </li>
                <li class="nav-item forActive">
                    <a href="#" class="nav-link subActive">
                        <i class="nav-icon fa fa-gift"></i>
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="inventory.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        
                           <li class="nav-item">
                            <a href="view_items.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>View</p>
                            </a>
                        </li>
                      
                    </ul>
                </li>
                      <li class="nav-item forActive">
                    <a href="#" class="nav-link subActive">
                        <i class="nav-icon fa fa-chart-line"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="orphan_report.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Orphan Report</p>
                            </a>
                        </li>
                        
                           <li class="nav-item">
                            <a href="donations_report.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Donations Report</p>
                            </a>
                        </li>
                      <li class="nav-item">
                            <a href="inventory_report.php" class="nav-link">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Inventory Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
 
                           </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

