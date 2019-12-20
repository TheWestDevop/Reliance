
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css" rel="stylesheet" >

<link href="style.css" rel="stylesheet" >
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
    
    <img src='avatar.png' width="200" height="200" style="margin-top:20px;"
/>

</div>

    <!-- Login Form -->
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="Username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
      <div class="field-group" style="margin:10px;">
		<div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["username"])) { ?> checked <?php } ?>  />
		<label for="remember-me" class="underlineHover">Remember me</label>
	</div>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
<?php
session_start();
if(!empty($_POST["username"])) {
	    

        if($_POST["remember"]=='1'){
            setcookie("username", $_POST['username'], time()+60*60*24*90 );
         
            echo "Remember Me set";
        }else{
            if(ISSET($_COOKIE['username'])){
                setcookie("username", "");
            }
        
            echo "Remember Me removed";
        }
	} else {
		$message = "Invalid Login";
	}




?>