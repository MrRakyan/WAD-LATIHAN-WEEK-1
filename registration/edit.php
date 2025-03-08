<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses update data pengguna
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    
    // Jika password diisi, maka update password juga
    if (!empty($_POST["password"])) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id='$id'";
    } else {
        $sql = "UPDATE users SET username='$username', email='$email' WHERE id='$id'";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    // Menampilkan form edit berdasarkan id yang dikirim via GET
    if(isset($_GET["id"])) {
        $id = mysqli_real_escape_string($conn, $_GET["id"]);
        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
        } else {
            echo "User tidak ditemukan.";
            exit();
        }
    } else {
        echo "ID tidak diberikan.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { max-width: 500px; margin: auto; background: #fff; padding: 20px; }
        h2 { text-align: center; }
        form { margin-top: 20px; }
        input[type=text], input[type=email], input[type=password] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px 0;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Pengguna</h2>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <label>Password (kosongkan jika tidak ingin mengubah):</label>
        <input type="password" name="password">
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
