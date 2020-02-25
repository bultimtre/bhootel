@extends('layouts.base')

@include('components.header')
@section('search')

<div class="container-fluid d-lg-flex mt-5">
  <div class="chart-container mt-5" style="position: relative; margin:auto; width:50vw">
    <canvas id="messagesChart"></canvas>
  </div>
  <div class="chart-container mt-5" style="position: relative; margin:auto; width:50vw">
    <canvas id="viewsChart"></canvas>
  </div>
</div>


<select name="" id="year_selection">
  <option value="2020" selected>2020</option>
  <option value="2019" >2019</option>
  <option value="2018">2018</option>
</select>



<script>

    var url = window.location.origin;
    var year = $("#year_selection").val();
    var id = {{json_encode($apartment->id)}};
    var msgGraph;
    var viewGraph;
    $("#year_selection").change(function(){
            year = $(this).val();
            // if the chart is not undefined (e.g. it has been created)
            // then destory the old one so we can create a new one later
            if (msgGraph && viewGraph) {
                msgGraph.destroy();
                viewGraph.destroy();
            }
        setMessagesStat();
        setViewsStat();
    });


    //ajax Call
    function setMessagesStat(){
        $.ajax({
            url: url + '/stat-msg' + '/{id}',
            method: "GET",
            data: {
                year_jq: year,
                id_jq: id
            },
            success: function (data) {
                console.log(id);
                
                messagesData(data);
            },
            error: function (err) {
                console.log("error", err);
            }
        });
    }
    
    
    function setViewsStat(){
        $.ajax({
            url: url + '/view-stat' + '/{id}',
            method: "GET",
            data: {
                year_jq: year
            },
            success: function (data) {

                viewsData(data);
            },
            error: function (err) {
                console.log("error", err);
            }
        });
    }


    // grafico messaggi
    function messagesGraph(data) {

        var messagesChart = $("#messagesChart");
        var msgGraph = new Chart(messagesChart, {

            type: "bar",
            data: {
            labels: moment.months(),
            datasets: [{
                label: "Messages",
                data: data,
                backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(163, 174, 24, 0.6)',
                'rgba(68, 122, 247, 0.6)',
                'rgba(232, 34, 209, 0.6)',
                'rgba(21, 51, 221, 0.6)',
                'rgba(194, 139, 128, 0.6)',
                'rgba(87, 4, 131, 0.6)',
                'rgba(169, 26, 127, 0.6)'
                ]
            }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Apartment Messages',
                    fontSize: 30
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }


    // grafico views
    function viewsGraph(data) {

        var viewsChart = $("#viewsChart");
        new Chart(viewsChart, {

            type: "line",
            data: {
                labels: moment.months(),
                datasets: [{
                label: "Views",
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(163, 174, 24, 0.6)',
                    'rgba(68, 122, 247, 0.6)',
                    'rgba(232, 34, 209, 0.6)',
                    'rgba(21, 51, 221, 0.6)',
                    'rgba(194, 139, 128, 0.6)',
                    'rgba(87, 4, 131, 0.6)',
                    'rgba(169, 26, 127, 0.6)'
                ]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Apartment Views',
                    fontSize: 30
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }


    // dati da passare per messaggi
    function messagesData(data) {

        var months = data.map(function(e) {
            var x = e.created_at;
            return (moment(x).month()+1);
        });

        var rowCount = [{1: 0}, {2: 0}, {3: 0}, {4: 0}, {5: 0}, {6: 0}, {7: 0}, {8: 0}, {9: 0}, {10: 0}, {11: 0}, {12: 0}];
        // var rowCount = [{1: 2}, {2: 5}, {3: 3}, {4: 7}, {5: 5}, {6: 2}, {7: 9}, {8: 7}, {9: 8}, {10: 6}, {11: 8}, {12: 5}]; //serve per testare

        $.each(months, function(i, el) {
            rowCount[el-1][el] = (rowCount[el-1][el])+1;
        });

        var count = Object.keys(rowCount).map(x => Object.values(rowCount[x]));

        messagesGraph(count);
    }


    // dati da passare per views
    function viewsData(data) {

        var months = data.map(function(e) {
            var x = e.created_at;
            return (moment(x).month()+1);
        });

        var rowCount = [{1: 0}, {2: 0}, {3: 0}, {4: 0}, {5: 0}, {6: 0}, {7: 0}, {8: 0}, {9: 0}, {10: 0}, {11: 0}, {12: 0}];

        $.each(months, function(i, el) {
            rowCount[el-1][el] = (rowCount[el-1][el])+1;
        });

        var count = Object.keys(rowCount).map(x => Object.values(rowCount[x]));

        viewsGraph(data);
    }

    setMessagesStat();
    setViewsStat();

</script>
@endsection
