<?php 

  include('config/db_connection.php');

  // delete posts
  include('delete.php');

  // get posts
  $query = "SELECT * FROM cricketers ORDER BY created_at";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // free memory
  mysqli_free_result($result);

  // close connection
  mysqli_close($con);

?>
    
<?php include('includes/header.php'); ?>

<main class="mb-5">
  <?php if (count($data) <= 0): ?>
    <div class="text-center text-body-secondary">No Cricketers Posted Yet...</div>
  <?php else: ?> 
    <div class="container">
      <div class="row">

        <?php foreach($data as $user): ?>  
          <div class="col">
            <div class="card text-center">
              <div class="card-body">
                <div class="card-header">
                  <h3 class="card-title"><?php echo htmlspecialchars($user['username']); ?></h3>
                  <p>
                    <small><?php echo $user['email']; ?></small>
                  </p>
                </div>
                <div class="mt-2">
                  <h6>Favourite Cricketer</h6>
                  <p><?php echo htmlspecialchars($user['cricketer']); ?></p>
                </div>
                <div class="mt-2">
                  <h6>Favourite Cricketer</h6>
                  <p><?php echo htmlspecialchars($user['role']); ?></p>
                </div>
                <div class="card-text">
                  <h6>What do you like about <?php echo htmlspecialchars($user['cricketer']); ?>?</h6>
                  <p><?php echo htmlspecialchars($user['comment']); ?></p>
                </div>
                <div class="d-flex justify-content-around">
                  <a href="edit.php?id=<?php echo htmlspecialchars($user['id']); ?>"><span class="btn btn-dark">Edit</span></a>
                  <form action="index.php" method="POST">
                    <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($user['id']); ?>">
                    <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                  </form>
                </div>
                <div>
                  <a href="" class="btn btn-primary mt-3 w-100">More</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  <?php endif; ?>
</main>

<?php include('includes/footer.php'); ?>