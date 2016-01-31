
<!-- BEGIN CONTENT -->
        <div id="page-content">
            <div id='wrap'>                
                          
                <div class="container">
                    <!--PUT ALERT HERE-->                               
					<?php
                        if(isset($message) && ($message != '')){
							echo '
								<div class="alert alert-dismissable alert-'.$message_type.'">
									'.$message.'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								</div>
							';
                        }
                    ?>
                    <!--PUT ALERT HERE-->   
                    
					<div class="panel">
                        <div class="panel-heading">                            
                              <h4><?php echo $title;?></h4>
                        </div>
                        <div class="panel-body collapse in">
                        
                        	<!--PUT DATA HERE-->

                            <div class="row">
                                <?php
                                    echo $calendar_view;
                                ?>
                                <?php
                                    echo $taskview;
                                ?>
                            </div>

                            <div style="width:100%" align="center">
                                <img src="<?php echo base_url();?>public/images/logo.png" />
                            </div>
                        	<!--PUT DATA HERE-->                        
                            
                        </div>
                    </div>
                    
                    <script language="javascript">
						/*$(document).ready(function(){								
							$("#user_records_per_page").on("change", function(){
								$("#form").submit();
							});	
						})*/
					</script>
                        
                </div> <!-- container -->
            </div> <!--wrap -->
    </div> <!-- page-content -->
    <!-- END CONTENT -->

