
                            <div class="row">
                                <div class="panel panel-success">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 clearfix">
                                                <h4 class="pull-left" style="margin:0 0 10px">Sales Compared To Forecast</h4>
                                            </div>

                                            <div class="col-xs-6 col-sm-6 col-md-3">
                                                <span class="easypiechart" id="this_month" data-percent="0">
                                                    <span class="percent"></span>
                                                </span>
                                                <label for="bouncerate">This month</label>
                                                <hr class="visible-sm visible-xs" />
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-3">
                                                <span class="easypiechart" id="this_year" data-percent="0">
                                                    <span class="percent"></span>
                                                </span>
                                                <label for="bouncerate">This year</label>
                                                <hr class="visible-sm visible-xs" />
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-3">
                                                <div class="easypiechart" id="last_month" data-percent="0">
                                                    <span class="percent"></span>
                                                </div>
                                                <label for="newvisits">Last month</label>
                                                <hr class="visible-sm visible-xs" />
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-3">
                                                <div class="easypiechart" id="last_year" data-percent="0">
                                                    <span class="percent"></span>
                                                </div>
                                                <label for="newvisits">Last year</label>
                                                <hr class="visible-sm visible-xs" />
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

    <style>
        .easypiechart {
            position: relative;
            display: block;
            width: 150px;
            height: 150px;
            line-height: 150px;
            margin: 0 auto;
            text-align: center;
        }
        .easypiechart .percent {
            position: absolute;
            width: 150px;
            line-height: 150px;
            font-size: 24px;
            font-weight: 300;
            color: #808080;
        }
    </style>
<script language="JavaScript">

    jQuery(document).ready(function() {




    });
</script>
<script type='text/javascript' src='<?php echo base_url();?>public/avant/assets/plugins/easypiechart/jquery.easypiechart.min.js'></script>