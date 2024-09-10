@extends('.backend.layout.layout')
@section('content')
<div class="contain">
    <section class="sticky-top">
        <div class="title-table">
            <h4>LIST CATEGORIES</h4>
        </div>
        <div class="section-item-right">
            <form id="formSearch" method="GET" action="{{ route('admin.industry.suggest') }}">
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
                <div class="form-group" style="width: 100px">
                    <select class="js-example-basic-single form-control" id="select_active" data-type="level"
                            data-placeholder="Level" name="state">
                    </select>
                </div>
                <a href="{{route("admin.industry.index")}}">
                    <button type="button" id="clearCategory" class="btn-add">CLEAR</button>
                </a>
            </form>
            <a style="color: #ffffff" href="{{route("admin.industry.create")}}">
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
                <span id="get_limit" data-url="{{ route('admin.industry.limit') }}"> </span>
                @php
                    $shows = [ '5', '10', '15'];
                    $limit = request()->input('limit', 5);
                    $page = request()->input('page', 1);
                @endphp
                @foreach($data as $key => $value)
                    <tr>
                        <td> {{ ($page-1)*$limit+$key+1}}</td>
                        <td>{{optional($value->parent)->name}}</td>
                        <td>{{$value->name}}</td>
                        <td class="d-flex">
                            <a href="{{ route('admin.industry.edit', $value['id']) }}">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </a>
                            <form id='delete-form-{{ $value['id'] }}'
                                  action="{{ route('admin.industry.destroy', $value['id']) }}" method="POST">
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
        <div class="card-bottom">
            <div class="paginate" id="pagination-links">
                {{ $data->withQueryString()->appends($_GET)->links('.backend.component.paginate') }}
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
</div>
@stop
