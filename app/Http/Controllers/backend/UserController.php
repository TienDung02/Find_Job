<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getTable($request);
        return view('backend.user.index', compact('data'));
    }

    public function getLimit (Request $request) {
        $data = $this->getTable($request);
        return view('backend.user.ajax.table', compact('data'));
    }

    public function getTable ($request) {
        $data = user::query();
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

    public function search($type, $keyword, $limit)
    {
        if ($type === 'email') {
            $query = user::where('email', 'like', "%$keyword%");
        }elseif($type === 'role'){
            $query = user::where('role', $keyword);
        }elseif($type === 'active'){
            $query = user::where('active', $keyword);
        }
        return $query->paginate($limit);
    }


//    public function edit($id_category)
//    {
//        $category_id = Category::findOrFail($id_category);
//        $type = 'edit';
//        $id = (int)$category_id->id_category;
//        $name = $category_id->name;
//        $parent_id = (int)$category_id->parent_id;
//        $categoryList = $this->show($type ,0,$parent_id, $space='&nbsp;');
////        return view('backend.category.admin_add_category', compact('categoryList', 'name', 'category_id'));
//    }

    public function suggest(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        $parent_id = $request->input('parent_id', null);

        $query = user::query();

        if ($type == 'email') {
            $query->where('email', 'like', "%" . $keyword . "%");
        }

        $data = $query
            ->select('users.id', 'users.email as data1', 'users.role as data2', 'users.active as data3')
            ->get();
        $data = $data->map(function ($item) {
            return [
                'id_data' => $item->data1,
                'data1' => $item->data1,
                'data2' => $item->data2,
                'data3' => $item->data3
            ];
        });
        return response()->json($data);
    }



    public function update(Request $request)
    {
        $data = $this->getTable($request);
        $id = $request->input('id');
        $user_id = user::find($id);
        if (!$user_id) {
            return redirect()->route('backend.user.index')->with('error', 'user not found.');
        }
        $user_id->active = $request->input('status_to');
        if ($user_id->save()) {
            $type_ = $request->input('type_');
            if ($type_ == 'view') {
                toastr()->success('Update user successfully!');
                return response()->json([
                    'redirect' => route('user.index', compact('data')),
                    'message' => 'Update user successfully!'
                ]);
            } else {
                toastr()->success('Update user successfully!');
                return redirect()->back();
            }
        } else {
            toastr()->error('There was an error updating a user!');
//            return back();
        }
    }

}
