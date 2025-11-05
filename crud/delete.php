<?php
include __DIR__ . '/../db.php';
$id = isset($_GET['id'])? (int)$_GET['id']:0;
if($id){
    $conn->query('DELETE FROM sections WHERE id=' . $id);
}
header('Location: read.php');
exit;
