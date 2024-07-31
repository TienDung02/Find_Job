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
            <span id="get_limit" data-url="{{ route('category.limit') }}"> </span>
            @foreach($data as $key => $value)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{optional($value->parent)->name}}</td>
                    <td>{{$value->name}}</td>
                    <td class="d-flex">
                        <a href="{{ route('category.edit', $value['id']) }}">
                            <button type="submit"  class="btn btn-secondary">Update</button>
                        </a>
                        <form id='delete-form-{{ $value['id'] }}' action="{{ route('category.destroy', $value['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a><button type="button" class="btn btn-danger btn-delete" data-id="{{ $value['id'] }}" >Delete</button></a>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-bottom {{$search ?'d-none': ''}}">
        <div class="paginate">
            {{ $data->withQueryString()->appends($_GET)->links('.backend.component.admin') }}
        </div>
        <form action="" method="post">
            @csrf
            <div class="border-start">
                <p>Show</p>
                <select name="limit-category" id="show-limit">
                    @php
                        $shows = [ '5', '10', '15'];
                        if ($limit_category = request()->input('limit-category'))
                        {
                            $limit_category = request()->input('limit-category');
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
