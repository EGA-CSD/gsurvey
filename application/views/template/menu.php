<?php
	$_session_in = $this->session->userdata('logged_in');
	$_user_name_head 	= $_session_in['USERNAME'];
	$_usertypecode 		= $_session_in['user_type_code'];
	
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left info">
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">เมนูหลัก</li>
        <li class="active">
          <a href="<?=base_url()?>items/add">
            <i class="fa fa-files-o"></i> <span>แบบฟอร์ม</span>
            <span class="pull-right-container"></span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>