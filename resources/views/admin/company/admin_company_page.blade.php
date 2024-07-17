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
                        <th>Employer</th>
                        <th>Company Name</th>
                        <th>Active</th>
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
                            <input class="toggle_switch"  type="checkbox">
                        </td>
                        <td>
                            <a
                                href=""><i
                                    class="bi bi-pencil-square"></i></a>
                            <a href="<?php ?>"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                    }
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
            title: 'Update Success'
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
            title: 'System Error'
        })
    });
</script>

</body>
</html>
