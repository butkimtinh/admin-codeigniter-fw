    <div id="headerbar">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-brown">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="icon-pencil"></i></div>
                        </div>
                        <div class="tiles-footer">
                            Create Post
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-grape">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="icon-group"></i></div>
                            <div class="pull-right"><span class="badge">2</span></div>
                        </div>
                        <div class="tiles-footer">
                            Contacts
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-primary">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="icon-envelope-alt"></i></div>
                            <div class="pull-right"><span class="badge">10</span></div>
                        </div>
                        <div class="tiles-footer">
                            Messeges
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-inverse">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="icon-camera"></i></div>
                            <div class="pull-right"><span class="badge">3</span></div>
                        </div>
                        <div class="tiles-footer">
                            Gallery
                        </div>
                    </a>
                </div>

                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-green">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="icon-cog"></i></div>
                        </div>
                        <div class="tiles-footer">
                            Settings
                        </div>
                    </a>
                </div>
                <!--div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-success">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="icon-cog"></i></div>
                        </div>
                        <div class="tiles-footer">
                            Admin Settings
                        </div>
                    </a>
                </div-->
                            
            </div>
        </div>
    </div>

    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <a id="leftmenu-trigger" class="pull-left" data-toggle="tooltip" data-placement="bottom" title="Toggle Left Sidebar"></a>
        <a id="rightmenu-trigger" class="pull-right" data-toggle="tooltip" data-placement="bottom" title="Toggle Right Sidebar"></a>

        <div class="navbar-header pull-left">
            <a class="navbar-brand" href="index.php">Avant</a>
        </div>

        <?php
	        $avt = '';
	        if($this->session->userdata('user_avatar') != ''){
		        if(file_exists('public/images/user/avatar/'.$this->session->userdata('user_avatar')))
			        $avt = $this->session->userdata('user_avatar');
		        else
			        $avt = '';
	        }

	        if($avt == ''){
		        if($this->session->userdata('user_gender') == 'Female')
			        $avt = 'non-avatar-female.jpg';
		        else
			        $avt = 'non-avatar-male.jpg';
            }
        ?>

        <ul class="nav navbar-nav pull-right toolbar">
        	<li class="dropdown">
        		<a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span class="hidden-xs"><?php echo $this->session->userdata('user_name');?> <i class="icon-caret-down icon-scale"></i></span>
                    <!--
                    <img class="userimg" src="<?php echo base_url()."/public/images/user/avatar/".$avt;?>" />
                    -->
                </a>
        		<ul class="dropdown-menu userinfo arrow">
        			<li class="username">
                        <a href="#">
	                        <!--
                            <div class="pull-left"><img class="userimg" src="<?php echo base_url()."/public/images/user/avatar/".$avt;?>" /></div>
                            -->
        				    <div class="pull-right"><h5><?php echo $this->session->userdata('user_name');?></h5>
                            <small>Logged in as <span><?php echo $this->session->userdata('user_username');?></span></small></div>
                        </a>
        			</li>
        			<li class="userlinks">
        				<ul class="dropdown-menu">
        					<li><a href="<?php echo site_url('user/edit_user/'.$this->session->userdata('user_id'));?>">Edit Profile <i class="pull-right icon-pencil"></i></a></li>
        					<li><a href="#">Account <i class="pull-right icon-cog"></i></a></li>
        					<li><a href="#">Help <i class="pull-right icon-question-sign"></i></a></li>
        					<li class="divider"></li>
        					<li><a href="<?php echo site_url('user/logout_user');?>" class="text-right" id="logout_user">Log Out</a></li>
                            <script language="javascript">															
							$("#logout_user").on("click", function(){
								var r = confirm("Are you sure!?");
								if (r != true) {		
									return false;
								}
							});	
							</script>
        				</ul>
        			</li>
        		</ul>
        	</li>

        	<li class="dropdown">

			</li>
			

            <!-- 
            <li>
                <a href="#" id="headerbardropdown"><span><i class="icon-level-down"></i></span></a>
            </li>
            -->
		</ul>
    </header>