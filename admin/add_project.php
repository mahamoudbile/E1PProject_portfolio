<?php
// session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header("Location: ../auth/login.php");
//     exit;
// }

require_once '../includes/header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST['title']) ? trim($_POST['title']) : null;
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;
    $image = isset($_FILES['image']) && $_FILES['image']['error'] == 0;

 
    if (empty($title) || empty($description) || !$image) {
        $error = "Alle velden en de afbeelding zijn verplicht.";
    } else {

        $tempName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imagePath = 'uploads/' . basename($imageName);

        if (move_uploaded_file($tempName, "../" . $imagePath)) {
            // Opslaan van de gegevens in de database
            $stmt = $conn->prepare("INSERT INTO projects (title, description, image_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $description, $imagePath);
            $stmt->execute();
            $stmt->close();

            header("Location: ../index.php");
            exit;
        } else {
            $error = "Fout bij het uploaden van de afbeelding.";
        }
    }
}

?>



<div class="container mt-5">
    <h2>Voeg Project Toe</h2>
    <form action="add_project.php" method="post" enctype="multipart/form-data">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <div class="form-group">
        <label for="title">Titel:</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="description">Beschrijving:</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Afbeelding:</label>
        <input type="file" class="form-control-file" id="image" name="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Voeg Toe</button>
</form>

</div>

<?php include('../includes/footer.php'); // Zorg dat dit pad correct is ?>