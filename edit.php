<?php 

  include('config/db_connection.php');

  // get full url 
  $url = $_SERVER['REQUEST_URI'];

  // returns url query param(s) as string - a variable
  $id_var = parse_url($url, PHP_URL_QUERY);

  // converts string above(query param) to array (in a way) [first param: converts query param to array | second param: name of array]
  parse_str($id_var, $url_id);

  // value (what's wanted wanted) of query param: which is the id value of post
  $url_id_value = $url_id['id'];

  // get siingle post by id
  $query = "SELECT * FROM cricketers WHERE id = $url_id_value";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // make sure fields are empty initially when loading page
  $username = $email = $cricketer = $role = $comment = '';

  $errors = [
    'username' => '',
    'email' => '',
    'cricketer' => '',
    'role' => '',
    'comment' => ''
  ];

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if something is posted

    // validate and send form
    
    if(empty($_POST['username'])) {
      $errors['username'] = 'username is required';
    } else {
      $username = $_POST['username'];
      if(!preg_match('/^[a-zA-Z\s]+$/', $username)) {
        $errors['username'] = 'username must be letter and spaces only';
      }
    }

    if(empty($_POST['email'])) {
      $errors['email'] = 'email is required';
    } else {
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'email must be a validate email address';
      }
    }

    if(empty($_POST['cricketer'])) {
      $errors['cricketer'] = 'cricketer is required';
    } else {
      $cricketer = $_POST['cricketer'];
      if(!preg_match('/^[a-zA-Z\s]+$/', $cricketer)) {
        $errors['cricketer'] = 'cricketer must be letter and spaces only';
      }
    }

    if(empty($_POST['role'])) {
      $errors['role'] = 'role is required';
    } else {
      $role = $_POST['role'];
    }

    if(empty($_POST['comment'])) {
      $errors['comment'] = 'comment is required';
    } else {
      $comment = $_POST['comment'];
      if(!preg_match('/^[a-zA-Z\s]+$/', $comment)) {
        $errors['comment'] = 'cricketer must be letter and spaces only';
      }
    }

    if(array_filter($errors)) {
      // show errors
    } else {
      // form is valid
      $username = mysqli_real_escape_string($con, $_POST['username']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $cricketer = mysqli_real_escape_string($con, $_POST['cricketer']);
      $role = mysqli_real_escape_string($con, $_POST['role']);
      $comment = mysqli_real_escape_string($con, $_POST['comment']);
    
      $query = "UPDATE cricketers 
      SET username = '$username', email = '$email', cricketer = '$cricketer', role = '$role', comment = '$comment'
      WHERE id = $url_id_value";

      if(mysqli_query($con, $query)) {
        header('Location: index.php');
      } else {
        echo 'query error' . mysqli_error($con);
      }
    }
  }

?>

<?php include('includes/header.php'); ?>

<div class="row justify-content-center mb-5 px-3">
  <div class="col-lg-6">
    <form action="" class="text center" method="POST">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($data[0]['username']); ?>">
        <p class="text-danger"><?php echo htmlspecialchars($errors['username']); ?></p>
      </div>
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($data[0]['email']); ?>">
        <p class="text-danger"><?php echo htmlspecialchars($errors['email']); ?></p>
      </div>
      <div class="mb-3">
        <label class="form-label">Favourite cricketer</label>
        <input type="text" class="form-control" name="cricketer" value="<?php echo htmlspecialchars($data[0]['cricketer']); ?>">
        <p class="text-danger"><?php echo htmlspecialchars($errors['cricketer']); ?></p>
      </div>
      <div class="mb-3">
      <label class="form-label">Select role</label>
        <select class="form-select" name="role">
          <option>Batter</option>
          <option>Bowler</option>
          <option>Wicket Keeper</option>
          <option>Batting all-rounder</option>
          <option>Bowling all-rounder</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Please tell us what you like about the player</label>
        <textarea class="form-control" rows="3" name="comment"><?php echo htmlspecialchars($data[0]['comment']); ?></textarea>
        <p class="text-danger"><?php echo htmlspecialchars($errors['comment']); ?></p>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </div>
    </form>
  </div>
</div>

<?php include('includes/footer.php'); ?>

