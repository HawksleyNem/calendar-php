<?php
    $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
    $days = ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Calendrier</title>
</head>
<body>
    <?php include dirname(__FILE__) . "./templates/header.php" ?>
    
    <main>
        <section id="calendar">
            <div class="cal-header">
                <div class="top-cal-header">
                    <img src="" alt="" class="arrow">
                    <h2>Mois XXXX</h2>
                    <img src="" alt="" class="arrow">
                </div>
                <div class="bottom-cal-header">
                    <input type="text">
                    <input type="text">
                    <button>Valider</button>
                </div>
            </div>
            <div class="grid">
                <?php for ($i = 0; $i < 7; $i++) { ?>
                    <div class="grid-item day-name"><?= $days[$i] ?></div>
                <?php } ?>
                <?php for ($i = 1; $i < 29; $i++) { ?>
                    <div class="grid-item day-case"><?= $i ?></div>
                <?php } ?>
            </div>
        </section>

        <?php include dirname(__FILE__) . "./templates/footer.php" ?>
    </main>
</body>
</html>