<?php 

    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
        try {
            $types = $_REQUEST['txt_type'];
            $sex = $_REQUEST['txt_sex'];
            $name = $_REQUEST['txt_name'];
            $breed = $_REQUEST['txt_breed'];
            $tel = $_REQUEST['txt_tel'];
            $age = $_REQUEST['txt_age'];

            $image_file = $_FILES['txt_file']['name'];
            $type = $_FILES['txt_file']['type'];
            $size = $_FILES['txt_file']['size'];
            $temp = $_FILES['txt_file']['tmp_name'];

            $path = "upload/" . $image_file; // set upload folder path

            if (empty($type)) {
                $errorMsg = "Please Select type";
            }else if (empty($sex)) {
                $errorMsg = "Please Select sex";
            }else if (empty($name)) {
                $errorMsg = "Please Enter name";
            }else if (empty($breed)) {
                $errorMsg = "Please Enter breed";
            }else if (empty($tel)) {
                $errorMsg = "Please Enter tel";
            }else if (empty($age)) {
                $errorMsg = "Please Enter age";
            } else if (empty($image_file)) {
                $errorMsg = "please Select Image";
            } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
                if (!file_exists($path)) { // check file not exist in your upload folder path
                    if ($size < 5000000) { // check file size 5MB
                        move_uploaded_file($temp, 'upload/'.$image_file); // move upload file temperory directory to your upload folder
                    } else {
                        $errorMsg = "ไฟล์ของคุณมีขนากใหญ่เกินไป อัปโฟลดไฟล์ได้ขนาดไม่เกิน 5MB"; // error message file size larger than 5mb
                    }
                } else {
                    $errorMsg = "ไม่อนุญาติให้ใช้รูปเดิม"; // error message file not exists your upload folder path
                }
            } else {
                $errorMsg = "ไฟล์ที่ใส่ไม่ถูกต้อง โปรดไฟล์ที่นามสกุล JPG, JPEG, PNG & GIF";
            }

            if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare('INSERT INTO tbl_file(types, sex, name, breed, tel, age, image ) VALUES (:ftypes, :fsex, :fname, :fbreed, :ftel, :fage, :fimage)');
                $insert_stmt->bindParam(':ftypes', $types);
                $insert_stmt->bindParam(':fsex', $sex);
                $insert_stmt->bindParam(':fname', $name);
                $insert_stmt->bindParam(':fbreed', $breed);
                $insert_stmt->bindParam(':ftel', $tel);
                $insert_stmt->bindParam(':fage', $age);
                $insert_stmt->bindParam(':fimage', $image_file);

                if ($insert_stmt->execute()) {
                    $insertMsg = "บันทึกข้อมูลเรียบร้อย กำลังกลับสู่หน้าหลัก";
                    header('refresh:2;index.php');
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
    <title>แบบฟอร์มข้อมูลสัตว์เลี้ยง</title>

    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/form_a.css">
    <style>
        p{
            color:red;
        }
    </style>
</head>
<body>
    <div class="container">
        <center>
        <h1>แบบฟอร์มข้อมูลสัตว์เลี้ยง</h1>
        <p>กรอกข้อมูลสัตว์เลี้ยง เพื่อลงทะเบียนและง่ายต่อการจับคู่สัตว์เลี้ยงของคุณ</p>
        </center>
        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label for="ประเภท">ประเภท</label>
                    <select id="ประเภท" name="txt_type" class="custom-select">
                        <option placeholder="ปรเภท">โปรดเลือก</option>
                        <option value="สุนัข">สุนัข</option>
                        <option value="แมว">แมว</option>
                    </select>
            </div>
            <div class="form-group">
                <label for="เพศ">เพศ</label>
                    <select id="เพศ" name="txt_sex" class="custom-select">
                        <option placeholder="เพศ">โปรดเลือก</option>
                        <option value="เพศชาย">ตัวผู้</option>
                        <option value="เพศหญิง">ตัวเมีย</option>
                </select>
                </div>
            <div class="form-group">
                <label for="ชื่อ">ชื่อสัตว์เลี้ยง</label>
                <div>
                    <input type="text" name="txt_name" class="form-control" id="name-animal" placeholder="กรอกชื่อสัตว์เลี้ยง">
            </div>
            <div class="form-group">
                <label for="พันธุ์">พันธุ์สัตว์</label>
                    <input type="text" name="txt_breed" class="form-control" id="p-animal" placeholder="กรอกพันธุ์สัตว์">
            </div>
            <div class="form-group">
                <label for="เบอร์โทร">เบอร์โทรติดต่อ</label>
                <input type="tel" name="txt_tel"class="form-control" id="tel" placeholder="กรอกเบอร์โทรของคุณ">
            </div>
            <div class="form-group row mb-4">
                <div class="col-12">
                    <label for="อายุ">อายุสัตว์เลี้ยง</label>
                    <input type="text" name="txt_age" class="form-control" id="age" placeholder="กรอกอายุของสัตว์ เช่น 20 ปี">
                </div>
            </div>
            <div class="form-group row mb-4">
                <div class="col-12">
                    <label for="name" >แนบรูปภาพสัตว์เลี้ยง</label>
                    <input type="file" name="txt_file" class="form-control">
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
                if(isset($insertMsg)) {
            ?>
                <div class="alert alert-success">
                    <strong><?php echo $insertMsg; ?></strong>
                </div>
            <?php } ?>
            <div class="form-group">
                <div class="col-12">
                    <center>
                    <input type="submit" name="btn_insert" class="btn btn-success" value="ยืนยัน">
                    </center>
                </div>
            </div>
            <div class="from-group">
                <a href="index.php"><-- กลับไปหน้าหลัก</a>
            </div>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>