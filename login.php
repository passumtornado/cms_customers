<?php
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
   $username = mysqli_real_escape_string($db,$username);
   $password=mysqli_real_escape_string($db,$password);
    
    $password = md5($password);
    
    $query = "SELECT * FROM customer WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($db,$query);
     if(mysqli_num_rows($result) ==1){
         $row = mysqli_fetch_array($result);
             $_SESSION['cID']= $row["customerID"];
             $_SESSION['customer']= $row["username"];
            $_SESSION['customer']= $username;
            $_SESSION['password']= $password;
            $_SESSION['email']= $email;
            $_SESSION['success']= "Hi";
           $_SESSION['cusomerID']= $customerID;
            header('location: myproduct.php');
        }else{
            
            echo "
                <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>wrong username or password</p></b>
                 </div>
            ";
        }
}
?>
 <div class="wait overlay">
	<div class="loader"></div>
</div>
<div class="row">
   
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Customer Login</strong>
                    </h2>
                    <hr>
                     <form method="post" action="">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" required autofocus>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required autofocus>
                            </div>
                           
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <a href="index.php?source=forgot"><strong>forgot password?</strong></a><br/>
                                <a href="index.php?source=signup"><strong>New user, Create an account</strong></a>
                                <button type="submit" class="btn btn-primary" style="float:right;" name="login">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
        
                
                <div class="clearfix"></div>
            </div>
        </div>
