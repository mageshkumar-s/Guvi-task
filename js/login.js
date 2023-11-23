const SendDatatolog = (event) => {
    event.preventDefault();
    var email = $("#email").val();
    var password = $("#password").val();
    if(email === ''||password ===''){
        alert("We don't recognize this username or password.\nPlease check your credentials and try again.")
    }else{
        $.ajax({
            type:"POST",
            url:"http://localhost/guvitask/php/login.php",
            data:{
                email:email,
                password:password
            },
            success:function(response){
                alert(response);
            },
            error:function(){
                alert("Invalid login credentials");
            }
        });
    }
    
}