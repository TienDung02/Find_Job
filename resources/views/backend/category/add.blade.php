@include('backend.component.admin_head')
<body>
<div id="admin_wrapper">
    @include('backend.component.admin_header')
    <main>
        @include('backend.component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h3>CATEGORY /
                        @if($category_id != '')
                            EDIT
                        @else
                            ADD
                        @endif
                    </h3>
                </div>
            </section>

            <div class="parent-form-admin">
                <form
                    action="{{ $category_id != '' ? route('category.update', $category_id) : route('category.store') }}"
                    method="POST" class="form-main">
                    @csrf
                    @if($category_id != '')
                        @method('PUT')
                    @endif
                    <div class="form_add_company  flex-wrap">
                        <div class="about-contact-person m-auto" style=" width: 1000px;">
                            <h4>

                            </h4>
                            <div class="form-admin-insert-data">
                                <label for="#">Parent category</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="parent_id">
                                    <option value='0'>Root category</option>
                                    {!! $categoryList !!}
                                </select>
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Category name</label>
                                <input type="text" name="name" value="{{ $category_id != '' ? $name : '' }}"
                                       placeholder="Name">
                            </div>
                            <div class="form-group d-flex m-auto" style="width:23rem;">
                                <input type="submit" style="width:10rem;" value="SAVE"
                                       class="btn me-5 mt-3 rounded-pill fw-bold fs-6">
                                <a href="{{ route('category.index') }}">
                                    <button type="button" style="width:10rem;padding: 0.75rem;"
                                            class="btn btn-secondary mt-3 rounded-pill fw-bold fs-6">
                                        CANCEL
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>
</main>
</div>
@include('backend.component.admin_script')

</body>

</html>
