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
$id = $_GET['id'];
$pdo = new PDO ('mysql:dbname=firstbd;host=localhost:3306', 'root', 'root');
$sel = 'SELECT word.text_id, word.word, word.count FROM word LEFT OUTER JOIN uploaded_text ON text_id = uploaded_text.ID WHERE text_id = :id';
$sel1 = 'SELECT id, content FROM uploaded_text WHERE id = :id';
$selectQueryText = $pdo -> prepare($sel1);
$selectQueryText -> execute(['id'=>$id]);
$selectQueryText = $selectQueryText -> fetchAll(PDO::FETCH_ASSOC);
$selectQueryWords = $pdo -> prepare($sel);
$selectQueryWords -> execute(['id'=>$id]);
$selectQueryWords = $selectQueryWords -> fetchAll(PDO::FETCH_ASSOC);
?><table border=1 width='800px' align=center>
    <?php foreach ($selectQueryText as $a){?>
        <tr>
            <td><?=$a['content']?></td>
        </tr>
    <?php } ?>
</table>
?><table border=1 width='800px' align=center>
<?php foreach ($selectQueryWords as $a){?>
    <tr>
        <td><?=$a['ID']?></td>
        <td><?=$a['text_id']?></td>
        <td><?=$a['word']?></td>
        <td><?=$a['count']?></td>
    </tr>
    <?php } ?>
</table>
<a href="index.php">Посмотреть анализ текста</a>
<a href="main.php">Добавить текст</a>
</body>
</html>

