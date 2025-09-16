<style>
  .product-author{
    display: block;
    color:#999;
    font-size:10px;
    font-style:italic;
  }
  .product-author:hover{
    color:#666;
  }
</style>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row d-none">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Orders 2024</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">

                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr class="text-center">
                      <th>Order ID</th>
                      <th>Date</th>
                      <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php foreach($orders as $o):?>
                    <tr class="text-center">
                      <td><a href="<?php echo base_url("orders/receipt/".$o->uuid);?>"><?php echo $o->document_number;?></a></td>
                      <td><?php echo $o->order_date;?></td>
                      <td><?php echo number_format($o->amount,2);?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="<?php echo base_url("orders/add");?>" class="btn btn-success float-left"><i class="fa fa-plus-square"></i> Place New Order</a>
                <a href="<?php echo base_url("orders/listing");?>" class="btn bg-purple float-right"><i class="fa fa-list"></i> View Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Customers</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr class="text-center">
                      <th>Surname</th>
                      <th>Names</th>
                      <th>City</th>
                      <th>Phones</th>
                      <th>Email</th>
                      <th>Created On</th>
                      <th>Created By</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php foreach($customers as $o):?>
                    <tr class="text-center">
                      <td><?php echo $o->last_name;?></td>
                      <td><?php echo $o->first_name;?></td>
                      <td><?php echo $o->city;?></td>
                      <td><a href="tel:<?php echo $o->phone_number1;?>"><?php echo $o->phone_number1;?></a>,  <a href="tel:<?php echo $o->phone_number2?>"><?php echo $o->phone_number2;?></a></td>
                      <td><a href="mailto:<?php echo $o->email;?>"><?php echo $o->email;?></a></td>
                      <td><?php echo date_format(date_create($o->created_date),'Y-m-d');?></td>
                      <td><?php echo $o->agent;?></td>
                      <td><a href="<?php echo base_url("customers/view/".$o->uuid);?>"><div class="btn btn-default"><i class="fa fa-eye"></i> View</div></a></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="<?php echo base_url("customers/listing");?>" class="btn bg-purple float-right"><i class="fa fa-list"></i> View Customers</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">


            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Latest Added Products</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <?php foreach($products as $p):?>
                  <li class="item">
                    <div class="product-img">
                      <?php if( (!empty($p->photo)) && (file_exists(realpath('.').'/uploads/products/'.$p->photo) ) ):?>
                      <img src="<?php echo base_url("/uploads/products/".$p->photo);?>" alt="Product Image" class="img-size-50">
                      <?php else:?>
                        <img src="<?php echo base_url("assets/images/image-placeholder-50px.png");?>" alt="">
                      <?php endif;?>
                    </div>
                    <div class="product-info">
                      <a href="<?php echo base_url("products/edit/".$p->uuid);?>" class="product-title"><?php echo $p->stockref;?>
                        <span class="badge badge-warning float-right">Rs <?php echo number_format($p->selling_price,2);?></span></a>
                      <span class="product-description"><?php echo $p->name;?></span>
                      <span class="product-author">Added on <?php echo date_format(date_create($p->created_date),'d F Y');?> by <?php echo $p->agent;?></span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <?php endforeach;?>

                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <!-- <a href="<?php echo base_url("products/listing/");?>" class="uppercase">View All Products</a> -->
                <a href="<?php echo base_url("products/listing");?>" class="btn bg-navy"><i class="fa fa-truck"></i> View Products</a>

              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Latest Addons</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <?php foreach($addons as $p):?>
                  <li class="item">
                    <div class="product-img">
                      <?php if( (!empty($p->photo)) && (file_exists(realpath('.').'/uploads/addons/'.$p->photo) ) ):?>
                      <img src="<?php echo base_url("/uploads/addons/".$p->photo);?>" alt="Addon Image" class="img-size-50">
                      <?php else:?>
                        <img src="<?php echo base_url("assets/images/image-placeholder-50px.png");?>" alt="">
                      <?php endif;?>
                    </div>
                    <div class="product-info">
                      <a href="<?php echo base_url("addons/edit/".$p->uuid);?>" class="product-title"><?php echo $p->stockref;?>
                        <span class="badge badge-warning float-right">Rs <?php echo number_format($p->selling_price,2);?></span></a>
                      <span class="product-description"><?php echo $p->name;?></span>
                      <span class="product-author">Added on <?php echo date_format(date_create($p->created_date),'d F Y');?> by <?php echo $p->agent;?></span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <?php endforeach;?>

                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <!-- <a href="<?php echo base_url("addons/listing/");?>" class="uppercase">View All Products</a> -->
                <a href="<?php echo base_url("addons/listing");?>" class="btn bg-orange"><i class="fa fa-puzzle-piece"></i> View Addons</a>

              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->