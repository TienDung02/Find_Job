@include('component.admin_head')
<body>

<div id="admin_wrapper">
    @include('component.admin_header')

    <main>
        @include('component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h4>CANDIDATES
{{--                        @if (isset($aa))--}}
{{--                            @php print_r($aa); @endphp--}}
{{--                        @endif--}}
                    </h4>
                </div>
                <div class="section-item-right ">
                    <form id="formSearch" class="border-0" method="GET" action="{{ route('candidate.suggest') }}">
                        <div class="form-group ">
                            <select class="js-example-basic-single form-control"  id="first_suggest" data-type="email" data-placeholder="Email"  name="state">
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="js-example-basic-single form-control" id="second_suggest" data-type="name" data-placeholder="Name" name="state">
                            </select>
                        </div>
                        <a href="{{route("candidate.index")}}"><button type="button" id="clearCategory" class="btn-add">CLEAR</button></a>
                    </form>
                </div>
            </section>
            <div id="append_ajax">
            <div class="table-main">

                <table class="table table-hover">
                    <colgroup>
                        <col width="200">
                        <col width="400">
                        <col>
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
                    @foreach($data as $key => $value)

                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$value['last_name'] . ' ' . $value['first_name']}}</td>
                        <td>{{$value['email']}}</td>
                        <td><input class="toggle_switch ms-3 mt-3" {{$value['active']==1?'checked':''}}  type="checkbox"></td>
                        <td class="d-flex">
                            <a href="{{ route('candidate.edit', $value['id_candidate']) }}">
                                <button type="submit"  class="btn btn-primary">View</button>
                            </a>
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
                        <select name="limit" id="show-limit">
                            @php
                                $shows = [ '5', '10', '15'];
                                if ($limit_category = request()->input('limit'))
                                {
                                    $limit_category = request()->input('limit');
                                }
                            @endphp
                            @foreach($shows as $show)

                                <option  {{$show==$limit_category?'selected':''}} value="{{$show}}">{{$show}}</option>
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
@include('component.admin_script')
</body>

</html>
