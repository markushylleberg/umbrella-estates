<?php 
$sPageTitle = 'Sign up';
$sActiveName = 'sign-up-user';

require_once(__DIR__.'/components/header.php');
?>


<div class="sign-up-container">
    <form method="POST" id="newUserForm" enctype="multipart/form-data">
            <h2>Sign up as user</h2>

            <label class="has-float-label">
                <input type="text" name="userName" placeholder="First name" value="<?php echo isset($_POST['userName']) ? $_POST['userName'] : '' ?>">
            <span>First name</span>
            </label>
            
            <label class="has-float-label">
                <input type="text" name="userLastName" placeholder="Last name" value="<?php echo isset($_POST['userLastName']) ? $_POST['userLastName'] : '' ?>">
                <span>Last name</span>
            </label>

            <label class="has-float-label">
                <input type="text" name="userEmail" placeholder="Email" value="<?php echo isset($_POST['userEmail']) ? $_POST['userEmail'] : '' ?>">
                <span>Email</span>
            </label>

            <label class="has-float-label">
                <input type="password" name="userPassword" placeholder="Password" value="<?php echo isset($_POST['userPassword']) ? $_POST['userPassword'] : '' ?>">
                <span>Password</span>
            </label>

                <p>(optional)</p>
                <input type="file" name="userImage" id="image-uploader">
        <button id="btnSignUpUser" class="nav-btn">SIGN UP</button>
    </form>
</div>
<div class="center mar">
    <p>Are you an agent?</p>
    <a href="sign-up-agent.php">Click here to sign up</a>
</div>


<?php 
include_once(__DIR__.'/components/footer.php');
require_once(__DIR__.'/api-sign-up-user.php');
?>