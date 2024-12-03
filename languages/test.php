<?php
$con = mysqli_connect("localhost","root","", "lb");
if ($_GET['lang'] == 'en') {
    $count = mysqli_num_rows(mysqli_query($con, "select * from words where language = 'английский'"));
$all = mysqli_fetch_all(mysqli_query($con, "select * from words where language = 'английский'"));
}
else {
    $count = mysqli_num_rows(mysqli_query($con, "select * from words where language = 'французский'"));
    $all = mysqli_fetch_all(mysqli_query($con, "select * from words where language = 'французский'"));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div style="height:2vmax;"></div>
    <div class="container">
<form action="test_result.php" method="post">
    <?php
    for ($i=0; $i<5; $i++) {
        $rand = rand(1,($count-1));
    ?>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Введите перевод слова <?=$all[$rand][1]?></label>
        <input type="text" class="form-control" name="word_<?=$i?>">
        <input type="hidden" value="<?=$all[$rand][0]?>" name="id_<?=$i?>">
      </div>
    <?php
    }
    ?>
 
  <button type="submit" class="btn btn-primary">Отправить все</button>
</form>
</div>
</body>
</html>