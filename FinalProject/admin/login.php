<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>

<form action="" method="post">
<p><label>Username</label><input type="text" name="username" value=""  /></p>
<p><label>Password</label><input type="password" name="password" value=""  /></p>
<p><label></label><input type="submit" name="submit" value="Login"  /></p>
</form>

<?php
//process login form if submitted
if(isset($_POST['submit'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if($user->login($username,$password)){ 

        //logged in return to index page
        header('Location: index.php');
        exit;
    

    } else {
        $message = '<p class="error">Wrong username or password</p>';
    }

}//end if submit

if(isset($message)){ echo $message; }

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

