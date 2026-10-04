 <?php
include "db.php";

$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Students - StudentHub</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="navbar">

    <div class="logo">
        🎓 StudentHub
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="students.php">Students</a>
        <a href="add_student.php">Add Student</a>
        <a href="search.php">Search</a>
    </nav>

</header>


<div class="container">

    <div class="page-title">

        <h1>👨‍🎓 All Students</h1>

        <p>
            Manage all student records from the database.
        </p>

    </div>


    <?php if (isset($_GET['success'])): ?>

        <?php if ($_GET['success'] == 'updated'): ?>

            <div class="success">
                ✅ Student updated successfully!
            </div>

        <?php elseif ($_GET['success'] == 'deleted'): ?>

            <div class="success">
                🗑️ Student deleted successfully!
            </div>

        <?php endif; ?>

    <?php endif; ?>


    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Gender</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>

            </thead>


            <tbody>

                <?php if (mysqli_num_rows($result) > 0): ?>

                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td>
                                <?php echo $row['id']; ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['name']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['email']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['phone']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['course']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['gender']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['city']); ?>
                            </td>

                            <td>

                                <!-- EDIT -->
                                <a
                                    href="edit_student.php?id=<?php echo $row['id']; ?>"
                                    class="action-btn edit-btn"
                                >
                                    ✏️ Edit
                                </a>


                                <!-- DELETE -->
                                <a
                                    href="delete_student.php?id=<?php echo $row['id']; ?>"
                                    class="action-btn delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this student?');"
                                >
                                    🗑️ Delete
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="8" style="text-align:center;">
                            No students found.
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<footer>

    <p>
        © 2026 StudentHub | PHP & MySQL Database Project
    </p>

</footer>

</body>

</html>