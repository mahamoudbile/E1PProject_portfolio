<?php

include('../includes/config.php');
require_once '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Zoek de gebruiker in de database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Controleer het wachtwoord
        if (password_verify($password, $user['password'])) {
            // Wachtwoord klopt, start de sessie en sla de gebruiker op
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Verwijs naar een dashboard of beheerderspagina
            header("Location: ../index.php");
            exit;
        } else {
            // Ongeldig wachtwoord
            $error = "Onjuist wachtwoord.";
        }
    } else {
        // Geen gebruiker gevonden met dit e-mailadres
        $error = "Geen gebruiker gevonden met dat e-mailadres.";
    }
}

// Toon het inlogformulier
?>

    <div class="container">
        <h2>Admin Panel</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">E-mailadres:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Inloggen</button>
        </form>
    </div>
</body>
</html>
