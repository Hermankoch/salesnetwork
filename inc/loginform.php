<div class="login-form-wrapper" id="login">
  <div class="login-container">
    <form class="login-form" action="core/auth.php" method="post">
      <img src="assets/images/icons/asset_436.png" class="close-login" alt="Sales Network Logo" onclick="openLogin();">

      <h1>Login</h1>
        <?php if(isset($_GET['error']) && !empty($_GET['error'])){
            echo '<div id="loginError" class="alert alert-danger" role="alert">'.htmlspecialchars($_GET['error']).'</div>';
        } ?>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email" id="email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="#">Forgot password?</a>
    </form>    
  </div>
</div>
