<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div id="alertdiv" class="mx-5 mt-2 px-3" style="height: 40px">
        <div id="alertmessage" style="display: none">

        </div>   
    </div>

    <div class="card" style="width: 28rem; margin:45px auto; padding:20px">
        <form>
            <h2>Login</h2>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input placeholder="Email" type="email" id="loginemail" class="form-control" />
            </div>
            <!-- Password input -->
            <div class="form-outline mb-4">
              <input placeholder="Password" type="password" id="loginpassword" class="form-control" />
            </div>
            <!-- Submit button -->
            <button  id="loginbutton" type="button" class="btn btn-primary btn-block mb-4">Sign in</button>
        </form>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function(){
            $('#loginbutton').on('click',function(){
                const email = $('#loginemail').val();
                const password = $('#loginpassword').val();

                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        email: email,
                        password: password
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        // console.log(response);
                        localStorage.setItem('api_token', response.token);
                        let obj = {
                            status : response.status,
                            message : response.message
                        };
                        localStorage.setItem('dataKey',JSON.stringify(obj));

                        // window.location.replace = "http:://localhost:8000/allposts";
                        window.location.href = "/allposts";
                    },
                    // error: function(xhr, status, error){
                    //     alert('Error:' + xhr.responseText);
                    // }
                    error: function(response){
                        alert('Error: ' + response.responseJSON.message);
                    }
                });
            });
        });

        if(localStorage.getItem('dataKey')){
            let storedData = JSON.parse(localStorage.getItem('dataKey'));
            localStorage.removeItem('dataKey'); 
            var type="";
            if(storedData.status==true){
                type="alert-success";
            }
            else{
                type="alert-danger";
            }
            var elem = `<div class="alert ${type} mb-0" role="alert">${storedData.message}</div>`;
            $('#alertmessage').html(elem).fadeIn('slow');
            setTimeout(() => {
                $('#alertmessage').fadeOut('slow');
            }, 2000);
        }
    </script>
</body>
</html>