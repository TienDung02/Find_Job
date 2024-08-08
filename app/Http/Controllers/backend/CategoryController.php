<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $data = $this->getTable($request);
        return view('backend.category.index', compact('data'));
    }

    public function getLimit (Request $request) {
        $data = $this->getTable($request);
        return view('backend.category.ajax.table', compact('data'));
    }

    public function getTable ($request) {
        $data = category::query();
        $data->with('parent');
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $limit = $request->input('limit', 5);
        $data = $data->paginate($limit);
        if ($keyword != '')
        {
            $search = $this->search($type, $keyword,$limit);
            if ($search->isNotEmpty()) {
                $data = $search;
            }
        }
        return $data;
    }

    public function create()
    {
        $name = '';
        $id_category = '';
        $categoryList = category::query()->where('level', '<', 4)->get();
        return view('backend.category.add', compact('categoryList', 'name', 'id_category'));
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
        } elseif ($type === 'level') {
            $query = category::where('level', $keyword);
        }else {
            $query = category::where('name', 'like', "%$keyword%");
        }
        return $query->paginate($limit);
    }

    public function store(Request $request)
    {

        $parentId = $request->input('parent_id');
        $query = category::query()->where('id', $parentId)->get();
        $level = 1;
        foreach ($query as $p){
            $parentId2 = $p['parent_id'];
            if ($parentId2 == 0){
                $level = 2;
            }elseif ($parentId2 != 0){
                $query2 = category::query()->where('id', $parentId2)->get();
                foreach ($query2 as $p2)
                {
                    $parentId3 = $p2['parent_id'];
                    if ($parentId3 != 0){
                        $level = 4;
                    }else{
                        $level = 3;
                    }
                }
            }
        }


        $data = $this->getTable($request);
        $insert_category = new category();
        $insert_category->name = $request->input('name');
        $insert_category->parent_id = $parentId;
        $insert_category->level = $level;

        $categoryExists = category::where('name', $insert_category->name)
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
        return view('backend.category.index', compact('data'));
    }

    public function edit($id_category)
    {
        $category_id = category::findOrFail($id_category);
        $name = $category_id->name;
        $parent_id = (int)$category_id->parent_id;
        $categoryList = category::query()->get();
        return view('backend.category.add', compact('categoryList', 'name', 'id_category', 'parent_id'));
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
                $query->where('name', 'like', "%" . $keyword . "%");
            }
        } else if ($type === 'category') {
            if ($parent_id) {
                $query->where('parent_id', $parent_id);
            }
            if ($keyword) {
                $query->where('name', 'like', "%" . $keyword . "%");
            }
        }

        $suggestions = $query->select('categories.id', 'categories.name as data1', 'categories.level as data3')->get();
        $suggestions = $suggestions->map(function ($item) {
            return [
                'id_data' => $item->id,
                'data1' => $item->data1,
                'data2' => $item->data1,
                'data3' => $item->data3
            ];
        });


        return response()->json($suggestions);
    }



    public function update(Request $request, $id)
    {

        $parentId = $request->input('parent_id');
        $query = category::query()->where('id', $parentId)->get();
        foreach ($query as $p){
            $parentId2 = $p['parent_id'];
            if ($parentId2 == 0){
                $level = 2;
            }elseif ($parentId2 != 0){
                $query2 = category::query()->where('id', $parentId2)->get();
                foreach ($query2 as $p2)
                {
                    $parentId3 = $p2['parent_id'];
                    if ($parentId3 != 0){
                        $level = 4;
                    }else{
                        $level = 3;
                    }
                }
            }
        }

        $id_category = category::find($id);
        if (!$id_category) {
            return redirect()->route('category.index')->with('error', 'Category not found.');
        }
        $id_category->parent_id = $parentId;
        $id_category->level = $level;
        $id_category->name = $request->input('name');
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
