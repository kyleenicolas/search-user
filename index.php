<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (isset($_GET['searchBtn'])) {
    $searchResult = searchTeachers($pdo, $_GET['searchInput']); // Updated function call
    $teachers = $searchResult['querySet'] ?? [];
    $message = $searchResult['message'];
    $searchSuccessMessage = !empty($teachers) ? "Search completed successfully! Found " . count($teachers) . " result(s)." : "No teachers found matching your search.";
} else {
    $allTeachers = getAllTeachers($pdo); // Updated function call
    $teachers = $allTeachers['querySet'] ?? [];
    $message = $allTeachers['message'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Applicant System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">

        <!-- Success Message Display -->
        <?php if (isset($_SESSION['message'])): ?>
            <p class="message success"><?php echo $_SESSION['message']; ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <h1>Teacher Applicant System</h1>

        <div class="search-container">
            <form action="index.php" method="GET">
                <input type="text" name="searchInput" placeholder="Search for applicants">
                <button type="submit" name="searchBtn">Search</button>
            </form>
        </div>

        <!-- Additional Links -->
        <p>
            <a class="clear-search" href="index.php">Clear Search</a> | 
            <a href="insert.php">Insert New Teacher</a>
        </p>

        <!-- Teachers Table -->
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Field of Expertise</th>
                    <th>Years of Experience</th>
                    <th>Education</th>
                    <th>Date Applied</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($teachers)) {
                    foreach ($teachers as $teacher) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($teacher['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($teacher['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($teacher['email']); ?></td>
                            <td><?php echo htmlspecialchars($teacher['department']); ?></td>
                            <td><?php echo htmlspecialchars($teacher['field_of_expertise']); ?></td>
                            <td><?php echo htmlspecialchars($teacher['years_of_experience']); ?> years</td>
                            <td><?php echo htmlspecialchars($teacher['education']); ?></td>
                            <td><?php echo htmlspecialchars($teacher['date_applied']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $teacher['id']; ?>">Edit</a> |
                                <a href="delete.php?id=<?php echo $teacher['id']; ?>" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</a>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo '<tr><td colspan="9">No teachers found.</td></tr>';
                } ?>
            </tbody>
        </table>

    </div>
</body>
</html>
