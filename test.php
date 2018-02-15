<?php
if (isset($_GET['number']) === false) {
    header('Location: list.php');
    exit;
}
$allTests = glob('tests/*.json');
$number = $_GET['number'];
$test = file_get_contents($allTests[$number]);
$test = json_decode($test, true);
if (isset($_POST['check-test'])) {
    function checkTest($testFile) {
        foreach ($testFile as $key => $item) {
            if (!isset($_POST['answer' . $key])) {
                echo 'Должны быть решены все задания!';
                exit;
            }
        }
        $i = 0;
        $questions = 0;
        foreach ($testFile as $key => $item) {
            $questions++;
            if ($item['correct_answer'] === $_POST['answer' . $key]) {
                $i++;
                $infoStyle = 'correct';
            } else {
                $infoStyle = 'incorrect';
            }
            echo "<div class=\"$infoStyle\">";
            echo 'Вопрос: ' . $item['question'] . '<br>';
            echo 'Ваш ответ: ' . $item['answers'][$_POST['answer' . $key]] . '<br>';
            echo 'Правильный ответ: ' . $item['answers'][$item['correct_answer']] . '<br>';
            echo '</div>';
            echo '<hr>';
        }
        echo '<p style="font-weight: bold;">Итого правильных ответов: ' . $i . ' из ' . $questions . '</p>';
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>test</title>
</head>
<body>
    <a href="<?php echo isset($_POST['check-test']) ? $_SERVER['HTTP_REFERER'] : 'list.php' ?>"><div>< Назад</div></a><br>
 
    <?php if (isset($_GET['number']) && !isset($_POST['check-test'])): ?>
        <form method="POST">
            <h1><?php echo basename($allTests[$number]); ?></h1>
            <?php foreach($test as $key => $item):  ?>
            <fieldset>
                <legend><?php echo $item['question'] ?></legend>
                <div class="on-hidden-radio"></div>
            
                <label><input type="radio" name="answer<?php echo $key ?>" value="0"><?php echo $item['answers'][0] ?></label><br>
                <label><input type="radio" name="answer<?php echo $key ?>" value="1"><?php echo $item['answers'][1] ?></label><br>
                <label><input type="radio" name="answer<?php echo $key ?>" value="2"><?php echo $item['answers'][2] ?></label><br>
                <label><input type="radio" name="answer<?php echo $key ?>" value="3"><?php echo $item['answers'][3] ?></label>
            </fieldset>
            <?php endforeach; ?>
            <input type="submit" name="check-test" value="Проверить">
        </form>
    <?php endif; ?>

    <div class="check-test">
        <?php if (isset($_POST['check-test'])) echo checkTest($test); ?>
    </div>
</body>
</html>