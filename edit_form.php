<?php 

    require_once('connection.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare('SELECT * FROM tbl_file WHERE id = :id');
            $select_stmt->bindParam(":id", $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }   

    if (isset($_REQUEST['btn_update'])) {
        try {
            
            $name = $_REQUEST['txt_name'];
            $breed = $_REQUEST['txt_breed'];
            $tel = $_REQUEST['txt_tel'];
            $age = $_REQUEST['txt_age'];


            $image_file = $_FILES['txt_file']['name'];
            $type = $_FILES['txt_file']['type'];
            $size = $_FILES['txt_file']['size'];
            $temp = $_FILES['txt_file']['tmp_name'];

            $path = "upload/".$image_file;
            $directory = "upload/"; // set uplaod folder path for upadte time previos file remove and new file upload for next use

            if ($image_file) {
                if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
                    if (!file_exists($path)) { // check file not exist in your upload folder path
                        if ($size < 5000000) { // check file size 5MB
                            unlink($directory.$row['image']); // unlink functoin remove previos file
                            move_uploaded_file($temp, 'upload/'.$image_file); // move upload file temperory directory to your upload folder
                        } else {
                            $errorMsg = "ไฟล์ของคุณมีขนากใหญ่เกินไป อัปโฟลดไฟล์ได้ขนาดไม่เกิน 5MB";
                        }
                    } else {
                        $errorMsg = "ไม่อนุญาติให้ใช้รูปเดิม";
                    }
                } else {
                    $errorMsg = "ไฟล์ที่ใส่ไม่ถูกต้อง โปรดไฟล์ที่นามสกุล JPG, JPEG, PNG & GIF";
                }
            } else {
                $image_file = $row['image']; // if you not select new image than previos image same it is it.
            }

            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare("UPDATE tbl_file SET name = :name_up, breed = :breed_up, tel = :tel_up, age = :age_up, image = :file_up WHERE id = :id ");
                $update_stmt->bindParam(':name_up', $name);
                $update_stmt->bindParam(':breed_up', $breed);
                $update_stmt->bindParam(':tel_up', $tel);
                $update_stmt->bindParam(':age_up', $age);
                $update_stmt->bindParam(':file_up', $image_file);
                $update_stmt->bindParam(':id', $id);

                if ($update_stmt->execute()) {
                    $updateMsg = "File update successfully...";
                    header("refresh:1;post_infor.php");
                }
            }
            
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>

    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/edit_form.css">
    <style>
        p{
            color:red;
        }
    </style>
</head>
<body>
    <div class="container">
        <center>
        <h1>แก้ไขข้อมูลการโพสต์</h1>
        <p>แก้ไขข้อมูลการโพสต์ ของผู้ใช้งานของคุณ</p>
        </center>
        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label for="ชื่อสัตว์เลี้ยง" class="control">ชื่อสัตว์เลี้ยง</label>
                    <input type="text" name="txt_name" class="form-control" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label for="พันธุ์">พันธุ์สัตว์</label>
                    <input type="text" name="txt_breed" class="form-control" id="p-animal" placeholder="กรอกพันธุ์สัตว์" value="<?php echo $breed; ?>">
            </div>
            <div class="form-group">
                <label for="เบอร์โทร">เบอร์โทรติดต่อ</label>
                    <input type="tel" name="txt_tel" class="form-control" id="tel" placeholder="กรอกเบอร์โทรของคุณ" value="<?php echo $tel; ?>">
            </div>
            <div class="form-group row mb-4">
                    <div class="col-12">
                        <label for="อายุ">อายุสัตว์เลี้ยง</label>
                        <input type="text" name="txt_age" class="form-control" id="age" placeholder="กรอกอายุของสัตว์" value="<?php echo $age; ?>">
                    </div>
            </div>
            <div class="form-group row mb-4">
                <div class="col-12">
                    <label for="name">แนบรูปภาพสัตว์เลี้ยง</label>
                    <input type="file" name="txt_file" class="form-control" value="<?php echo $image; ?>">
                </div>
            </div>
                <p align = 'right'>
                    ***โปรดแนบไฟล์รูปที่เป็น JPG, JPEG, PNG & GIF  เท่านั้น***
                </p>
            <?php 
                if(isset($errorMsg)) {
            ?>
                <div class="alert alert-danger">
                    <strong><?php echo $errorMsg; ?></strong>
                </div>
            <?php } ?>

            <?php 
                if(isset($updateMsg)) {
            ?>

                <div class="alert alert-success">
                    <strong><?php echo $updateMsg; ?></strong>
                </div>
            <?php } ?>
            <center>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="submit" name="btn_update" class="btn btn-primary" value="ยืนยัน">
                    <a href="post_infor.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
            </center>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>