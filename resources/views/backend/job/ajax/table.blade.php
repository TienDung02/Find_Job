<div id="append_ajax">
    <div class="table-main">
        <table class="table table-hover" id="table">
            <colgroup>
                <col width="200">
                <col width="300">
                <col >
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
            <span id="get_limit" data-url="{{ route('job.limit') }}"> </span>
            <span id="change_active" data-url="{{ route('job.update') }}"> </span>
            @php
                $shows = [ '5', '10', '15'];
                $limit = request()->input('limit', 5);
                $page = request()->input('page', 1);
            @endphp
            @foreach($data as $key => $value)
                <tr>
                    <td> {{ ($page-1)*$limit+$key+1}}</td>
                    <td>
                        {{ $value->company->company_name ?? 'No company name available' }}
                    </td>
                    <td> {{ $value['title'] }} </td>
                    <td><input class="toggle_switch ms-3 mt-3" data-type="job with title " data-id="{{$value['id']}}" data-name="{{$value['title']}}" {{$value['active']==1?'checked':''}}  type="checkbox"></td>
                    <td>
                        <a class="" href="{{ route('job.edit', $value['id']) }}">
                            <button type="submit" style="margin-top: -1rem" class="btn btn-primary text-white">View</button>
                        </a>
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
