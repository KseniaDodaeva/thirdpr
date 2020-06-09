<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$pdo = new PDO ('mysql:dbname=firstbd;host=localhost:3306', 'root', 'root');
$selectQueryText = 'SELECT * FROM `uploaded_text`';
$allRow = $pdo->query($selectQueryText)->fetchAll(PDO::FETCH_ASSOC);
?><table border=1 width='800px' align=center>
<?php foreach ($allRow as $a){?>
    <tr>
        <td><a href="all.php?id=<?= $a['ID'] ?>"><?= $a['ID'] ?></a></td>
        <td><?= substr($a['content'], 0, 100), '...' ?></td>
        <td><?=$a['date']?></td>
        <td><?=$a['words_count']?></td>
    </tr>
<?php } ?>
</table>
<a href="main.php">Добавить текст</a>
</body>
</html>