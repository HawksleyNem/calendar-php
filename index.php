<?php
    date_default_timezone_set('Europe/Paris');
    $dt = time();
    $formatter = new IntlDateFormatter('fr_FR');
    $formatter -> setPattern('eeee');

    $years = [2023, 2022, 2021, 2020, 2019, 2018, 2017, 2016, 2015, 2013];
    $months = [1 => 'Janvier',2 => 'Février',3 => 'Mars',4 => 'Avril',5 => 'Mai',6 => 'Juin',7 => 'Juillet',8 => 'Août',9 => 'Septembre',10 => 'Octobre',11 => 'Novembre',12 => 'Décembre'];
    $days = [1 => 'Lun',2 => 'Mar',3 => 'Mer',4 => 'Jeu',5 => 'Ven',6 => 'Sam',7 => 'Dim'];
    date_default_timezone_set('Europe/Paris');
    $currentDate = isset($_POST['submit']) ? new DateTime($_POST['submit']) : new DateTime();

    if (isset($_POST['submit'])) {
        $selectedMonth = $_POST['month'];
        $selectedYear = $_POST['year'];
        // echo 'La date que vous avez saisie est : ' . $selectedMonth . ' ' . $selectedYear;
        foreach ($months as $month => $value) {
            if ($months[$month] == $selectedMonth) {
                $selectedMonthNb = $month;
            }
        };
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN,$selectedMonthNb,$selectedYear);

        $selectedDate = new DateTime($selectedYear . '-' . $selectedMonthNb . '-01');
        $selectedDate->modify('first day of this month');
        $firstDayOfMonth = ucwords($formatter->format($selectedDate));
        $firstDayOfMonth = $firstDayOfMonth[0] . $firstDayOfMonth[1] . $firstDayOfMonth[2];

        foreach ($days as $day => $value) {
            if ($days[$day] == $firstDayOfMonth) {
                $firstDayOfMonth = $day;
            }
        };

        $selectedDate->modify('last day of this month');
        $lastDayOfMonth = ucwords($formatter->format($selectedDate));
        $lastDayOfMonth = $lastDayOfMonth[0] . $lastDayOfMonth[1] . $lastDayOfMonth[2];

        foreach ($days as $day => $value) {
            if ($days[$day] == $lastDayOfMonth) {
                $lastDayOfMonth = $day;
            }
        };
    }
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
                    <a href="">
                        <img src="./assets/img/arrow-left-white.png" alt="Flèche gauche" class="arrow">
                    </a>
                    <h2><?= isset($selectedDate) ? $selectedMonth . ' ' . $selectedYear : $currentDate->format('m') . ' ' . $currentDate->format('Y') ?></h2>
                    <a href="">
                        <img src="./assets/img/arrow-right-white.png" alt="Flèche droite" class="arrow">
                    </a>
                </div>
                <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="bottom-cal-header">
                        <select name="month" id="month">
                            <?php for ($i = 1; $i < count($months) + 1; $i++) { ?>
                                <option value="<?= $months[$i] ?>"><?= $months[$i] ?></option>
                            <?php } ?>
                        </select>
                        <select name="year" id="year">
                            <?php for ($i = 0; $i < count($years); $i++) { ?>
                                <option value="<?= $years[$i] ?>"><?= $years[$i] ?></option>
                            <?php } ?>
                        </select>
                        <button name="submit" type="submit">Valider</button>
                    </div>
                </form>
            </div>
            <div class="grid">
                <?php for ($i = 1; $i <= 7; $i++) { ?>
                    <div class="grid-item day-name"><?= $days[$i] ?></div>
                <?php } ?>
                <?php for ($i = 1; $i < $firstDayOfMonth; $i++) { ?>
                    <div class="grid-item day-case"></div>
                <?php } ?>
                <?php for ($i = 1; $i <= $daysInMonth; $i++) { ?>
                    <div class="grid-item day-case"><?= $i ?></div>
                <?php } ?>
                <?php for ($i = $lastDayOfMonth; $i < 7; $i++) { ?>
                    <div class="grid-item day-case"></div>
                <?php } ?>
                
            </div>
        </section>

        <?php include dirname(__FILE__) . "./templates/footer.php" ?>
    </main>
</body>
</html>