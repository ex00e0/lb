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
    <svg id="chart_x" width="700" height="700" style="margin-left:50px; margin-bottom:50px;"></svg>
<script>
let events_all = <?php $sm = mysqli_fetch_all(mysqli_query($con, "select * from events"));
                       echo json_encode($sm);?>;
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

// function filterEvents() {
//     const selectedType = document.getElementById("eventType").value;
//     const filteredEvents = selectedType ? events.filter(event => event.type === selectedType) : events;
//     renderEventTable(filteredEvents);
// }

document.addEventListener("DOMContentLoaded", () => {
    createAttendanceChart();
});


</script>
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
  }
  document.addEventListener("DOMContentLoaded", () => {
    get_elems(null);
    });

  </script>
</body>
</html>