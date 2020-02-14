require('./bootstrap');
require('./components');


var api_key = 'eHsDmslbcIzT8LG5Yw54AH9p2munbhhh';
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

//Refers to form http://localhost:8000/user/aparts/create
function getCoordByAddress(e) {
    e.preventDefault();

    var formData = new FormData(this);
    // Display the key/value pairs
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    var address = $('#apart-address').serialize().split('=')[1];
    // var address = $('#apart-address').val().replace(/\s/g, "%20"); //refactor da serialize ARr
    // console.log('serialize address: ', address);
    var apartUrl = "https://api.tomtom.com/search/2/geocode/" + address + ".json?limit=1&key=" + api_key;
    console.log(apartUrl);
    $.ajax({
        url: apartUrl,
        method: "GET",
        success: function (data) {
            if (data.results) {
                console.log("data", data.results[0]);
            }
            // console.log("data: ", data);
            var position = data.results[0].position;
            var lat = position.lat;
            var lon = position.lon;
            formData.append('lat', lat);
            formData.append('lon', lon);
            // Display the key/value pairs
            // for (var pair of formData.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
            addNewApart(formData);
        },
        error: function (error) {
            console.log("error", error);
            //posso chiamare addNewApart e salvare dati senza Geoloc
            addNewApart(formData);
        }
    });
}
// send Apartment data with coord to UserApartmentsController@store
function addNewApart(formData) {

    $.ajax({
        url: "http://localhost:8000/user/index",
        enctype: 'multipart/form-data',
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        data: formData
        ,
        success: function (data) {
            console.log("data", data);
            window.location.href = 'http://localhost:8000/user/index/'; //redirect finito create
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function init() {


    $('#addApartForm').submit(getCoordByAddress);


};

$(document).ready(init);

