$(document).ready(function(){
    
    cat();
     function cat(){
        
         $.ajax({
          url: "action.php",
          method: "POST",
          data: {category:1},
          success: function(data){
             
             $("#get_category").html(data);
          }
      })
        
    }
    $("body").delegate("myevent","click",function(){
        var mid = $(this).attr('m_id');
         alert(mid);
    })
   
    menu();
    function menu(){
         $.ajax({
          url: "action.php",
          method: "POST",
          data: {getMenu:1},
          success: function(data){
             
             $("#get_myfood").html(data);
          }
      })
    }
    
    
     $("body").delegate(".category","click",function(event){
         event.preventDefault();
         var cid = $(this).attr('cid');
         $.ajax({
             url:"action.php",
             method:"POST",
             data: {get_selected_menu:1,cat_id:cid},
             success: function(data){
                $("#get_myfood").html(data); 
                 
          }
             
         })
        
})
     $("#search_button").click(function(){
         event.preventDefault();
         var keyword = $("#search").val();
         if(keyword !=""){
             $.ajax({
             url:"action.php",
             method:"POST",
             data: {search:1,keyword:keyword},
             success: function(data){
                $("#get_myfood").html(data); 
                 
          }
             
         })
        
         }
         
})
    cart_count()
     $("#myMenu").click(function(event){
        event.preventDefault();
        var p_id = $(this).attr('m_id');
      $.ajax({
          url: "action.php",
          method: "POST",
          data: {addMenu:1,menuID:p_id},
          success: function(data){
             $("#food_msg").html(data);
              cart_count();
          }
      })
         
    })
     
    cart_count()
    function cart_count(){
         $.ajax({
             url:"action.php",
             method:"POST",
             data: {cart_count:1},
             success: function(data){
            $(".badge").html(data);
            
          }
         })
    }
    
     checkcart_edit();
     function checkcart_edit(){
         $.ajax({
             url:"action.php",
             method:"POST",
             data: {checkout_edit_cart:1},
             success: function(data){
            $("#cart_edit_checkout").html(data);
            
          }
         })
     }
     $("body").delegate(".qty","keyup",function(event){
        event.preventDefault();
         var mid = $(this).attr("m_id");
         var qty = $("#qty-"+mid).val();
         var price = $("#price-"+mid).val();
         var total = qty * price;
         $("#total-"+mid).val(total);
    })
    
    $("body").delegate(".remove","click",function(event){
         event.preventDefault();
         var mid = $(this).attr('remove_id');
         $.ajax({
             url:"action.php",
             method:"POST",
             data: {removecart:1,removeId:mid},
             success: function(data){
            $("#delete_msg").html(data);
                 checkcart_edit();
          }
         })
         
     })
     $("body").delegate(".update","click",function(event){
         event.preventDefault();
         var mid = $(this).attr('update_id');
         var qty = $("#qty-"+mid).val();
         var price = $("#price-"+mid).val();
         var total = $("#total-"+mid).val();
         $.ajax({
             url:"action.php",
             method:"POST",
             data: {updatecart:1,updateId:mid,qty:qty,price:price,total:total},
             success: function(data){
             
            $("#delete_msg").html(data);
                  checkcart_edit();
                 
          }
         })
         
     })
    page();
    function page(){
        $.ajax({
             url:"action.php",
             method:"POST",
             data: {page:1},
             success: function(data){     
           $("#pageno").html(data);
                 
          }
         })
        
    }
    
     $("body").delegate("#page","click",function(){
         
         var pn = $(this).attr("page");
          $.ajax({
             url:"action.php",
             method:"POST",
             data: {getMenu:1,setPage:1,pageNumber:pn},
             success: function(data){   
              $("#get_myfood").html(data);
                 
          }
              
         })
        
         
         
     })
    
    
    
    
    
    })
        