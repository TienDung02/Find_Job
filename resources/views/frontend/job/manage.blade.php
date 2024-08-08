
@extends('frontend.layout.layout')
@section('content')

    <div class="clearfix margin-top-90"></div>

    <!-- Content
    ================================================== -->
    <div class="d-flex">
        @include('.frontend.component.menu_left_employer')
        <div class="" style="margin: auto; width: calc(100% - 260px);">
            <!-- Titlebar
            ================================================== -->
            <div id="titlebar" class="single">
                <div class="container">

                    <div class="sixteen columns">
                        <h2>Manage Applications</h2>
                        <nav id="breadcrumbs">
                            <ul>
                                <li>You are here:</li>
                                <li><a href="#">Home</a></li>
                                <li>Job Dashboard</li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="container">

                <!-- Table -->
                <div class="sixteen columns">

                    <p class="margin-bottom-25"></p>

                    <table class="manage-table responsive-table">

                        <tr>
                            <th><i class="fa fa-file-text"></i> Title</th>
                            <th><i class="fa fa-check-square-o"></i> Filled?</th>
                            <th><i class="fa fa-calendar"></i> Date Posted</th>
                            <th><i class="fa fa-calendar"></i> Date Expires</th>
                            <th><i class="fa fa-user"></i> Applications</th>
                            <th></th>
                        </tr>

                        <!-- Item #1 -->
                        <tr>
                            <td class="title"><a href="#">title</a></td>
                            <td class="centered">
                                <input class='checkbox_fail' readonly type='checkbox'>
                                <input class='checkbox_fail' checked readonly type='checkbox'>
                                <div class='label_check_fail'><i class='bi bi-x-lg'></i></div>
                            </td>
                            <td>create_day</td>
                            <td>closing day</td>
                            <td class="centered">
                                <a href="../employer/manage-applications.blade.php?id_job=" class="button">Show ()</a>
                            </td>
                            <td class="action">
                                <a href="add.blade.php?id="><i class="fa fa-pencil"></i> Edit</a>
                                <a href="#"><i class="bi bi-eye-fill"></i> View</a>
                                <a href="#" class="delete alert_delete" data-target="delete_job_process.php?id=" ><i class="fa fa-remove"></i> Delete</a>
                            </td>
                        </tr>


                    </table>
                    <br>
                    <a href="add.blade.php" class="button">Add Job</a>

                </div>

            </div>
        </div>
@stop
