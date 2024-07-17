@include('component.admin_head')
<body>

<div id="admin_wrapper">
    @include('component.admin_header')
    <main>
        @include('component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h3>Blog</h3>
                </div>
                <div class="section-item-right">
                    <form onsubmit="event.preventDefault();" role="search" class="form-search-admin">
                        <label for="search" class="label-search">Search for stuff</label>
                        <input id="search" type="search" class="input-search" placeholder="Search..." autofocus
                               required/>
                        <button class="button-search" type="submit">Go</button>
                    </form>
                    <button
                        onClick="document.location.href='/admin/blog/admin_add_blog.php?id=0'"
                        class="btn-add">ADD NEW
                    </button>
                </div>
            </section>
            <div class="table-main">

                <table class="table table-hover">
                    <colgroup>
                        <col width="200">
                        <col width="400">
                        <col>
                        <col width="200">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <a
                                href=""><i
                                    class="bi bi-pencil-square"></i></a>
                            <a href=""><i class="delete bi bi-x-circle"></i></a>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>
            <div class="card-bottom">
                <a href="?page=1" class="">First</a>

                <a href="">Last</a>
                <form action="#" method="post">
                    <div>
                        <p>Show</p>
                        <select name="limit-category" id="show-limit">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                        <p>item</p>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@include('component.admin_script')
<script>
    $(document).ready(function executeExample() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: 'Add success'
        })
    });
</script>

<script>
    $(document).ready(function executeExample() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: 'Update success'
        })
    });
</script>

<script>
    $(document).ready(function executeExample() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: 'Delete success'
        })
    });
</script>

<script>
    $(document).ready(function executeExample() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'error',
            title: 'System error'
        })
    });
</script>

<script>
    $("#show-limit").on("change", function () {
        var selectData = $(this).val();
        console.log(selectData);
        $.ajax({
            url: "admin-category-page.php",
            method: 'POST',
            data: {val: $(this).val()},
            success: function (data) {
                $(".asdvdv").val(data);

            }
        });
    });
</script>
</body>

</html>
