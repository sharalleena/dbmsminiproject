<?php
include 'conn.php';
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$f=$_FILES["fileToUpload"];
if(isset($_POST["submit"])) {
  $username =$_POST['username'];
  $bookname =$_POST['bookname'];
  $bookauthor =$_POST['bookauthor'];
  $subject =$_POST['subject'];
  $branch =$_POST['branch'];
  $semester =$_POST['sem'];
  $contact =$_POST['contact'];

  //print_r($f);
  $filename=$f['name'];
  $filepath=$f['tmp_name'];
//print_r($filepath);
  $fileerror=$f['error'];
  if($f['error'] ==0){
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    
     
     $insertquery="insert into book_ads(username,bookname,bookauthor,subject,semester,branch,
     price,contact,photo) values('$username','$bookname','$bookauthor','$subject','$semester','$branch',
     '$price',$contact','$target_file')";
      $query = mysqli_query($con,$insertquery);
      echo " inserted into database";
} else {
    echo "Sorry, there was an error uploading your file.";
  }
}
 } }
?>
