<?php
include 'db.php';


if (!isset($_SESSION['id'])) {
    header("location:login.php");
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['id'];

$res = $conn->prepare("SELECT * FROM photos WHERE id = ? AND user_id = ?");
$res->bind_param("ii", $id, $user_id);
$res->execute();
$result = $res->get_result();
$photos = $result->fetch_assoc();

if (!$photos) {
    die("Unauthorized user");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $descr = $_POST["descr"];

    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image_name");
    } else {
        $image_name = $photos['image'];
    }

   
    $stmt = $conn->prepare("UPDATE photos SET title = ?, descr = ?, image = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sssii", $title, $descr, $image_name, $id, $user_id);
    $stmt->execute();

    header("location:dash.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Edit Photo</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>

  <body>
    <main class="container my-5">
      <h2>Edit Your Photo</h2>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            name="title"
            id="titleInput"
            placeholder="Title"
            value="<?= htmlspecialchars($photos['title']) ?>"
          />
          <label for="titleInput">Title</label>
        </div>

        <div class="form-floating mb-3">
          <textarea
            class="form-control"
            name="descr"
            id="descrInput"
            placeholder="Description"
            style="height: 150px"
          ><?= htmlspecialchars($photos['descr']) ?></textarea>
          <label for="descrInput">Description</label>
        </div>

        <div class="mb-3">
          <p>Current Image:</p>
          <img src="uploads/<?= htmlspecialchars($photos['image']) ?>" class="img-fluid rounded mb-2" alt="Current Photo" style="max-width: 300px;" />
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Change Image (optional):</label>
          <input type="file" name="image" class="form-control" />
        </div>

        <button type="submit" class="btn btn-primary">💾 Save Changes</button>
        <a href="dash.php" class="btn btn-secondary">↩️ Cancel</a>
      </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
