<?php
include('connect.php');  // Az adatbázis kapcsolat betöltése

// Ellenőrizzük, hogy a formot elküldték-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Jelszó titkosítása

    // Lekérdezés előkészítése és végrehajtása
    $stmt = $conn->prepare("INSERT INTO Players (Name, Email, Password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Sikeres regisztráció után átirányítjuk a login oldalra, és átadjuk a success_message-t
        header("Location: login.php?success=1");
        exit(); // Fontos, hogy az átirányítás után megállítsuk a további feldolgozást
    } else {
        echo "Hiba történt: " . $stmt->error;
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
    <title>Regisztráció</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../images/Új projekt.png" type="image/x-icon">
</head>    
<body>
    <div class="wrapper">
        <form method="POST" action="register.php" autocomplete="off">
            <h2>Regisztráció</h2>

            <div class="input-group">
                <input type="text" name="username" id="input" required>
                <label for="input" class="label">Felhasználónév</label>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email-input" required>
                <label for="email-input" class="label">Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password-input" required>
                <label for="password-input" class="label">Jelszó</label>
                <span id="eye-icon" class="eye-icon" onclick="togglePasswordVisibility('password-input', 'eye-icon')">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
            
            <div class="check">
                <label>
                    <input type="checkbox" id="terms-checkbox">
                    <span>Elfogadom a felhasználási feltételeket</span>
                </label>
            </div>
            
            <button type="submit">Regisztrálok</button>
            <div class="signin">
                <p>Már van fiókod? <a href="login.php">Bejelentkezés</a></p>
            </div>

            <span id="terms-error" class="error-message">A felhasználási feltételeket el kell fogadni!</span>
        </form>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>