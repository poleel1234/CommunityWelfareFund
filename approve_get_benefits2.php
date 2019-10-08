<?php
session_start();
include "connect_db.php";
if($_GET['mode'] == 'fail'){
?>           
<form class="form-horizontal" action="approve_get_benefits_save.php?mode=fail" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div>
                    <div class="panel-body">                                                                        
                        <div class="row">
                            <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">ไม่อนุมัติเนื่องจาก</label>
                                    <div class="col-md-9 col-xs-12">      
                                        <input type="hidden" name="get_id" value="<?=$_SESSION['ss_get_id']?>">
                                        <textarea class="form-control" name="disapproval" rows="5" required=""></textarea>
                                    </div>
                                 </div>
                            </div>
                    </div>
                        <div><br>
                        <button class="btn btn-primary pull-right" type="submit">Submit</button>
                    <a href="approve_get_benefits_show.php"><button type="button" class="btn btn-default btn-lg">Close</button></a> 
                    </div>
                </div>
                </div>
            </form>
<?php } ?>