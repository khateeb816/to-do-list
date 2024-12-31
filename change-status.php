<?php
include 'db.php';
$sql = "UPDATE `tasks` SET `status` = '{$_GET['value']}' WHERE `id` = {$_GET['id']}";
if($conn->query($sql) === TRUE){

    echo '<script>window.location.href = "index.php?msg=Task Status Changed Successfully"</script>';
}
?>