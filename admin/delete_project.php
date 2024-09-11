<?php
// session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header("Location: ../auth/login.php");
//     exit;
// }

include('../includes/config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $projectId = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $projectId);

    if ($stmt->execute()) {
        echo "Project succesvol verwijderd!";
    } else {
        echo "Fout bij het verwijderen van het project!";
    }
}
?>
