 <?php

include "db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid student ID.");
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM students WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("Student not found.");
}

$student = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $course = trim($_POST['course']);
    $gender = trim($_POST['gender']);
    $city = trim($_POST['city']);

    if (
        $name == "" ||
        $email == "" ||
        $phone == "" ||
        $course == "" ||
        $gender == "" ||
        $city == ""
    ) {

        $error = "Please fill all fields.";

    } else {

        $sql = "UPDATE students
                SET name = ?,
                    email = ?,
                    phone = ?,
                    course = ?,
                    gender = ?,
                    city = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "ssssssi",
            $name,
            $email,
            $phone,
            $course,
            $gender,
            $city,
            $id
        );

        if (mysqli_stmt_execute($stmt)) {

            header("Location: students.php?success=updated");
            exit();

        } else {

            $error = "Update failed: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Student - StudentHub</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header class="navbar">

    <div class="logo">
        🎓 StudentHub
    </div>

    <nav>

        <a href="index.php">Home</a>

        <a href="students.php" class="active">
            Students
        </a>

        <a href="add_student.php">
            Add Student
        </a>

        <a href="search.php">
            Search
        </a>

    </nav>

</header>


<div class="form-container">

    <div class="form-header">

        <h1>✏️ Edit Student</h1>

        <p>
            Update student information.
        </p>

    </div>


    <?php if ($error != ""): ?>

        <div class="alert error">

            <?php echo htmlspecialchars($error); ?>

        </div>

    <?php endif; ?>


    <form method="POST"
          class="student-form">

        <div class="form-grid">

            <div class="form-group">

                <label>Student Name</label>

                <input
                    type="text"
                    name="name"
                    value="<?php echo htmlspecialchars($student['name']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars($student['email']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    value="<?php echo htmlspecialchars($student['phone']); ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Course</label>

                <select name="course" required>

                    <option value="BCA"
                        <?php if ($student['course'] == 'BCA') echo 'selected'; ?>>
                        BCA
                    </option>

                    <option value="BBA"
                        <?php if ($student['course'] == 'BBA') echo 'selected'; ?>>
                        BBA
                    </option>

                    <option value="B.Tech"
                        <?php if ($student['course'] == 'B.Tech') echo 'selected'; ?>>
                        B.Tech
                    </option>

                    <option value="MCA"
                        <?php if ($student['course'] == 'MCA') echo 'selected'; ?>>
                        MCA
                    </option>

                    <option value="MBA"
                        <?php if ($student['course'] == 'MBA') echo 'selected'; ?>>
                        MBA
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Gender</label>

                <select name="gender" required>

                    <option value="Male"
                        <?php if ($student['gender'] == 'Male') echo 'selected'; ?>>
                        Male
                    </option>

                    <option value="Female"
                        <?php if ($student['gender'] == 'Female') echo 'selected'; ?>>
                        Female
                    </option>

                    <option value="Other"
                        <?php if ($student['gender'] == 'Other') echo 'selected'; ?>>
                        Other
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>City</label>

                <input
                    type="text"
                    name="city"
                    value="<?php echo htmlspecialchars($student['city']); ?>"
                    required
                >

            </div>

        </div>


        <div class="form-actions">

            <a href="students.php"
               class="btn secondary">

                Cancel

            </a>

            <button
                type="submit"
                class="btn primary">

                Update Student

            </button>

        </div>

    </form>

</div>


<footer>

    <p>
        © 2026 StudentHub | PHP & MySQL Database Project
    </p>

</footer>

</body>
</html>