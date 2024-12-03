<?php
$con = mysqli_connect("localhost","root","", "lb");
// $sm_all = mysqli_fetch_all(mysqli_query($con, "select * from students"));
// $counts = mysqli_fetch_assoc(mysqli_query($con, "select (count(CASE
//                                     WHEN average >= 4.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '5', 
//                                 (count(CASE
//                                     WHEN average < 4.5 AND average >= 3.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '4',
//                                 (count(CASE
//                                     WHEN average < 3.5 AND average >= 2.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '3',
//                                 (count(CASE
//                                     WHEN average < 2.5 AND average >= 1.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '2',
//                                 (count(CASE
//                                     WHEN average < 1.5 THEN 1
//                                     ELSE NULL
//                                 END)) as '1' from students"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика успеваемости студентов</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="https://d3js.org/d3.v7.min.js"></script>
</head>
<body>
    <select class="form-select" aria-label="Default select example" style="width:25%" onchange="get_elems(this.value)">
        <option value="">
            все
        </option>
        <option value="лекции">лекции</option>
        <option value="семинары">семинары</option>
        <option value="конференции">конференции</option>
    </select>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Мероприятие</th>
        <th scope="col">Тип</th>
        <th scope="col">Дата</th>
        <th scope="col">Посещений</th>
        </tr>
    </thead>
    <tbody id="fill">
      
        
        
    </tbody>
    </table>
    <div>Всего посещений</div>
    <svg id="chart_x" width="700" height="700" style="margin-left:50px; margin-bottom:50px;"></svg>
    <div>Посещений за последнюю неделю</div>
    <svg id="chart_x2" width="700" height="700" style="margin-left:50px; margin-bottom:50px;"></svg>
    <div>Посещений за последний месяц</div>
    <svg id="chart_x3" width="700" height="700" style="margin-left:50px; margin-bottom:50px;"></svg>
    <div>Посещений за последний год</div>
    <svg id="chart_x4" width="700" height="700" style="margin-left:50px; margin-bottom:50px;"></svg>
<?php 
   $date_year = date_create();
   date_modify($date_year, "-1 year"); 
   $date_year = date_format($date_year, "Y-m-d");
   
   $date_month = date_create();
   date_modify($date_month, "-1 month"); 
   $date_month = date_format($date_month, "Y-m-d");

   $date_week = date_create();
   date_modify($date_week, "-1 week"); 
   $date_week = date_format($date_week, "Y-m-d");
   ?>
   


<script>
    function get_elems (filter) {
        let sm;
    if (filter != null && filter != '') {
      
        if (filter == "лекции") {
            sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'лекции'"));
                       echo json_encode($sm);?>
        }
        else if (filter == "семинары") {
            sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'семинары'"));
                       echo json_encode($sm);?>
        }
        else if (filter == "конференции") {
            sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'конференции'"));
                       echo json_encode($sm);?>
        }
       
    }
    else {
        sm = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events"));
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
                <td>${value[4]}</td>
            `;
            div.innerHTML = html;
            document.getElementById('fill').append(div);
            
        })

        // if (filter != null && filter != '') {}
        // else {}

        let events_all = sm;
let events_arr = [];
  events_all.forEach((value) => {
     let obj = {
        name: value[1],
        type: value[2],
        date: value[3],
        people: value[4]
     }
     events_arr.push(obj);
    });
    console.log(events_arr);
// const events = [
//     { name: "Лекция по программированию", type: "лекция", attendees: 50 },
//     { name: "Семинар по дизайну", type: "семинар", attendees: 30 },
//     { name: "Конференция по маркетингу", type: "конференция", attendees: 100 },
//     { name: "Лекция по математике", type: "лекция", attendees: 45 },
//     { name: "Семинар по искусству", type: "семинар", attendees: 25 },
// ];

function createAttendanceChart() {
    const marginTop = 20;
  const marginRight = 20;
  const marginBottom = 20;
  const marginLeft = 40;
    const svg = d3.select("#chart_x");
    const width = +svg.attr("width");
    const height = +svg.attr("height");
    document.getElementById('chart_x').innerHTML = '';

    const x = d3.scaleBand()
        .domain(events_arr.map(event => event.name))
        .range([0, width])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(events_arr, d => d.people)])
        .range([height, 0]);

    svg.selectAll("rect")
        .data(events_arr)
        .enter()
        .append("rect")
        .attr("x", d => x(d.name))
        .attr("y", d => y(d.people))
        .attr("width", x.bandwidth())
        .attr("height", d => height - y(d.people))
        .attr("fill", "steelblue");
        

        svg.append("g")
      .attr("transform", `translate(0,${height - marginBottom})`)
      .call(d3.axisBottom(x));

  // Add the y-axis.
  svg.append("g")
      .attr("transform", `translate(${marginLeft},0)`)
      .call(d3.axisLeft(y));

}
createAttendanceChart();
let events_all2;
if (filter != null && filter != '') {
      if (filter == "лекции") {
          events_all2 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'лекции' and date >= '$date_week'"));
                     echo json_encode($sm);?>
      }
      else if (filter == "семинары") {
        events_all2 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'семинары' and date >= '$date_week'"));
                     echo json_encode($sm);?>
      }
      else if (filter == "конференции") {
        events_all2 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'конференции' and date >= '$date_week'"));
                     echo json_encode($sm);?>
      }
     
  }
  else {
    events_all2 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where date >= '$date_week'"));
                     echo json_encode($sm);?>
      
  }
  let events_arr2 = [];
  events_all2.forEach((value) => {
     let obj = {
        name: value[1],
        type: value[2],
        date: value[3],
        people: value[4]
     }
     events_arr2.push(obj);
    });

function createAttendanceChart2() {
    const marginTop = 20;
  const marginRight = 20;
  const marginBottom = 20;
  const marginLeft = 40;
    const svg = d3.select("#chart_x2");
    const width = +svg.attr("width");
    const height = +svg.attr("height");
    document.getElementById('chart_x2').innerHTML = '';

    const x = d3.scaleBand()
        .domain(events_arr2.map(event => event.name))
        .range([0, width])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(events_arr2, d => d.people)])
        .range([height, 0]);

    svg.selectAll("rect")
        .data(events_arr2)
        .enter()
        .append("rect")
        .attr("x", d => x(d.name))
        .attr("y", d => y(d.people))
        .attr("width", x.bandwidth())
        .attr("height", d => height - y(d.people))
        .attr("fill", "steelblue");
        

        svg.append("g")
      .attr("transform", `translate(0,${height - marginBottom})`)
      .call(d3.axisBottom(x));

  // Add the y-axis.
  svg.append("g")
      .attr("transform", `translate(${marginLeft},0)`)
      .call(d3.axisLeft(y));

}

let events_all3;
if (filter != null && filter != '') {
      if (filter == "лекции") {
          events_all3 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'лекции' and date >= '$date_month'"));
                     echo json_encode($sm);?>
      }
      else if (filter == "семинары") {
        events_all3 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'семинары' and date >= '$date_month'"));
                     echo json_encode($sm);?>
      }
      else if (filter == "конференции") {
        events_all3 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'конференции' and date >= '$date_month'"));
                     echo json_encode($sm);?>
      }
     
  }
  else {
    events_all3 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where date >= '$date_month'"));
                     echo json_encode($sm);?>
      
  }
  let events_arr3 = [];
  events_all3.forEach((value) => {
     let obj = {
        name: value[1],
        type: value[2],
        date: value[3],
        people: value[4]
     }
     events_arr3.push(obj);
    });

  function createAttendanceChart3() {
    const marginTop = 20;
  const marginRight = 20;
  const marginBottom = 20;
  const marginLeft = 40;
    const svg = d3.select("#chart_x3");
    const width = +svg.attr("width");
    const height = +svg.attr("height");
    document.getElementById('chart_x3').innerHTML = '';

    const x = d3.scaleBand()
        .domain(events_arr3.map(event => event.name))
        .range([0, width])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(events_arr3, d => d.people)])
        .range([height, 0]);

    svg.selectAll("rect")
        .data(events_arr3)
        .enter()
        .append("rect")
        .attr("x", d => x(d.name))
        .attr("y", d => y(d.people))
        .attr("width", x.bandwidth())
        .attr("height", d => height - y(d.people))
        .attr("fill", "steelblue");
        

        svg.append("g")
      .attr("transform", `translate(0,${height - marginBottom})`)
      .call(d3.axisBottom(x));

  // Add the y-axis.
  svg.append("g")
      .attr("transform", `translate(${marginLeft},0)`)
      .call(d3.axisLeft(y));

}
let events_all4;
if (filter != null && filter != '') {
      
      if (filter == "лекции") {
          events_all4 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'лекции' and date >= '$date_year'"));
                     echo json_encode($sm);?>
      }
      else if (filter == "семинары") {
        events_all4 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'семинары' and date >= '$date_year'"));
                     echo json_encode($sm);?>
      }
      else if (filter == "конференции") {
        events_all4 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where type = 'конференции' and date >= '$date_year'"));
                     echo json_encode($sm);?>
      }
     
  }
  else {
    events_all4 = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events where date >= '$date_year'"));
                     echo json_encode($sm);?>
      
  }

let events_arr4 = [];
  events_all4.forEach((value) => {
     let obj = {
        name: value[1],
        type: value[2],
        date: value[3],
        people: value[4]
     }
     events_arr4.push(obj);
    });
console.log(events_arr4);
function createAttendanceChart4() {
    const marginTop = 20;
  const marginRight = 20;
  const marginBottom = 20;
  const marginLeft = 40;
    const svg = d3.select("#chart_x4");
    const width = +svg.attr("width");
    const height = +svg.attr("height");
    document.getElementById('chart_x4').innerHTML = '';

    const x = d3.scaleBand()
        .domain(events_arr4.map(event => event.name))
        .range([0, width])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(events_arr4, d => d.people)])
        .range([height, 0]);

    svg.selectAll("rect")
        .data(events_arr4)
        .enter()
        .append("rect")
        .attr("x", d => x(d.name))
        .attr("y", d => y(d.people))
        .attr("width", x.bandwidth())
        .attr("height", d => height - y(d.people))
        .attr("fill", "steelblue");
        

        svg.append("g")
      .attr("transform", `translate(0,${height - marginBottom})`)
      .call(d3.axisBottom(x));

  // Add the y-axis.
  svg.append("g")
      .attr("transform", `translate(${marginLeft},0)`)
      .call(d3.axisLeft(y));

}

createAttendanceChart2();
createAttendanceChart3();
createAttendanceChart4();
  }
  document.addEventListener("DOMContentLoaded", () => {
    get_elems(null);
    });

  </script>
</body>
</html>