<?php

namespace App\Http\Controllers;


use App\Models\{
    Post,
    User,
    Role,
    Permission,
};

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdatePostRequest;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }
    
    public function index()
    {
        try {

            $this->authorize('view_post');
            $posts = $this->posts->get();
            return response()->json($posts, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function createPost(StoreUpdatePostRequest $request)
    {
        try {

            $this->authorize('create_post');
            $data = $request->all();
            $user = auth()->user();
            $data['image'] = $this->uploadFileBase64($request->image, $user);
            auth()->user()->posts()->create($data);
            return response()->json(['msg' => 'Post cadastrado!'], 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }

    public function uploadFileBase64($file, $user, $path = '')
    {
        // receber a tratar arquivo base64
        $separator = DIRECTORY_SEPARATOR;
        $time = time();
        $directoryImage = $path;
        $extension = substr($file, 11, strpos($file, ';') - 11);
        $path = $directoryImage . $separator . $time . '.' . $extension;

        $file = str_replace('data:image/' . $extension . ';base64,', '', $file);
        $file = base64_decode($file);

        Storage::disk('tenant')->put($path, $file);
        return $path;
    }

    public function checkIfTheFileExistsAndDelete($file, $user)
    {

        $image = explode(DIRECTORY_SEPARATOR, $file);
        $index = array_key_last($image);

        if (Storage::disk('tenant')->exists("./perfils/perfil_id/{$user['id']}/")) {
            Storage::disk('tenant')->delete("./perfils/perfil_id/{$user['id']}/{$image[$index]}");
        };
    }

    public function getPost($id)
    {
        try {

            $this->authorize('view_post');
            $post = $this->post->find($id);
            if (!is_null($post)) {
                return response()->json($post, 200);
            }
            return response()->json(['msg' => 'Post não encontrado'], 404);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function updatePost(StoreUpdatePostRequest $request, $id)
    {
        try {

            $this->authorize('update_post');
            $post = $this->post->find($id);

            if (!$post) {
                return response()->json(["msg" => 'Post não encontrado!'], 404);
            }

            $post = $post->update($request->all());

            return response()->json(['msg' => 'Post atualizado!'], 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }
}
