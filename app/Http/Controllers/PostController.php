<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create posts', ['only' => ['create','store']]);
        $this->middleware('permission:edit posts',   ['only' => ['edit','update']]);
        $this->middleware('permission:delete posts', ['only' => ['destroy']]);
    }

    public function index()
    {
        $posts = Post::paginate(5);

        return view('posts.index', compact('posts'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }

    public function trash()
    {

        $posts = Post::paginate(5);
        $posts = Post::onlyTrashed()->get();
        return view('posts.trash', compact('posts'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = auth()->user()->id;

        if($request->file('image')) {
            $pic = $request->file('image');
            $destinationPath = public_path()."/images";
            $extension =  $pic->getClientOriginalExtension();
            $fileName = time();
            $fileName .= rand(11111,99999).'.'.$extension; // renaming image
            if(!$pic->move($destinationPath,$fileName))
            {
                throw new \Exception("Failed Upload");
            }
            $picture =  "http://localhost/multiauthguard/public/images/". $fileName;
            $post->file = $picture;
        }
        $post->save();

        //Post::create($request->all());

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // dd($request->all());

        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;

        if($request->file('image')) {
            $pic = $request->file('image');
            $destinationPath = public_path()."/images";
            $extension =  $pic->getClientOriginalExtension();
            $fileName = time();
            $fileName .= rand(11111,99999).'.'.$extension; // renaming image
            if(!$pic->move($destinationPath,$fileName))
            {
                throw new \Exception("Failed Upload");
            }
            $picture =  "http://localhost/multiauthguard/public/images/". $fileName;
            $post->file = $picture;
            // dd('sdfa');
        }
        // $updated_post =  $post->update([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'file' => $picture
        // ]);
        // if(!$updated_post)
        // dd('failed');
        $post->save();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post Moved to trash successfully');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        $post->restore();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post Restored successfully');
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->find($id);

        $post->forceDelete();

        return redirect()
            ->back()
            ->with('success', 'Post is deleted permenantly');
    }
}
