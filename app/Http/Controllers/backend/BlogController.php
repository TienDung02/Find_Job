<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\Category;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $data = $this->getTable($request);

        return view('backend.blog.index', compact('data'));
    }

    public function getLimit (Request $request) {
        $data = $this->getTable($request);
        return view('backend.blog.ajax.table', compact('data'));
    }

    public function getTable ($request) {
        $data = Blog::query()->with('category_blog');
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);
        if ($keyword != '')
        {
            $data = $this->search($data, $type, $keyword);
        }
        return $data->paginate($limit);
    }

    public function create()
    {
        $name = '';
        $id_blog = '';
        $CategoryBlog = Category::query()->where('level', '<', 3)->get();
        return view('backend.blog.add', compact('CategoryBlog', 'name', 'id_blog'));
    }

    public function search($query, $type, $keyword)
    {
        if ($type === 'author') {
            $query->where('author', 'like', "%$keyword%");
        } else {
            $query->where('title', 'like', "%$keyword%");
        }
        return $query;
    }

    public function store(Request $request)
    {
        $data = $this->getTable($request);
        $insert_blog = new blog();
        $insert_blog->author = $request->input('author');
        $insert_blog->category_blog_id = $request->input('category_blog_id');
        $insert_blog->title = $request->input('title');
        $insert_blog->desc = $request->input('desc');
        $file = $request->file('file');
        dd($file);
        $path = $file->store('uploads', 'public');
        $url = asset('storage/' . $path);
        $insert_blog->img = $url;
        if ($insert_blog->save()) {
            toastr()->success('Added industry successfully!');
        } else {
            toastr()->error('There was an error adding a blog!');
            return 789;
        }

        return view('backend.blog.index', compact('data'));
    }



    public function edit($id_blog)
    {
        $blog = blog::with('category_blog')->findOrFail($id_blog);
        $CategoryBlog = CategoryBlog::query()->where('level', '<', 4)->get();
        return view('backend.blog.add', compact('blog', 'id_blog', 'CategoryBlog'));
    }



    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');

        $query = blog::query();

        if ($type == 'author') {
            $query->where('author', 'like', "%$keyword%");
        } elseif ($type == 'title') {
            $query->where('title', 'like', "%$keyword%");
        }

        $data = $query
            ->select('blogs.id', 'blogs.title as data2', 'blogs.author as data1')->get();
        $data = $data->map(function ($item) {
            return [
                'id_data' => $item->data1,
                'data1' => $item->data1,
                'data2' => $item->data2,
                'data3' => $item->data2
            ];
        });
//        return 123;
        return response()->json($data);
    }



    public function update(Request $request, $id_blog)
    {
        $blog_update = blog::find($id_blog);
        if (!$blog_update) {
            return redirect()->route('industry.index')->with('error', 'Category not found.');
        }
        $blog_update->author = $request->input('author');
        $blog_update->category_blog_id = $request->input('category_blog_id');
        $blog_update->title = $request->input('title');
        $blog_update->desc = $request->input('desc');
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');
        $url = asset('storage/' . $path);
        $blog_update->img = $url;
        if ($blog_update->save()) {
            toastr()->success('Update blog successfully!');
        } else {
            toastr()->error('There was an error updating a blog!');
            return back();
        }
        return redirect()->route('blog.index');
    }


    public function destroy($id)
    {
        $blog = blog::find($id);

        if (!$blog) {
            toastr()->error('blog not found.');
            return redirect()->route('industry.index');
        }

        if ($blog->delete()) {
            toastr()->success('blog deleted successfully!');
            return redirect()->back();
        } else {
            toastr()->error('There was an error deleting the blog!');
            return redirect()->back();
        }
    }
}
