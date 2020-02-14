/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import parsleyjs for front-end validation
require('parsleyjs');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

var api_key = 'eHsDmslbcIzT8LG5Yw54AH9p2munbhhh';
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

//Refers to form http://localhost:8000/user/aparts/create
function getCoordByAddress(e) {
    e.preventDefault();
    console.log('data submit');
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
            console.log('data', data);
            if (data.results.length != 0) {
                var position = data.results[0].position;
                var lat = position.lat;
                var lon = position.lon;
                formData.append('lat', lat);
                formData.append('lon', lon);
            }

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

function getApartMap() {
    var dataLat = $('.data-lat').attr("data-lat");
    var dataLon = $('.data-lon').attr("data-lon");
    console.log('dataLat', dataLat, ' - dataLon', dataLon);

    var map_obj = {
        layer: 'basic',
        style: 'main',
        format: 'jpg',
        center: parseFloat(dataLon).toFixed(6) + ', ' + parseFloat(dataLat).toFixed(6),
        width: '512',
        height: '512',
        view: 'Unified',
        key: api_key
    };
    var map_url = jQuery.param(map_obj);

    var api_map_url = 'https://api.tomtom.com/map/1/staticimage?' + map_url;
    console.log(api_map_url);
    $('.map-img').attr("src", api_map_url);
}

function init() {

    $('#addApartForm').parsley();

    // $('.form-control').parsley().on('field:error', function() {
    //     $('.create-apartment').removeClass('btn-primary').addClass('btn-warning');

    // });

    // $.listen('parsley:field:error', function (ParsleyField) {
    //     ParsleyField.$element.addClass('is-invalid');
    // });

    // $.listen('parsley:field:success', function (ParsleyField) {
    //     ParsleyField.$element.removeClass('is-invalid');
    // });

    $('#addApartForm').parsley().on('field:error', function(ParsleyField) {
        ParsleyField.$element.addClass('is-invalid');
        console.log('fired error');
    });
    $('#addApartForm').parsley().on('field:success', function(ParsleyField) {
        ParsleyField.$element.removeClass('is-invalid');
    });
    var $createApart = $('#create-apartment');
    $('#addApartForm').parsley().on('field:error', function (ParsleyField) {

        if ($createApart.hasClass('btn-primary')) {
            $('#create-apartment').removeClass('btn-primary').addClass('btn-danger');
        }
    });

    $('#addApartForm').parsley().on('field:success', function () {

        if ($createApart.hasClass('btn-danger')) {
            $('#create-apartment').removeClass('btn-danger').addClass('btn-primary');
        }
    });

    $('#addApartForm').submit(getCoordByAddress);

    if($('#apart-map').length) {

        getApartMap();
    }
};

$(document).ready(init);

