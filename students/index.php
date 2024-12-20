<?php
$con = mysqli_connect("localhost","root","", "lb");
// $counts = mysqli_fetch_assoc(mysqli_query($con, "select (count(CASE
//                                     WHEN (sum(marks.mark)/count(marks.id)) >= 4.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '5', 
//                                 (count(CASE
//                                     WHEN (sum(marks.mark)/count(marks.id)) < 4.5 AND (sum(marks.mark)/count(marks.id)) >= 3.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '4',
//                                 (count(CASE
//                                     WHEN (sum(marks.mark)/count(marks.id)) < 3.5 AND (sum(marks.mark)/count(marks.id)) >= 2.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '3',
//                                 (count(CASE
//                                     WHEN (sum(marks.mark)/count(marks.id)) < 2.5 AND (sum(marks.mark)/count(marks.id)) >= 1.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '2',
//                                 (count(CASE
//                                     WHEN (sum(marks.mark)/count(marks.id)) < 1.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '1' from students join marks on students.id = marks.student_id group by students.id order by students.id"));

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
<div>
  <canvas id="myChart2"></canvas>
</div>
    <script>
  const ctx = document.getElementById('myChart');
  let count_5 = 0;
  let count_4 = 0;
  let count_3 = 0;
  let count_2 = 0;
  let count_1 = 0;
  let count_all = <?php $sm_all = mysqli_fetch_all(mysqli_query($con, "select students.*, sum(marks.mark), count(marks.id) from students join marks on students.id = marks.student_id group by students.id"));
                       echo json_encode($sm_all);?>;
  count_all.forEach((value) => {
    if (value[2]/value[3] >= 4.5) {
      count_5++;
    }
    else if (value[2]/value[3] < 4.5 && value[2]/value[3] >= 3.5) {
      count_4++;
    }
    else if (value[2]/value[3] < 3.5 && value[2]/value[3] >= 2.5) {
      count_3++;
    }
    else if (value[2]/value[3] < 2.5 && value[2]/value[3] >= 1.5) {
      count_2++;
    }
    else if (value[2]/value[3] < 1.5) {
      count_1++;
    }
})
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['5', '4', '3', '2', '1'],
      datasets: [{
        label: '- количество студентов с данным средним баллом',
        data: [count_5, count_4, count_3, count_2, count_1],
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

  const ctx2 = document.getElementById('myChart2');
let sm_all = <?php $sm_all = mysqli_fetch_all(mysqli_query($con, "select students.*, count(marks.id) from students join marks on students.id = marks.student_id group by students.id"));
                       echo json_encode($sm_all);?>;
let labels_arr = [];
let marks_arr = [];
sm_all.forEach((value) => {
    labels_arr.push(value[1]);
    marks_arr.push(value[2]);
})
new Chart(ctx2, {
  type: 'line',
  data: {
    labels: labels_arr,
    datasets: [{
      label: '- общее количество оценок',
      data: marks_arr,
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
        sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select students.*, sum(marks.mark), count(marks.id) from students join marks on students.id = marks.student_id group by students.id order by students.id"));
                       echo json_encode($sm);?> 
      document.getElementById('fill').innerHTML = '';
    if (filter != null && filter != '') {
     
      sm.forEach((value) => {
         
        if (filter == "5") {
      if (value[2]/value[3] >= 4.5) {
         let div = document.createElement('tr');
          html = `
          <th scope="row">${value[0]}</th>
              <td>${value[1]}</td>
              <td>${value[2]/value[3]}</td>
              <td>${value[3]}</td>
          `;
          div.innerHTML = html;
          document.getElementById('fill').append(div);
      }
      // console.log(value[0]);
     
              }
              if (filter == "4") {
      if (value[2]/value[3] < 4.5 && value[2]/value[3] >= 3.5) {
         let div = document.createElement('tr');
          html = `
          <th scope="row">${value[0]}</th>
              <td>${value[1]}</td>
              <td>${value[2]/value[3]}</td>
              <td>${value[3]}</td>
          `;
          div.innerHTML = html;
          document.getElementById('fill').append(div);
      }
      // console.log(value[0]);
     
              }
              if (filter == "3") {
      if (value[2]/value[3] < 3.5 && value[2]/value[3] >= 2.5) {
         let div = document.createElement('tr');
          html = `
          <th scope="row">${value[0]}</th>
              <td>${value[1]}</td>
              <td>${value[2]/value[3]}</td>
              <td>${value[3]}</td>
          `;
          div.innerHTML = html;
          document.getElementById('fill').append(div);
      }
      // console.log(value[0]);
     
              }
              if (filter == "2") {
      if (value[2]/value[3] < 2.5 && value[2]/value[3] >= 1.5) {
         let div = document.createElement('tr');
          html = `
          <th scope="row">${value[0]}</th>
              <td>${value[1]}</td>
              <td>${value[2]/value[3]}</td>
              <td>${value[3]}</td>
          `;
          div.innerHTML = html;
          document.getElementById('fill').append(div);
      }
      // console.log(value[0]);
     
              }
              if (filter == "1") {
      if (value[2]/value[3] < 1.5 ) {
         let div = document.createElement('tr');
          html = `
          <th scope="row">${value[0]}</th>
              <td>${value[1]}</td>
              <td>${value[2]/value[3]}</td>
              <td>${value[3]}</td>
          `;
          div.innerHTML = html;
          document.getElementById('fill').append(div);
      }
      // console.log(value[0]);
     
              }
})
       
    }
    else {
      sm.forEach((value) => {

// console.log(value[0]);
let div = document.createElement('tr');
html = `
<th scope="row">${value[0]}</th>
    <td>${value[1]}</td>
    <td>${value[2]/value[3]}</td>
    <td>${value[3]}</td>
`;
div.innerHTML = html;
document.getElementById('fill').append(div);

})
        
    }
   
       
  }
  document.addEventListener("DOMContentLoaded", () => {
    get_elems(null);
    });

  </script>
</body>
</html>