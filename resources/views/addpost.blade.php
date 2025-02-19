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
    <div class="card" style="width: 38rem; margin:25px auto; padding:10px">
        <form id="addForm">
            <h2>Create Post</h2>
            <!-- Title input -->
            <div class="form-outline mb-4">
              <input placeholder="Title" type="text" id="title" class="form-control" />
            </div>
            <!-- Description input -->
            <div class="form-outline mb-4">
                <textarea placeholder="Description" class="form-control" id="description" rows="3"></textarea>
            </div>
            <!-- File input -->
            <div class="form-outline mb-4">
                <input class="form-control" type="file" id="image">
            </div>
            <!-- Submit button -->
            <input type="submit" class="btn btn-primary mb-4">
            <!-- Back button -->
            <a href="/allposts"><button  type="button" class="btn btn-secondary btn-block mb-4">Back</button></a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>

        var addform = document.querySelector('#addForm');
        addform.onsubmit = async (e) => {
            e.preventDefault();
            const token = localStorage.getItem('api_token');
            const title = document.querySelector('#title').value;
            const description = document.querySelector('#description').value;
            const image = document.querySelector('#image').files[0];

            var formData = new FormData();
            formData.append('title',title);
            formData.append('description',description);
            formData.append('image',image);

            let response = await fetch('/api/posts',{
                method: 'POST',
                body: formData,
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                
            })
            .then(response => response.json())
            .then(data => {
                // console.log(data);

                let obj = {
                    status : data.status,
                    message : data.message
                };
                localStorage.setItem('dataKey',JSON.stringify(obj));
                window.location.href = "http://localhost:8000/allposts";

                // let obj = {
                //     status : data.status,
                //     message : data.message
                // };
                // sessionStorage.setItem('dataKey',JSON.stringify(obj));
                // window.location.href = "http://localhost:8000/allposts";
            });

        }
    </script>

</body>
</html>