<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/index.css">
    <title>Tests</title>
</head>
<body>
    <div class="container">
        <div class="field-wrapper">
            <h1>Testa uzdevums</h1>
            <form action="<?php echo URLROOT?>/pages/index" method="post">
                <input type="text" name="name" class="input-field" value="<?php echo $data['name']?>" placeholder="Vārds">
                <span><?php echo $data['name_error']?></span>
                <select name="test" class="input-field">
                    <option value="" disabled selected>Izvēle</option>
                    <?php foreach($data['test'] as $test):?>
                    <option value="<?php echo $test->test_id?>"><?php echo $test->name?></option>
                    <?php endforeach;?>
                </select>
                <button>Sākt</button>
            </form>
        </div>
    </div>
</body>
</html>