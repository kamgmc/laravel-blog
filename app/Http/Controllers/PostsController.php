<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PostsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index () {
        return response(Post::with('status')->orderByDesc('id')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store (Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'status_id' => 'required|integer|exists:App\Models\Status,id'
        ]);
        $post = new Post();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->status_id = $request->get('status_id');
        $post->save();
        return response($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show (int $id) {
        return response(Post::find($id)->append('status_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update (Request $request, int $id) {
        $this->validate($request, [
            "status_id" => "exists:status,id"
        ]);

        $post = Post::find($id);
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->status_id = $request->get('status_id');
        $post->save();

        return response($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy (int $id) {
        $post = Post::find($id);
        $post->delete();
        return response($post, 200);
    }



    /**
     * Display a listing of published resource.
     *
     * @return Response
     */
    public function getAllPublished () {
        return response(Post::with('status')
            ->whereHas('status', function ($query){
                $query->where('status.name', 'like', 'Published');
            })
            ->orderByDesc('posts.id')
            ->get());
    }
}
