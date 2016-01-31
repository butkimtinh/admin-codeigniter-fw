<?php $this->load->helper('url');?>
<!-- BEGIN SIDEBAR -->
<nav id="page-leftbar" role="navigation">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="acc-menu" id="sidebar">
        <li id="search">
            <a href="javascript:;"><i class="icon-search opacity-control"></i></a>
            <form />
            <input type="text" class="search-query" placeholder="Search..." />
            <button type="submit"><i class="icon-search"></i></button>
            </form>
        </li>

        <li class="divider"></li>

        <li><a href="<?php echo site_url('dashboard'); ?>"><i class="icon-home"></i> <span>Dashboard</span></a></li>

        <?php
        /*echo "<pre>";
        print_r($info);
        echo "</pre>";*/
        function in_menu($ds_lbv,$ma)
        {
            foreach($ds_lbv as $lbv)
            {

                if($lbv['parent_id']==$ma)
                {
                   
                    if(kiem_tra_co_con($ds_lbv,$lbv['id']))
                    {
                        if(check_role($lbv['link'], 'view') || 0)
                            echo '<li><a href="javascript:;"><i class="'.$lbv['icon'].'"></i><span>'.$lbv['title'].'</span></a>';
                        echo '<ul class="acc-menu">';
                        in_menu($ds_lbv,$lbv['id']);
                        echo '</ul>';
                    }else{
                        if(check_role($lbv['link'], 'view') || 0){
                            $links ='<a href="'.site_url($lbv['link']).'">';
                            echo '<li>'.$links.'<i class="'.$lbv['icon'].'"></i><span>'.$lbv['title'].'</span></a>';
                        }
                    }

                    echo '</li>';
                }
            }
        }
        function kiem_tra_co_con($ds_lbv,$ma)
        {
            foreach($ds_lbv as $lbv)
            {
                if($lbv['parent_id']==$ma)
                    return true;
            }
            return false;
        }
        //if(check_role($item['link'], 'view') || 0){
        in_menu($info,0);
        ?>

        <!--<li><a href="javascript:;"><i class="icon-sitemap"></i> <span>Unlimited Level Menu</span></a>
            <ul class="acc-menu">
                <li><a href="javascript:;">Menu Item 1</a></li>
                <li><a href="javascript:;">Menu Item 2</a>
                    <ul class="acc-menu">
                        <li><a href="javascript:;">Menu Item 2.1</a></li>
                        <li><a href="javascript:;">Menu Item 2.2</a>
                            <ul class="acc-menu">
                                <li><a href="javascript:;">Menu Item 2.2.1</a></li>
                                <li><a href="javascript:;">Menu Item 2.2.2</a>
                                    <ul class="acc-menu">
                                        <li><a href="javascript:;">And deeper yet!</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>-->

        </li></ul>
    <!-- END SIDEBAR MENU -->
</nav>

<!-- BEGIN RIGHTBAR -->
<?php /*?><div id="page-rightbar">

    <div id="chatarea">
        <div class="chatuser">
            <span class="pull-right">Jane Smith</span>
            <a id="hidechatbtn" class="btn btn-default btn-sm"><i class="icon-arrow-left"></i> Back</a>
        </div>
        <div class="chathistory">
            <div class="chatmsg">
                <p>Hey! How's it going?</p>
                <span class="timestamp">1:20:42 PM</span>
            </div>
            <div class="chatmsg sent">
                <p>Not bad... i guess. What about you? Haven't gotten any updates from you in a long time.</p>
                <span class="timestamp">1:20:46 PM</span>
            </div>
            <div class="chatmsg">
                <p>Yeah! I've been a bit busy lately. I'll get back to you soon enough.</p>
                <span class="timestamp">1:20:54 PM</span>
            </div>
            <div class="chatmsg sent">
                <p>Alright, take care then.</p>
                <span class="timestamp">1:21:01 PM</span>
            </div>
        </div>
        <div class="chatinput">
            <textarea name="" rows="2"></textarea>
        </div>
    </div>

    <div id="widgetarea">
        <div class="widget">
            <div class="widget-heading">
                <a href="javascript:;" data-toggle="collapse" data-target="#accsummary"><h4>Account Summary</h4></a>
            </div>
            <div class="widget-body collapse in" id="accsummary">
                <div class="widget-block" style="background: #7ccc2e;">
                    <div class="pull-left">
                        <small>Current Balance</small>
                        <h5>$71,182</h5>
                    </div>
                    <div class="pull-right"><div id="currentbalance"></div></div>
                </div>
                <div class="widget-block" style="background: #595f69;">
                    <div class="pull-left">
                        <small>Account Type</small>
                        <h5>Business Plan A</h5>
                    </div>
                    <div class="pull-right">
                        <small class="text-right">Monthly</small>
                        <h5>$19<small>.99</small></h5>
                    </div>
                </div>
                <span class="more"><a href="#">Upgrade Account</a></span>
            </div>
        </div>


        <div id="chatbar" class="widget">
            <div class="widget-heading">
                <a href="javascript:;" data-toggle="collapse" data-target="#chatbody"><h4>Online Contacts <small>(5)</small></h4></a>
            </div>
            <div class="widget-body collapse in" id="chatbody">
                <ul class="">
                    <li data-stats="online"><a href="javascript:;"><img src="<?php echo base_url();?>/public/avant/assets/demo/avatar/potter.png" alt="" /><span>Jeremy Potter</span></a></li>
                    <li data-stats="online"><a href="javascript:;"><img src="<?php echo base_url();?>/public/avant/assets/demo/avatar/tennant.png" alt="" /><span>David Tennant</span></a></li>
                    <li data-stats="online"><a href="javascript:;"><img src="<?php echo base_url();?>/public/avant/assets/demo/avatar/johansson.png" alt="" /><span>Anna Johansson</span></a></li>
                    <li data-stats="busy"><a href="javascript:;"><img src="<?php echo base_url();?>/public/avant/assets/demo/avatar/jackson.png" alt="" /><span>Eric Jackson</span></a></li>
                    <li data-stats="away"><a href="javascript:;"><img src="<?php echo base_url();?>/public/avant/assets/demo/avatar/jobs.png" alt="" /><span>Howard Jobs</span></a></li>
                    <!--li data-stats="offline"><a href="javascript:;"><img src="../public/avant/assets/demo/avatar/watson.png" alt=""><span>Annie Watson</span></a></li>
                    <li data-stats="offline"><a href="javascript:;"><img src="../public/avant/assets/demo/avatar/doyle.png" alt=""><span>Alan Doyle</span></a></li>
                    <li data-stats="offline"><a href="javascript:;"><img src="../public/avant/assets/demo/avatar/corbett.png" alt=""><span>Simon Corbett</span></a></li>
                    <li data-stats="offline"><a href="javascript:;"><img src="../public/avant/assets/demo/avatar/paton.png" alt=""><span>Polly Paton</span></a></li-->
                </ul>
                <span class="more"><a href="#">See all</a></span>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <a href="javascript:;" data-toggle="collapse" data-target="#taskbody"><h4>Pending Tasks <small>(5)</small></h4></a>
            </div>
            <div class="widget-body collapse in" id="taskbody">
                <div class="contextual-progress">
                    <div class="clearfix">
                        <div class="progress-title">Backend Development</div>
                        <div class="progress-percentage">25%</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-info" style="width: 25%"></div>
                    </div>
                </div>
                <div class="contextual-progress">
                    <div class="clearfix">
                        <div class="progress-title">Bug Fix</div>
                        <div class="progress-percentage">17%</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" style="width: 17%"></div>
                    </div>
                </div>
                <div class="contextual-progress">
                    <div class="clearfix">
                        <div class="progress-title">Javascript Code</div>
                        <div class="progress-percentage">70%</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 70%"></div>
                    </div>
                </div>
                <div class="contextual-progress">
                    <div class="clearfix">
                        <div class="progress-title">Preparing Documentation</div>
                        <div class="progress-percentage">6%</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger" style="width: 6%"></div>
                    </div>
                </div>
                <div class="contextual-progress">
                    <div class="clearfix">
                        <div class="progress-title">App Development</div>
                        <div class="progress-percentage">20%</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-orange" style="width: 20%"></div>
                    </div>
                </div>

                <span class="more"><a href="ui-progressbars.php">View all Pending</a></span>
            </div>
        </div>



        <div class="widget">
            <div class="widget-heading">
                <a href="javascript:;" data-toggle="collapse" data-target="#storagespace"><h4>Storage Space</h4></a>
            </div>
            <div class="widget-body collapse in" id="storagespace">
                <div class="contextual-progress">
                    <div class="clearfix">
                        <div class="progress-title">1.31 GB of 1.50 GB used</div>
                        <div class="progress-percentage">87.3%</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 50%"></div>
                        <div class="progress-bar progress-bar-warning" style="width: 25%"></div>
                        <div class="progress-bar progress-bar-danger" style="width: 12.3%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <a href="javascript:;" data-toggle="collapse" data-target="#serverstatus"><h4>Server Status</h4></a>
            </div>
            <div class="widget-body collapse in" id="serverstatus">
                <div class="clearfix" style="padding: 10px 24px;">
                    <div class="pull-left">
                        <div class="easypiechart" id="serverload" data-percent="67">
                            <span class="percent"></span>
                        </div>
                        <label for="serverload">Load</label>
                    </div>
                    <div class="pull-right">
                        <div class="easypiechart" id="ramusage" data-percent="20.6">
                            <span class="percent"></span>
                        </div>
                        <label for="ramusage">RAM: 422MB</label>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div> <?php */?>
<style type="text/css">
    #sidebar ul li a{padding: 5px 7px!important}
    #sidebar li li li a{padding-left: 30px!important;}
	#rightmenu-trigger{ display: none; }
</style>
<!-- END RIGHTBAR -->