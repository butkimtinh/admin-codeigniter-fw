	<!-- BEGIN CONTENT -->
        <div id="page-content">
            <div id='wrap'>
                <div id="page-heading">        
                    <h1><?php echo $title;?></h1>
                    <div class="options">
                        <div class="btn-toolbar">
                        </div>
                    </div>
                </div>
        
                <div class="container">
                    <!--PUT ALERT HERE-->                               
					<?php
                        if(isset($message)){
							echo '
								<div class="alert alert-dismissable alert-'.$message_type.'">
									'.$message.'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								</div>
							';
                        }
                    ?>
                    <!--PUT ALERT HERE-->  
                    
					<div class="panel panel-midnightblue">
                        <!--PUT DATA HERE-->
                        <?php $e = ($info) ? 1 : 0; //Check NEW or EDIT?>
                        <form action="<?php echo base_url();?>index.php/menuitem/edit_menuitem/<?php echo ($e) ? $info->id : '';?>" method="post" class="form-horizontal" >
                        
                        <div class="panel-heading">                            
                              <h4><?php echo $title;?></h4>
                            <div class="options">   
                                <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a>
                            </div>
                        </div>
                        <div class="panel-body collapse in">                                                        
                              <div class="form-group">
                                <label for="focusedinput" class="col-sm-3 control-label">Tile</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" id="txttitle" name="txttitle" placeholder="" value="<?php echo ($e) ? $info->title : '';?>" />
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputCategory" class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-6">
                                    <select name="name_parent" id ="name_parent">
                                        <option value="0">----No Parent----</option>
                                        <?php
                                        function ds_parent($ds_lbv,$ma,$kt,$info){
                                            foreach($ds_lbv as $lbv){
                                                if($lbv['parent_id']==$ma)
                                                {
                                                    if($info->parent_id == $lbv['id'])
                                                        $selected = 'selected="selected"';
                                                    else
                                                        $selected = '';
                                                    echo '<option value = "'.$lbv['id'].'" '.$selected.'>'.$kt.$lbv['title'].' ('.$lbv['id'].')</option>';
                                                    ds_parent($ds_lbv,$lbv['id'],$kt.$kt, $info);
                                                }
                                            }
                                        }
                                        ds_parent($name_parent,0,'---',$info);
                                        ?>
                                    </select>
                                    <script type="text/javascript" src="<?php echo base_url(); ?>/public/avant/assets/plugins/form-select2/select2.min.js"></script> 
                                        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/avant/assets/plugins/form-select2/select2.css" /> 
                                        <script>
                                            $(function() {
                                                var opts=$("#name_parent").html(), opts2="<option></option>"+opts;
                                                $("select.populate").each(function() { var e=$(this); e.html(e.hasClass("placeholder")?opts2:opts); });
                                        
                                        
                                                $("#name_parent").select2({width: "resolve"});
                                            });
                                        </script>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputLink" class="col-sm-3 control-label">Link</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" name="txtlink" id="txtlink" placeholder="" value="<?php echo ($e) ? $info->link : '';?>" />
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label for="inputLink" class="col-sm-3 control-label">Ordered</label>
                                <div class="col-sm-6">
                                  <input type="text" data-type="digits" class="form-control" name="txtordered" id="txtordered" placeholder="" value="<?php echo ($e) ? $info->ordered : '';?>" />
                                </div>
                              </div>
                            <div class="form-group">
                                <label for="inputLink" class="col-sm-3 control-label">Icon</label>
                                <div class="col-sm-6">
                                    <input type="text" data-type="digits" class="form-control" name="txticon" id="txticon" placeholder="" value="<?php echo ($e) ? $info->icon : '';?>" />
                                </div>
                            </div>
                              <div class="form-group">
                                <label for="radio" class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-6">
                                    <div class="radio block">
                                    	<label><input type="radio" name="published" value="1" <?php if($e && $info->published == 1) echo 'checked=""'; ?> />Published</label>
                                    </div>
                                    
                                    <div class="radio block">
                                    	<label><input type="radio"  name="published" value="0" <?php if($e && $info->published == 0) echo 'checked=""'; ?> />Unpublished</label>
                                    </div>
                                </div>
                              </div>	            
                            
                        </div>
                        
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="btn-toolbar">
                                		<input type="submit" name="submit" id="submit" value="Submit" class="btn-primary btn" />
                                		<input type="submit" name="cancel" id="cancel" value="Cancel" class="btn-default btn" />
                                    </div>
                                </div>
                            </div>
                        </div>              
                        </form>                            
                        <!--PUT DATA HERE-->
                        
                    </div>
                                                            
                    <script language="javascript">
						$(document).ready(function(){								
							/*$("#user_records_per_page").on("change", function(){
								$("#form").submit();
							});*/		
						})
					</script>
                        
                </div> <!-- container -->
            </div> <!--wrap -->
    </div> <!-- page-content -->
    <!-- END CONTENT --> 
    
    