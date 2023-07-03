<?php
    session_start();

    //9.fetch and delete record
    include_once 'dbconnect.php';
    include_once 'connection.php';

    // fetch records
    $sql = "SELECT * FROM users ORDER BY user_id DESC";
    $result = mysqli_query($con, $sql);

    $cnt = 1;

    // delete record
    if (isset($_GET['user_id'])) {
        $sql = "DELETE FROM users where user_id = " . $_GET['user_id'];
        mysqli_query($con, $sql);
        header("location: show_user.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้ใช้งาน</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/show_user.css" type="text/css" />
</head>
<body>
<div class="container">
     <div class="row">
         <div class="col-xs-8 col-xs-offset-2">
             <br>
         <h5 align = 'center'><legend><b>ข้อมูลผู้ใช้งาน</b></legend>
         <div><br></div>
            <div class="table-responsive">
             <table class="table table-bordered table-hover">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>User Name</th>
                         <th>E-Mail</th>
                         <th>Password</th>
                         <th colspan="2" style="text-align:center">Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                </h5>
                <!--10.show all users in this part of table -->
                    <?php 
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $cnt++; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['user_passwd']; ?></td>
                            <td><input type="button" value="แก้ไข" name="btn-edit" class="btn btn-primary" onclick="update_user(<?php echo $row['user_id']; ?>);"></td>
                            <td><input type="button" value="ลบ" name="btn-delete" class="btn btn-danger" onclick="delete_user(<?php echo $row['user_id']; ?>);"></td>
                        </tr>
                    <?php } ?>
                 </tbody>
             </table>
            </div>
            <h5 align = 'left'><!--12.display number of records -->
            <div >
                <a href="index_admin.php"><-- กลับไปหน้าหลัก</a>
            
            </div>
            </h5>
         </div>
     </div>
 </div>
 <!--11.JavaScript for edit and delete actions -->
    <script>
        function delete_user(id) {
            if (confirm("คุณยืนยันที่จะลบใช่หรือไม่?")) {
                window.location.href = "show_user.php?user_id=" + id;
            }
        }

        function update_user(id) {
            window.location.href = "update_user.php?user_id=" + id;
        }
    </script>
</body>
</html>