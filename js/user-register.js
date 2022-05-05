$(document).ready(function() {
    let error = $("#error").text();
    if(error!='') {
        document
        .querySelector("#head-section")
        .scrollIntoView({ behavior: "smooth" });
    }
})


$("#register-form").submit(function(event){
    
    $("#firstname-err").text("")
    $("#lastname-err").text("")
    $("#email-err").text("")
    $("#password-err").text("")
    $("#cpassword-err").text("")


    var valid = true;
     let password = $("#password").val();
     let cpassword = $("#cpassword").val();
     let firstname = $("#firstname").val()
     let lastname = $("#lastname").val()
     let email = $("#email").val()
   

     if(firstname==''){
         $("#firstname-err").text("Please enter a firstname")
         $("#firstname").focus();
         valid = false;
     }
     else if(lastname==''){
        $("#lastname-err").text("Please enter lastname")
        $("#lastname").focus();
        valid = false;
    }
    else if(email==''){
        $("#email-err").text("Please enter email")
        $("#email").focus();
        valid = false;
    }

     else if(password==''){
         $("#password-err").text("Please enter a  password")
         $("#password").focus();
         valid = false;
     }
     else if(password.length < 6 || $password.length > 12){
        $("#password-err").text("Password must be between 6 and 12 characters")
        $("#password").focus();
        valid = false;
    }
     else if(cpassword==''){
         $("#cpassword-err").text("Please confirm  password")
         $("#cpassword").focus();
         valid = false;
     }
     else if(password != $cpassword){
         $("#cpassword-err").text("Password do not match")
         $("#cpassword").focus();
         valid = false;
     }
    
     if (!valid) {
        event.preventDefault();
     }
   
})