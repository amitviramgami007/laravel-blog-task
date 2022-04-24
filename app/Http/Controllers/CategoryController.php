<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $createRoute = 'categories.create';

        if ($request->ajax())
        {
            $data = Category::latest()->get();

            return DataTables::of($data)
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
                    return (string) view('categories.action', ['id' => $data->id]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('categories.index', compact('createRoute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $input = $request->all();
        Category::create($input);
        Session::flash('statusCode', 'success');
        return redirect()->route('categories.index')->with('status', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $input = $request->all();
        $category->update($input);
        Session::flash('statusCode', 'success');
        return redirect()->route('categories.index')->with('status', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('statusCode', 'success');
        return redirect()->route('categories.index')->with('status', 'Category Deleted Successfully');
    }
}
