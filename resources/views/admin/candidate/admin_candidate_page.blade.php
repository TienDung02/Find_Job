@include('component.admin_head')
<body>

<div id="admin_wrapper">
    @include('component.admin_header')

    <main>
        @include('component.admin_menu_left')
        <div class="contain">
            <section>
                <div class="title-table">
                    <h3>Candidate</h3>
                </div>
                <div class="section-item-right">
                    <form onsubmit="event.preventDefault();" role="search" class="form-search-admin">
                        <label for="search" class="label-search">Search for stuff</label>
                        <input id="search" type="search" class="input-search" placeholder="Search..." autofocus
                               required />
                        <button class="button-search" type="submit">Go</button>
                    </form>
                </div>
            </section>
            <div class="table-main">

                <table class="table table-hover">
                    <colgroup>
                        <col width="200">
                        <col width="400">
                        <col>
                        <col>
                        <col width="200">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Full Name</th>
                        <th>Email</th>
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
                            <input class="toggle_switch"  " type="checkbox">
                        </td>
                        <td>
                            <a
                                href="<?php  ?>"><i
                                    class="bi bi-pencil-square"></i></a>
                            <a href="<?php  ?>"><i class="delete bi bi-x-circle"></i></a>
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
            title: 'Thêm thành công'
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
            title: 'Cập nhật thành công'
        })
    });
</script>

<script>
    // $(".btn_hidden_menu").click(function(){
    //     console.log('aadasd');
    //     $('.menu_01').addClass('d-none').removeClass('d-block');
    //     $('.menu_02').addClass('d-block').removeClass('d-none');
    // });
    // $(".btn_Show_menu").click(function(){
    //     console.log('aadasd');
    //     $('.menu_02').addClass('d-none').removeClass('d-block');
    //     $('.menu_01').addClass('d-block').removeClass('d-none');
    // });
</script>
</body>

</html>
