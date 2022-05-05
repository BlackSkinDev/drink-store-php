   function dispatch(id){
        var x = confirm('Are you sure you want to mark as delivered ?')
        if(x==true){
            $.ajax({
                url: "../admins/dispatch.php",
                type: "post",
                data: {
                    id: id,
                },
                success: function (response) {
                    let x =  JSON.parse(response);
                    alert(x);
                    location.reload()
                },
                error: function(error) {
                   alert(error)
                }
            });
        }
       
    }
