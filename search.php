<?php
require_once "db.php";

$search = "";
$students = [];

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);

    if ($search !== "") {
        $sql = "SELECT * FROM students
                WHERE name LIKE ?
                OR email LIKE ?
                OR phone LIKE ?
                OR course LIKE ?
                OR city LIKE ?
                ORDER BY id DESC";

        $stmt = mysqli_prepare($conn, $sql);

        $keyword = "%" . $search . "%";

        mysqli_stmt_bind_param(
            $stmt,
            "sssss",
            $keyword,
            $keyword,
            $keyword,
            $keyword,
            $keyword
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Search Students - StudentHub</title>

    <link rel="stylesheet" href="css/style.css">

    <style>
        .search-box {
            max-width: 700px;
            margin: 30px auto;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-form input {
            flex: 1;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
        }

        .search-form button {
            padding: 14px 25px;
            border: none;
            border-radius: 10px;
            background: #0757b5;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: white;
        }

        .student-table th,
        .student-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .student-table th {
            background: #0757b5;
            color: white;
        }

        .no-result {
            text-align: center;
            padding: 30px;
            background: #fff3cd;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<header>
    <nav>
        <div class="logo">
            🎓 StudentHub
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="students.php">Students</a>
            <a href="add_student.php">Add Student</a>
            <a href="search.php">Search</a>
        </div>
    </nav>
</header>

<main>

    <div class="search-box">

        <h1>🔍 Search Students</h1>

        <p>Search student records from the MySQL database.</p>

        <form method="GET" action="search.php" class="search-form">

            <input
                type="text"
                name="search"
                placeholder="Search by name, email, phone, course or city..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <button type="submit">
                Search
            </button>

        </form>

        <?php if ($search !== ""): ?>

            <?php if (count($students) > 0): ?>

                <h2>
                    Search Results
                    (<?php echo count($students); ?>)
                </h2>

                <table class="student-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Gender</th>
                            <th>City</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($students as $student): ?>

                        <tr>
                            <td>
                                <?php echo $student['id']; ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['name']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['email']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['phone']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['course']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['gender']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['city']); ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div class="no-result">
                    ❌ No student found for
                    <strong>
                        <?php echo htmlspecialchars($search); ?>
                    </strong>
                </div>

            <?php endif; ?>

        <?php endif; ?>

    </div>

</main>

<footer>
    © 2026 StudentHub | PHP & MySQL Database Project
</footer>

</body>
</html>