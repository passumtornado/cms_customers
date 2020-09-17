$(document).ready(function(){
    
    
var offset = 500;
var duration = 300;
    jQuery(window).scroll(function(){
        
        if($(this).scrollTop() > offsets){
            
            $('.back-to-top').fadeIn(duration);
            
        }else{
            $('.back-to-top').fadeOut(duration);
        }
    });
    
    $('.back-to-top').click(function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:0},duration);
        return false;
    })
    
});
   