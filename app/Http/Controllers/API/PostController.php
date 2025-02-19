<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

// class PostController extends Controller
// {
//     public function index()
//     {
//         $data['posts'] = Post::all();
//         return response()->json([
//             'status' => true,
//             'message' => 'All Post Data',
//             'user' => $data,
//         ],200); 
//     }
    
//     public function store(Request $request)
//     {
//         $validateUser = Validator::make(
//             $request->all(),
//             [
//                 'title' => 'required',
//                 'description' => 'required',
//                 'image' => 'required|mimes:png,jpg,jpeg,gif',
//             ]
//         );

//         if($validateUser->fails()){
//             return response()->json([
//                 'status' => false,
//                 'message' => 'Validation Error',
//                 'errors' => $validateUser->errors()->all(),
//             ],401);
//         }

//         $img = $request->image;
//         $ext = $img->getClientOriginalExtension();
//         $imageName = time(). '.' .$ext;
//         $img->move(public_path(). '/uploads',$imageName);

//         $post = Post::create([
//             'title' => $request->title,
//             'description' => $request->description,
//             'image' => $imageName,
//         ]);

//         return response()->json([
//             'status' => true,
//             'message' => 'Post created successifully',
//             'post' => $post,
//         ],200);
//     }

//     public function show(string $id)
//     {
//         $data['post'] = Post::select('id','title','description','image')->where(['id' => $id])->get();
//         return response()->json([
//             'status' => true,
//             'message' => 'Your single post',
//             'data' => $data,
//         ],200);
//     }

//     public function update(Request $request, string $id)
//     {
//         $validateUser = Validator::make(
//             $request->all(),
//             [
//                 'title' => 'required',
//                 'description' => 'required',
//                 'image' => 'required|mimes:png,jpg,jpeg,gif',
//             ]
//         );

//         if($validateUser->fails()){
//             return response()->json([
//                 'status' => false,
//                 'message' => 'Validation Error',
//                 'errors' => $validateUser->errors()->all(),
//             ],401);
//         }

//         $postImage = Post::select('id','image')->where(['id' => $id])->get();
//         $imageName = '';
//         if($request->image != ''){
//             $path = public_path(). '/uploads';
//             if($postImage[0]->image != '' && $postImage[0]->image != null){
//                 $old_file = $path. $postImage[0]->image;
//                 if(file_exists($old_file)){
//                     unlink($old_file);
//                 }
//             }
//             $img = $request->image;
//             $ext = $img->getClientOriginalExtension();
//             $imageName = time(). '.' .$ext;
//             $img->move(public_path(). '/uploads',$imageName);
//         }else {
//             $imageName =  $postImage[0]->image;
//         }

        
//         $post = Post::where(['id' => $id])->update([
//             'title' => $request->title,
//             'description' => $request->description,
//             'image' => $imageName,
//         ]);

//         return response()->json([
//             'status' => true,
//             'message' => 'Post updated successifully',
//             'post' => $post,
//         ],200);
//     }

//     public function destroy(string $id)
//     {
//         $imageName = Post::select('image')->where('id',$id)->get();
//         $filePath = public_path(). '/uploads/'. $imageName[0]['image'];
//         unlink($filePath);

//         $post = Post::where('id',$id)->delete();

//         return response()->json([
//             'status' => true,
//             'message' => 'Post removed successifully',
//             'post' => $post,
//         ],200);
//     }
// }


class PostController extends BaseController
{
    public function index()
    {
        $data['posts'] = Post::all();
        return $this->sendResponse('All Post Data',$data);
    }
    
    public function store(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
            ]
        );

        if($validateUser->fails()){
            return $this->sendError('Validation Error',$validateUser->errors()->all(),401);
        }

        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time(). '.' .$ext;
        $img->move(public_path(). '/uploads',$imageName);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return $this->sendResponse('Post created successifully',$post);

    }

    public function show(string $id)
    {
        $data['post'] = Post::select('id','title','description','image')->where(['id' => $id])->get();
        return $this->sendResponse('Your single post',$data);

    }

    public function update(Request $request, string $id)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            ]
        );

        if($validateUser->fails()){
            return $this->sendError('Validation Error',$validateUser->errors()->all(),401);
        }

        $postImage = Post::select('id','image')->where(['id' => $id])->get();
        $imageName = '';
        if($request->image != ''){
            $path = public_path(). '/uploads/';
            if($postImage[0]->image != '' && $postImage[0]->image != null){
                $old_file = $path. $postImage[0]->image;
                if(file_exists($old_file)){
                    unlink($old_file);
                }
            }
            $img = $request->image;
            $ext = $img->getClientOriginalExtension();
            $imageName = time(). '.' .$ext;
            $img->move(public_path(). '/uploads',$imageName);
        }else {
            $imageName =  $postImage[0]->image;
        }

        
        $post = Post::where(['id' => $id])->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return $this->sendResponse('Post updated successifully',$post);

        
    }

    public function destroy(string $id)
    {
        $imageName = Post::select('image')->where('id',$id)->get();
        $filePath = public_path(). '/uploads/'. $imageName[0]['image'];
        unlink($filePath);

        $post = Post::where('id',$id)->delete();

        return $this->sendResponse('Post removed successifully',$post);
        
    }
}
