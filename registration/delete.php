<?php
include "db.php";

if(isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    $sql = "DELETE FROM users WHERE id='$id'";
    if(mysqli_query($conn, $sql)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    echo "ID tidak diberikan.";
}
?>
