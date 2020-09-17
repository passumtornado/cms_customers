<?php

if(isset($_POST['submit'])){
  
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $sql = "SELECT * FROM customer WHERE email = '$email'";
    $sql_result = mysqli_query($db,$sql);
    if($sql_result){
        if(mysqli_num_rows($sql_result)> 0){
            $row = mysqli_fetch_assoc($sql_result);
            $password = $row['password'];
            $to = $row['email'];
            $subject = "your recovered password";
            
            $message = "Please use this password to login".$password;
            $headers = "From: Mbp@canteen.com";
            if(mail($to,$subject,$message,$headers)){
                echo "
                       <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>your password has been send to your email</p></b>
                 </div>
                     ";
            }else{
                echo " <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>failed to recover your password. try again</p></b>
                 </div>";
            }
        }
    }else{
        echo "<div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>Query failed</p></b>
                 </div>";
    }
    
}
    
    
?>
<div class="row">
   
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Enter email to receive new password</strong>
                    </h2>
                    <hr>
                     <form method="post" action="">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                            
                            <div class="input-group">
                               <span class="input-group-addon">
                                <i class="material-icons-email">email</i>
                                </span>
                                <div class="form-line">
                                <input type="email" name="email" class="form-control" required autofocus>
                                </div>
                                 </div>
                                
                                 <div class="form-group">
                               
                                <button type="submit" class="btn btn-primary" style="margin-top:10px;" name="submit">Submit</button>
                            </div>
                           
                            </div>
                            
                            <div class="col-md-4"></div>
                           
                        </div>
                    </form>
                </div>
        
                
                <div class="clearfix"></div>
            </div>
        </div>