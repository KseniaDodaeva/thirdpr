<form method="post" enctype="multipart/form-data">
    <input type="file" name="test"></br>
    <textarea name="text"></textarea></br>
    <input type="submit">
    <a href="index.php">Посмотреть анализ текста</a>
</form>

<?php
$pdo = new PDO ('mysql:dbname=firstbd;host=localhost:3306', 'root', 'root');
$selectQuery = 'SELECT * FROM word';
$insertQueryWords = 'INSERT INTO 
word(text_id, word, count) 
VALUES (?, ?, ?)';
$insertQueryText = 'INSERT INTO 
uploaded_text(content, date, words_count) 
VALUES (?, ?, ?)';
$insertQueryWordsBD = $pdo->prepare($insertQueryWords);
$insertQueryTextBD = $pdo->prepare($insertQueryText);

function count_word($pdo, $str, $insertQueryWordsBD, $insertQueryTextBD)
{
    $strF = explode(" ", preg_replace("/[^a-z\']+/", ' ', strtolower($str)));
    $text = array_filter($strF, fn($elem) => $elem!='');
    $count = count($text);


    $count_values = array();
    foreach ($text as $a) {
        $count_values[$a]++;
    }

    $date = date('Y-m-d');

    $insertQueryTextBD->execute([$str, $date, $count]);
    $text_id = $pdo->lastInsertId();
    foreach ($count_values as $key => $value){
        $insertQueryWordsBD->execute([$text_id, $key, $value]);
    }

}

if (!empty($_FILES['test']['name'])) {
    count_word($pdo, file_get_contents($_FILES['test']['tmp_name']), $insertQueryWordsBD, $insertQueryTextBD);
}

if (!empty($_POST['text'])) {
    count_word($pdo, $_POST['text'], $insertQueryWordsBD, $insertQueryTextBD);
}

