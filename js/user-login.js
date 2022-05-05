$(document).ready(function() {
    let error = $("#error").text();
    if(error!='') {
        document
        .querySelector("#head-section")
        .scrollIntoView({ behavior: "smooth" });
    }
})


$("#login-form").submit(function(event){
    
    $("#email-err").text("")
    $("#password-err").text("")
   

    var valid = true;
     let password = $("#password").val();
     let email = $("#email").val()
   

    
     if(email==''){
        $("#email-err").text("Please enter email")
        $("#email").focus();
        valid = false;
    }

     else if(password==''){
         $("#password-err").text("Please enter a  password")
         $("#password").focus();
         valid = false;
     }
    
     if (!valid) {
        event.preventDefault();
     }
   
})