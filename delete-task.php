<?php
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM tasks WHERE id = $id";
    if($conn->query($sql) === TRUE){
        echo '<script>window.location.href = "index.php?msg=Task Deleted Successfully"</script>';
    }
}

?>