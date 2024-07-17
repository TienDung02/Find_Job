<?php require_once('../../connection.php') ?>
<?php require_once('../../function.php') ?>
<?php require_once('../admin_head.php') ?>

<body>
<div id="admin_wrapper">
    <?php require_once('../admin_header.php') ?>
    <main>
        <?php require_once('../admin_menu_left.php') ?>
        <div class="contain">
            <section>
                <div class="title-table">
                    <h3>Category</h3>
                </div>
            </section>

            <div class="parent-form-admin">
                <form action="<?php
                    $id_category = $_GET['id_category'];
                    if ($id_category == 0) {
                        echo "add-industry-process.php";
                    } else {
                        echo "edit-industry-process.php?id_category=$id_category";
                    }
                    ?>" method="post" class="form-main">
                    <div class="form-admin-company flex-wrap">
                        <div class="about-contact-person m-auto">
                            <h4>
                                <?php
                                if ($id_category == 0) {
                                    echo "<h4>Add category</h4>";
                                } else {
                                    $category_sql3 = "select * from categories where id_category = $id_category";
                                    $category_ = callsql($category_sql3);
                                    echo "<h4>Edit category";
                                    echo "</h4>";
                                    $category_ = $category_[0];
                                }
                                ?>
                            </h4>
                            <div class="form-admin-insert-data">
                                <label for="#">Parent category</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="parent_id">
                                    <?php
                                    echo "<option value='0'>' Parent category '</option>";
                                    $sql_select_parent_id = "select * from categories ";
                                    $show_parent_categories = callsql($sql_select_parent_id);
                                    foreach ($show_parent_categories as $show_parent_category) {
                                        $selected = '';
                                        if ($id_category == 0) {
                                        } else {
                                            if ($category_['parent_id'] == $show_parent_category['id_category']) {
                                                $selected = 'selected';
                                            }
                                        }

                                        echo "<option " . $selected . " value='" . $show_parent_category['id_category'] . "'>" . $show_parent_category['name'] . "</option>";
                                    }
                                    $connect->close();
                                    ?>
                                </select>
                            </div>
                            <div class="form-admin-insert-data">
                                <label for="#">Category name</label>
                                <input type="text" name="category-name" value="<?php if($id_category != 0){echo $category_['name']; }?>">
                            </div>
                            <div class="form-group d-flex m-auto" style="width:23rem;">
                                <input type="submit" style="width:10rem;" value="Save"   class="btn me-5 mt-3 rounded-pill">
                                <input type="reset"  style="width:10rem;" value="CANCEL" class="btn btn-danger mt-3 rounded-pill" onClick="document.location.href='<?php echo FULL_URL; ?>/admin/category/admin-category-page.php?page=1'"  >
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>
<?php require_once('../admin_script.php') ?>
</body>

</html>
