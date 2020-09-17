<?php
session_start();
if(!isset($_SESSION['cID'])){
  header("location:index.php");
}

if(isset($_GET["st"])){
    
    $trx_id = $_GET["tx"];
    $p_st = $_GET["st"];
    $amt = $_GET["amt"];
    $cc = $_GET["cc"];
    $cm_user_id = $_GET["cm"];
    $c_amt = $_COOKIE["ta"];
    
    if($p_st == "Completed"){
        
        include "includes/db.php";
        $sql = "SELECT mID,quantity FROM cart WHERE C_Id = '$cm_user_id'";
		$query = mysqli_query($db,$sql);
		if (mysqli_num_rows($query) > 0) {
			# code...
			while ($row=mysqli_fetch_array($query)) {
			$product_id[] = $row["mID"];
			$qty[] = $row["quantity"];
			}

			for ($i=0; $i < count($product_id); $i++) { 
				$sql = "INSERT INTO customer_order (c_ID,m_ID,quantity,t_ID,p_status) VALUES ('$cm_user_id','".$product_id[$i]."','".$qty[$i]."','$trx_id','$p_st')";
				mysqli_query($db,$sql);
			}

			$sql = "DELETE FROM cart WHERE C_Id = '$cm_user_id'";
            
            if(mysqli_query($db,$sql)){
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
                        <a class="active" href="myproduct.php" id="login"><span class="glyphicon glyphicon-"></span>products</a>
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
               <h1 class="text-center">Thankyou</h1>
                <hr/>
               <p>Hello <?php echo $_SESSION['customer'];?>, Your payment process is successfully completed and your Transaction ID is <b><?php echo $trx_id; ?></b><br/>you can continue your shopping<br/></p>
                   <a href="myproduct.php"  class="btn btn-success btn-lg">
                       continue shopping
                   </a>
                   
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
<?php

                      
     }
    }else{
            echo "query failed";
           // header("location:index.php");
        }
}

}
?>
