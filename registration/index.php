<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna & CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 20px; }
        h2 { text-align: center; }
        form { margin-bottom: 20px; }
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
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        tr:nth-child(even){ background-color: #f2f2f2; }
        th { background-color: #4CAF50; color: white; }
        .action-btn {
            padding: 5px 10px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 3px;
            text-decoration: none;
        }
        .delete-btn { background-color: #d9534f; }
    </style>
</head>
<body>
<div class="container">
    <h2>Registrasi Pengguna</h2>
    <form action="register.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Daftar</button>
    </form>

    <h2>Daftar Pengguna</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['username']."</td>
                        <td>".$row['email']."</td>
                        <td>
                            <a class='action-btn' href='edit.php?id=".$row['id']."'>Edit</a> 
                            <a class='action-btn delete-btn' href='delete.php?id=".$row['id']."' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pengguna ini?\")'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data pengguna.</td></tr>";
        }
        mysqli_close($conn);
        ?>
    </table>
</div>
</body>
</html>
