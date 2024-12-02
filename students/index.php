<?php
$con = mysqli_connect("localhost","root","", "lb");
// $sm = mysqli_fetch_all(mysqli_query($con, "select * from students"));
$counts = mysqli_fetch_assoc(mysqli_query($con, "select (count(CASE
                                    WHEN average >= 4.5 THEN 1
                                    ELSE NULL
                                END)) as '5', 
                                (count(CASE
                                    WHEN average < 4.5 AND average >= 3.5 THEN 1
                                    ELSE NULL
                                END)) as '4',
                                (count(CASE
                                    WHEN average < 3.5 AND average >= 2.5 THEN 1
                                    ELSE NULL
                                END)) as '3',
                                (count(CASE
                                    WHEN average < 2.5 AND average >= 1.5 THEN 1
                                    ELSE NULL
                                END)) as '2',
                                (count(CASE
                                    WHEN average < 1.5 THEN 1
                                    ELSE NULL
                                END)) as '1' from students"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика успеваемости студентов</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <select class="form-select" aria-label="Default select example" style="width:25%" onchange="get_elems(this.value)">
        <option value="">
            все
        </option>
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
    </select>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Имя студента</th>
        <th scope="col">Средний балл</th>
        <th scope="col">Всего оценок</th>
        </tr>
    </thead>
    <tbody id="fill">
      
        
        
    </tbody>
    </table>
    <div>
  <canvas id="myChart"></canvas>
</div>
    <script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['5', '4', '3', '2', '1'],
      datasets: [{
        label: '- количество студентов с данным средним баллом',
        data: [<?=$counts["5"]?>, <?=$counts["4"]?>, <?=$counts["3"]?>, <?=$counts["2"]?>, <?=$counts["1"]?>],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  
</script>
<script>
    function get_elems (filter) {
        let sm;
    if (filter != null && filter != '') {
     
        if (filter == "5") {
            sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from students where average >= 4.5"));
                       echo json_encode($sm);?>
        }
        else if (filter == "4") {
            sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from students where average < 4.5 AND average >= 3.5")); 
            echo json_encode($sm);?>
        }
        else if (filter == "3") {
            sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from students where average < 3.5 AND average >= 2.5"));
            echo json_encode($sm);?>
        }
        else if (filter == "2") {
            sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from students where average < 2.5 AND average >= 1.5"));
            echo json_encode($sm);?>
        }
        else if (filter == "1") {
            sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from students where average < 1.5")); 
            echo json_encode($sm);?>
        }
       
    }
    else {
        sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from students"));
                       echo json_encode($sm);?>
        
    }
    document.getElementById('fill').innerHTML = '';
        sm.forEach((value) => {

            // console.log(value[0]);
            let div = document.createElement('tr');
            html = `
            <th scope="row">${value[0]}</th>
                <td>${value[1]}</td>
                <td>${value[2]}</td>
                <td>${value[3]}</td>
            `;
            div.innerHTML = html;
            document.getElementById('fill').append(div);
            
        })
  }
  document.addEventListener("DOMContentLoaded", () => {
    get_elems(null);
    });

  </script>
</body>
</html>