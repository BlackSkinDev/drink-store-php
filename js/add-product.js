$(document).ready(function() {
    let error = $("#error").text();
    let successMsg = $("#success").text();
    if(successMsg!='') {
        document
        .querySelector("#head-section")
        .scrollIntoView({ behavior: "smooth" });
    }
})


$("#product-form").submit(function(event){
    
    $("#name-err").text("")
    $("#description-err").text("")
    $("#price-err").text("")
    $("#file-err").text("")
    

    var valid = true;
     let name = $("#name").val();
     let description = $("#description").val();
     let price = $("#price").val();
     let file = $("#file").val();
    

     if(name==''){
         $("#name-err").text("Please enter a product name")
         $("#firstname").focus();
         valid = false;
     }
     else if(description==''){
        $("#description-err").text("Please enter product description")
        $("#description").focus();
        valid = false;
    }
    else if(price==''){
        $("#price-err").text("Please enter product price")
        $("#price").focus();
        valid = false;
    }
    else if(file==''){
        $("#file-err").text("Please select product image")
        $("#file").focus();
        valid = false;
    }

    
     if (!valid) {
        event.preventDefault();
     }
   
})