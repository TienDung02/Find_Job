@extends('backend.layout.layout')

@section('content')
<div class="contain">
    <section>
        <div class="title-table">
            <h4>BLOG</h4>
        </div>
        <div class="section-item-right">
            <form id="formSearch" method="GET" action="{{ route('blog.suggest') }}">
                <div class="form-group ">
                    <select class="js-example-basic-single form-control" id="first_suggest" data-type="author"
                            data-placeholder="Select author name" name="state">
                    </select>
                </div>
                <div class="form-group">
                    <select class="js-example-basic-single form-control" id="second_suggest" data-type="title"
                            data-placeholder="Title" name="state">
                    </select>
                </div>
                <a href="{{route("blog.index")}}">
                    <button type="button" id="clearCategory" class="btn-add">CLEAR</button>
                </a>
            </form>
            <a style="color: #ffffff" href="{{route("blog.create")}}">
                <button class="btn-add">ADD NEW</button>
            </a>
        </div>
    </section>
    <div class="table-main">

        <table class="table table-hover">
            <colgroup>
                <col width="200">
                <col width="400">
                <col>
                <col width="200">
            </colgroup>
            <thead>
            <tr>
                <th>STT</th>
                <th>Author</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            {{--                    @php print_r($data); @endphp--}}
            @foreach($data as $key => $value)
                <tr>
                    <td> {{$key+1}}</td>
                    <td>{{$value['author']}} </td>
                    <td>{{$value['title']}}</td>
                    <td class="d-flex">
                        <a href="{{ route('blog.edit', $value['id_blog']) }}">
                            <button type="submit" class="btn btn-secondary">Update</button>
                        </a>
                        <form id='delete-form-{{ $value['id_blog'] }}'
                              action="{{ route('blog.destroy', $value['id_blog']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a>
                                <button type="button" class="btn btn-danger btn-delete"
                                        data-id="{{ $value['id_blog'] }}">Delete
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
            {{ $data->withQueryString()->appends($_GET)->links() }}
        </div>

        <form action="" method="post">
            @csrf
            <div class="border-start">
                <p>Show</p>
                <select name="limit-category" id="show-limit">
                    @php
                        $shows = [ '5', '10', '15'];
                        if ($limit_category = request()->input('limit-category'))
                        {
                            $limit_category = request()->input('limit-category');
                        }
                    @endphp
                    @foreach($shows as $show)

                        <option {{$show==$limit_category?'selected':''}} value="{{$show}}">{{$show}}</option>
                    @endforeach
                </select>
                <p>item</p>
            </div>
        </form>
    </div>
</div>
@stop
