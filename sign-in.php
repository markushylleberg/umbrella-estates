<?php 
$sPageTitle = 'Sign in';
$sActiveName = 'sign-in';

require_once(__DIR__.'/components/header.php');
?>


<div class="login-container center">

<form method="POST" id="signInForm" enctype="multipart/form-data">
        <h2>Login</h2>

        <label class="has-float-label">
            <input type="text" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
            <span>Email</span>
        </label>

        <label class="has-float-label">
            <input type="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"> 
            <span>Password</span>
        </label>
    <button class="nav-btn">LOGIN</button>
    <?php require_once(__DIR__.'/api-sign-in.php'); ?>
</form>
</div>


</div>



<?php include_once(__DIR__.'/components/footer.php'); 


?>