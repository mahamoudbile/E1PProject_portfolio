<!-- header laden en data -->
<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../auth/login.php"); 
    exit;
}
require_once '../includes/header.php';

include('../includes/config.php');


// Haal het project-ID uit de URL
if (isset($_GET['id'])) {
    $projectId = intval($_GET['id']);  // Zorg dat ID een integer is

    // Haal het project op uit de database
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $project = $result->fetch_assoc();
    } else {
        echo "Project niet gevonden!";
        exit;
    }
} else {
    echo "Geen geldig project-ID!";
    exit;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imagePath = $project['image_path'];  // Standaard blijft de oude afbeelding

    // Als er een nieuwe afbeelding is geüpload, verwerk die dan
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $tempName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imagePath = 'uploads/' . basename($imageName);
        move_uploaded_file($tempName, "../" . $imagePath);
    }

    // Update query voor de database
    $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, image_path = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $imagePath, $projectId);

    if ($stmt->execute()) {
        // Na het updaten, stuur de gebruiker terug naar index.php
        header("Location: ../index.php");
        exit;
    } else {
        echo "Fout bij het updaten van het project!";
    }
}
?>


<form action="edit_project.php?id=<?php echo $project['id']; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Titel:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Beschrijving:</label>
        <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($project['description']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Afbeelding:</label>
        <input type="file" class="form-control-file" id="image" name="image">
        <p>Huidige afbeelding: <img src="<?php echo htmlspecialchars($project['image_path']); ?>" alt="Project Afbeelding" style="width: 100px;"></p>
    </div>
    <button type="submit" class="btn btn-primary">Opslaan</button>
</form>

