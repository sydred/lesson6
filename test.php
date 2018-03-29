<?php
$file_list = glob('tests/*.json');
$test = [];
foreach ($file_list as $key => $file) {
    if ($key == $_GET['number']) {
        $file_test = file_get_contents($file_list[$key]);
        $decode_file = json_decode($file_test, true);
        $test = $decode_file;
    }
}
$question = $test[0]['question'];
$answers[] = $test[0]['answers'];
$result_true = 0;
foreach ($answers[0] as $item) {
    if ($item['result'] === true) {
        $result_true++;
    }
}
$post_true = 0;
$post_false = 0;
if (count($_POST) > 0) {
    foreach ($_POST as $key => $item) {
        if ($answers[0][$key]['result'] === true) {
            $post_true++;
        }else{
            $post_false++;
        }
    }
    if ($post_true === $result_true && $post_false === 0) {
        echo 'Правильно!';
    }elseif ($post_true > 0 && $post_false > 0) {
        echo 'Почти угадали =)';
    }else{
        echo 'Вы ошиблись =(';
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест: <?=$question?></title>
</head>
<body>

<form method="post">
    <fieldset>
        <legend><?=$question?></legend>
        <?php foreach ($answers[0] as $key => $item) : ?>
            <label><input type="radio" name="<?=$key;?>" value="<?=$item['answer'];?>"> <?=$item['answer'];?></label>
        <?php endforeach; ?>
    </fieldset>
    <input type="submit" value="Отправить">
</form>

<ul>
    <li><a href="admin.php">Загрузить тест</a></li>
    <li><a href="list.php">Список тестов</a></li>
</ul>

</body>
</html>