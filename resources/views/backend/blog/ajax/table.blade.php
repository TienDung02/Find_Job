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
            <span id="get_limit" data-url="{{ route('blog.limit') }}"> </span>
            <span id="change_active" data-url="{{ route('blog.update') }}"> </span>
                @php
                    $shows = [ '5', '10', '15'];
                    $limit = request()->input('limit', 5);
                    $page = request()->input('page', 1);
                @endphp
                @foreach($data as $key => $value)
                <tr>
                    <td> {{ ($page-1)*$limit+$key+1}}</td>
                    <td>{{$value['author']}} </td>
                    <td>{{$value['title']}}</td>
                    <td class="d-flex">
                        <a href="{{ route('blog.edit', $value['id']) }}">
                            <button type="submit"  class="btn btn-secondary">Update</button>
                        </a>
                        <form id='delete-form-{{ $value['id'] }}' action="{{ route('blog.destroy', $value['id']) }}" method="POST">
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
    <div class="card-bottom">
        <div class="paginate">
            {{$data->withQueryString()->appends($_GET)->links('.backend.component.paginate')}}
        </div>
        <form action="" method="post">
            @csrf
            <div class="border-start">
                <p>Show</p>
                <select name="limit-category" id="show-limit">

                    @foreach($shows as $show)

                        <option  {{$show==$limit?'selected':''}} value="{{$show}}">{{$show}}</option>
                    @endforeach
                </select>
                <p>item</p>
            </div>
        </form>
    </div>
</div>
