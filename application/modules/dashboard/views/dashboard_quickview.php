<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-6">
                <a class="info-tiles tiles-grape" href="<?php echo site_url("invoices/");?> ">
                    <div class="tiles-heading">Revenue</div>
                    <div class="tiles-body-alt">
                        <div class="text-center"><span class="text-top" >$</span><span id="today_revenue">0</span><span class="text-smallcaps"></span></div>
                        <small>yesterday: $<span id="yesterday_revenue">0</span></small>
                    </div>
                    <div class="tiles-footer">go to invoices</div>
                </a>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <a class="info-tiles tiles-midnightblue" href="<?php echo site_url("invoices/");?>">
                    <div class="tiles-heading">Orders</div>
                    <div class="tiles-body-alt">
                        <i class="icon-shopping-cart"></i>
                        <div class="text-center"><span id="today_orders">0</span></div>
                        <small>today orders with <span id="today_items">0</span> item(s)</small>
                    </div>
                    <div class="tiles-footer">manage orders</div>
                </a>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <a class="info-tiles tiles-success" href="<?php echo site_url("purchasingorder/");?>">
                    <div class="tiles-heading">Pipeline</div>
                    <div class="tiles-body-alt">
                        <i class="icon-truck"></i>
                        <div class="text-center"><span id="pipeline_total">0</span></div>
                        <small>product(s) in <span id="count_order">0</span> orders</small>
                    </div>
                    <div class="tiles-footer">manage purchasing orders</div>
                </a>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <a class="info-tiles tiles-danger" href="<?php echo site_url("inventory/");?>">
                    <div class="tiles-heading">Out of stock</div>
                    <div class="tiles-body-alt">
                        <i class="icon-truck"></i>
                        <div class="text-center"><span id="out_of_stock">0</span></div>
                        <small>product(s)</small>
                    </div>
                    <div class="tiles-footer">manage inventory</div>
                </a>
            </div>
        </div>
    </div>
</div>
