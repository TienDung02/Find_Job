@include('backend.component.admin_head')
<body>
<div id="admin_wrapper">
    @include('backend.component.admin_header')

    <main>
        @include('backend.component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h3>Categories</h3>
                </div>
                <div class="section-item-right mb-5">
                    <form id="formSearch" class="border-0" method="GET" action="{{ route('company.suggest') }}">
                        <div class="form-group ">
                            <select class="js-example-basic-single form-control" id="first_suggest" data-type="employer"
                                    data-placeholder="Employer" name="state">
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="js-example-basic-single form-control" id="second_suggest" data-type="company"
                                    data-placeholder="Company" name="state">
                            </select>
                        </div>
                        <div class="form-group" style="width: 100px">
                            <select class="js-example-basic-single form-control" id="select_active" data-type="active"
                                    data-placeholder="Status" name="state">
                            </select>
                        </div>
                        <a href="{{route("company.index")}}">
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
                            <th>Employer</th>
                            <th>Company Name</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <span id="get_limit" data-url="{{ route('company.limit') }}"> </span>
                        <span id="change_active" data-url="{{ route('company.update') }}"> </span>

                        @foreach($data as $key => $value)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$value->employer->last_name . " " . $value->employer->first_name}}</td>
                                <td>{{$value['company_name']}}</td>
                                <td><input class="toggle_switch ms-3 mt-3" data-type="company with name "
                                           data-id="{{$value['id_company']}}" data-name="{{$value['company_name']}}"
                                           {{$value['active']==1?'checked':''}}  type="checkbox"></td>
                                <td>
                                    <a class="" href="{{ route('company.edit', $value['id_company']) }}">
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

                    <form action="" class="" method="post">
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
    </main>
</div>
@include('backend.component.admin_script')

</body>
</html>
