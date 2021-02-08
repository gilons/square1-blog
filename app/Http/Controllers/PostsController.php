<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Validators\PostValidator;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorter = request('sorter', null);
        $order = request('order', null);
        $search = request('search', false);
        if ($search) {
            return PostService::searchPost($sorter, $order, $search);
        }
        return PostService::getPosts($sorter, $order);
    }

    public function myPosts()
    {
        $sorter = request('sorter', null);
        $order = request('order', null);
        $search = request('search', false);
        $userId = auth()->user()->id;
        if ($search) {
            $posts = PostService::searchMyPosts( $search, $userId,$sorter, $order);
            return response(['data' => $posts], 200);
        }

        $posts = PostService::postsByUser($userId, $sorter, $order);
        return response(['data' => $posts], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->all();
        $validation = PostValidator::validateCreatePost($post);
        if ($validation->fails()) {
            return response(['errors' => $validation->errors()], 200);
        } else {
            $post['user_id'] = auth()->user()->id;
            $response = PostService::savePost($post);
            return response($response, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = PostService::getSinglePost($slug);
        return response($post, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getRandom()
    {
        $post = PostService::getRandomPosts();
        return $post;
    }

    public function showPost($slug)
    {
        $post = PostService::getSinglePost($slug);

        return view('post', ['post' => $post]);
    }
}
