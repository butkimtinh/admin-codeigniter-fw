	<!-- BEGIN CONTENT -->
        <div id="page-content">
            <div id='wrap'>
                <div id="page-heading">        
                    <h1><?php echo $title;?></h1>
                    <div class="options">
                        <div class="btn-toolbar">
                        <?php if($canEdit){?>
                            <a href="#" class="btn btn-muted" title="New" id="new_button"><i class="icon-pencil"></i></a>
                            <a href="#" class="btn btn-muted" title="Delete" id="delete_button"><i class="icon-trash"></i></a>
                        <?php } ?>
                        </div>
                    </div>
                </div>
                          
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
                    
                	<form action="<?php echo site_url("user/index");?>" method="post" name="form" id="form">
                    
					<div class="panel panel-midnightblue">
                        <div class="panel-heading">                            
                              <h4><?php echo $title;?></h4>
                            <div class="options">   
                                <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a>
                            </div>
                        </div>
                        <div class="panel-body collapse in">
                        
                        	<!--PUT DATA HERE-->    
                             
                            <div id="example_wrapper" class="dataTables_wrapper" role="grid">
                            <div class="row">
                                <div class="col-xs-6">                            
                                    <div id="example_length" class="dataTables_length">
                                        <label>
                                            <select size="1" name="user_records_per_page" id="user_records_per_page" aria-controls="example" class="form-control records_per_page">
                                                <option value="5"  <?php if($per_page == 5) echo 'selected="selected"';?>>5</option>
                                                <option value="10" <?php if($per_page == 10) echo 'selected="selected"';?>>10</option>
                                                <option value="25" <?php if($per_page == 25) echo 'selected="selected"';?>>25</option>
                                                <option value="50" <?php if($per_page == 50) echo 'selected="selected"';?>>50</option>
                                                <option value="100"<?php if($per_page == 100) echo 'selected="selected"';?>>100</option>
                                                <option value="99999999" <?php if($per_page == 99999999) echo 'selected="selected"';?>>All</option>
                                            </select> records / page
                                        </label>
                                    </div>                            
                                </div>
                            
                            	<div class="col-xs-6">
                                	<div class="dataTables_filter" id="example_filter">
                                        <label>
                            				<a href="#" class="btn btn-muted" title="Clear search" id="clear_button"><i class="icon-refresh"></i></a>
                                        </label>
                                        
                                        <label>
                            				<a href="#" class="btn btn-muted" title="Clear search" id="submit_button"><i class="icon-ok"></i></a>
                                        </label>
                                    	<label>
                                        	<input type="text" aria-controls="example" class="form-control search" placeholder="Search..." name="user_search" value="<?php echo $search;?>">
                                        </label>
                                        <label><?php echo $sltUserGroup;?></label>
                                    </div>
                                </div>
                            </div>                            
                            
                            <table class="table">
                                    <thead>
                                        <tr>
                                        	<!--SORT-->
                                            <input type="hidden" name="user_order_by" id="order_by" value="<?php echo $order_by; ?>" />
                                            <input type="hidden" name="user_asc_desc" id="asc_desc" value="<?php echo $asc_desc; ?>" />
                                        	<!--SORT-->
                                            
                                            <th width="3%"><input type="checkbox" id="select-all"></th>
                                            <th width="3%">#</th>
                                            <th width="20%" class="sorting <?php echo ($order_by == 'name') ? 'sorting_'.$asc_desc : '';?>"
                                                title="Click to sort" alt="name">Họ tên</th>
                                            <th width="7%">Ngày sinh</th>
                                            <th width="30%">Địa chỉ</th>
                                            <th width="15%" class="sorting <?php echo ($order_by == 'username') ? 'sorting_'.$asc_desc : '';?>"
                                            				title="Click to sort" alt="username">Facebook</th>
                                                            
                                            <th width="15%" class="sorting <?php echo ($order_by == 'usergroup_title') 	 ? 'sorting_'.$asc_desc : '';?>"
                                            				title="Click to sort" alt="usergroup_title">Email/Điện thoại</th>
                                                            
                                            <th width="20%"class="sorting <?php echo ($order_by == 'published') ? 'sorting_'.$asc_desc : '';?>"
                                            				title="Click to sort" alt="published">Trạng thái</th>
                                                            
                                            <th width="10%" style="text-align:center">Sửa</th>
                                            <th width="10%" style="text-align:center">Xóa</th>
                                                            
                                            <th width="4%"class="sorting <?php echo ($order_by == 'id') ? 'sorting_'.$asc_desc : '';?>"
                                            				title="Click to sort" alt="id">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody class="selects">                                        
                                        <?php
                                            $stt = $start_no-1;
                                            foreach($info as $item){
                                                $stt++;
                                                echo "<tr>";
                                                echo "<td><input type='checkbox' name='id[]' value='".$item['id']."'></td>";
                                                echo "<td width='50'>$stt</td>";
												
												if($canEdit)
	                                                echo "<td><a href='".base_url()."index.php/user/edit_user/$item[id]'>$item[name]</a></td>";
												else
													echo "<td><a href='#'>$item[name]</a></td>";
                                                echo "<td class='text-muted'>".$item['birthday']."</td>";
                                                echo "<td class='text-muted'>".$item['address']."</td>";
                                                echo "<td class='text-muted'>".$item['facebook']."</td>";
                                                echo "<td class='text-muted'>".$item['email']."<br />".$item['phone']."</td>";
												
												if($canEdit){
													$publishedLink = "<a style='color: #fff; text-decoration: none;' 																href='".base_url()."index.php/user/unpublished_user/$item[id]'>Published</a>";
													$unpublishedLink = "<a style='color: #fff; text-decoration: none;' 																href='".base_url()."index.php/user/published_user/$item[id]'>Unpublished</a>";
												}else{
													$publishedLink = "Published";
													$unpublishedLink = "UnPublished";
													
												}
												
                                                if($item['published']){
                                                    echo "<td><span class='label label-success'>".$publishedLink."</span></td>";
                                                }else{
                                                    echo "<td><span class='label label-danger'>".$unpublishedLink."</span></td>";
                                                }
												
												if($canEdit)
                                                	echo "<td align='center'><a href='".base_url()."index.php/user/edit_user/$item[id]'><i class='icon-wrench'></i></a></td>";
                                                else
													echo "<td align='center'><i class='icon-wrench'></i></td>";
													
												if($canEdit)
                                                	echo "<td align='center'><a href='".base_url()."index.php/user/delete_user/$item[id]'><i class='icon-trash'></i></a></td>";
                                                else
													echo "<td align='center'><i class='icon-trash'></i></td>";
													
												echo "<td width='50'>".$item['id']."</td>";
												
                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="dataTables_info" id="example_info">
                                        	Showing <?php echo ($total_rows) ? $start_no : 0;?> to <?php echo $stt;?> of <?php echo $total_rows;?> entries
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-6">
                                        <div class="dataTables_paginate paging_bootstrap">
                                            <?php echo $this->pagination->create_links();?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        	<!--PUT DATA HERE-->                        
                            
                        </div>
                    </div>
                    </form>
                    
                    <script language="javascript">
						$(document).ready(function(){								
							$("#user_records_per_page").on("change", function(){
								$("#form").submit();
							});	
														
							$("#delete_button").on("click", function(){
								var r = confirm("Are you sure!?");
								if (r == true) {									
									$("#form").attr("action", '<?php echo site_url("user/delete_user");?>');
									$("#form").submit();
								}
							});	
														
							$("#new_button").on("click", function(){								
								$("#form").attr("action", '<?php echo site_url("user/new_user");?>');
								$("#form").submit();
							});	
							
							$('#select-all').on("click", function(){
								var checkboxes = $(this).closest('form').find(':checkbox');
								if($(this).is(':checked')) {
									checkboxes.prop('checked', true);
								} else {
									checkboxes.prop('checked', false);
								}
							});
							
							$(".sorting").on("click", function(){
								var asc_desc = $("#asc_desc").val();	
								var order_by = $(this).attr('alt');
								
								$("#order_by").val(order_by);	
								
								if(asc_desc == 'asc'){
									$("#asc_desc").val("desc");	
								}else{
									$("#asc_desc").val("asc");		
								}
								
								$("#form").submit();
							});
							
							$("#clear_button").on("click", function(){
								$(".records_per_page").val('10');
								$(".search").val('');
								$("#order_by").val('id');	
								$("#asc_desc").val("asc");
								$("#user_group_id").val("0");
								$("#form").submit();
							});

							$("#submit_button").on("click", function(){
								$("#form").submit();
							});
						})
					</script>
                        
                </div> <!-- container -->
            </div> <!--wrap -->
    </div> <!-- page-content -->
    <!-- END CONTENT --> 
    
    