@include('component.admin_head')
<body>

<div id="admin_wrapper">
    @include('component.admin_header')
    <main>
        @include('component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h3>Categories</h3>
                </div>
            </section>
            <div class="table-main">

                <table class="table table-hover">
                    <colgroup>
                        <col width="200">
                        <col width="400">
                        <col>
                        <col width="200">
                        <col width="200">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Email</th>
                        <th>Type User</th>
                        <th>Active</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $value)
                        <tr>
                            <td> {{$key + 1}} </td>
                            <td> {{$value['email']}} </td>
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
                                <input class="toggle_switch" {{$value['active']==1?'checked':''}} type="checkbox">
                            </td>
                            <td>
                                <a class="" href="">
                                    <button type="submit" style="margin-top: -1rem" class="btn btn-primary text-white">View</button>
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
                        <select name="limit-category" id="show-limit">
                            @php
                                $shows = [ '5', '10', '15'];
                                if ($limit_category = request()->input('limit-categories'))
                                {
                                    $limit_category = request()->input('limit-categories');
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
    </main>
</div>
@include('component.admin_script')
</body>
</html>
