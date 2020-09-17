<?php
$error = "";

if(isset($_POST['customer_signup'])){
    $username= $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['repassword'];
    $mobile = $_POST['mobile'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];

    $username = mysqli_real_escape_string($db,$username);
    $email = mysqli_real_escape_string($db,$email);
    $password=mysqli_real_escape_string($db,$password);
    $confirm_pass = mysqli_real_escape_string($db,$confirm_pass);
    $mobile = mysqli_real_escape_string($db,$mobile);
    $address1 = mysqli_real_escape_string($db,$address1);
    $address2 = mysqli_real_escape_string($db,$address2);

    if($password == $confirm_pass){
        $password = md5($password);
    }
    else{
         echo  "
             <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>Please password is not valid</p></b>
                 </div>
            ";
        exit();
    }
    if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',$mobile)){
        
         $error = "Invalid Number!";
          // echo "<script>alert('invalid number!')</script>";
        exit();
    }


   $query = "SELECT username,email FROM customer WHERE username= '$username' OR email= '$email'";
    $query_result = mysqli_query($db,$query);
    if($row = mysqli_num_rows($query_result)>0){
        echo "
             <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>Email or Username already exist</p></b>
                 </div>
            ";
        exit();
    }else{
        $query = $query = "INSERT INTO customer (username,email,password,mobile,address1,address2)
                          VALUES('$username','$email','$password','$mobile','$address1','$address2')";
        $result = mysqli_query($db,$query);
        if($result){
            echo "
             <div class='alert alert-warning'>
                 <a href='login.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>you have successfully signUp</p></b>
                 <br />
                 <p>Login to place order</p>
                
                 </div>
            ";
             header('location:index.php?source=login');
            exit();
        }
        else{
            echo "
             <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>you couldn't register</p></b>
                 </div>
            ";
            exit();
        }
    }
}else{
    echo "";
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
                        <strong>Custmer SignUP </strong>
                    </h2>
                    <hr>
                     <form method="POST" action="">
                     
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="username">Username*</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                             <div class="form-group col-lg-4">
                                <label for="email">Email*</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="password">Password*</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="repassword">Confirm Password*</label>
                                <input type="password" name="repassword" class="form-control" required>
                            </div>
                             <div class="form-group col-lg-4">
                                <label for="mobile">Mobile Number*</label>
                                <input type="text" id="mobile" name="mobile" placeholder="000-000-0000" class="form-control" required>
                                 <span class="warning" style="color:red;"><?php echo $error; ?></span>
                            </div>
                             <div class="form-group col-lg-4">
                                <label for="address1">Address line 1*</label>
                                <input type="text" name="address1" class="form-control" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="address2">Address line 2</label>
                                <input type="text" name="address2" class="form-control" >
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                               <a href="index.php?source=login"><strong>Already have an account?Login</strong></a>
                                <button type="submit" class="btn btn-primary" name="customer_signup">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
        
                
                <div class="clearfix"></div>
            </div>
        </div>