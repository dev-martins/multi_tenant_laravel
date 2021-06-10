<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdatePostRequest;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function index()
    {
        try {

            // $posts = $this->posts->get();
            // $this->authorize('list-post', $posts);

            return response()->json($this->post->get(), 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function createPost(StoreUpdatePostRequest $request)
    {
        try {
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
