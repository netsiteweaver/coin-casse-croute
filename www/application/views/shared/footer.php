  <footer class="main-footer">
    <div class="pull-left author">Developed by <a href='https://www.netsiteweaver.com'>Netsiteweaver Ltd</a></div>
    <div class="pull-right hidden-xs">
      v<?php echo $current_version; ?>
    </div>
  </footer>

  <div id="issuesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Regions Issue Detected</h4>
        </div>
        <div class="modal-body">
          <p>We have detected that some regions are not found in any route and have been listed below.</p>
          <table id="region-list" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Regions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($_SESSION['regions_in_no_route'] as $region):?>
                <tr>
                  <td><?php echo $region->name;?></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <a href="./routes/listing"><div class="btn btn-info pull-right"><i class="fa fa-list"></i> Routes</div></a>
          <a href="./regions/listing"><div class="btn btn-info pull-right bg-purple"><i class="fa fa-list"></i> Regions</div></a>
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div>

    </div>
  </div>