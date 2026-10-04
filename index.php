 <?php
include "db.php";

$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$data = mysqli_fetch_assoc($result);
$total_students = $data['total'];

$course_result = mysqli_query($conn, "SELECT COUNT(DISTINCT course) AS total_courses FROM students");
$course_data = mysqli_fetch_assoc($course_result);
$total_courses = $course_data['total_courses'];

$recent_result = mysqli_query(
    $conn,
    "SELECT * FROM students ORDER BY id DESC LIMIT 5"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudentHub - Student Management System</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="navbar">

    <div class="logo">
        🎓 StudentHub
    </div>

    <nav>
        <a href="index.php" class="active">Home</a>
        <a href="students.php">Students</a>
        <a href="add_student.php">Add Student</a>
        <a href="search.php">Search</a>
    </nav>

</header>


<section class="hero">

    <div class="hero-content">

        <span class="badge">PHP + MYSQL PROJECT</span>

        <h1>
            Student Management
            <span>System</span>
        </h1>

        <p>
            Manage student records easily using PHP,
            MySQL and a modern database-connected website.
        </p>

        <div class="hero-buttons">

            <a href="add_student.php" class="btn primary">
                + Add Student
            </a>

            <a href="students.php" class="btn secondary">
                View Students
            </a>

        </div>

    </div>


    <div class="hero-card">

        <div class="card-icon">
            👨‍🎓
        </div>

        <h2>
            <?php echo $total_students; ?>
        </h2>

        <p>Total Students</p>

    </div>

</section>


<section class="stats">

    <div class="stat-card">
        <div class="stat-icon">👨‍🎓</div>
        <h2><?php echo $total_students; ?></h2>
        <p>Total Students</p>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📚</div>
        <h2><?php echo $total_courses; ?></h2>
        <p>Total Courses</p>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🗄️</div>
        <h2>MySQL</h2>
        <p>Database</p>
    </div>

</section>


<section class="features">

    <h2>System Features</h2>

    <div class="feature-grid">

        <div class="feature-card">
            <div class="feature-icon">➕</div>

            <h3>Add Students</h3>

            <p>
                Add new student records directly
                into the MySQL database.
            </p>

            <a href="add_student.php">
                Add Student →
            </a>
        </div>


        <div class="feature-card">
            <div class="feature-icon">📋</div>

            <h3>View Students</h3>

            <p>
                View all student records stored
                in the MySQL database.
            </p>

            <a href="students.php">
                View Students →
            </a>
        </div>


        <div class="feature-card">
            <div class="feature-icon">✏️</div>

            <h3>Update Records</h3>

            <p>
                Edit and update existing student
                information whenever required.
            </p>

            <a href="students.php">
                Manage Records →
            </a>
        </div>


        <div class="feature-card">
            <div class="feature-icon">🗑️</div>

            <h3>Delete Records</h3>

            <p>
                Remove unwanted student records
                from the database.
            </p>

            <a href="students.php">
                Manage Records →
            </a>
        </div>

    </div>

</section>


<section class="recent">

    <div class="section-heading">

        <div>
            <h2>Recent Students</h2>
            <p>Latest records from database</p>
        </div>

        <a href="students.php" class="view-all">
            View All →
        </a>

    </div>


    <div class="recent-table">

        <?php if (mysqli_num_rows($recent_result) > 0): ?>

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>City</th>
                    </tr>

                </thead>

                <tbody>

                <?php while ($student = mysqli_fetch_assoc($recent_result)): ?>

                    <tr>

                        <td>
                            <?php echo $student['id']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['course']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['city']); ?>
                        </td>

                    </tr>

                <?php endwhile; ?>

                </tbody>

            </table>

        <?php else: ?>

            <div class="empty">
                No student records available.
                <br><br>

                <a href="add_student.php" class="btn primary">
                    + Add First Student
                </a>
            </div>

        <?php endif; ?>

    </div>

</section>


<footer>

    <p>
        © 2026 StudentHub | PHP & MySQL Database Project
    </p>

</footer>

</body>
</html>