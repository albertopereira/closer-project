var closer = closer || {};

closer.heatmap = function () {
    var map, heatmap

    /*
    *   Initialization routines
    *
    *   @param {jquery obj} $container - container for visualization
    */
    initialize = function () {
        map = new google.maps.Map(document.getElementById('heatmap_container'), {
          zoom: 13,
          center: {lat: parseFloat(closer.root.coords.split(',')[0]), lng: parseFloat(closer.root.coords.split(',')[1])},
          mapTypeId: 'satellite'
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: getPoints(),
          map: map,
          radius: 50
        });
    },

    open = function () {

    },

    getPoints = function () {
        let coords = []
        let points = []

        getCoords(closer.root.sub, coords)

        for (var i = 0; i < coords.length; i++) {
            points[i] = new google.maps.LatLng(coords[i][0], coords[i][1])
        }

        return points

    },

    getCoords = function (obj, coords) {
        for (var i in obj) {
            if(obj[i].hasOwnProperty('coords')){
                coords.push(obj[i].coords.split(',').map(function(item){ return item.trim(); }))
            }

            if(obj[i].hasOwnProperty('sub')){
                getCoords(obj[i].sub, coords)
            }
        }
    };

    return {
        heatmap: heatmap,
        initialize: initialize,
        open: open
    }
}();
