<?php
$con = mysqli_connect("localhost","root","", "lb");
$counts = mysqli_fetch_assoc(mysqli_query($con, "select (count(CASE
WHEN tests_main.date <= '2024-12-31' AND tests_main.date >= '2024-12-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'december', 
(count(CASE
WHEN tests_main.date <= '2024-11-30' AND tests_main.date >= '2024-11-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'november',
(count(CASE
WHEN tests_main.date <= '2024-10-31' AND tests_main.date >= '2024-10-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'october', 
(count(CASE
WHEN tests_main.date <= '2024-09-30' AND tests_main.date >= '2024-09-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'september', 
(count(CASE
WHEN tests_main.date <= '2024-08-31' AND tests_main.date >= '2024-08-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'august', 
(count(CASE
WHEN tests_main.date <= '2024-07-31' AND tests_main.date >= '2024-07-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'july', 
(count(CASE
WHEN tests_main.date <= '2024-06-30' AND tests_main.date >= '2024-06-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'june', 
(count(CASE
WHEN tests_main.date <= '2024-05-31' AND tests_main.date >= '2024-05-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'may', 
(count(CASE
WHEN tests_main.date <= '2024-05-31' AND tests_main.date >= '2024-04-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'april', 
(count(CASE
WHEN tests_main.date <= '2024-03-31' AND tests_main.date >= '2024-03-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'march', 
(count(CASE
WHEN tests_main.date <= '2024-02-29' AND tests_main.date >= '2024-02-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'february', 
(count(CASE
WHEN tests_main.date <= '2024-01-31' AND tests_main.date >= '2024-01-01' AND tests.is_correct = 'true' AND words.language = 'английский' THEN 1
ELSE NULL
END)) as 'january'
from tests_main join tests on tests_main.id = tests.test_id join words on tests.word_id = words.id"));
$counts_fr = mysqli_fetch_assoc(mysqli_query($con, "select (count(CASE
WHEN tests_main.date <= '2024-12-31' AND tests_main.date >= '2024-12-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'december', 
(count(CASE
WHEN tests_main.date <= '2024-11-30' AND tests_main.date >= '2024-11-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'november',
(count(CASE
WHEN tests_main.date <= '2024-10-31' AND tests_main.date >= '2024-10-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'october', 
(count(CASE
WHEN tests_main.date <= '2024-09-30' AND tests_main.date >= '2024-09-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'september', 
(count(CASE
WHEN tests_main.date <= '2024-08-31' AND tests_main.date >= '2024-08-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'august', 
(count(CASE
WHEN tests_main.date <= '2024-07-31' AND tests_main.date >= '2024-07-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'july', 
(count(CASE
WHEN tests_main.date <= '2024-06-30' AND tests_main.date >= '2024-06-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'june', 
(count(CASE
WHEN tests_main.date <= '2024-05-31' AND tests_main.date >= '2024-05-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'may', 
(count(CASE
WHEN tests_main.date <= '2024-05-31' AND tests_main.date >= '2024-04-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'april', 
(count(CASE
WHEN tests_main.date <= '2024-03-31' AND tests_main.date >= '2024-03-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'march', 
(count(CASE
WHEN tests_main.date <= '2024-02-29' AND tests_main.date >= '2024-02-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'february', 
(count(CASE
WHEN tests_main.date <= '2024-01-31' AND tests_main.date >= '2024-01-01' AND tests.is_correct = 'true' AND words.language = 'французский' THEN 1
ELSE NULL
END)) as 'january'
from tests_main join tests on tests_main.id = tests.test_id join words on tests.word_id = words.id"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<body>
<div style="height:2vmax;"></div>
<div class="container"><a href="test.php?lang=en">Перейти к тесту по английскому</a></div>
<div class="container"><a href="test.php?lang=fr">Перейти к тесту по французскому</a></div>
<div style="height:2vmax;"></div>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
       
    </p>
</figure>

<script>
    // Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Прогресс изучения слов за год'
    },
    // subtitle: {
    //     text: 'Source: ' +
    //         '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
    //         'target="_blank">Wikipedia.com</a>'
    // },
    xAxis: {
        categories: [
            'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
            'Октябрь', 'Ноябрь', 'Декабрь'
        ]
    },
    yAxis: {
        title: {
            text: 'Количество слов'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Английский',
        data: [
            <?=$counts['january']?>,<?=$counts['february']?>,<?=$counts['march']?>,<?=$counts['april']?>,<?=$counts['may']?>,<?=$counts['june']?>,<?=$counts['july']?>,<?=$counts['august']?>,<?=$counts['september']?>,<?=$counts['october']?>,<?=$counts['november']?>,<?=$counts['december']?>
        ]
    }, {
        name: 'Французский',
        data: [
            <?=$counts_fr['january']?>,<?=$counts_fr['february']?>,<?=$counts_fr['march']?>,<?=$counts_fr['april']?>,<?=$counts_fr['may']?>,<?=$counts_fr['june']?>,<?=$counts_fr['july']?>,<?=$counts_fr['august']?>,<?=$counts_fr['september']?>,<?=$counts_fr['october']?>,<?=$counts_fr['november']?>,<?=$counts_fr['december']?>
        ]
    }]
});

</script>
</body>
</html>


