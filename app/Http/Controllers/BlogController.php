<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
class BlogController extends Controller
{

    private $getCandidate;
    private $search;


    public function index(Request $request)
    {
        $limit = 5;
        $data = blog::with('category_blog')->paginate($limit);
        return view('admin.blog.index', compact('data'));
    }

    public function getLimit (Request $request) {
        $data = blog::query();
        $search = '';
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);
        $data = $data->paginate($limit);
        if ($keyword != '')
        {
            $search = $this->search($type, $keyword, $limit);
            if ($search->isNotEmpty()) {
                $data = $search;
                if ($type == 'active'){
                    $search = '';
                }
            }
        }
        return view('admin.blog.ajax.table', compact('data', 'search'));
    }

    public function create()
    {
        $name = '';
        $blog_id = '';
        $blogList = $this->show();
        return view('admin.blog.add', compact('blogList', 'name', 'blog_id'));
    }

    public function search($type, $keyword, $limit)
    {
        if ($type === 'parent') {
            $this->search = blog::where('parent_id', $keyword)->paginate($limit);
        }else{
            $this->search = blog::where('id_blog', $keyword)->paginate($limit);
        }

        return $this->search;
    }

    public function show($type = 'add', $id=0, $blog_id=0, $space='&nbsp;')
    {
        $data = blog::all();
        foreach ($data as $value) {
            if ($type == 'add'){
                if ($value['parent_id'] == $id){
                    $this->Getblog .= "<option "  . " value='" . $value['id_blog'] . "' >" . $space . "-&nbsp;" . $value['name'] . "</option>";
                    $this->show('add',$value['id_blog'],0, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                }
            }
            else if ($type == 'edit'){
                if ($blog_id == 0){
                    if ($value['parent_id'] == $id){
                        $this->Getblog .= "<option "  . " value='" . $value['id_blog'] . "' >" . $space . "-&nbsp;" . $value['name'] . "</option>";
                        $this->show($type = 'add', $value['id_blog'],$blog_id, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    }
                }else{
                    $selected = ' ';
                    if ($value['parent_id'] == $id) {
                        if ($value['id_blog'] == $blog_id) {
                            $selected = 'selected';
                        }
                        $this->Getblog .= "<option "  . " value='" . $value['id_blog'] . "' $selected>" . $space . "-&nbsp;" . $value['name'] . "</option>";
                        $this->show('add',$value['id_blog'],0, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    }
                }
            }
        }

        return $this->Getblog;
    }

//    public function store(Request $request)
//    {
//        $data = blog::query();
//        $limit = $request->input('limit-blog', 5);
//        $data = $data->paginate($limit);
//        $insert_blog = new blog();
//        $insert_blog->name = $request->input('name');
//        $insert_blog->parent_id = $request->input('parent_id');
//
//        $blogExists = blog::where('name', $insert_blog->name)
//            ->where('parent_id', $insert_blog->parent_id)
//            ->exists();
//
//        if (!$blogExists) {
//            if ($insert_blog->save()) {
//                toastr()->success('Added blog successfully!');
//            } else {
//                toastr()->error('There was an error adding a blog!');
//                return back();
//            }
//        } else {
//            toastr()->error('This blog already exists!');
//            return back();
//        }
//        return view('admin.blog.admin_blog_page', compact('data'));
//    }



    public function edit($id_blog)
    {
        $blog = blog::with('category_blog')->findOrFail($id_blog);
        return view('admin.blog.add', compact('blog', 'id_blog'));
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
            ->select('blogs.id_blog', 'blogs.title as data2', 'blogs.author as data1')->get();
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



    public function update(Request $request, $id)
    {
        $request->validate([
            'parent_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
        ]);
        $id_blog = blog::find($id);
        if (!$id_blog) {
            return redirect()->route('categories.index')->with('error', 'blog not found.');
        }
        $id_blog->parent_id = $request->input('parent_id');
        $id_blog->name = $request->input('name');
        if ($id_blog->save()) {
            toastr()->success('Update blog successfully!');
        } else {
            toastr()->error('There was an error updating a blog!');
            return back();
        }

        return redirect()->route('categories.index');
    }


    public function destroy($id)
    {
        $blog = blog::find($id);

        if (!$blog) {
            toastr()->error('blog not found.');
            return redirect()->route('categories.index');
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
