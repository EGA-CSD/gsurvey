<?php
	$_session_in = $this->session->userdata('logged_in');
	$_user_code_head 	= $_session_in['UID'];
	$_user_name_head 	= $_session_in['USERNAME'];
?>
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="items/add" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>แบบ</b>สำรวจ</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>แบบ</b>สำรวจ</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="<?=base_url()?>home" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><i class="fa fa-user-circle" aria-hidden="true"></i>  <?=$_user_name_head?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=base_url()?>users/profile/?code=<?=base64_encode($_user_code_head);?>" class="btn btn-default btn-flat"><i class="fa fa-user"></i> ข้อมูลส่วนตัว</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url()?>login/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> ออกจากระบบ</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>