<?php 
$sPageTitle = 'Sign up';
$sActiveName = 'sign-up-user';

require_once(__DIR__.'/components/header.php');
?>


<div class="sign-up-container-agent">

    <form method="POST" class="agent-signup-form" id="newAgentForm" enctype="multipart/form-data">
            <h2>Sign up as agent</h2>

            <label class="has-float-label">
                <input type="text" name="agentName" placeholder="First name" value="<?php echo isset($_POST['agentName']) ? $_POST['agentName'] : '' ?>">
                <span>First name</span>
            </label>   
            
            <label class="has-float-label">
                <input type="text" name="agentLastName" placeholder="Last name" value="<?php echo isset($_POST['agentLastName']) ? $_POST['agentLastName'] : '' ?>">
                <span>Last name</span>
            </label>   

            <label class="has-float-label">
                <input type="text" name="agentEmail" placeholder="Email" value="<?php echo isset($_POST['agentEmail']) ? $_POST['agentEmail'] : '' ?>">
                <span>Email</span>
            </label>   

            <label class="has-float-label">
                <input type="password" name="agentPassword" placeholder="Password" value="<?php echo isset($_POST['agentPassword']) ? $_POST['agentPassword'] : '' ?>">
                <span>Password</span>
            </label>   

            <label class="has-float-label">
                <input type="text" name="agentAddress" placeholder="Address" value="<?php echo isset($_POST['agentAddress']) ? $_POST['agentAddress'] : '' ?>">
                <span>Address</span>
            </label>   

            <label class="has-float-label">
                <input type="text" name="agentCity" placeholder="City" value="<?php echo isset($_POST['agentCity']) ? $_POST['agentCity'] : '' ?>">
                <span>City</span>
            </label>   

            <label class="has-float-label">
                <input type="text" name="agentCountry" placeholder="Country" value="<?php echo isset($_POST['agentCountry']) ? $_POST['agentCountry'] : '' ?>">
                <span>Country</span>
            </label>   
        <div>
            <label for="image-uploader">Upload profile picture
            <input type="file" name="agentImage" id="image-uploader">
            </label>
        </div>
        <button class="nav-btn">SIGN UP</button>
    </form>
</div>



<?php 
include_once(__DIR__.'/components/footer.php');

require_once(__DIR__.'/api-sign-up-agent.php');