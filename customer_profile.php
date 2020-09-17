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
    
   

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
     <link href="css/profile.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   

</head>
    <body>
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
                        <a class="active" href="#" id="login"><span class="glyphicon glyphicon-profile"></span>profile</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
        <p><br/></p>
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
        <h2 style="text-align:center; color:white;">Customer profile</h2>
        <div class="card">
        <img src="img/LOGO.jpg" class="img-circle" alt="mbp" style="width:100%">
            <h1><?php echo $username;?></h1>
            <p class="title"><?php echo $email;?></p>
            <p><?php echo $address1;?></p>
            <p><button id="mycontact">Contact:<?php echo $mobile;?></button></p>
        </div>
        
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
     <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>



    </body>
</html>