<!-- <div class="row">
    <div class="col-xs-12 col-sm-12"> -->
<div class="box box-primary">
    <form id="edit_user" name="form" method="post" action="users/update" enctype="multipart/form-data">
        <div class="box-body">
            <input type="hidden" name="id" value="<?php echo $user->id; ?>">
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Name</h3>
                            <input type="text" class="form-control required" name="name" placeholder=""
                                value="<?php echo $user->name; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h3>Job Title</h3>
                            <input type="text" class="form-control required" name="job_title" placeholder=""
                                value="<?php echo $user->job_title; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h3>Username</h3>
                            <input type="text" class="form-control required" name="username" placeholder=""
                                value="<?php echo $user->username; ?>" readonly>
                        </div>
                    </div>

                    <div class="row <?php echo (empty($user->email))?'has-error':'';?>">
                        <div class="col-md-12">
                            <h3>Email</h3>
                            <input type="email" class="form-control required" name="email" placeholder=""
                                value="<?php echo $user->email; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h2>User Access Level</h2>
                            <select class="form-control required" name="level">
                                <option value="">Select Access Level</option>
                                <option value="Normal" <?php echo ($user->user_level == "Normal")?'selected':''; ?>>
                                    Normal</option>
                                <option value="Admin" <?php echo ($user->user_level == "Admin")?'selected':''; ?>>Admin
                                </option>
                                <?php if($_SESSION['user_level']=='Root'):?>
                                <option value="Root" <?php echo ($user->user_level == "Root")?'selected':''; ?>>Root
                                </option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xs-12">
                            <h2>Department</h2>
                            <select name="department_id" class="form-control required" data-name="Department" required>
                                <option value="" name="department_id" disabled>Select</option>
                                <?php foreach ($dpt as $row) : ?>
                                <option value="<?php echo $row->id; ?>"
                                    <?php echo($row->id==$user->department_id)?"selected":"";?>><?php echo $row->name; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <br>

					<div class="row <?php echo (empty($user->photo))?'d-none':'';?>">
						<div class="col-xs-12">
							<img src="<?php echo base_url("uploads/users/".$user->photo);?>" style="clip-path: circle();width:200px;" alt="">
							<!-- <div><i class="fa fa-trash"></i></div> -->
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<label for="userPhoto">Photo</label>
							<input type="file" name="image" accept=".jpg,.png,.jpeg">
						</div>
					</div>

                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Password management</h2>
                            <p>Leave empty for no change in password</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>New Password</h3>
                            <p>Please enter your new password</p>
                            <input type="password" class="form-control required2" minlength="6" name="pswd"
                                placeholder="" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Confirm New Password</h3>
                            <p>Please confirm your new password</p>
                            <input type="password" class="form-control required2" minlength="6" name="pswd2"
                                placeholder="" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 col-xs-offset-1">
                    <div class="btn btn-xs btn-flat btn-success" id="update"><i class='fa fa-save'></i> Update</button>
                    </div>
                </div>
            </div>
    </form>
</div>
<!-- </div>
</div> -->