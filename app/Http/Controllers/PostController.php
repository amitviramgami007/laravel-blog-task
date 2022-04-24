<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCreateNotification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $createRoute = 'posts.create';

        if ($request->ajax())
        {
            $data = Post::latest()->get();

            $data = auth()->user()->role == "Admin" ? Post::with('user', 'categories')->latest()->get() : auth()->user()->posts('categories')->latest();

            return DataTables::of($data)
                ->addColumn('category', function ($data)
                {
                    $categories = '';
                    foreach($data->categories as $category)
                    {
                        $categories .= '<label class="badge badge-info">'.$category->title.'</label>';
                    }
                    return $categories;
                })
                ->addColumn('created_by', function ($data)
                {
                    return getUserName($data->created_by);
                })
                ->addColumn('updated_by', function ($data)
                {
                    return getUserName($data->updated_by);
                })
                ->addColumn('created_at', function ($data)
                {
                    return Carbon::parse($data->created_at)->format('d-m-Y H:i:s');
                })
                ->addColumn('updated_at', function ($data)
                {
                    return Carbon::parse($data->updated_at)->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function($data)
                {
                    return (string) view('posts.action', ['id' => $data->id]);
                })
                ->rawColumns(['action', 'category'])
                ->make(true);
        }

        return view('posts.index', compact('createRoute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $categories = Category::pluck('title', 'id')->toArray();
        $category_ids = [];
        return view('posts.create', compact('categories', 'category_ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $input = $request->all();
        $post = auth()->user()->posts()->create($input);

        $category = Category::find($input['category']);
        $post->categories()->sync($category);

        $admins =  User::where('role', 'Admin')->get();
        Notification::send($admins, new PostCreateNotification($post));

        Session::flash('statusCode', 'success');
        return redirect()->route('posts.index')->with('status', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Category $category)
    {
        $categories = Category::pluck('title', 'id')->toArray();
        $category_ids = [];
        foreach ($post->categories as $category)
        {
            array_push($category_ids, $category->id);
        }
        return view('posts.edit', compact('post', 'categories', 'category_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $input = $request->all();
        $post->update($input);

        $category = Category::find($input['category']);
        $post->categories()->sync($category);

        Session::flash('statusCode', 'success');
        return redirect()->route('posts.index')->with('status', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('statusCode', 'success');
        return redirect()->route('posts.index')->with('status', 'Post Deleted Successfully');
    }
}
