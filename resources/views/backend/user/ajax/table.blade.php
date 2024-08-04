<div id="append_ajax">
    <div class="table-main">
        <table class="table table-hover" id="table">
            <colgroup>
                <col width="200">
                <col width="400">
                <col >
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
            <span id="get_limit" data-url="{{ route('user.limit') }}"> </span>
            <span id="change_active" data-url="{{ route('user.update') }}"> </span>
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
                        <input class="toggle_switch ms-3 mt-3 status_active" data-type="user with email "
                               data-id="{{$value['id']}}" data-name="{{$value['email']}}"
                               {{$value['active']==1?'checked':''}}  type="checkbox">
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-bottom">
        <div class="paginate">
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

                        <option  {{$show==$limit_category?'selected':''}} value="{{$show}}">{{$show}}</option>
                    @endforeach
                </select>
                <p>item</p>
            </div>
        </form>
    </div>
</div>
