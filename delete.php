<?php
include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM  `student` WHERE `id`='$id'";

$run = mysqli_query($conn,$sql);

if($run){
    header('location:show.php');
}
