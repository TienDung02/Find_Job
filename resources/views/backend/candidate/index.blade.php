@extends('backend.layout.layout')
@section('content')
<div class="contain">
    <section>
        <div class="title-table">
            <h4>CANDIDATES</h4>
        </div>
        <div class="section-item-right ">
            <form id="formSearch" class="border-0" method="GET" action="{{ route('candidate.suggest') }}">
                <div class="form-group ">
                    <select class="js-example-basic-single form-control" id="first_suggest" data-type="email"
                            data-placeholder="Email" name="state">
                    </select>
                </div>
                <div class="form-group">
                    <select class="js-example-basic-single form-control" id="second_suggest" data-type="name"
                            data-placeholder="Name" name="state">
                    </select>
                </div>
                <div class="form-group" style="width: 100px">
                    <select class="js-example-basic-single form-control" id="select_active" data-type="active"
                            data-placeholder="Status" name="state">
                    </select>
                </div>
                <a href="{{route("candidate.index")}}">
                    <button type="button" id="clearCategory" class="btn-add">CLEAR</button>
                </a>
            </form>
        </div>
    </section>
    <div id="append_ajax">
        <div class="table-main">

            <table class="table table-hover">
                <colgroup>
                    <col width="200">
                    <col width="300">
                    <col>
                    <col width="200">
                </colgroup>
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <span id="get_limit" data-url="{{ route('candidate.limit') }}"> </span>
                <span id="change_active" data-url="{{ route('candidate.update') }}"> </span>
                @php
                    $shows = [ '5', '10', '15'];
                    $limit = request()->input('limit', 5);
                    $page = request()->input('page', 1);
                @endphp
                @foreach($data as $key => $value)
                    <tr>
                        <td> {{ ($page-1)*$limit+$key+1}}</td>
                        <td>{{$value['last_name'] . ' ' . $value['first_name'] }} </td>
                        <td>{{ $value->user->email ?? 'No email available'}}</td>
                        <td><input class="toggle_switch ms-3 mt-3" data-type="candidate with name "
                                   data-id="{{$value['id']}}"
                                   data-name="{{$value['last_name'] . ' ' . $value['first_name']}}"
                                   {{$value['active']==1?'checked':''}}  type="checkbox"></td>
                        <td class="d-flex">
                            <a href="{{ route('candidate.edit', $value['id']) }}">
                                <button type="submit" class="btn btn-primary">View</button>
                            </a>
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

                        @foreach($shows as $show)

                            <option
                                {{$show==$limit?'selected':''}} value="{{$show}}">{{$show}}</option>
                        @endforeach
                    </select>
                    <p>item</p>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
