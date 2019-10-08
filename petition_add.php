<?php
@session_start();
if($_GET['mode'] == 'add'){
if (in_array($_GET['mem_id'], $_SESSION['session_pet_mem_id'])) {
}else{
$_SESSION['session_pet_mem_id'][] = $_GET['mem_id'];
}
echo 'ok';
}else if($_GET['mode'] == 'del'){
    foreach ($_SESSION['session_pet_mem_id'] as $key => $value) {
        if ($value == $_GET['mem_id']) {
            unset($_SESSION['session_pet_mem_id'][$key]);
        }
    }
}
?>