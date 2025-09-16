  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url();?>" class="brand-link elevation-4">
      <img src="<?php echo base_url("assets/AdminLTE-3.2.0/");?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Control Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if(!empty($authenticated_user->photo)):?>
          <img src="<?php echo base_url("uploads/users/".$authenticated_user->photo);?>" class="img-circle elevation-2" alt="User Image">
          <?php else:?>
            <img src="<?php echo base_url("assets/images/photo-placeholder.webp");?>" class="img-circle elevation-2">
          <?php endif;?>
        </div>
        <div class="info">
          <a href="<?php echo base_url("users/myprofile?referer=".$this->uri->segment(1).DIRECTORY_SEPARATOR.$this->uri->segment(2).DIRECTORY_SEPARATOR.$this->uri->segment(3)); ?>" class="d-block"><?php echo $authenticated_user->name;?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if( (!is_null($menu_items['main'])) && (count($menu_items['main'])>0) ):?>
          <?php foreach($menu_items['main'] as $item): ?>
            <?php if(isset($menu_items['sub'][$item->id])): ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa <?php echo $item->class; ?>"></i>
                <p>
                  <?php echo $item->nom; ?>
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php foreach($menu_items['sub'][$item->id] as $sub_item): ?>
                <li class="nav-item <?php echo (($controller==$sub_item->controller)&&($method==$sub_item->action))?"class='active'":"";?>">
                  <a href="<?php echo base_url($sub_item->controller.'/'.$sub_item->action); ?>" class="nav-link">
                    <i class="fa <?php echo $sub_item->class; ?>"></i>
                    <p><?php echo $sub_item->nom; ?></p>
                  </a>
                </li>
                <?php endforeach;?>
              </ul>
            </li>
            <?php else:?>
              <li class="nav-item">
                <a href="<?php echo base_url($item->controller.'/'.$item->action); ?>" class="nav-link">
                  <i class="nav-icon fas <?php echo $item->class; ?>"></i>
                  <p><?php echo $item->nom; ?></p>
                </a>
              </li>
            <?php endif;?>  
          <?php endforeach;?>
          <?php endif;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>