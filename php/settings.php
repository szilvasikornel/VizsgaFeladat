<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../admin/login.php");
    exit();
}

include('../admin/connect.php');
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $new_username = $_POST['new_username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (isset($_POST['delete_account'])) {
        $stmt = $conn->prepare("DELETE FROM Players WHERE Name = ?");
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            session_destroy(); 
            header("Location: ../admin/register.php");
            exit();
        } else {
            $error_message = "Hiba történt a fiók törlésekor!";
        }
    } else {
        $stmt = $conn->prepare("SELECT * FROM Players WHERE Name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($old_password, $user['Password'])) {
            if (!empty($new_username)) {
                $update_username_stmt = $conn->prepare("UPDATE Players SET Name = ? WHERE Name = ?");
                $update_username_stmt->bind_param("ss", $new_username, $username);
                $update_username_stmt->execute();
                $_SESSION['username'] = $new_username; 
                $success_message = "Felhasználónév sikeresen módosítva!";
            }

            if (!empty($new_password) && $new_password === $confirm_password) {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_password_stmt = $conn->prepare("UPDATE Players SET Password = ? WHERE Name = ?");
                $update_password_stmt->bind_param("ss", $hashed_new_password, $username);
                $update_password_stmt->execute();
                $success_message = "Jelszó sikeresen módosítva!";
            } elseif (!empty($new_password) && $new_password !== $confirm_password) {
                $error_message = "A két új jelszó nem egyezik!";
            }
        } else {
            $error_message = "Hibás régi jelszó!";
        }
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beállítások</title>
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="shortcut icon" href="../images/Új projekt.png" type="image/x-icon">
</head>
<body>
    <div class="wrapper">
        <?php include 'header/header_settings.php'; ?>

        <main>
            <div class="content">
                <h2>Beállítások</h2>
                
                <?php if (!empty($success_message)): ?>
                    <p class="success-message"><?php echo $success_message; ?></p>
                <?php endif; ?>
                
                <?php if (!empty($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <form method="POST" action="settings.php">
                    <div class="input-group">
                        <label for="new_username">Új felhasználónév</label>
                        <input type="text" name="new_username" id="new_username" placeholder="Új felhasználónév (opcionális)">
                    </div>
                    <div class="input-group">
                        <label for="old_password">Régi jelszó</label>
                        <input type="password" name="old_password" id="old_password" required placeholder="Régi jelszó">
                    </div>
                    <div class="input-group">
                        <label for="new_password">Új jelszó</label>
                        <input type="password" name="new_password" id="new_password" placeholder="Új jelszó (opcionális)">
                    </div>
                    <div class="input-group">
                        <label for="confirm_password">Új jelszó megerősítése</label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Új jelszó megerősítése">
                    </div>
                    <button type="submit" class="modify-account-btn">Módosítások mentése</button>
                </form>

                <form method="POST" action="settings.php" onsubmit="return confirmDelete()">
                    <button type="submit" name="delete_account" class="delete-account-btn">Fiók törlése</button>
                </form>
            </div>
        </main>

        <?php include 'footer/footer.php'; ?>
    </div>

    <script src="../js/settings.js"></script>
</body>
</html>
