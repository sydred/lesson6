<?php
    $allFiles = glob('tests/*.json');
?>
<!doctype html>
<html >
<head>
    <meta charset="UTF-8">
    <title>выберите тест</title>
</head>
<body>
    <a href="index.php" class="back"><div>< Назад</div></a>
    <hr>

    <?php if (!empty($allFiles)): ?>
        <?php foreach ($allFiles as $file): ?>

            <div class="file-block">
                <h1><?php echo str_replace('tests/', '', $file); ?></h1><br>
                <a href="test.php?number=<?php echo array_search($file, $allFiles); ?>">Перейти на страницу с тестом ></a>
            </div>
            <hr>

        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (empty($allFiles)) echo 'Пока не загружено ни одного теста';?>
</body>
</html>