<!DOCTYPE html>
<html lang="en"><head>
	<meta charset="utf-8" />
    <title>Administrator</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Administrator" />
	<meta name="author" content="QuocVu88" />
    
    <script type="text/javascript" src="<?php echo base_url();?>/public/avant/assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/public/avant/assets/js/jqueryui-1.10.3.min.js"></script>
    
    
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <link href="<?php echo base_url();?>/public/avant/assets/css/styles.min.css" rel="stylesheet" type='text/css' media="all" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css' />

	 
    <link href='<?php echo base_url();?>/public/avant/assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher' />     
    <link href='<?php echo base_url();?>/public/avant/assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher' /> 
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>/public/avant/assets/plugins/charts-flot/excanvas.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>/public/avant/assets/css/ie8.css">
	<![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>/public/avant/assets/plugins/jquery-fileupload/css/jquery.fileupload-ui.css' /> 
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>/public/avant/assets/plugins/datatables/dataTables.css'>
    <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>/public/avant/assets/plugins/codeprettifier/prettify.css' /> 
    <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>/public/avant/assets/plugins/form-toggle/toggles.css' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>/public/avant/assets/js/jqueryui.css' />

    <!-- Generic page styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/avant/assets/plugins/jquery-fileupload/css/style.css">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/avant/assets/plugins/jquery-fileupload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/avant/assets/plugins/jquery-fileupload/css/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>public/avant/assets/plugins/jquery-fileupload/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>public/avant/assets/plugins/jquery-fileupload/css/jquery.fileupload-ui-noscript.css"></noscript>
    <!-- The file upload form used as target for the file upload widget -->
    <script src="<?php echo base_url();?>/public/scripts/ckeditor/ckeditor.js"></script>
	<style>
    </style>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body class="">

    <?php echo $header;?>
    
    <div id="page-container">
    
    	<?php echo $left;?>
        
		<?php include('right.php');?>

    	<?php echo $bottom;?>

	</div>

<!--

<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo base_url();?>/public/avant/assets/js/jquery-1.10.2.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript">!window.jQuery.ui && document.write(unescape('%3Cscript src="<?php echo base_url();?>/public/avant/assets/js/jqueryui-1.10.3.min.js'))</script>
-->

<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/js/bootstrap.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/js/enquire.js'></script> 
<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/js/jquery.cookie.js'></script> 
<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/js/jquery.touchSwipe.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/js/jquery.nicescroll.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/plugins/codeprettifier/prettify.js'></script> 
<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/plugins/form-toggle/toggle.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/js/placeholdr.js'></script> 
<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/js/application.js'></script> 



<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="assets/js/fileupload/cors/jquery.xdr-transport.js"></script>
<![endif]-->



</body>
</html>
