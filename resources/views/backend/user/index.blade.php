@extends('backend.layout.layout')
@section('content')
    <div class="contain">
        <section class="sticky-top">
            <div class="title-table">
                <h4>JOBS</h4>
            </div>
            <div class="section-item-right mb-5">
                <form id="formSearch" class="border-0" method="GET" action="{{ route('admin.user.suggest') }}">
                    <div class="form-group ">
                        <select class="js-example-basic-single form-control" id="first_suggest" data-type="email"
                                data-placeholder="Email" name="state">
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="js-example-basic-single form-control" id="second_suggest" data-type="role"
                                data-placeholder="Role" name="state">
                        </select>
                    </div>
                    <div class="form-group" style="width: 100px">
                        <select class="js-example-basic-single form-control" id="select_active" data-type="active"
                                data-placeholder="Status" name="state">
                        </select>
                    </div>
                    <a href="{{route("admin.user.index")}}">
                        <button type="button" id="clearCategory" class="btn-add">CLEAR</button>
                    </a>
                </form>
            </div>
        </section>
        <div id="append_ajax">
            <div id="append_ajax">
                <div class="table-main">
                    <table class="table table-hover">
                        <colgroup>
                            <col width="200">
                            <col width="400">
                            <col>
                            <col width="300">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tbody>
                        <span id="get_limit" data-url="{{ route('admin.user.limit') }}"> </span>
                        <span id="change_active" data-url="{{ route('admin.user.update') }}"> </span>
                        @php
                            $shows = [ '5', '10', '15'];
                            $limit = request()->input('limit', 5);
                            $page = request()->input('page', 1);
                        @endphp
                        @foreach($data as $key => $value)
                            <tr>
                                <td> {{ ($page-1)*$limit+$key+1}}</td>
                                <td>
                                    {{ $value->email }}
                                </td>
                                <td>
                                    @if($value['role'] == 1)
                                        Candidate
                                    @elseif($value['role'] == 2)
                                        Employer
                                    @elseif($value['role'] == 3)
                                        Admin
                                    @endif
                                </td>
                                <td>
                                    <input class="toggle_switch ms-3 mt-3" data-type="user with email "
                                           data-id="{{$value['id']}}"
                                           data-name="{{$value['email']}}"
                                           {{$value['active']==1?'checked':''}}  type="checkbox">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-bottom">
                    <div class="paginate" id="pagination-links">
                        {{$data->withQueryString()->appends($_GET)->links('.backend.component.paginate')}}
                    </div>

                    <form action="" method="post">
                        @csrf
                        <div class="border-start">
                            <p>Show</p>
                            <select name="limit-category" id="show-limit">
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
</div>
@stop
