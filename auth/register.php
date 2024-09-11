<?php

// session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header("Location: ../auth/login.php");
//     exit;
// }


require_once '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check of het e-mailadres al bestaat
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Dit e-mailadres is al in gebruik.";
    } else {
        // Hash het wachtwoord
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Voeg de nieuwe gebruiker toe aan de database
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            $success = "Gebruiker succesvol aangemaakt.";
        } else {
            $error = "Er is een fout opgetreden bij het aanmaken van de gebruiker: " . $stmt->error;
        }
    }

    // Sluit de statement
    $stmt->close();
}
?>

<div class="container">
        <h2>Gebruiker Aanmaken</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="email">E-mailadres:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Maak Gebruiker Aan</button>
        </form>
    </div>
</body>
</html>