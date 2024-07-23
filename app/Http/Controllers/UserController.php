<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Models\user;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
class UserController extends Controller
{

    private $getCandidate;
    private $search;


    public function index(Request $request)
    {
        $data = user::query();
        $limit = 5;
        $data = $data->paginate($limit);

        return view('admin.user.admin_user_page', compact('data'));
    }

    public function getLimit (Request $request) {
        $data = category::query();
        $data->with('parent');

        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit-category', 5);


        $categories = $this->search($type, $keyword, $limit);

        $data = $data->paginate($limit);
        if ($categories->isNotEmpty()) {
            $data = $categories;
        }

        return view('admin.category.ajax.category_table', compact('data'));
    }

    public function create()
    {
        $name = '';
        $category_id = '';
        $categoryList = $this->show();
        return view('admin.category.admin_add_category', compact('categoryList', 'name', 'category_id'));
    }

    public function search($type, $keyword, $limit)
    {
        if ($type === 'parent') {
            $this->search = Category::where('parent_id', $keyword)->paginate($limit);
        }else{
            $this->search = Category::where('id_category', $keyword)->paginate($limit);
        }

        return $this->search;
    }

    public function show($type = 'add', $id=0, $category_id=0, $space='&nbsp;')
    {
        $data = category::all();
        foreach ($data as $value) {
            if ($type == 'add'){
                if ($value['parent_id'] == $id){
                    $this->GetCategory .= "<option "  . " value='" . $value['id_category'] . "' >" . $space . "-&nbsp;" . $value['name'] . "</option>";
                    $this->show('add',$value['id_category'],0, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                }
            }
            else if ($type == 'edit'){
                if ($category_id == 0){
                    if ($value['parent_id'] == $id){
                        $this->GetCategory .= "<option "  . " value='" . $value['id_category'] . "' >" . $space . "-&nbsp;" . $value['name'] . "</option>";
                        $this->show($type = 'add', $value['id_category'],$category_id, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    }
                }else{
                    $selected = ' ';
                    if ($value['parent_id'] == $id) {
                        if ($value['id_category'] == $category_id) {
                            $selected = 'selected';
                        }
                        $this->GetCategory .= "<option "  . " value='" . $value['id_category'] . "' $selected>" . $space . "-&nbsp;" . $value['name'] . "</option>";
                        $this->show('add',$value['id_category'],0, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    }
                }
            }
        }

        return $this->GetCategory;
    }

    public function store(Request $request)
    {
        $data = category::query();
        $limit = $request->input('limit-category', 5);
        $data = $data->paginate($limit);
        $insert_category = new category();
        $insert_category->name = $request->input('name');
        $insert_category->parent_id = $request->input('parent_id');

        $categoryExists = Category::where('name', $insert_category->name)
            ->where('parent_id', $insert_category->parent_id)
            ->exists();

        if (!$categoryExists) {
            if ($insert_category->save()) {
                toastr()->success('Added category successfully!');
            } else {
                toastr()->error('There was an error adding a category!');
                return back();
            }
        } else {
            toastr()->error('This category already exists!');
            return back();
        }
        return view('admin.category.admin_category_page', compact('data'));
    }



    public function edit($id_category)
    {
        $category_id = Category::findOrFail($id_category);
        $type = 'edit';
        $id = (int)$category_id->id_category;
        $name = $category_id->name;
        $parent_id = (int)$category_id->parent_id;
        $categoryList = $this->show($type ,0,$parent_id, $space='&nbsp;');
        return view('admin.category.admin_add_category', compact('categoryList', 'name', 'category_id'));
    }



    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $parent_id = $request->input('parent_id', null);

        $query = Category::query();

        if ($type === 'parent') {
            $query->where('parent_id', 0);
            if ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            }
        } else if ($type === 'category') {
            if ($parent_id) {
                $query->where('parent_id', $parent_id);
            }
            if ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            }
        }

        $suggestions = $query->take(100)->get(['id_category', 'name']);

        return response()->json($suggestions);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'parent_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
        ]);
        $id_category = Category::find($id);
        if (!$id_category) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }
        $id_category->parent_id = $request->input('parent_id');
        $id_category->name = $request->input('name');
        if ($id_category->save()) {
            toastr()->success('Update category successfully!');
        } else {
            toastr()->error('There was an error updating a category!');
            return back();
        }

        return redirect()->route('categories.index');
    }


    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            toastr()->error('Category not found.');
            return redirect()->route('categories.index');
        }

        if ($category->delete()) {
            toastr()->success('Category deleted successfully!');
            return redirect()->back();
        } else {
            toastr()->error('There was an error deleting the category!');
            return redirect()->back();
        }
    }
}
