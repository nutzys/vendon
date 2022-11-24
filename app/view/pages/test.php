<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests</title>
</head>
<body>

    <h1><?php echo $data['question'][$data['obj_num']]->text?></h1>
    <form action="<?php echo URLROOT?>/pages/test/<?php echo $data['test']->test_id?>" method="post">
        <input type="hidden" name="secret" value="<?php echo $data['obj_num']?>">
        <input type="hidden" name="secret_question" value="<?php echo $data['secret_num']?>">
        <?php foreach($data['answers'] as $answer):?>
            <?php echo $answer->name?>
        <?php endforeach;?>
        <button>Next</button>
    </form>
</body>
</html>