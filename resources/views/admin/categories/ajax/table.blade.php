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
            <span id="get_limit" data-url="{{ route('categories.limit') }}"> </span>
            @foreach($data as $key => $value)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{optional($value->parent)->name}}</td>
                    <td>{{$value->name}}</td>
                    <td class="d-flex">
                        <a href="{{ route('categories.edit', $value['id_category']) }}">
                            <button type="submit"  class="btn btn-secondary">Update</button>
                        </a>
                        <form id='delete-form-{{ $value['id_category'] }}' action="{{ route('categories.destroy', $value['id_category']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a><button type="button" class="btn btn-danger btn-delete" data-id="{{ $value['id_category'] }}" >Delete</button></a>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-bottom {{$search ?'d-none': ''}}">
        <div class="paginate">
            {{ $data->withQueryString()->appends($_GET)->links('component.admin') }}
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
                        }else{
                            $limit_category = request()->input('limit');
                        }
                        if ($limit_category)
                        {
                            echo $limit_category;
                        }else{
                            echo 'none';
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
