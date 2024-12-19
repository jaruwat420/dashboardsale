<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\BlogDataTable;
use App\Traits\FileUploadTrait;
use App\Models\Blog;
use App\Http\Requests\Admin\BlogCreateRequest;

class BlogController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render ('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCreateRequest $request)
    {
        $imagePath = $this->uploadImage($request, 'image');

        $blog = new Blog();
        $blog->image = $imagePath;
        $blog->user_name = auth()->user()->name;
        $blog->blog_type = $request->blog_type;
        $blog->blog_title = $request->blog_title;
        $blog->blog_link = $request->blog_link;
        $blog->status = $request->blog_status;
        $blog->save();

        toastr()->success('Create Blog Successfully.');

        return to_route('admin.blog.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blogs = Blog::findOrFail($id);
        return view ('admin.blog.edit', compact('blogs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $blog =  Blog::findOrFail($id);

        $imagePath = $this->uploadImage($request, 'image', $blog->image);

        $blog->image = !empty($imagePath) ? $imagePath : $blog->image;
        $blog->user_name = auth()->user()->name;
        $blog->blog_type = $request->blog_type;
        $blog->blog_title = $request->blog_title;
        $blog->blog_link = $request->blog_link;
        $blog->status = $request->blog_status;
        $blog->save();

        toastr()->success('Update Blog Successfully.');

        return to_route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->delete();

            return response(['status' => 'success', 'message' => 'Delete Blog Successfully.']);
        } catch (\exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
