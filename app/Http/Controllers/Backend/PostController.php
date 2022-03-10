<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('categories', 'photos', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('backend.posts.index', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeSlug($string)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }
    public function store(PostRequest $request)
    {
        $post = new Post();

        $post->title = $request->title;
        $post->description = $request->description;
        $post->slug = $this->makeSlug($request->slug);
        $post->user_id = Auth::id();
        $post->status = $request->status;
        $post->views = 0;

        $post->save();

        $post->photos()->sync([$request->photo_id]);
        $post->categories()->sync($request->category_id);

        Session::flash('success', 'پست با موفقیت ذخیره شد');
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);

        return view('backend.posts.edit', compact(['categories', 'post']));
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
        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->slug = $this->makeSlug($request->slug);
        $post->description = $request->description;
        $post->status = $request->status;

        $post->save();

        $post->photos()->sync([$request->photo_id]);
        $post->categories()->sync($request->category_id);

        Session::flash('success','پست با موفقیت ویرایش شد');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        Session::flash('warning', 'پست با موفقیت حذف شد');
        return redirect(route('post.index'));
    }
}
