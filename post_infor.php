<?php

    require_once('connection.php');



    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare('SELECT * FROM tbl_file WHERE id = :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        $image_path = "upload/" . $row['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM tbl_file WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header("Location: post_infor.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูข้อมูลการโพสต์เลี้ยง</title>

    <link rel="icon" type="image/png" href="images/icons/favicon.png" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/post_infor.css" type="text/css" />
</head>

<body>


    <div class="container text-center">
        <br>
        <h2>ข้อมูลการโพสต์สัตว์เลี้ยง</h2>
        <div><br></div>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>type</th>
                    <th>sex</th>
                    <th>Name</th>
                    <th>breed</th>
                    <th>tel</th>
                    <th>age</th>
                    <th>Image</th>
                    <th colspan="2" style="text-align:center">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $select_stmt = $db->prepare('SELECT * FROM tbl_file');
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $row['types']; ?></td>
                        <td><?php echo $row['sex']; ?></td>
                        <td><?php echo $row['breed']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['tel']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><img src="upload/<?php echo $row['image']; ?>" width="100px" height="100px" alt=""></td>
                        <td><a type="button" value="แก้ไข" name="btn-edit" class="btn btn-primary" onclick="update_id(<?php echo $row['id']; ?>)">แก้ไข</td>
                        <td><a type="button" value="ลบ" name="btn-delete" class="btn btn-danger" onclick="delete_id(<?php echo $row['id']; ?>)">ลบ</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--12.display number of records -->
        <h5 align='left'><!--12.display number of records -->
            <div>
                <a href="index_admin.php"><-- กลับไปหน้าหลัก</a>

            </div>
        </h5>
    </div>
    <!--11.JavaScript for edit and delete actions -->
    <script>
        function delete_id(id) {
            if (confirm("คุณแน่ใจที่จะลบ?")) {
                window.location.href = "post_infor.php?delete_id=" + id;
            }
        }

        function update_id(id) {
            window.location.href = "edit_form.php?update_id=" + id;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>