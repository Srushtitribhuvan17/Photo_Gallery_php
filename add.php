<?php
include 'db.php';

if (!isset($_SESSION["id"])) {
   header("location:login.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title=$_POST["title"];
    $desc=$_POST["desc"];
    $image_name=$_FILES["image"]["name"];
    $user_id=$_SESSION["id"];
    move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/$image_name");

    
    $sql=$conn->prepare("insert into photos(title,descr,image,user_id) values(?,?,?,?)");
    $sql->bind_param("sssi",$title,$desc,$image_name,$user_id);
    $sql->execute();
    header("location:dash.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload Photo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .upload-form {
      max-width: 500px;
      margin: 60px auto;
      padding: 30px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
      background-color: #5c7cfa;
      border: none;
    }
    .btn-primary:hover {
      background-color: #4a67e1;
    }
  </style>
</head>
<body>

  <div class="upload-form">
    <h4 class="mb-4 text-center">📤 Upload a New Photo</h4>
    <form action="" method="POST" enctype="multipart/form-data">
      
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" required />
      </div>

      <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea name="desc" id="desc" class="form-control" rows="3" required></textarea>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Choose Image</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*" required />
      </div>

      <button type="submit" class="btn btn-primary w-100">Upload</button>

    </form>
  </div>

</body>
</html>
