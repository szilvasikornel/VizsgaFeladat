<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/player.css">
    <link rel="shortcut icon" href="../images/Új projekt.png" type="image/x-icon">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
    
        <?php include 'header/header_player.php'; ?> 

    <main>
        <div class="content">
            <div class="datas">
                <h2>Profile</h2>              
                <div class="profile">
                    <img src="../images/yuri-kondo-knight1000.jpg" alt="profil">
                    <ul>
                        <li>Name: <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Nincs bejelentkezve'; ?></li>
                    </ul>
                    <ul>
                        <li>Character:</li>
                    </ul>
                    <ul>
                        <li>Armory:</li>
                        <li><input type="range" min="0" max="100" step="25" value="80" class="slider"></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer/footer.php'; ?> 

</div>
</body>
</html>
