<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pass = $_POST["password"];

    $sql = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $sql->store_result();
    $sql->bind_result($id, $password);

    if ($sql->fetch() && password_verify($pass, $password)) {
        $_SESSION["username"] = $username;
        $_SESSION["id"] = $id;
        header("Location: dash.php"); 
        exit();
    } else {
        echo "<div style='color:red;text-align:center;'>Invalid username or password</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login – Photo Gallery</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background: #f8f9fa;
      }
      .card {
        max-width: 420px;
        margin: 60px auto;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        background-color: #fff;
      }
      .form-control:focus {
        box-shadow: none;
        border-color: #5c7cfa;
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
    <div class="card">
      <h3 class="mb-4 text-center">Login to Your Account</h3>

      <form action="" method="POST" >
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input
            type="text"
            class="form-control"
            id="username"
            name="username"
            placeholder="Enter your username"
            required
          />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Enter your password"
            required
          />
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>

        <p class="mt-3 text-center">
          Don’t have an account?
          <a href="reg.html">Register here</a>
    </p>

      </form>
    </div>
  </body>
</html>

