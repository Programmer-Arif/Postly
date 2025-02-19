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

    <div class="m-5 mt-0 p-3">
        <h1>All Posts</h1>
        <a href="/addpost" class="btn btn-primary">Add New</a>
        <button id="logoutbutton" class="btn btn-danger">Logout</button>
        <div id="postsContainer">

        </div>
    </div>

    <!-- Single Post Modal -->
    <div class="modal fade" id="singlePostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="singlePostLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title fs-5" id="singlePostLabel">Single Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Update Post Modal -->
     <div class="modal fade" id="updatePostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatePostLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title fs-5" id="updatePostLabel">Update Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="updateform">
                    <div class="modal-body">
                        <input type="hidden" id="postId" class="form-control" value="">
                        <b>Title</b> <input type="text" id="postTitle" class="form-control" value="">
                        <b>Description</b> <input type="text" id="postBody" class="form-control" value="">
                        <img width="150px" src="" alt="" id="showImage">
                        <p>Upload Image</p><input type="file" id="postImage" class="form-control">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Save Changes" class="btn btn-primary"> 
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.querySelector('#logoutbutton').addEventListener('click',function(){
            const token =  localStorage.getItem('api_token');

            // fetch('/api/logout',{
            //     method: 'POST',
            //     headers: {
            //         'Authorization': `Bearer ${token}`
            //     }
            // })
            // .then(response => response.json())
            // .then(data => {
            //     console.log(data);
            //     window.location.href = "http://localhost:8000/login";
            // });

            $.ajax({
                url: '/api/logout',
                type: "POST",
                contentType: "application/json",
                dataType: 'JSON',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    console.log(data);
                    localStorage.removeItem('api_token');
                    let obj = {
                        status : data.status,
                        message : data.message
                    };
                    localStorage.setItem('dataKey',JSON.stringify(obj));

                    window.location.href = "http://localhost:8000/login";
                }
            });

        });

        function loadData() {
            const token =  localStorage.getItem('api_token');

            fetch('/api/posts',{
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // console.log(data.data['posts']);
                var allposts = data.data.posts;
                const postContainer = document.querySelector('#postsContainer');

                var tabledata = `<table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">View</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>`;
                    allposts.forEach(post => {
                        tabledata += `<tr>
                            <td><img src="/uploads/${post.image}" width="100px" height="100px"/></td>
                            <td><h6>${post.title}</h6></td>
                            <td><p>${post.description}</p></td>
                            <td><button class="btn btn-primary" data-bs-postid="${post.id}" data-bs-toggle="modal" data-bs-target="#singlePostModal">View</button></td>
                            <td><button class="btn btn-success" data-bs-postid="${post.id}" data-bs-toggle="modal" data-bs-target="#updatePostModal">Update</button></td>
                            <td><button onclick="deletePost(${post.id})" class="btn btn-danger">Delete</button></td>
                        </tr>`;
                    });
                    
                tabledata += `</tbody>
                            </table>`;

                postContainer.innerHTML = tabledata;

            });
        }

        loadData();

        // Open single post modal
        const singleModal = document.getElementById('singlePostModal')
        if (singleModal) {
            singleModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget;

                const modalBody = document.querySelector('#singlePostModal .modal-body');
                modalBody.innerHTML = "";

                // Extract info from data-bs-* attributes
                const id = button.getAttribute('data-bs-postid');
            
                const token =  localStorage.getItem('api_token');

                fetch(`/api/posts/${id}`,{
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type' : 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const post = data.data.post[0];
                    modalBody.innerHTML = `
                        Title: ${post.title}
                        <br>
                        Description: ${post.description}
                        <br>
                        <img width="150px" src="http://localhost:8000/uploads/${post.image}" />
                    `;
                });
            })
        }



        // Open updatepost modal
        const updateModal = document.getElementById('updatePostModal');
        if (updateModal) {
            updateModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget;

                // Extract info from data-bs-* attributes
                const id = button.getAttribute('data-bs-postid');
            
                const token =  localStorage.getItem('api_token');

                fetch(`/api/posts/${id}`,{
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type' : 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const post = data.data.post[0];
                    
                    document.querySelector('#postId').value = post.id;
                    document.querySelector('#postTitle').value = post.title;
                    document.querySelector('#postBody').value = post.description;
                    document.querySelector('#showImage').src = `/uploads/${post.image}`;
                    document.querySelector('#postImage').value="";
                });
            })
        }

        // Update Post
        var updateform = document.querySelector('#updateform');
        updateform.onsubmit = async (e) => {
            e.preventDefault();
            const token = localStorage.getItem('api_token');

            const postId = document.querySelector('#postId').value;
            const title = document.querySelector('#postTitle').value;
            const description = document.querySelector('#postBody').value;

            var formData = new FormData();
            // formData.append('id',postId);
            formData.append('title',title);
            formData.append('description',description);
            
            if(!document.querySelector('#postImage').files[0] == ""){
                const image = document.querySelector('#postImage').files[0];
                formData.append('image',image);
            }

            let response = await fetch(`/api/posts/${postId}`,{
                method: 'POST',
                body: formData,
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'X-HTTP-Method-Override' : 'PUT'
                }
            })
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                // window.location.href = "http://localhost:8000/allposts";

                loadData();
                $('#updatePostModal').modal('toggle');

                var type="";
                if(data.status==true){
                    type="alert-success";
                }
                else{
                    type="alert-danger";
                }
                var elem = `<div class="alert ${type} mb-0" role="alert">${data.message}</div>`;
                $('#alertmessage').html(elem).fadeIn('slow');
                setTimeout(() => {
                    $('#alertmessage').fadeOut('slow');
                }, 2000);
                

            });

        }

        // Delete Post
        async function deletePost(postId){
            if(confirm("Do you really want to delete this record ? ")){
                const token = localStorage.getItem('api_token');

                let response = await fetch(`/api/posts/${postId}`,{
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    // window.location.href = "http://localhost:8000/allposts";

                    loadData();

                    var type="";
                    if(data.status==true){
                        type="alert-success";
                    }
                    else{
                        type="alert-danger";
                    }
                    var elem = `<div class="alert ${type} mb-0" role="alert">${data.message}</div>`;
                    $('#alertmessage').html(elem).fadeIn('slow');
                    setTimeout(() => {
                        $('#alertmessage').fadeOut('slow');
                    }, 2000);
                    });
            }
        }

        if(localStorage.getItem('dataKey')){
            let storedData = JSON.parse(localStorage.getItem('dataKey'));
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
            localStorage.removeItem('dataKey'); 
        }

        // if(sessionStorage.getItem('dataKey')){
        //     let storedData = JSON.parse(sessionStorage.getItem('dataKey'));
        //     var type="";
        //     if(storedData.status==true){
        //         type="alert-success";
        //     }
        //     else{
        //         type="alert-danger";
        //     }
        //     var elem = `<div class="alert ${type} mb-0" role="alert">${storedData.message}</div>`;
        //     $('#alertmessage').html(elem).fadeIn('slow');
        //     setTimeout(() => {
        //         $('#alertmessage').fadeOut('slow');
        //     }, 2000);
        //     sessionStorage.removeItem('dataKey');
        // }

    </script>
    
</body>
</html>