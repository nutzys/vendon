<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/score.css">
    <title>Beigas</title>
</head>
<body>
    <div class="container">
        <div class="score-wrapper">
            <h1>Tests pabeigts, Paldies, <?php echo ucwords($_SESSION['name'])?>!</h1>
            <p><span>Iegūtie punkti</span> - <?php echo $_SESSION['score']?> no <?php echo $_SESSION['max_score']?></p>
            <form action="<?php echo URLROOT?>/pages/score" method="post">
                <button>Iziet</button>
            </form>
        </div>
    </div>
</body>
</html>