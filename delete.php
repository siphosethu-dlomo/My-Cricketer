<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_to_delete = mysqli_real_escape_string($con, $_POST['id_to_delete']);

  $query = "DELETE FROM cricketers WHERE id = $id_to_delete";

  if(mysqli_query($con, $query)) {
    header('Location: index.php');
  } else {
    echo 'query error' . mysqli_error($con);
  }
}