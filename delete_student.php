 <?php

include "db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid student ID.");
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM students WHERE id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header("Location: students.php?success=deleted");
    exit();

} else {

    echo "Delete failed: " . mysqli_error($conn);
}

?>