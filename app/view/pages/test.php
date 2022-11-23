<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests</title>
</head>
<body>
    <div class="container">
        <div class="test-container">
            <?php foreach($data['questions'] as $question):?>
            <h2><?php echo $question->text?></h2>
            <form action="<?php echo URLROOT?>/pages/proccess" method="post">
                <input type="radio" name="option" value="test"><span>Answer</span>
                <button>Tālāk</button>
            </form>
            <?php endforeach;?>
        </div>
    </div>
</body>
</html>