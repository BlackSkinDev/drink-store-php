function trash(id){
    var x = confirm('Are you sure you want to trash product ?')
    if(x==true){
        $.ajax({
            url: "../admins/trash.php",
            type: "post",
            data: {
                id: id,
            },
            success: function (response) {
                $("#success").show();
                $("#success").text(JSON.parse(response))
                $("#row"+id).remove();
                setTimeout(function() { $("#success").hide(); }, 2000);
            },
            error: function(error) {
               alert(error)
            }
        });
    }
   
}