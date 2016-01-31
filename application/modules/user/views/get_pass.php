<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Yes4All</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Avant" />
	<meta name="author" content="The Red Team" />
<script type="text/javascript" src="<?php echo base_url();?>/public/avant/assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){
$("#signupform").validate({
    rules: {
        txtpass1: {
            required: true,
            minlength: 5
        },
        txtpass2: {
            required: true,
            minlength: 5,
            equalTo: "#password1"
        },
  
        usage: "required"                       
    },
    messages: {
        txtpass1: {
            required: "please password!",
            minlength: "password at least 5 chars"
        },
        txtpass2: {
            required: "please password",
            minlength: "password at least 5 chars",
            equalTo: "password fields have to match"
        },
        usage: "please check my terms!" 
    },
});
});//]]>  
</script>
	<link href="<?php echo base_url();?>public/avant/assets/css/styles.min.css" rel='stylesheet' type='text/css' />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body class="focusedform">

<div class="verticalcenter">
	<img src="<?php echo base_url();?>public/images/logo.png" alt="Logo" class="brand" />
	<div class="panel panel-primary">
    
		<form action="<?php echo base_url();?>index.php/user/login_user" method="post" class="form-horizontal" id="signupform" style="margin-bottom: 0px !important;" />
		<div class="panel-body">
			<h4 class="text-center" style="margin-bottom: 25px;">Reset Password</h4>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-lock"></i></span>
                            <input type="password" id="password1" name="txtpass1" placeholder="Password" class="form-control parsley-validated" />
                        </div>
                    </div>
                </div>
				<div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-lock"></i></span>
                            <input type="password"id="password2" name="txtpass2" placeholder="Repeat Password" class="form-control parsley-validated" />
                        </div>
                    </div>
                </div>			
		</div>
		<div class="panel-footer">
			<div class="pull-right">
                <input type="submit" name="reset_password" value="Reset password" class="btn btn-primary" />
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
			</div>
		</div>
		</form>
	</div>
 </div>      
</body>
</html>