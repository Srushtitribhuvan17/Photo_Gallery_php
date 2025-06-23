<?php
include 'db.php';
if (!isset($_SESSION["id"])) {
   header("location:login.php");
   exit();
}

$user_id = $_SESSION["id"];

$res = $conn->prepare("SELECT photos.*, users.username FROM photos JOIN users ON photos.user_id = users.id");
$res->execute();
$result = $res->get_result();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Photo Gallery Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      .navbar-custom {
        background-color: #5c7cfa;
      }
      .navbar-custom .navbar-brand,
      .navbar-custom .nav-link,
      .navbar-custom .btn {
        color: white;
      }
      .gallery-img {
        width: 100%;
        max-height: 250px;
        object-fit: cover;
        border-radius: 10px;
        height: auto;
      }
      .btn:hover {
        opacity: 0.9;
        transform: scale(1.02);
        transition: all 0.2s ease-in-out;
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom px-4">
      <a class="navbar-brand fw-bold" href="#">PhotoGallery</a>
      <div class="ms-auto d-flex align-items-center flex-wrap gap-2">
        <span class="text-white me-3">👋 Welcome to the Community Gallery</span>
        <a href="add.php" class="btn btn-outline-light">📤 Upload Photo</a>
        <a href="all_csv.php" class="btn btn-outline-light" title="Download all photos as CSV">📥 All CSV</a>
        <a href="all_pdf.php" class="btn btn-outline-light" title="Download all photos as PDF">📄 All PDF</a>
        <a href="logout.php" class="btn btn-danger">🚪 Logout</a>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="card mb-4 shadow-sm p-3">
          <h4><?= $row['title'] ?></h4>
          <small class="text-muted">By: <?= $row['username']?> || <?= $row['created_at'] ?></small>

          <div class="row mt-3">
            <div class="col-md-4">
              <img src="uploads/<?= $row['image'] ?>" alt="Photo" class="gallery-img">
            </div>
            <div class="col-md-8 d-flex align-items-center">
              <p class="mb-0"><?= nl2br($row['descr']) ?></p>
            </div>
          </div>

          <div class="container px-0 mt-3">
            <div class="row g-2">
              <div class="col-6 col-md-6">
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning w-100">✏️ Edit</a>
              </div>
              <div class="col-6 col-md-6">
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this photo?');">🗑️ Delete</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
