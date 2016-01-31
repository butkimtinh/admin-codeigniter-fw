<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>/public/avant/assets/plugins/form-multiselect/css/multi-select.css' />
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
                        <form action="<?php echo base_url();?>index.php/usergroup/edit_usergroup/<?php echo ($e) ? $info->id : '';?>" method="post" class="form-horizontal" id="form">
                        
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
                                <label for="inputLink" class="col-sm-3 control-label">Note</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" name="txtnote" id="txtnote" placeholder="" value="<?php echo ($e) ? $info->note : '';?>" />
                                </div>
                              </div>
                              <div class="form-group">
                                    <label for="inputLink" class="col-sm-3 control-label">Can View</label>
                                    <div class="col-sm-6">
                                        <?php echo $sltCanView; ?>
                                    </div>
                              </div>
                              <div class="form-group">
                                    <label for="inputLink" class="col-sm-3 control-label">Can Edit</label>
                                    <div class="col-sm-6">
                                        <?php echo $sltCanEdit; ?>
                                    </div>
                              </div>
                              <div class="form-group">
                                <label for="inputLink" class="col-sm-3 control-label">Ordered</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" name="txtordered" id="txtordered" placeholder="" value="<?php echo ($e) ? $info->ordered : '';?>" />
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
                                		<input type="submit" name="submit" value="Submit" class="btn-primary btn" />
                                		<input type="submit" name="cancel" id="cancel" value="Cancel" class="btn-default btn" />
                                        <input type="hidden" name="canview" id="canview" value=""  />
                                        <input type="hidden" name="canedit" id="canedit" value="" />
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
						});

                        $("#form").submit(function(){
                            var strCanView = "";
                            $('#sltCanView :selected').each(function(i, selected){
                                strCanView += $(selected).text() + ",";
                            });
                            $('#canview').val(strCanView);
                            var strCanEdit = "";
                            $('#sltCanEdit :selected').each(function(i, selected){
                                strCanEdit += $(selected).text() + ",";
                            });
                            $('#canedit').val(strCanEdit);
                        });

                        $(function() {
                            $('#sltCanView').multiSelect();
                            $('#sltCanEdit').multiSelect();
                        });

					</script>
                        
                </div> <!-- container -->
            </div> <!--wrap -->
    </div> <!-- page-content -->
    <!-- END CONTENT -->

<script type='text/javascript' src='<?php echo base_url();?>/public/avant/assets/plugins/form-multiselect/js/jquery.multi-select.min.js'></script>