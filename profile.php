<?php 
session_start();

include "includes\db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>MPB CANTEEN</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/profile.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="top" class="has-header-search" data-spy="scroll" data-target="#materialize-menu" data-offset="100">
    <div class="wait overlay">
	<div class="loader"></div>
</div>

    <div class="brand">MPB Canteen</div>
    <div class="address-bar">UENR | SUNYANI-FIAPRE | BEREKUM ROAD</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">MPB CANteen</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li >
                        <a  href="index.php" ><span class="glyphicon glyphicon-home"></span>Home</a>
                    </li>
                    <li>
                        <a href="about.html"><span class="glyphicon glyphicon-user"></span>About</a>
                    </li>
                    <li>
                        <a href="contact.html"><span class="glyphicon glyphicon-phone"></span>Contact</a>
                    </li>
                      <li>
                        <a href="myproduct.php"><span class="glyphicon glyphicon-shopping-cart"></span>Product</a>
                    </li>
                    <li>
                        <a class="active" href="index.php?source=login" id="login"><span class="glyphicon glyphicon-off"></span>Profile</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
        <div class="row">
        <div class="col-md-4">
            
          <?php
                        $customerID = $_SESSION['cID'];
                        $sql= "SELECT * FROM customer WHERE customerID = '$customerID'";
                        $sql_result = mysqli_query($db,$sql);
                        if($sql_result){
                            if(mysqli_num_rows($sql_result)>0){
                                while($row=mysqli_fetch_assoc($sql_result)){
                                    $username = $row['username'];
                                    $mobile = $row['mobile'];
                                    $address1 = $row['address1'];
                                    $email = $row['email'];
                                }
                            }
                        }else{
                             echo "<div class='alert alert-warning'>
                              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>Query failed</p></b>
                               </div>";
                        }
                        ?>
        <h2 style="text-align:center" id="cust">Customer profile</h2>
        <div class="card">
        <img src="img/LOGO.jpg" alt="mbp" style="width:100%">
           <i>username:</i><h4><?php echo $username;?></h4>
            <p class="title"><i>email:</i><?php echo $email;?></p>
            <p><i>Address:</i><?php echo $address1;?></p>
            <p><button id="mycontact">Contact:<?php echo $mobile;?></button></p>
        </div>   
        </div>
        <p><br /></p>
        <?php 
          if (isset($_POST['change_pass'])) {
           $oldpassword =   $_POST['oldpass'];
           $newpassword =   $_POST['npassword'];
           $confirmpassword = $_POST['cpassword'];
            
            $oldpassword = md5(mysqli_real_escape_string($db,$oldpassword));
            $newpassword = md5(mysqli_real_escape_string($db,$newpassword));
            $confirmpassword = md5(mysqli_real_escape_string($db,$confirmpassword));
             
             $sql = "SELECT * FROM customer WHERE password = '$oldpassword'";
             $result = mysqli_query($db,$sql);
            if (mysqli_num_rows($result)==0) {
                echo "<div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>wrong old password</p></b>
                 </div>";
            }elseif($newpassword != $confirmpassword){
                echo "<div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>password do not match</p></b>
                 </div>";
            }else{
                $sql_update = "UPDATE customer SET password = '$newpassword'";
                $update_result = mysqli_query($db,$sql_update);
                if($update_result){
                     echo "<div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>password successfully updated</p></b>
                 </div>";
                }
            }

          }

         ?>
        <form method="post" action="">
               <div class="row">
                            <div class="form-group col-md-3">
                                <label for="username"  style="color:white;"> Old password</label>
                                <input type="password" name="oldpass" class="form-control" required autofocus>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="password"  style="color:white;">New Password</label>
                                <input type="password" name="npassword" class="form-control" required autofocus>
                            </div>
                             <div class="form-group col-md-3">
                                <label for="password" style="color:white;">Confrim New Password</label>
                                <input type="password" name="cpassword" class="form-control" required autofocus>
                            </div>
                           
                            <div class="form-group col-md-3">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-primary" style="width:100%;" name="change_pass">Submit</button>
                            </div>
                        </div>
           
        </form>
        <div class="col-md-6">
            
            
        </div>
        <div class="col-md-2"></div>
        
        </div>
     
        
       
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
             <a href="#top" class="page-scroll btn-floating btn-large pink back-top waves-effect waves-light" data-section="#top">
                    <i class="material-icons">&#xE316;</i>
                  </a>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; MPB andriod App 2018</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="ajax.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
