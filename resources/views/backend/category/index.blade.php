@extends('.backend.layout.layout')
@section('content')
<div class="contain">
    <section class="sticky-top">
        <div class="title-table">
            <h4>LIST CATEGORIES</h4>
        </div>
        <div class="section-item-right">
            <form id="formSearch" method="GET" action="{{ route('category.suggest') }}">
                <div class="form-group ">
                    <select class="js-example-basic-single form-control" id="first_suggest" data-type="parent"
                            data-placeholder="Select parent name" name="state">
                    </select>
                </div>
                <div class="form-group">
                    <select class="js-example-basic-single form-control" id="second_suggest"
                            data-type="category" data-placeholder="Name category" name="state">
                    </select>
                </div>
                <a href="{{route("category.index")}}">
                    <button type="button" id="clearCategory" class="btn-add">CLEAR</button>
                </a>
            </form>
            <a style="color: #ffffff" href="{{route("category.create")}}">
                <button class="btn-add">ADD NEW</button>
            </a>
        </div>
    </section>
    <div id="append_ajax">
        <div class="table-main">
            <table class="table table-hover modal-scrollbar-measure" id="table">
                <colgroup>
                    <col width="200">
                    <col width="300">
                    <col>
                    <col width="200">
                </colgroup>
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Parent</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <span id="get_limit" data-url="{{ route('category.limit') }}"> </span>
                @foreach($data as $key => $value)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{optional($value->parent)->name}}</td>
                        <td>{{$value->name}}</td>
                        <td class="d-flex">
                            <a href="{{ route('category.edit', $value['id']) }}">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </a>
                            <form id='delete-form-{{ $value['id'] }}'
                                  action="{{ route('category.destroy', $value['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a>
                                    <button type="button" class="btn btn-danger btn-delete"
                                            data-id="{{ $value['id'] }}">Delete
                                    </button>
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-bottom {{$search ?'d-none': ''}}">
            <div class="paginate" id="pagination-links">
                {{--                            {{ $data->withQueryString()->appends($_GET)->links() }}--}}
                {{ $data->withQueryString()->appends($_GET)->links('.backend.component.admin') }}
            </div>

            <form action="" method="post">
                @csrf
                <div class="border-start">
                    <p>Show</p>
                    <select name="limit" id="show-limit">
                        @php
                            $shows = [ '5', '10', '15'];
                            if ($limit_category = request()->input('limit'))
                            {
                                $limit_category = request()->input('limit');
                            }
                        @endphp
                        @foreach($shows as $show)

                            <option
                                {{$show==$limit_category?'selected':''}} value="{{$show}}">{{$show}}</option>
                        @endforeach
                    </select>
                    <p>item</p>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="form-group">
                            <label for="parentCategory">Parent Category</label>
                            <select class="form-control" id="parentCategory" name="parentCategory">
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
