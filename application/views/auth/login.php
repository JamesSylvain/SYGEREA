<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/login.css" media="screen" />
  <title>Connexion</title>
</head>
<body>
<MARQUEE><?php echo lang('login_subheading');?></MARQUEE>

<div><?php echo $message;?></div>
  <div class="login">
    <h1>Connexion SYGEREA</h1>
   <?php echo form_open("auth/login");?>
      <p><?php echo form_input($identity);?></p>
      <p> <?php echo form_input($password);?></p>
      <p class="remember_me">
        <label>
			<a href="forgot_password"><?php echo lang('login_forgot_password');?></a>
        </label>
      </p>
      <p class="submit"><input type="submit" name="commit" value="<?php echo lang('login_submit_btn');?>"></p>
<?php echo form_close();?>
  </div>

  <div class="login-help">
    <p>Forgot your password? <a href="#">Click here to reset it</a>.</p>
  </div>
</body>
</html>