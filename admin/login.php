<?php
include('connect.php');  // Az adatbázis kapcsolat betöltése

// Hibaváltozó inicializálása
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lekérdezés, hogy létezik-e a felhasználónév
    $stmt = $conn->prepare("SELECT * FROM Players WHERE Name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Felhasználói adatok lekérése
        $user = $result->fetch_assoc();
        // Jelszó ellenőrzése
        if (password_verify($password, $user['Password'])) {
            // Bejelentkezés sikeres, session beállítása
            session_start();
            $_SESSION['username'] = $user['Name']; // A felhasználói nevet a session-be tesszük
            $_SESSION['role'] = $user['role']; // Ha van role mező, beállítjuk admin jogot
            header("Location: ../php/main.php");  // A bejelentkezés után átirányítunk a player oldalra
            exit();
        } else {
            // Hibás jelszó üzenet
            $error_message = "Hibás jelszó!";
        }
    } else {
        // Hibás felhasználónév üzenet
        $error_message = "Nincs ilyen felhasználó!";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../images/Új projekt.png" type="image/x-icon">
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="login.php" autocomplete="off">

            <h2>Bejelentkezés</h2>

            <div class="input-group">
                <input type="text" name="username" id="input" required>
                <label for="input" class="label">Felhasználónév</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password-input" required>
                <label for="password-input" class="label">Jelszó</label>
                <span id="eye-icon" class="eye-icon" onclick="togglePasswordVisibility('password-input', 'eye-icon')">
                    <i class="fas fa-eye-slash"></i> <!-- Kezdetben áthúzott szem -->
                </span>
            </div>

            <button id="button_login" type="submit">Bejelentkezés</button>
            
            <div class="signin">
                <p>Még nincs fiókod? <a href="register.php">Fiók létrehozása</a></p>
            </div>

            <!-- Sikeres regisztráció üzenet -->
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <p class="success-message">Sikeres regisztráció! Kérjük, jelentkezzen be.</p>
            <?php endif; ?>

            <!-- Hibaüzenet közvetlenül a bejelentkezési gomb előtt -->
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
                
        </form>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
