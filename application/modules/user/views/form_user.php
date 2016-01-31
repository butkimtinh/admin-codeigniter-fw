<!-- BEGIN CONTENT -->
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <h1><?php echo $title;?></h1>
            <div class="options">
                <div class="btn-toolbar">
                    <a href="#" class="btn btn-muted"><i class="icon-cog"></i></a>
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
                <form action="<?php echo base_url();?>index.php/user/edit_user/<?php echo ($e) ? $info->id : '';?>" method="post" class="form-horizontal" >

                    <div class="panel-heading">
                        <h4><?php echo $title;?></h4>
                        <div class="options">
                            <a href="javascript:;" class="panel-collapse"><i class="icon-chevron-down"></i></a>
                        </div>
                    </div>
                    <div class="panel-body collapse in">
                        <div class="form-group">
                            <label for="usernamenput" class="col-sm-3 control-label">Tên đăng nhập</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtusername" name="txtusername" placeholder="" value="<?php echo ($e) ? $info->username : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-3 control-label">Mật khẩu</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="pass" id="pass" placeholder="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fullnameinput" class="col-sm-3 control-label">Họ và tên</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtfullname" name="txtfullname" placeholder="" value="<?php echo ($e) ? $info->name : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="addressinput" class="col-sm-3 control-label">Địa chỉ</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtaddress" name="txtaddress" placeholder="" value="<?php echo ($e) ? $info->address : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phoneinput" class="col-sm-3 control-label">Điện thoại</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtphone" name="txtphone" placeholder="" value="<?php echo ($e) ? $info->phone : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emailinput" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="fieldemail" name="txtemail" placeholder="" value="<?php echo ($e) ? $info->email : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Facebook</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="fieldfacebook" name="txtfacebook" placeholder="" value="<?php echo ($e) ? $info->facebook : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="workdayinput" class="col-sm-3 control-label">Birthday</label>
                            <div class="col-sm-2">
                                <select id="year" name='year'>
                                    <?php
                                    echo ($e) ? '<option value="'.substr($info->birthday,0,4).'">'.substr($info->birthday,0,4)."</option>" : '';
                                    for ($i=1950;$i<=date('Y');$i++){
                                        echo "<option value = $i > $i </option>";
                                    }
                                    ?>
                                </select>
                                <select id="month" name='month'>
                                    <?php
                                    echo ($e) ? '<option value="'.substr($info->birthday,5,2).'">'.substr($info->birthday,5,2)."</option>" : '';
                                    for ($i=1;$i<=12;$i++){
                                        echo "<option value = $i > $i </option>";
                                    }
                                    ?>
                                </select>
                                <select id="day" name='day'>
                                    <?php
                                    echo ($e) ? '<option value="'.substr($info->birthday,8,2).'">'.substr($info->birthday,8,2)."</option>" : '';
                                    for ($i=1;$i<=31;$i++){
                                        echo "<option value = $i > $i </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <script>
                                $(function() {
                                    //jQueryUI Date Picker
                                    $("#datepicker").datepicker({dateFormat: "yy-mm-dd"});
                                    $('#user_datepickerbtn').click(function () {
                                        $('#datepicker').datepicker("show");
                                    });
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="sexinput" class="col-sm-3 control-label">Giới tính</label>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender" value="Male" <?php if(isset($info->gender ) and ($info->gender == 'Male')){echo 'checked';} ?>>
                                        Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender" value="Female"  <?php if(isset($info->gender ) and ($info->gender == 'Female')){echo 'checked';} ?>>
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(function() {
                                //jQueryUI Date Picker
                                $("#datepicker").datepicker({dateFormat: "yy-mm-dd"});
                                $('#user_datepickerbtn').click(function () {
                                    $('#datepicker').datepicker("show");
                                });
                            });
                        </script>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mô tả</label>
                            <div class="col-sm-6">
                                <textarea name="txtdescription" class="form-control" rows="3"><?php echo ($e) ? $info->description : '';?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="selector1" class="col-sm-3 control-label">Nhóm</label>
                            <div class="col-sm-6"><?php echo $sltUserGroup; ?></div>
                        </div>

                        <div class="form-group">
                            <label for="radio" class="col-sm-3 control-label">Published</label>
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
                                    <input type="submit" name="submit" id="submit" value="Nhập" class="btn-primary btn" />
                                    <input type="submit" name="cancel" id="cancel" value="Hủy" class="btn-default btn" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--PUT DATA HERE-->

            </div>
        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->
<!-- END CONTENT -->