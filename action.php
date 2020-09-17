<?php 
session_start();
include 'includes/db.php';
if(isset($_POST['category'])){
    
    $category_query = "SELECT * FROM categories";
    $result_cat = mysqli_query($db,$category_query);
    
      echo "
       <p class='lead'><a href='myproduct.php'>MENU</a></p>
       
         <div class='list-group'>
      
      ";
    
      if(mysqli_num_rows($result_cat)> 0){
           while( $row=mysqli_fetch_assoc($result_cat)){
               $c_id = $row['CID'];
               $cat_name = $row['categoryName'];
               
               echo "
                     <a href='#' class='list-group-item category'  cid='$c_id'>$cat_name </a>
               
                    ";
        
    }
              echo "</div>";
      }
   
}
if(isset($_POST['page'])){
    $page_query = "SELECT * FROM menu";
    $run_query = mysqli_query($db,$page_query);
    $page_count = mysqli_num_rows($run_query);
    $pageno = ceil($page_count/6);
    
    for($i=1;$i<=$pageno;$i++){
        echo "
           <li><a href='#' page='$i' id='page'>$i</a></li>
        ";
    }
}

if(isset($_POST['getMenu'])){
    $limit = 6;
    if(isset($_POST['setPage'])){
     $pageno=$_POST['pageNumber'];
     $start = ($pageno * $limit) - $limit;   
    }else{
        $start = 0;
    }
    $query_menu = "SELECT * FROM menu LIMIT $start,$limit";
    $menu_result = mysqli_query($db, $query_menu);
    if($menu_result){
         if(mysqli_num_rows($menu_result)> 0){
        while($row = mysqli_fetch_assoc($menu_result)){
            
            $mID = $row['m_ID'];
            $image = $row['image'];
            $foodname = $row['foodName'];
            $quantity = $row['quantity'];
            $price = $row['amount'];
            $category =$row['category_ID'];
            $time = $row['date'];
            $description = $row['description'];
            
            echo"
                  <div class='col-md-4'>
                      <a href='view_menu.php?source=$mID'>
                         <div class='panel panel-info'>
                         <div class='panel-heading'>$foodname</div>
                            <div class='panel-body'>
                              <img src='cookUpload/$image' style='width: 200px; height: 250px;'class='img img-thumbnail'>
                                </div>
                                <div class='panel-heading'><strong>&#8373 $price.00</strong>
                                <button id='$mID' style='float: right;' class='btn btn-success btn-xs'>placeOrder</button>
                                </div>
                            </div>
                            </a>
                            </div>
            
               ";
        }
    }
        
    }else{
        echo "Query failed";
    }
   
    
}
if(isset($_POST['get_selected_menu'])||isset($_POST['search'])){
    if(isset($_POST['get_selected_menu'])){
    $cat_id = $_POST['cat_id'];
    $select_query = "SELECT * FROM menu WHERE category_ID = '$cat_id'";
    }else{
    $keyword = $_POST['keyword'];
    $select_query = "SELECT * FROM menu WHERE foodtags LIKE '%$keyword%'";
        
    }
    
    $select_result = mysqli_query($db,$select_query);
    if($select_result){
         while($row = mysqli_fetch_assoc($select_result)){
             $mID = $row['m_ID'];
            $image = $row['image'];
            $foodname = $row['foodName'];
            $quantity = $row['quantity'];
            $price = $row['amount'];
            $category =$row['category_ID'];
            $time = $row['date'];
            $description = $row['description'];
            
            echo"
            
                  <div class='col-md-4'>
                      <a href='view_menu.php?source=$mID'>
                         <div class='panel panel-info'>
                         <div class='panel-heading'>$foodname</div>
                            <div class='panel-body'>
                              <img src='cookUpload/$image' style='width: 200px; height: 250px;'class='img img-thumbnail'>
                                </div>
                                <div class='panel-heading'><strong>&#8373 $price.00</strong>
                                <button id='$mID' style='float: right;' class='btn btn-success btn-xs'>placeOrder</button>
                                </div>
                            </div>
                            </a>
                            </div>
            
               ";
      
            
        }
        
    }else{
        echo "
                <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>No Result Found!!!</p></b>
                 </div>
            ";
    }
    
       
    }
    
if(isset($_POST['addMenu'])){
    $m_id = $_POST['menuID'];
   $customer_Id =  $_SESSION['cID'];
    
    $query= "SELECT * FROM Cart WHERE mID = '$m_id'AND C_id='$customer_Id'";
    $query_result = mysqli_query($db,$query);
    $count = mysqli_num_rows( $query_result);
    if($count > 0){
        echo "
              <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>Meal already in cart!!!</p></b>
                 </div>
        ";
    }else{
        $query_food = "SELECT * FROM menu WHERE m_ID='$m_id'";
        $query_run = mysqli_query($db,$query_food );
        $row = mysqli_fetch_array($query_run);
            $mID = $row['m_ID'];
            $image = $row['image'];
            $foodname = $row['foodName'];
            $quantity = $row['quantity'];
            $price = $row['amount'];
            $category = $row['category_ID'];
            $time = $row['date'];
            $description = $row['description'];
        $query_cart = "INSERT INTO Cart (mID,C_Id,foodname,image,quantity,price,total_amt)
        VALUES('$mID','$customer_Id',' $foodname','$image',' $quantity',' $price',' $price ')";
        
        $cart_result = mysqli_query($db,$query_cart);
        if($cart_result){
            echo "
                  <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>Meal added to cart continue ordering!!</p></b>
                 </div>
            ";
        }else{
            echo "Query Failed";
        }

    }
}
if(isset($_POST['checkout_edit_cart'])) {
   $customer_Id =  $_SESSION['cID'];
    $sql_checkout = "SELECT * FROM Cart WHERE C_id='$customer_Id'";
    $run_query = mysqli_query($db,$sql_checkout);
    $count = mysqli_num_rows($run_query);
      if($count > 0){
          $total_amt = 0;
          echo "<table  class='table table-bordered table-hover'";
          echo " <thead>";
          echo " <tr>";
          echo "<th>Action</th>";
          echo "<th>Image</th>";
           echo "<th>MEAL</th>";
           echo "<th>Quantity</th>";
           echo "<th>Price</th>";
           echo "<th>SubTotal</th>";
           echo "</tr>" ;
           echo " </thead>";
        while($row=mysqli_fetch_array($run_query)){
            $cartId = $row['cartID'];
            $m_Id = $row['mID'];
            $foodname = $row['foodname'];
            $image = $row['image'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $total_amnt = $row['total_amt'];
            $price_array = array($total_amnt);
            $total_sum = array_sum( $price_array);
            $total_amt = $total_amt +  $total_sum;
            
            
        echo "
             
              <tbody>
               <tr>
            
           <td> <div class='btn -group'>
                    <a href='#' remove_id='$m_Id'  class='btn btn-danger btn-xs remove'><span class='glyphicon glyphicon-trash'></span></a>
                    <a href='#'  update_id='$m_Id' class='btn btn-primary btn-xs update'><span class='glyphicon glyphicon-ok-sign'></span></a>
                    </div></td>
         <td><img width='60px' height='60px' src='cookUpload/$image' alt='pass' class='img img-thumbnail img-reponsive'></td>
         <td>$foodname</td>
         <td><input type='text' m_id='$m_Id' id='qty-$m_Id' class='form-control qty' value='$quantity'></td>
         <td><input type='text'  m_id='$m_Id' id='price-$m_Id' class='form-control price' value=' $price' disabled></td>
         <td><input type='text'  m_id='$m_Id' id='total-$m_Id' class='form-control total' value='$total_amnt' disabled></td>
      
         </tr>
              </tbody>
             
         ";
           
        }
     echo "<tfoot>";
         echo "<tr>";
         echo "<td></td>";
         echo "<td></td>";
         echo "<td></td>";
         echo "<td></td>";
         echo "<td></td>";
         echo "<td>Grant Total:&#8373 $total_amt</td>";
         echo "</tr>";
         echo "</tfoot>";
          
          
     echo "</table>";      
      }else{
          
          echo " <h4>Your Cart is empty!!!</h4> ";
      }
    echo '
    
          <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_cart">
              <input type="hidden" name="business" value="mbp@canteen.com">
              <input type="hidden" name="upload" value="1">';
           $x = 0;
           $sql = "SELECT * FROM cart WHERE C_id='$customer_Id'";
            $sql_result = mysqli_query($db,$sql);
            while($row=mysqli_fetch_array($sql_result)){
            $cartId = $row['cartID'];
            $m_Id = $row['mID'];
            $foodname = $row['foodname'];
            $image = $row['image'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $total_amnt = $row['total_amt'];
                $x++;
                      
          echo ' <input type="hidden" name="item_name_'.$x.'" value="'.$foodname.'">
              <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
              <input type="hidden" name="amount_'.$x.'" value="'.$price.'">
              <input type="hidden" name="quantity_'.$x.'" value="'.$quantity.'">
              
              ';
              
                
            }
        
              
             echo '
               <input type="hidden" name="return" value=" http://96cbaeab.ngrok.io/mbpapp/payment_success.php"/>
                <input type="hidden" name="notify_url" value="http://96cbaeab.ngrok.io/mbpapp/payment_success.php"/>
                <input type="hidden" name="cancel_return" value="http://192.168.43.165:8080/mbpapp/cancel.php"/>
                <input type="hidden" name="currency_code" value="USD"/>
                <input type="hidden" name="custom" value="'.$_SESSION["cID"].'"/>
              <input type="image" name="submit"
                src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png"
                alt="PayPal checkout">
</form>
    
        ';
        if(isset($_POST['submit_table'])){
         $mytable = $_POST['mytable'];
           $customer_Id =  $_SESSION['cID'];
               $query ="SELECT * FROM customer_table WHERE Tabletag = '$mytable' ";
               mysqli_query($db,$query);
           $table_query = "UPDATE";
        }
    
    echo '<button id="mytooltip" class="btn btn-success btn-lg" data-target="#selecTable" style="width:100%;" data-toggle="modal">Select table</button>
                <div class="modal" id="selecTable" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                  <button class="close" data-dismiss="modal">&times;</button>
                  <h4>Please select empty table</h4>
                </div>
                <div class="modal-body">
                  <form method="post">
                  <select name="mytable" class="form-control">
                    <option>Select Table</option>
                    <option value="table 1">Table 1</option>
                    <option value="table 2">Table 2</option>
                    <option value="table 3">Table 3</option>
                    <option value="table 4">Table 4</option>
                    <option value="table 5">Table 5</option>
                    <option value="table 6">Table 6</option>
                    </select>
                  </form>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="submit" name="submit_table">Submit</button>
                </div>
                </div>
                </div>
                 </div>
           ';
  }
if(isset($_POST['cart_count'])){
    $customer_Id =  $_SESSION['cID'];
    $query= "SELECT * FROM Cart WHERE C_id='$customer_Id'";
    $run_query = mysqli_query($db,$query);
    $count = mysqli_num_rows($run_query);
    echo "
        $count
    ";
}

if(isset($_POST['removecart'])){
    $mid = $_POST['removeId'];
    $customer_Id = $_SESSION['cID'];
    $query_delete = "DELETE  FROM Cart WHERE mID = '$mid' AND C_id='$customer_Id'";
    $result_delete = mysqli_query($db,$query_delete);
    if($result_delete){
        echo "
               <div class='alert alert-danger'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>Meal removed!!!</p></b>
                 </div>
        ";
    }
    else{
        echo "query failed";
    }
}

if(isset($_POST['updatecart'])){
    $mid = $_POST['updateId'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $customer_Id = $_SESSION['cID'];
    $query_update = "UPDATE Cart SET quantity = '$qty',price='$price', total_amt='$total' WHERE mID='$mid' AND C_id='$customer_Id'";
    $result_update = mysqli_query($db,$query_update);
    if($result_update){
        echo "
               <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>Meal updated!!!</p></b>
                 </div>
        ";
    }
    else{
        echo "
         <div class='alert alert-warning'>
                 <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><p>QUERY failed!!!</p></b>
                 </div>
        
        ";
    }
}

if(isset($_POST['forms'])){
    
   echo "
                
                       <div class='row'>
                  <div class='col-md-12'>
                      <div class='panel panel-success'>
                      <div class='panel-heading'><h2 class='text-center'>Notes</h2></div>
                          <div class='panel-body'>

                         <table  class='table table-bordered table-hover'>
                              <thead>
                              <tr>
                                  <th>Packages</th>
                                   <th>Range</th>
                                   <th>Price</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Fried Rice and chicken</td>
                                    <td>20-50</td>
                                     <td>&#8373 8</td>
                                  </tr>
                                  <tr>
                                  <td>Fried Rice and Tilapia</td>
                                    <td>20-50</td>
                                     <td>&#8373 9</td>
                                  </tr>
                                  <tr>
                                  <td>Jollof rice and chicken</td>
                                    <td>20-50</td>
                                     <td>&#8373 9</td>
                                  </tr>
                                   <tr>
                                  <td>Banku and Tilapia</td>
                                    <td>20-50</td>
                                     <td>&#8373 10</td>
                                  </tr>
                                  <tr>
                                  <td>Fried Rice and chicken</td>
                                    <td>51-200</td>
                                     <td>&#8373 7</td>
                                  </tr>
                                  <tr>
                                  <td>Fried Rice and Tilapia</td>
                                    <td>51-200</td>
                                     <td>&#8373 8</td>
                                  </tr>
                                  <tr>
                                  <td>Jollof rice and chicken</td>
                                    <td>51-</td>
                                     <td>&#8373 8</td>
                                  </tr>
                                   <tr>
                                  <td>Banku and Tilapia</td>
                                    <td>21-50</td>
                                     <td>&#8373 9</td>
                                  </tr>
                              </tbody>

                              </table>
                          </div>
                      </div>
                      </div>
                  </div>

                    <div class='row'>
                      <div class='col-md-4'></div>
                         <div class='col-md-4'>
                          <div class='panel panel-primary'>
                             <div class='panel-heading'>
                        <h4 class='text-center'>Event Order forms</h4>        
                    <form method='post'>

                         <div class='form-group'>
                    <label for='eventName'>Event Name</label>
                    <input type='text' name='ename' class='form-control' required>
                </div>
                 <div class='form-group'>
                    <label for='email'>Food Pages</label>
                    <input type='email' name='email' class='form-control' required>
                </div>
                <div class='form-group'>
                    <label for='quantity'>quantity</label>
                    <input type='text' name='quantity' class='form-control' required>
                </div>
                <div class='form-group'>
                    <label for='username'>Delivery Date and Time</label>
                    <input type='datetime-local' name='dtime' class='form-control' required>
                </div>
                    <div class='form-group'>

                    <input type='submit' style='width:100%;' class='btn btn-danger btn-lg' class='form-control' value='placeOrder'>
                </div>

                                 </form>

                              </div>
                             </div> 

                        </div>
                         <div class='col-md-4'></div>

                      </div>


   
       ";
}

?>