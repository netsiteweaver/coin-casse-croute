<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($page_title)?$page_title:"";?> | <?php echo $company->name; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?php echo base_url("assets/AdminLTE-3.2.0/");?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url("assets/AdminLTE-3.2.0/");?>/dist/css/adminlte.min.css">
    <!-- Login Page -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/login.min.css?ts=".time());?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/favicon/favicon.ico'); ?>" type="image/x-icon" />
    <style>
        .bg {
            position: fixed; 
            top: -50%; 
            left: -50%; 
            width: 200%; 
            height: 200%;
        }
        .bg img {
            position: absolute; 
            top: 0; 
            left: 0; 
            right: 0; 
            bottom: 0; 
            margin: auto; 
            min-width: 50%;
            min-height: 50%;
            filter:blur(5px) grayscale(1);
            z-index:0;
        }
        .login-box {
            z-index: 999;
        }

        @media (max-width: 576px) {
            .login-box, .register-box {
                margin-top: .5rem;
                width: 70%;
            }
            .login-box-body, .register-box-body {
                /* background: #fff; */
                padding: 10px;
                /* border-top: 0; */
                color: #666;
            }
            .login-box-msg, .register-box-msg {
                padding: 0 10px 10px;
            }
        }
    </style>

</head>

<body class="hold-transition login-page">

    <audio id="failed" src="<?php echo base_url("assets/audio/failed.wav");?>" preload="auto"></audio>  
    <audio id="success" src="<?php echo base_url("assets/audio/success.wav");?>" preload="auto"></audio>  
<?php if(!empty($background_image->image)):?>
    <div class="bg">
        <img src="<?php echo base_url("uploads/login/".$background_image->image);?>" alt="">
    </div>
<?php endif;?>
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo base_url(); ?>">
                <?php if(!empty($logo)):?>
                <img src="<?php echo base_url("uploads/logo/".$logo);?>" alt="Logo" class="img-thumbnail">
                <br>
                <?php else:?>
                    <?php echo $company->name;?>
                <?php endif;?>
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="login-container">
                <p class="login-box-msg">Sign in to start your session</p>
                <form name="signin" action="<?php echo base_url('users/authenticate'); ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control required1" placeholder="Username or Email"
                            name="inputEmail" <?php echo isset($username)?"":"autofocus";?>
                            value="<?php echo isset($username)?$username:"";?>">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <p class="error" style="color:red"></p>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control required1" placeholder="Password"
                            name="inputPassword" <?php echo isset($username)?"autofocus":"";?>>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <p class="error" style="color:red"></p>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" id="signin" class="btn btn-primary btn-block btn-flat"><i
                                    class="fas fa-sign-in-alt"></i> Sign In
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                
                <a style="font-size:0.8em; color:#999;" href="<?php echo base_url('users/forget_password');?>"
                    id="forget_password">Forgot Password ?</a>

                <p id="result" class="text-center"></p>
            </div>
            <!-------------------------------------------------------------->
            <div class="forgetpassword-container d-none">
                <p class="login-box-msg">Enter your email to reset your password</p>
                <p id="result" class="text-center"></p>
                <form name="signin" action="<?php echo base_url('users/forget_password_process'); ?>" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control required" id="email_to_reset" placeholder="Email"
                            name="inputEmail" value="" autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <p style='font-size:0.8em;color:#999;padding:10px;'>An email will be sent only if the email
                            provided exists in our active records. You will need the newly generated password to signin.
                            We strongly recommend that you change your password immediately by accessing your profile
                            from the dropdown on top-right.</p>
                        <p class="error" style="color:red"></p>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" id="reset_password"
                                class="btn btn-success btn-block btn-flat">Proceed</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a style="font-size:0.8em; color:#999;" href="<?php echo base_url('users/forget_password');?>"
                    id="back_to_signin"><i class="fa fa-angle-left"></i> Back to Sign In</a>
            </div>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url("assets/AdminLTE-3.2.0/");?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url("assets/AdminLTE-3.2.0/");?>/plugins/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <script>
      var base_url = "<?php echo base_url();?>";
    </script>
    <script src="<?php echo base_url("assets/js/pages/login.min.js?ts=".time());?>"></script>
</body>

</html>