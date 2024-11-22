<?php
// Handles form submission for inserting new teachers
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addTeacher'])) {
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'department' => $_POST['department'],
        'field_of_expertise' => $_POST['field_of_expertise'],
        'years_of_experience' => $_POST['years_of_experience'],
        'education' => $_POST['education']
    ];

    // Include model functions
    require_once 'models.php';

    // Insert the teacher
    $response = insertTeacher($pdo, $data);
    $_SESSION['message'] = $response['message'];
    header('Location: index.php');
    exit();
}

// Handle teacher deletion from the index page
if (isset($_GET['delete_id'])) {
    require_once 'models.php';
    $response = deleteTeacher($pdo, $_GET['delete_id']);
    $_SESSION['message'] = $response['message'];
    header('Location: index.php');
    exit();
}
?>
