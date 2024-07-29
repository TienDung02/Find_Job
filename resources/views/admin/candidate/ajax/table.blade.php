<div id="append_ajax">
    <div class="table-main">
        <table class="table table-hover">
            <colgroup>
                <col width="200">
                <col width="300">
                <col >
                <col width="200">
            </colgroup>
            <thead>
            <tr>
                <th>STT
{{--                @php print_r($search); @endphp--}}
                </th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <span id="get_limit" data-url="{{ route('candidate.limit') }}"> </span>
            @foreach($data as $key => $value)
                <span id="change_active" data-url="{{ route('candidate.update') }}"> </span>
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$value['last_name'] . ' ' . $value['first_name']}}</td>
                    <td>{{ $value->users->email ?? 'No email available'}}</td>
                    <td><input class="toggle_switch ms-3 mt-3" data-id="{{$value['id_candidate']}}" data-name="{{$value['last_name'] . ' ' . $value['first_name']}}" {{$value['active']==1?'checked':''}}  type="checkbox"></td>
                    <td class="d-flex">
                        <a href="{{ route('candidate.edit', $value['id_candidate']) }}  ">
                            <button type="submit"  class="btn btn-primary">View</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div class="card-bottom">
        <div class="paginate">
            {{ $search ? '' : $data->withQueryString()->appends($_GET)->links('component.admin')}}
        </div>
        <form action="" method="post">
            @csrf
            <div class="border-start">
                <p>Show</p>
                <select name="limit-category" id="show-limit">
                    @php
                        $shows = [ '5', '10', '15'];
                        if ($limit_category = request()->input('limit')){
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
