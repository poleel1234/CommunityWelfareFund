<?php
@session_start();
include "connect_db.php";
?><br><br><br>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-md-3 control-label">สมาชิก</label>
            <div class="col-md-7">                                                                                
                <select class="form-control" data-live-search="true" name="mem_id" id="mem_id-vv" required="">
                    <option style="display: none;"></option>
                    <?php
                    $sql_basic1 = "select * from member order by mem_id asc";
                    $query_basic1 = mysqli_query($connect, $sql_basic1);
                    while ($array_basic1 = mysqli_fetch_array($query_basic1)) {
                        ?>
                        <option value="<?= $array_basic1['mem_id'] ?>">[<?= $array_basic1['mem_id'] ?>] <?= $array_basic1['mem_name'] ?> <?= $array_basic1['mem_lastname'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2">
                <button id="add-list" class="btn btn-primary pull-right" type="button">เพิ่มรายชื่อ</button>
            </div>

        </div>
    </div>
</div><br><br><br><br><br>
<?php
if (count($_SESSION['session_pet_mem_id']) > 0) {
    ?>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th>สมาชิก</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อายุ</th>
                    <th>ที่อยู่</th>
                    <th>เป็นสมาชิกตั้งแต่</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($_SESSION['session_pet_mem_id']) == 0) {
                    ?>	
                    <tr>
                        <th style="text-align: center;color: darkred;"><i class="icon-info-sign"></i> ไม่พบข้อมูล</th>
                    </tr>
                    <?php
                } else {
                    foreach ($_SESSION['session_pet_mem_id'] as $key => $value) {
                        $sql_ses = "SELECT * FROM member m LEFT JOIN register r ON r.reg_id = m.reg_id WHERE m.mem_id = '" . $_SESSION['session_pet_mem_id'][$key] . "' ";
                        $query_ses = mysqli_query($connect, $sql_ses);
                        $array_ses = mysqli_fetch_array($query_ses);

                        $me = $array_ses['mem_birthday'];
                        $Y = date("Y");
                        $YE2 = date("Y", strtotime($me));
                        $D2 = $Y - $YE2;
                        ?>
                        <tr>
                            <td><?= $_SESSION['session_pet_mem_id'][$key] ?></td>
                            <td><?= $array_ses['mem_name'] ?> <?= $array_ses['mem_lastname'] ?></td>
                            <td><?= $D2 ?></td>
                            <td><?= $array_ses['mem_address'] ?></td>
                            <td><?= changedate($array_ses['mem_date']); ?></td>
                            <td><button  data-id="<?= $_SESSION['session_pet_mem_id'][$key] ?>" class="btn btn-danger pull-right del-list" type="button">ลบ</button></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
<?php } ?>