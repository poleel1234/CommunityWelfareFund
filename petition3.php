<?php
session_start();
include "connect_db.php";
 $sql_basic1 = "SELECT COUNT(*) AS sum FROM petition p WHERE p.mem_id = '".$_SESSION['login_reg_id']."'"
         . " AND p.pet_type = '".$_GET['pet_type']."' and p.aut_id != '' and p.pet_state != 1";
$query_basic1 = mysqli_query($connect, $sql_basic1);
$array_basic1 = mysqli_fetch_array($query_basic1);
//แจ้งเตือนค่า
if($array_basic1['sum'] > 0){
   echo "<script>alert('ไม่สามารถกู้ยิมได้ ท่านค้างชำระหนี้ ');</script>";
echo "<META http-equiv='refresh' Content='0; URL=index.php'> "; 
}else {
}
                             
          
?>
<input type="text" value="<?=$_GET['pet_type']?>-<?=$_GET['mem_id']?>" readonly="" class="form-control"/>
<?php
include 'footer.php';
?>