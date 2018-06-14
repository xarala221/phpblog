<?php
  require('config/config.php');
  require('config/db.php');

    //Check for submit
    if(isset($_POST['submit'])){
      //Get form Data
      $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $author = mysqli_real_escape_string($conn, $_POST['author']);
      $body = mysqli_real_escape_string($conn, $_POST['body']);

      $query = "UPDATE posts SET
            title = '$title',
            author = '$author',
            body = '$body'
            WHERE id = {$update_id}
          ";

    if(mysqli_query($conn, $query)){
      header('Location :'.ROOT_URL.'');
    }else{
      echo 'ERROR:'.mysqli_error($conn);
      }
    }
     //Get id
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  // Get query

  $query = 'SELECT * FROM posts WHERE id = '.$id;

  // Get result

  $result = mysqli_query($conn ,$query);

  // Fetch Data

  $post = mysqli_fetch_assoc($result);
  //var_dump($posts);

  // Free Result

  mysqli_free_result($result);

  // Close the connection

  mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
  <h1>Add Post</h1>
  <div class="container">
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
    </div>
    <div class="form-group">
      <label>Author</label>
      <input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>">
    </div>
    <div class="form-group">
      <label>Body</label>
      <textarea name="body" class="form-control"> <?php echo $post['body']; ?> </textarea>
    </div>
    <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
    <input type="submit" value="Submit" name="submit" class="btn btn-secondary">
   </form>
  </div>
<?php include('inc/footer.php'); ?>