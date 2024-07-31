<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $data = Category::query();
        $data->with('parent');

        $search = '';
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);

        $data = $data->paginate($limit);
        if ($keyword != '')
        {
            $search = $this->search($type, $keyword,$limit);
            if ($search->isNotEmpty()) {
                $data = $search;
                $search = '.';
            }
        }

        return view('backend.category.index', compact('data', 'search'));
    }

    public function getLimit (Request $request) {
        $data = category::query();
        $data->with('parent');

        $search = '';
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);

        $data = $data->paginate($limit);
        if ($keyword != '')
        {
            $search = $this->search($type, $keyword,$limit);
            if ($search->isNotEmpty()) {
                $data = $search;
                $search = '.';
            }
        }
        return view('backend.category.ajax.table', compact('data', 'search'));
    }

    public function create()
    {
        $name = '';
        $category_id = '';
        $categoryList = $this->show();
        return view('backend.category.add', compact('categoryList', 'name', 'category_id'));
    }

    public function search($type, $keyword, $limit)
    {
        $query = category::query();
        if ($type === 'parent') {
            $query->where(function($query) use ($keyword) {
                $query->where('parent_id', $keyword)
                    ->orWhere('id', $keyword);
            });
            $results = $query->get();
            if ($results->isEmpty()) {
                $query = category::where('id', $keyword);
            }
        } else {
            $query = category::where('name', 'like', "%$keyword%");
        }
        return $query->paginate($limit);
    }

    public function show($type = 'add', $id=0, $category_id=0, $space='&nbsp;')
    {
        $GetCategory = '';
        $data = category::all();
        foreach ($data as $value) {
            if ($type == 'add'){
                if ($value['parent_id'] == $id){
                    $GetCategory .= "<option "  . " value='" . $value['id'] . "' >" . $space . "-&nbsp;" . $value['name'] . "</option>";
                    $this->show('add',$value['id'],0, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                }
            }
            else if ($type == 'edit'){
                if ($category_id == 0){
                    if ($value['parent_id'] == $id){
                        $GetCategory .= "<option "  . " value='" . $value['id'] . "' >" . $space . "-&nbsp;" . $value['name'] . "</option>";
                        $this->show($type = 'add', $value['id'],$category_id, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    }
                }else{
                    $selected = ' ';
                    if ($value['parent_id'] == $id) {
                        if ($value['id'] == $category_id) {
                            $selected = 'selected';
                        }
                        $GetCategory .= "<option "  . " value='" . $value['id'] . "' $selected>" . $space . "-&nbsp;" . $value['name'] . "</option>";
                        $this->show('add',$value['id'],0, $space. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    }
                }
            }
        }

        return $GetCategory;
    }

    public function store(Request $request)
    {
        $data = category::query();
        $limit = $request->input('limit', 5);
        $data = $data->paginate($limit);
        $insert_category = new category();
        $insert_category->name = $request->input('name');
        $insert_category->parent_id = $request->input('parent_id');
        $insert_category->create_at = Carbon::now();
        $insert_category->update_at = Carbon::now();

        $categoryExists = category::where('name', $insert_category->name)
            ->where('parent_id', $insert_category->parent_id)
            ->exists();
        $search = '';
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
        return view('backend.category.index', compact('data', 'search'));
    }



    public function edit($id_category)
    {
        $category_id = category::findOrFail($id_category);
        $type = 'edit';
        $id = (int)$category_id->id_category;
        $name = $category_id->name;
        $parent_id = (int)$category_id->parent_id;
        $categoryList = $this->show($type ,0,$parent_id, $space='&nbsp;');
        return view('backend.category.add', compact('categoryList', 'name', 'category_id'));
    }



    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $parent_id = $request->input('data_first_suggest', null);

        $query = category::query();
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

        $suggestions = $query->get(['id', 'name']);
        $suggestions = $suggestions->map(function ($item) {
            return [
                'id_data' => $item->id, // Đổi tên trường từ id_category thành id
                'data1' => $item->name,
                'data2' => $item->name
            ];
        });

        return response()->json($suggestions);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'parent_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
        ]);
        $id_category = category::find($id);
        if (!$id_category) {
            return redirect()->route('category.index')->with('error', 'Category not found.');
        }
        $id_category->parent_id = $request->input('parent_id');
        $id_category->name = $request->input('name');
        $id_category->update_at = Carbon::now();
        if ($id_category->save()) {
            toastr()->success('Update category successfully!');
        } else {
            toastr()->error('There was an error updating a category!');
            return back();
        }

        return redirect()->route('category.index');
    }


    public function destroy($id)
    {
        $category = category::find($id);

        if (!$category) {
            toastr()->error('Category not found.');
            return redirect()->route('category.index');
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
