@extends('layouts.base')

{{-- @include('components.header') --}}
@section('search')


<div class="container-fluid d-flex-column mt-5">
    <div class="form-group w-100 selectdiv text-center">
        <select class="col-12 col-md-4 mt-5 form-control" id="year_selection">
            <option value="2020" selected>2020</option>
            <option value="2019" >2019</option>
            <option value="2018">2018</option>
        </select>
    </div>
    <div class="container-fluid mt-5 p-3">
    <div class="chart-container mt-5 p-3">
        <canvas id="messagesChart"></canvas>
    </div>
    <div class="chart-container mt-5 p-3">
        <canvas id="viewsChart"></canvas>
    </div>
    </div>
</div>



<script>

    var url = window.location.origin;
    var year = $("#year_selection").val();
    var id = {{json_encode($apartment->id)}};

    var msgGraph;
    var viewGraph;
    $("#year_selection").change(function(){
        year = $(this).val();

        getData(destMsg);
        getData(destView);
    });


    //ajax Call
    function getData(dest) {
        $.ajax({
            url: url + dest,
            method: "GET",
            data: {
                year_jq: year,
                id_jq: id
            },
            success: function (data) {

                if (dest == '/stat-msg') {

                    messagesData(data);
                } else {

                    viewsData(data);
                }

            },
            error: function (err) {
                console.log("error", err);
            }
        });
    }


    // grafico messaggi
    function messagesGraph(count) {

        var messagesChart = $("#messagesChart");

        if (msgGraph) msgGraph.destroy();

        window.msgGraph = new Chart(messagesChart, {

            type: "bar",
            data: {
                labels: moment.months(),
                datasets: [{
                    label: "Messaggi",
                    data: count,
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
                    text: 'Statistiche Messaggi',
                    fontSize: 30
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                // responsive: true
                maintainAspectRatio: true
            }
        });
    }


    // grafico views
    function viewsGraph(count) {

        var viewsChart = $("#viewsChart");

        if (viewGraph) viewGraph.destroy();

        window.viewGraph = new Chart(viewsChart, {

            type: "bar",
            data: {
                labels: moment.months(),
                datasets: [{
                label: "Visualizzazioni",
                data: count,
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
                    text: 'Statistiche Visualizzazioni',
                    fontSize: 30
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                // responsive: true
                maintainAspectRatio: true
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

        viewsGraph(count);
    }

    var destMsg = '/stat-msg';
    var destView = '/view-stat';




    getData(destMsg);
    getData(destView);
</script>
@endsection
