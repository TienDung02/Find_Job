@extends('backend.layout.layout')
@section('content')
<div class="contain">
    <section>
        <div class="title-table">
            <h3>CATEGORY /
                @if($id_category != '')
                    EDIT
                @else
                    ADD
                @endif
            </h3>
        </div>
    </section>

    <div class="parent-form-admin">
        <form
            action="{{ $id_category != '' ? route('industry.update', $id_category) : route('industry.store') }}"
            method="POST" class="form-main">
            @csrf
            @if($id_category != '')
                @method('PUT')
            @endif
            <div class="form_add_company  flex-wrap">
                <div class="about-contact-person m-auto" style=" width: 1000px;">
                    <h4>
{{--                        @php print_r($categoryList); @endphp--}}
                    </h4>
                    <span id="show_category" data-url="{{ route('industry.show') }}"> </span>
                    <div class="form-admin-insert-data form-admin-category" id="">
                        <label for="#">Parent category</label>
                        <select class="form-control select_category" id="exampleFormControlSelect2" name="parent_id">
                            <option style="font-weight: 500" value='0'>Root category</option>
                            @foreach($categoryList as $category)
                                @if($category->level == 1)
                                    <option style="font-weight: 500" value="{{$category->id}}"  {{isset($parent_id) && $parent_id == $category->id ? 'selected' : ''}}>{{$category->name}} </option>
                                @endif
                                @foreach($categoryList as $category2)
                                    @if($category2->parent_id == $category->id)
                                        <option value="{{$category2->id}}"  {{isset($parent_id) && $parent_id == $category2->id ? 'selected' : ''}}>&nbsp;&nbsp;&nbsp;&nbsp;{{$category2->name}} </option>
                                        @foreach($categoryList as $category3)
                                            @if($category3->parent_id == $category2->id)
                                                <option value="{{$category3->id}}"  {{isset($parent_id) && $parent_id == $category3->id ? 'selected' : ''}}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$category3->name}} </option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-admin-insert-data">
                        <label for="#">Category name</label>
                        <input type="text" name="name" value="{{ $id_category != '' ? $name : '' }}"
                               placeholder="Name">
                    </div>
                    <div class="form-group d-flex m-auto" style="width:23rem;">
                        <input  type="submit" style="width:10rem;" value="SAVE"
                               class="btn me-5 mt-3 text-white fw-bold fs-6">
                        <a href="{{ route('industry.index') }}">
                            <button type="button" style="width:10rem;padding: 0.75rem;"
                                    class="btn btn-secondary mt-3  fw-bold fs-6">
                                CANCEL
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
@stop
