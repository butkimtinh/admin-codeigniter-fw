<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Administrator</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Administrator" />
	<meta name="author" content="Quocvu88" />

    <script type="text/javascript" src="<?php echo base_url();?>/public/avant/assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/public/avant/assets/js/jqueryui-1.10.3.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css' />
	<link href="<?php echo base_url();?>public/avant/assets/css/styles.min.css" rel='stylesheet' type='text/css' />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body class="focusedform">

<div class="verticalcenter">
	<!--
    <img src="<?php //echo base_url();?>public/images/logo.png" alt="Logo" class="brand" />
    -->
	<div class="panel panel-primary">
    
		<form action="<?php echo base_url();?>index.php/user/login_user" method="post" class="form-horizontal" style="margin-bottom: 0px !important;" />
		<div class="panel-body">
			<h4 class="text-center" style="margin-bottom: 25px;">Login</h4>

				<?php 
                    if(isset($error)){
						echo '
							<div class="alert alert-dismissable alert-danger">
								<strong>Oh snap!</strong> '.$error.'
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							</div>
						';
                    }
                ?>
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-user"></i></span>
                            <input type="text" class="form-control" id="txtname" name="txtname" placeholder="Username" autofocus required class="form-control parsley-validated" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-lock"></i></span>
                            <input type="password" class="form-control" id="txtpass" name="txtpass" placeholder="Password" autofocus required class="form-control parsley-validated" />
                        </div>
                    </div>
                </div>
                <!--<div class="clearfix">
                    <div class="pull-right"><label><input type="checkbox" style="margin-bottom: 20px" checked="" /> Remember Me</label></div>
                </div>-->
					
		</div>
		<div class="panel-footer">
			<a href="mailto:dungnguyen@yes4all.com?Subject=Forget%20password%20" class="pull-left btn btn-link" style="padding-left:0">Forgot password?</a>
			
			<div class="pull-right">
				<a href="#" class="btn btn-default">Clear</a>
                <input type="submit" name="submit" value="Login" class="btn btn-primary" />
			</div>
		</div>
		</form>
	</div>
 </div>      
<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/js/bootstrap.min.js'></script> 
</body>
</html>