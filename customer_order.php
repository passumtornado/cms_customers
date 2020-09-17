<?php
session_start();
if(!isset($_SESSION["cID"])){
	header("location:index.php");
}
include "includes/db.php";
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
    <link href="css/shop-homepage.css" rel="stylesheet">
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
                        <a class="active" href="myproduct.php" id="login"><span class="glyphicon glyphicon-modal-window"></span>products</a>
                    </li>
                    
               </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <p><br/></p>
    <p><br/></p>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
         <div class="col-md-8">
        <div class="panel panel-default">
             <div class="panel-heading"></div>
            <div class="panel-body">
               <h1 class="text-center">Customer Order Details</h1>
                <hr/>
         <?php
							
							$user_id = $_SESSION["cID"];
							$orders_list = "SELECT o.orderID,o.c_ID,o.m_ID,o.quantity,o.t_ID,o.p_status,p.foodName,p.amount,p.image FROM customer_order o,menu p WHERE o.c_ID='$user_id' AND o.m_ID=p.m_ID";
							$query = mysqli_query($db,$orders_list);
                            if($query){
                                if (mysqli_num_rows($query) > 0) {
								while ($row=mysqli_fetch_array($query)) {
									?>
										<div class="row">
											<div class="col-md-4">
												<img style="float:right;width:150px;" src="cookUpload/<?php echo $row['image']; ?>" class="img-responsive img-thumbnail"/>
											</div>
											<div class="col-md-8">
												<table>
													<tr><td>Product Name</td><td><b><?php echo $row["foodName"]; ?></b> </td></tr>
													<tr><td>Product Price</td><td><b><?php echo "$ ".$row["amount"]; ?></b></td></tr>
													<tr><td>Quantity</td><td><b><?php echo $row["quantity"]; ?></b></td></tr>
													<tr><td>Transaction Id</td><td><b><?php echo $row["t_ID"]; ?></b></td></tr>
												</table>
											</div>
										</div>
									<?php
								}
							}else{
                                echo "                                     <div class='alert alert-warning'>
                 <a href='login.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>No Records Found</p></b>
                 <br />
                 <p>Login to place order</p>
                
                 </div>
                ";
                            }
                                
                            }
							else{
                                echo "
                                     <div class='alert alert-warning'>
                 <a href='login.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>query failed</p></b>
                 <br />
                 <p>Login to place order</p>
                
                 </div>
                                ";
                            }
						?>
            </div>
            <div class="panel-footer"></div>
             
             </div>
        
        </div>
         <div class="col-md-2"></div>
        </div>
    </div>
     
   
     <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; MPB andriod App 2018</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    

</body>

</html>
