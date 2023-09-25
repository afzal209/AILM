<?php

// session_start();
include('connection.php');


// error_reporting(0);


  if(isset($_SESSION['user'])!=null){
      echo '<script>location.href="dashboard.php"</script>';
  }




$header_name = 'Login';
$body_class = 'hold-transition login-page';
$main_div = 'login-box';
include('include/header.php');



if(isset($_POST['submit'])){

	//echo 'test';
    if (empty($_POST['number']) || empty($_POST['pass']) ) {
        $error = 'All Feild Required';
    }
    else{
        $number=$_POST['number'];

    	$password=$_POST['pass'];
    
    	$select=mysqli_query($con,"SELECT * FROM user WHERE number_no =$number ");
    	
    	if(mysqli_num_rows($select) > 0){
    	    while($row=mysqli_fetch_assoc($select)){
    	        $password_hash = $row['password'];
      
            	if (password_verify($_POST['pass'],$password_hash)) {
                
            			foreach($row as $key=>$val){
                    
            				$_SESSION['user'][$key] = $val;
            
            			}
                  
                     echo '<script>location.href="dashboard.php"</script>';
            
            		}
                else{
                  $error =  'Incorrect';
                }
            }
    	}
    	else{
    	    $error = 'Account Not created';
    	}
	
	
	
    }


	


			

}
?>

    <div class="login-logo">
        <a href="index.php"><b>Inter</b>BANK</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">


            <form action="index.php" method="post">
                <?php 
        if (isset($error)) {
          echo $error;
        }
        if (isset($msg)) {
          echo $msg;
        }
        ?>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Number" name="number">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="pass">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-0">
                <a href="register.php" class="text-center">Register a new membership</a>
            </p>
            <!-- /.social-auth-links -->


        </div>
        <!-- /.login-card-body -->
    </div>



<?php 
include('include/footer.php');
?>