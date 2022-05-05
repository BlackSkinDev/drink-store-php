function remove(id){
    var x = confirm('Are you sure you want to trash product ?')
    if(x==true){
        $.ajax({
            type:"POST",
            url:"/pages/users/remove-from-cart.php",
            data:{
                id:id,
        
            },
            success:function(res){
                alert(JSON.parse(res));
                window.location='/pages/users/cart.php'                  
            },
            error:function(){
            }
    
        });
    }
   
}