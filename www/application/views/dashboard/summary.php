          <div class='dashboard-collection vehicles'><!-- VEHICLES -->
            <div class='row'>
              <div class='col-xs-12'>
                <p class='dashboard-title'><span class='bg-green'><i class='fa fa-info-circle'></i> VEHICLES</span></p>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-automobile"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Models</span>
                      <span class="info-box-number"><?php echo $total_models; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    <div class="info-box-content">
                      <a href="<?php echo base_url('vehiclemodels/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-automobile"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Sub-Models</span>
                      <span class="info-box-number"><?php echo $total_submodels; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    <div class="info-box-content">
                      <a href="<?php echo base_url('submodels/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-automobile"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Versions</span>
                      <span class="info-box-number"><?php echo $total_versions; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    <div class="info-box-content">
                      <a href="<?php echo base_url('versions/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>              
                
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-automobile"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Lines</span>
                      <span class="info-box-number"><?php echo $total_lines; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    <div class="info-box-content">
                      <a href="<?php echo base_url('lines/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>   
                
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Categories</span>
                      <span class="info-box-number"><?php echo $total_categories; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    <div class="info-box-content">
                      <a href="<?php echo base_url('vehiclecat/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>   

            </div>
          </div>

          <div class='dashboard-collection others'><!-- OTHERS -->
            <div class='row'>
              <div class='col-xs-12'>
                <p class='dashboard-title'><span class="bg-purple"><i class='fa fa-users'></i> OTHERS</span></p>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-info-circle"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Colors</span>
                      <span class="info-box-number"><?php echo $total_colors; ?></span>
                    </div>
                    <div class="info-box-content info-box-footer">
                      <a href="<?php echo base_url('users/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div> 
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-question-circle"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">FAQs</span>
                      <span class="info-box-number"><?php echo $total_faqs; ?></span>
                    </div>
                    <div class="info-box-content info-box-footer">
                      <a href="<?php echo base_url('users/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div> 
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-question-circle-o"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">FAQ Categories</span>
                      <span class="info-box-number"><?php echo $total_faqcategories; ?></span>
                    </div>
                    <div class="info-box-content info-box-footer">
                      <a href="<?php echo base_url('users/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>                

            </div>
          </div>
        
          <div class='dashboard-collection users'><!-- USERS -->
            <div class='row'>
              <div class='col-xs-12'>
                <p class='dashboard-title'><span class="bg-purple"><i class='fa fa-users'></i> USERS</span></p>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Admin</span>
                      <span class="info-box-number"><?php echo $total_users['admin']; ?></span>
                    </div>
                    <div class="info-box-content info-box-footer">
                      <a href="<?php echo base_url('users/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>  
                <?php if ($total_users['normal']>0):?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Normal</span>
                      <span class="info-box-number"><?php echo $total_users['normal']; ?></span>
                    </div>
                    <div class="info-box-content info-box-footer">
                      <a href="<?php echo base_url('users/listing');?>">More Info <i class='fa fa-arrow-circle-right'></i></a>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>                
                <?php endif;?>
            </div>
          </div>
            <!-- /.row -->   

          <div class='dashboard-collection logins'><!-- RECENT LOGINS -->
            <div class='row'>
              <div class='col-xs-12'>
                <p class='dashboard-title'><span class="bg-blue"><i class='fa fa-users'></i> RECENT LOGINS</span></p>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>DATE</th>
                      <th>USER</th>
                      <th>IP</th>
                      <th>OS</th>
                      <th>BROWSER</th>
                      <th>STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($login_history as $row):?>
                    <tr <?php echo empty($row->name)?"class='red'":"";?>>
                      <td><?php echo date_format(date_create($row->datetime),'d M Y @ H:i');?></td>
                      <td><?php echo empty($row->name)?$row->username:$row->name;?></td>
                      <td><?php echo $row->ip;?></td>
                      <td><?php echo $row->os;?></td>
                      <td title="<?php echo $row->result_other;?>"><?php echo $row->browser;?></td>
                      <td><?php echo $row->result;?></td>
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
