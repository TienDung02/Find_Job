@extends('backend.layout.layout')
@section('content')
<div class="contain">
    <section class="sticky-top">
        <div class="title-table">
            <h4>JOBS</h4>
        </div>
        <div class="section-item-right mb-5">
            <form id="formSearch" class="border-0" method="GET" action="{{ route('job.suggest') }}">
                <div class="form-group ">
                    <select class="js-example-basic-single form-control" id="first_suggest" data-type="company"
                            data-placeholder="Select company name" name="state">
                    </select>
                </div>
                <div class="form-group">
                    <select class="js-example-basic-single form-control" id="second_suggest" data-type="title"
                            data-placeholder="title" name="state">
                    </select>
                </div>
                <div class="form-group" style="width: 100px">
                    <select class="js-example-basic-single form-control" id="select_active" data-type="active"
                            data-placeholder="Status" name="state">
                    </select>
                </div>
                <a href="{{route("job.index")}}">
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
                    <th>Company</th>
                    <th>Title</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <span id="get_limit" data-url="{{ route('job.limit') }}"> </span>
                <span id="change_active" data-url="{{ route('job.update') }}"> </span>
                @foreach($data as $key => $value)
                    <tr>
                        <td> {{$key + 1}}</td>
                        <td>
                            {{ $value->company->company_name ?? 'No company name available' }}
                        </td>
                        <td> {{ $value['title'] }} </td>
                        <td><input class="toggle_switch ms-3 mt-3 status_active" data-type="job with title "
                                   data-id="{{$value['job_id']}}" data-name="{{$value['title']}}"
                                   {{$value['active']==1?'checked':''}}  type="checkbox"></td>
                        <td>
                            <a class="" href="{{ route('job.edit', $value['job_id']) }}">
                                <button type="submit" style="margin-top: -1rem"
                                        class="btn btn-primary text-white">View
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-bottom {{$search ?'d-none': ''}}">
            <div class="paginate" id="pagination-links">
                {{ $search ?'':$data->withQueryString()->appends($_GET)->links('component.backend')}}
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
@stop
