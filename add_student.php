 <?php

include "db.php";

$message = "";
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

        $sql = "INSERT INTO students
                (name, email, phone, course, gender, city)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "ssssss",
            $name,
            $email,
            $phone,
            $course,
            $gender,
            $city
        );

        if (mysqli_stmt_execute($stmt)) {

            header("Location: students.php?success=added");
            exit();

        } else {

            $error = "Failed to add student: " . mysqli_error($conn);
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

    <title>Add Student - StudentHub</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header class="navbar">

    <div class="logo">
        🎓 StudentHub
    </div>

    <nav>

        <a href="index.php">
            Home
        </a>

        <a href="students.php">
            Students
        </a>

        <a href="add_student.php" class="active">
            Add Student
        </a>

        <a href="search.php">
            Search
        </a>

    </nav>

</header>


<div class="form-container">

    <div class="form-header">

        <h1>➕ Add New Student</h1>

        <p>
            Enter student information below.
        </p>

    </div>


    <?php if ($error != ""): ?>

        <div class="alert error">
            <?php echo htmlspecialchars($error); ?>
        </div>

    <?php endif; ?>


    <form method="POST" class="student-form">

        <div class="form-grid">

            <div class="form-group">

                <label>Student Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter student name"
                    required
                >

            </div>


            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="student@gmail.com"
                    required
                >

            </div>


            <div class="form-group">

                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    placeholder="9876543210"
                    required
                >

            </div>


            <div class="form-group">

                <label>Course</label>

                <select name="course" required>

                    <option value="">
                        Select Course
                    </option>

                    <option value="BCA">
                        BCA
                    </option>

                    <option value="BBA">
                        BBA
                    </option>

                    <option value="B.Tech">
                        B.Tech
                    </option>

                    <option value="MCA">
                        MCA
                    </option>

                    <option value="MBA">
                        MBA
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Gender</label>

                <select name="gender" required>

                    <option value="">
                        Select Gender
                    </option>

                    <option value="Male">
                        Male
                    </option>

                    <option value="Female">
                        Female
                    </option>

                    <option value="Other">
                        Other
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>City</label>

                <input
                    type="text"
                    name="city"
                    placeholder="Enter city"
                    required
                >

            </div>

        </div>


        <div class="form-actions">

            <a href="students.php" class="btn secondary">
                Cancel
            </a>

            <button type="submit" class="btn primary">
                Save Student
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