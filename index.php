<?php include 'includes/header.php';?>

<?php
  $name = $email = $body = '';

  $nameErr = $emailErr = $bodyErr = '';
  //form submit
  if(isset($_POST['submit'])){
    //validate name
    if(empty($_POST['name'])){
      $nameErr = 'Name is required';
    }else{
      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validate eamil
    if(empty($_POST['email'])){
      $emailErr = 'Email is required';
    }else{
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }
    //validate body
    if(empty($_POST['body'])){
      $bodyErr = 'Body is required';
    }else{
      $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if(empty($nameErr) && empty ($emailErr) && empty($bodyErr)){
      // add to database
      $sql = "INSERT INTO feedback (name, email, body) VALUES ('$name', '$email', '$body')";

      if(mysqli_query($conn, $sql)){
        //success
        header('Location: feedback.php');
      }else{
        //errors
        echo 'Error: ' . mysqli_error($conn);
      }
    }
  }
?>
    <img src="/PHP-projects-100daysofcode/feedback/img/icon.png" class="w-25 mb-3" alt="">
    <p class="lead text-center">Leave feedback for Mikey</p>
    <form action="<?php echo htmlspecialchars($_SERVER ['PHP_SELF']); ?>" method="POST" class="mt-4 w-75">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null; ?>" id="name" name="name" placeholder="Enter your name">
        <div class="invalid-feedback">
          <?php echo $nameErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email" placeholder="Enter your email">
        <div class="invalid-feedback">
          <?php echo $emailErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control <?php echo $bodyErr ? 'is-invalid' : null; ?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
        <div class="invalid-feedback">
          <?php echo $bodyErr; ?>
        </div>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>
    <?php include 'includes/footer.php';?>

