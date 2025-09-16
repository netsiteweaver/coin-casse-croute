<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label for="type">Select Date Range</label>
            <select name="type" id="type" class="form-control" autofocus>
                <option value="">Select</option>
                <option value="day">Day</option>
                <option value="month">Month</option>
                <option value="year">Year</option>
                <option value="custom">Custom Range</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-2 d-none" id="dayBlock"><!-- SINGLE DAY -->
        <div class="form-group">
            <label for="">Pick a Date</label>
            <input type="text" name="singleDate" class="form-control singledatepicker" value="">
        </div>
    </div>
    <div class="col-sm-12 col-md-4 d-none" id="monthBlock"><!-- MONTH -->
        <div class="row">
            <div class="col-md-6">
                <label for="">Select Month</label>
                <select name="mMonth" id="" class="form-control">
                    <option value="">Select</option>
                    <option value="1" <?php echo (date("m")=='01')?'selected':'';?>>January</option>
                    <option value="2" <?php echo (date("m")=='02')?'selected':'';?>>February</option>
                    <option value="3" <?php echo (date("m")=='3')?'selected':'';?>>March</option>
                    <option value="4" <?php echo (date("m")=='4')?'selected':'';?>>April</option>
                    <option value="5" <?php echo (date("m")=='5')?'selected':'';?>>May</option>
                    <option value="6" <?php echo (date("m")=='6')?'selected':'';?>>June</option>
                    <option value="7" <?php echo (date("m")=='7')?'selected':'';?>>July</option>
                    <option value="8" <?php echo (date("m")=='8')?'selected':'';?>>August</option>
                    <option value="9" <?php echo (date("m")=='9')?'selected':'';?>>September</option>
                    <option value="10" <?php echo (date("m")=='10')?'selected':'';?>>October</option>
                    <option value="11" <?php echo (date("m")=='11')?'selected':'';?>>November</option>
                    <option value="12" <?php echo (date("m")=='12')?'selected':'';?>>December</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="">Select Year</label>
                <select name="mYear" id="" class="form-control">
                    <option value="">Select</option>
                    <?php for($i=date('Y');$i>date('Y')-10;$i--):?>
                    <option value="<?php echo $i;?>" <?php echo (date("Y")==$i)?'selected':'';?>><?php echo $i;?></option>
                    <?php endfor;?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-2 d-none" id="yearBlock"><!-- YEAR -->
        <div class="form-group">
            <label for="">Select Year</label>
            <select name="year" id="" class="form-control">
                <option value="">Select</option>
                <?php for($i=date('Y');$i>date('Y')-10;$i--):?>
                <option value="<?php echo $i;?>" <?php echo (date("Y")==$i)?'selected':'';?>><?php echo $i;?></option>
                <?php endfor;?>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-2 d-none" id="customBlock"><!-- CUSTOM -->
        <div class="form-group">
            <label for="">Select a Date Range</label>
            <input type="text" name="dateRange" class="form-control rangepicker">
        </div>
    </div>
</div>
<div class="row d-none" id="options">
    <div class="col-md-2">
        <div class="form-group">
            <label for="">Sort By</label>
            <select name="sort_by" id="" class="form-control">
                <option value="order_date">Date</option>
                <option value="amount">Amount</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="">Sort Direction</label>
            <select name="sort_dir" id="" class="form-control">
                <option value="desc">Desc</option>
                <option value="asc">Asc</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="">Payment Mode Only</label>
            <select name="payment_mode_only" id="" class="form-control">
                <option value="">All</option>
                <?php foreach($payment_modes as $pm): ?>
                <option value="<?php echo $pm->id;?>"><?php echo $pm->name;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="">Agent Only</label>
            <select name="agent_only" id="" class="form-control">
                <option value="">All</option>
                <?php foreach($agents as $ag): ?>
                <option value="<?php echo $ag->id;?>"><?php echo $ag->name;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
</div>
<div class="row d-none" id="action">
    <div class="col-md-12">
        <div class="btn btn-success" id="proceed"> Proceed <i class="fa fa-chevron-right"></i></div>
        <div class="btn btn-default float-right" id="btnOptions"><i class="fa fa-cog"></i> Options</div>
    </div>
</div>
<div class="row d-none" id="result">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>NUMBER</th>
                    <th>AMOUNT</th>
                    <th>PAYMENT MODE</th>
                    <th>AGENT</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>