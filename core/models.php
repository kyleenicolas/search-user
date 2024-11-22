<?php
// Function to get all teachers
function getAllTeachers($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM teachers ORDER BY date_applied DESC");
        $stmt->execute();
        return ['querySet' => $stmt->fetchAll(PDO::FETCH_ASSOC), 'message' => 'Teachers retrieved successfully.'];
    } catch (PDOException $e) {
        return ['querySet' => [], 'message' => 'Error retrieving teachers: ' . $e->getMessage()];
    }
}

// Function to search for teachers
function searchTeachers($pdo, $searchTerm) {
    try {
        $query = "SELECT * FROM teachers 
                  WHERE first_name LIKE :searchTerm 
                  OR last_name LIKE :searchTerm 
                  OR email LIKE :searchTerm 
                  OR department LIKE :searchTerm 
                  OR field_of_expertise LIKE :searchTerm 
                  OR years_of_experience LIKE :searchTerm 
                  OR education LIKE :searchTerm 
                  ORDER BY date_applied DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
        return ['querySet' => $stmt->fetchAll(PDO::FETCH_ASSOC), 'message' => 'Search successful.'];
    } catch (PDOException $e) {
        return ['querySet' => [], 'message' => 'Search error: ' . $e->getMessage()];
    }
}

// Function to insert a new teacher
function insertTeacher($pdo, $data) {
    try {
        $stmt = $pdo->prepare("INSERT INTO teachers (first_name, last_name, email, department, field_of_expertise, years_of_experience, education) 
                                VALUES (:first_name, :last_name, :email, :department, :field_of_expertise, :years_of_experience, :education)");
        $stmt->execute($data);
        return ['message' => 'New teacher added successfully!'];
    } catch (PDOException $e) {
        return ['message' => 'Error inserting teacher: ' . $e->getMessage()];
    }
}

// Function to delete a teacher by ID
function deleteTeacher($pdo, $id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM teachers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return ['message' => 'Teacher deleted successfully!'];
    } catch (PDOException $e) {
        return ['message' => 'Error deleting teacher: ' . $e->getMessage()];
    }
}
?>
