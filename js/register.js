const sendData = (event) => {
    event.preventDefault();
    var fullName = $("#fname").val().trim();
    var email = $("#email").val().trim();
    var password = $("#password").val().trim();


    //validate the fields
    if(fullName === '' || email === '' || password ===''){
        alert("Enter required details");
    }else{
        
        $.ajax({
            type:"POST",
            url:"http://localhost/guvitask/php/register.php",
            data:{
                fullName:fullName,
                email:email,
                password:password
            },
            success:function(response){
                alert(response);
            },
            error:function(){
                alert("Error loading data");
            }
        });
    }
    

    
}
