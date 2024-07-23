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
        return view('admin.blog.admin_blog_page', compact('data'));
    }

//    public function getLimit (Request $request) {
//        $data = blog::query();
//        $data->with('parent');
//
//        $keyword = $request->input('keyword');
//        $type = $request->input('type');
//        $limit = $request->input('limit-blog', 5);
//
//
//        $categories = $this->search($type, $keyword, $limit);
//
//        $data = $data->paginate($limit);
//        if ($categories->isNotEmpty()) {
//            $data = $categories;
//        }
//
//        return view('admin.blog.ajax.blog_table', compact('data'));
//    }

    public function create()
    {
        $name = '';
        $blog_id = '';
        $blogList = $this->show();
        return view('admin.blog.admin_add_blog', compact('blogList', 'name', 'blog_id'));
    }

//    public function search($type, $keyword, $limit)
//    {
//        if ($type === 'parent') {
//            $this->search = blog::where('parent_id', $keyword)->paginate($limit);
//        }else{
//            $this->search = blog::where('id_blog', $keyword)->paginate($limit);
//        }
//
//        return $this->search;
//    }

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
        return view('admin.blog.admin_add_blog', compact('blog', 'id_blog'));
    }



    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $parent_id = $request->input('parent_id', null);

        $query = blog::query();

        if ($type === 'parent') {
            $query->where('parent_id', 0);
            if ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            }
        } else if ($type === 'blog') {
            if ($parent_id) {
                $query->where('parent_id', $parent_id);
            }
            if ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            }
        }

        $suggestions = $query->take(100)->get(['id_blog', 'name']);

        return response()->json($suggestions);
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
