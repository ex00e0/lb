<?php
$lang = $_POST['lang'];
$con = mysqli_connect("localhost","root","", "lb");
$today = date('Y-m-d');
mysqli_query($con, "insert into tests_main (date) VALUES ('$today', '$lang')");
$test_id = mysqli_insert_id($con);
$count_correct = 0;
for ($i=0; $i<5; $i++) {
    $id = $_POST["id_$i"];
    $word = $_POST["word_$i"];
   
    if ($word != '') {
      
        $bd = mysqli_fetch_array(mysqli_query($con, "select * from words where id = $id"))[3];
        var_dump($bd);
        if ($bd == $word) {
            mysqli_query($con, "insert into tests (test_id, word_id, is_correct) VALUES ($test_id, $id, 'true')");
            $count_correct ++;
        }
        else {
            mysqli_query($con, "insert into tests (test_id, word_id, is_correct) VALUES ($test_id, $id, 'false')");
        }
    }
    else {
        mysqli_query($con, "insert into tests (test_id, word_id, is_correct) VALUES ($test_id, $id, 'false')");
    }
    
}
echo "Правильных ответов:".$count_correct;
echo "<br><a href='index.php'>Вернуться назад</a>";
?>