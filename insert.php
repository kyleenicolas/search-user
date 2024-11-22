<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'department' => $_POST['department'],
        'field_of_expertise' => $_POST['field_of_expertise'],
        'years_of_experience' => $_POST['years_of_experience'],
        'education' => $_POST['education']
    ];

    $insertResponse = insertTeacher($pdo, $data); // Updated function name
    $_SESSION['message'] = $insertResponse['message'];
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Teacher</title> <!-- Updated title -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Insert New Teacher</h1> <!-- Updated heading -->
    <form action="insert.php" method="POST">
        <p>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required>
        </p>
        <p>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </p>
        <p>
            <label for="department">Department:</label>
            <input type="text" name="department" id="department" required>
        </p>
        <p>
            <label for="field_of_expertise">Field of Expertise:</label>
            <input type="text" name="field_of_expertise" id="field_of_expertise" required>
        </p>
        <p>
            <label for="years_of_experience">Years of Experience:</label>
            <input type="number" name="years_of_experience" id="years_of_experience" required>
        </p>
        <p>
            <label for="education">Education:</label>
            <input type="text" name="education" id="education" required>
        </p>
        <button type="submit">Add Teacher</button> <!-- Updated button text -->
    </form>
</body>
</html>
