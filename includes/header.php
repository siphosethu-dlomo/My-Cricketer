<?php

if(strpos($_SERVER['PHP_SELF'], "index.php")) {
  $title = 'Home - My Cricketer';
} elseif (strpos($_SERVER['PHP_SELF'], "create.php")) {
  $title = 'Create - My Cricketer';
} elseif (strpos($_SERVER['PHP_SELF'], "edit.php")) {
  $title = 'Edit - My Cricketer';
}

?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title><?php echo $title ?></title>
  <body class="bg-body-tertiary d-flex flex-column vh-100">
    <header class="d-flex justify-content-around align-items-center py-3 mb-5 border-bottom">
      <div class="brand">
        <a href="index.php" class="text-decoration-none">
          <h1>My Cricketer</h1>
        </a>
      </div>
      <div class="<?php echo strpos($_SERVER['PHP_SELF'], "create.php") ? 'd-none' : ' '; ?>">
        <a href="create.php" class="btn btn-primary">Post Cricketer</a>
      </div>
    </header>