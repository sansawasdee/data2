<?php
$this->title = 'Gis';
$this->params['breadcrumbs'][] = $this->title;
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
  <!-- leaflet font marker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css"
  />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.min.js"></script>
  <!-- end leaflet font maker-->


  <style>
    #mapid {
      width: 100%;
      height: 90vh;
    }

    

    .legend {
      text-align: left;
      line-height: 18px;
      color: #555;
    }

    .legend i {
      width: 18px;
      height: 18px;
      float: left;
      margin-right: 8px;
      opacity: 0.7;
    }

    /* step 9 */

    .my-leaflet-tooltip {
      background: none;
      border: none;
      box-shadow: none;
    }
  </style>
  
  <div class="panel panel-success">
  <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i>      ผลการดำเนินการการคัดกรองพัฒนาการเด็กตามกลุ่มอายุ specialpp ช่วงรณรงค์ 9-13 ก.ค. 2561</h3>
    </div>
    <div class="panel-body" id="mapid"></div>

  </div>
  <script>
      var mymap = L.map('mapid').setView([13.850301, 100.529272], 7);
      L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: ' &copy; <a href="http://openstreetmap.org">' +
          ' OpenStreetMap</a>',
        maxZoom: 18
      }).addTo(mymap);
  
      var areaLayer1;
      var listDataLayer1;
      var geojsonLayer1;
  
      var areaLayer2;
      var listDataLayer2;
      var geojsonLayer2;
  
      var areaLayer3;
      var listDataLayer3;
      var geojsonLayer3;
  
      var areaLayer4;
      var listDataLayer4;
      var geojsonLayer4;

      var listDataLayer5 ;
  
      var listMarkerLayer1 = new Array();
      var listMarkerLayer2 = new Array();
      var listMarkerLayer3 = new Array();
      var listMarkerLayer4 = new Array();
  
      var backButton;
  
      $.ajax({
        type: "get",
        url: "http://opendata.service.moph.go.th/gis/v1/geojson/3/57",
        async: false,
        success: function (response) {
          console.log(response);
          areaLayer1 = response;
        }
      });
  
      $.ajax({
        type: "get",
        url: "http://61.19.32.29/api/web/dspm",
        async: false,
        success: function (response) {
          console.log(response);
          listDataLayer1 = response;
        }
      });
  
      function getDataLayer1(id) {
        var result;
        listDataLayer1.forEach(function (data) {
          if (id == data.id) {
            result = data.data;
          }
        });
        return result;
      }
  
      function getDataLayer2(id) {
        var result;
        listDataLayer2.forEach(function (data) {
          if (id == data.id) {
            result = data.data;
          }
        });
        return result;
      }
  
      function getDataLayer3(id) {
        var result;
        listDataLayer3.forEach(function (data) {
          if (id == data.id) {
            result = data.data;
          }
        });
        return result;
      }
  
      function getDataLayer4(id) {
        var result;
        listDataLayer4.forEach(function (data) {
          if (id == data.id) {
            result = data.data;
          }
        });
        return result;
      }
  
      function getColor(d) {
        return d >= 95 ? 'green' :
          d >= 60 ? 'orange ' :
          d >= 40 ? 'yellow' :
          'red';
      }
  
      function getDataHopital(hoscode) {
        var result;
        listDataLayer5.forEach(function (data) {
          if (hoscode == data.hoscode) {
            result = data.data;
          }
        });
        return result;
      }
  
      function getMarker(feature) {
        return L.AwesomeMarkers.icon({
          markerColor: getColor(getDataHopital(feature.properties.hoscode)),
          icon: 'hospital-o',
          prefix: 'fa',
        });
      }
  
      function styleLayer1(feature) {
        var id = feature.properties.id;
        return {
          fillColor: getColor(getDataLayer1(id)),
          fillOpacity: 0.5,
          color: '#00FF00',
          opacity: 0.8,
          weight: 1,
          dashArray: 3
        }
      }
  
      function styleLayer2(feature) {
        var id = feature.properties.id;
        return {
          fillColor: getColor(getDataLayer2(id)),
          fillOpacity: 0.5,
          color: '#00FF00',
          opacity: 0.8,
          weight: 1,
          dashArray: 3
        }
      }
  
      function styleLayer3(feature) {
        var id = feature.properties.id;
        return {
          fillColor: getColor(getDataLayer3(id)),
          fillOpacity: 0.5,
          color: '#00FF00',
          opacity: 0.8,
          weight: 1,
          dashArray: 3
        }
      }
  
      function styleLayer4(feature) {
        var id = feature.properties.id;
        return {
          fillColor: getColor(getDataLayer4(id)),
          fillOpacity: 0.5,
          color: '#00FF00',
          opacity: 0.8,
          weight: 1,
          dashArray: 3
        }
      }
  
      function highlightFeature(e) {
        var layer = e.target;
        var properties = layer.feature.properties;
  
        if (mymap.hasLayer(geojsonLayer4)) {
          properties.data = getDataLayer4(properties.id);
        } else if (mymap.hasLayer(geojsonLayer3)) {
          properties.data = getDataLayer3(properties.id);
        } else if (mymap.hasLayer(geojsonLayer2)) {
          properties.data = getDataLayer2(properties.id);
        } else {
          properties.data = getDataLayer1(properties.id);
        }
  
        info.update(properties);
        layer.setStyle({
          fillOpacity: 0.8,
          weight: 3
        });
      }
  
      function resetHighlight(e) {
        if (mymap.hasLayer(geojsonLayer4)) {
          geojsonLayer4.resetStyle(e.target);
        } else if (mymap.hasLayer(geojsonLayer3)) {
          geojsonLayer3.resetStyle(e.target);
        } else if (mymap.hasLayer(geojsonLayer2)) {
          geojsonLayer2.resetStyle(e.target);
        } else {
          geojsonLayer1.resetStyle(e.target);
        }
        info.update();
      }
  
      function clickLayer1(e) {
        listMarkerLayer1.forEach(function (marker) {
          mymap.removeLayer(marker);
        });
        backButton.addTo(mymap);
        var id = e.target.feature.properties.id;
        $.ajax({
          type: "get",
          url: "http://opendata.service.moph.go.th/gis/v1/geojson/5/" + id,
          async: false,
          success: function (response) {
            console.log(response);
            areaLayer2 = response;
          }
        });
  
        $.ajax({
          type: "get",
          url: "http://61.19.32.29/api/web/dspmt",
          async: false,
          success: function (response) {
            console.log(response);
            listDataLayer2 = response;
          }
        });
  
        geojsonLayer2 = L.geoJSON(areaLayer2, {
          style: styleLayer2,
          onEachFeature: onEachFeatureLayer2
        }).addTo(mymap);
        mymap.fitBounds(geojsonLayer2.getBounds());
        mymap.removeLayer(geojsonLayer1);
  
        var provcode = id.substr(0, 2);
        var distcode = id.substr(2, 2);
        var hospitalLayer4;
  
        $.ajax({
          type: "get",
          url: `http://opendata.service.moph.go.th/gis/v1/getgis/provcode/${provcode}/distcode/${distcode}`,
          async: false,
          success: function (response) {
            console.log(response);
            hospitalLayer4 = response;
          }
        });
        $.ajax({
          type: "get",
          url: "http://61.19.32.29/api/web/dspms",
          async: false,
          success: function (response) {
            console.log(response);
            listDataLayer5 = response;
          }
        });
  
        function onEachFeature(feature, layer) {
        layer.bindPopup(feature.properties.hosname);
        
      }
	  
        hopitalPointLayer = L.geoJSON(hospitalLayer4, {
          pointToLayer: function (feature, latlng) {
            return L.marker(latlng, {
              icon: getMarker(feature)
              
            });
            
          },
		  onEachFeature: onEachFeature
        }).addTo(mymap);
        
  
      }
  
  
  
      function clickLayer2(e) {
        listMarkerLayer2.forEach(function (marker) {
          mymap.removeLayer(marker);
        });
        // #1
        var id = e.target.feature.properties.id;
        $.ajax({
          type: "get",
          url: "http://opendata.service.moph.go.th/gis/v1/geojson/5/" + id, // #2
          async: false,
          success: function (response) {
            console.log(response);
            areaLayer3 = response; // #4
          }
        });
  
        // #5
        $.ajax({
          type: "get",
          url: "http://61.19.32.29/api/web/dspmt", // #6
          async: false,
          success: function (response) {
            console.log(response);
            listDataLayer3 = response; // #7
          }
        });
        // #8
  
  
  
        geojsonLayer3 = L.geoJSON(areaLayer3, {
          style: styleLayer3,
          onEachFeature: onEachFeatureLayer3
        }).addTo(mymap);
        mymap.fitBounds(geojsonLayer3.getBounds()); //#9
        mymap.removeLayer(geojsonLayer2);
        mymap.removeLayer(hopitalPointLayer);
         
      }
  
      function clickLayer3(e) {
        listMarkerLayer3.forEach(function (marker) {
          mymap.removeLayer(marker);
        });
        var id = e.target.feature.properties.id;
  
  
        $.ajax({
          type: "get",
          url: "http://opendata.service.moph.go.th/gis/v1/geojson/5/" + id, // #2
          async: false,
          success: function (response) {
            console.log(response);
            areaLayer4 = response;
          }
        });
  
        $.ajax({
          type: "get",
          url: "http://61.19.32.29/api/web/dspmt", // #6
          async: false,
          success: function (response) {
            console.log(response);
            listDataLayer4 = response; // #7
          }
        });
  
  
        geojsonLayer4 = L.geoJSON(areaLayer4, {
          style: styleLayer4,
          onEachFeature: onEachFeatureLayer4
        }).addTo(mymap);
  
        mymap.removeLayer(geojsonLayer3);
        mymap.fitBounds(geojsonLayer4.getBounds());
      }
  
  
  
      function onEachFeatureLayer1(feature, layer) {
        var center = layer.getBounds().getCenter(); // #1
        var marker = L.circle(center, { // #2
            radius: 0,
            weight: 0
          })
          .bindTooltip("<b>" + feature.properties.name + "</b>", { // #3
            permanent: true, // #4 
            direction: 'center', // #5
            className: 'my-leaflet-tooltip' // #6
          })
          .addTo(mymap); // #7
        listMarkerLayer1.push(marker); // #8
  
        layer.on({
          mouseover: highlightFeature,
          mouseout: resetHighlight,
          click: clickLayer1
        });
      }
  
      function onEachFeatureLayer2(feature, layer) {
        var center = layer.getBounds().getCenter(); // #1
        var marker = L.circle(center, { // #2
            radius: 0,
            weight: 0
          })
          .bindTooltip("<b>" + feature.properties.name + "</b>", { // #3
            permanent: true, // #4 
            direction: 'center', // #5
            className: 'my-leaflet-tooltip' // #6
          })
          .addTo(mymap); // #7
        listMarkerLayer2.push(marker); // #8
  
        layer.on({
          mouseover: highlightFeature,
          mouseout: resetHighlight,
          click: clickLayer2
        });
      }
  
      function onEachFeatureLayer3(feature, layer) {
        var center = layer.getBounds().getCenter(); // #1
        var marker = L.circle(center, { // #2
            radius: 0,
            weight: 0
          })
          .bindTooltip("<b>" + feature.properties.name + "</b>", { // #3
            permanent: true, // #4 
            direction: 'center', // #5
            className: 'my-leaflet-tooltip' // #6
          })
          .addTo(mymap); // #7
        listMarkerLayer3.push(marker); // #8
        layer.on({
          mouseover: highlightFeature,
          mouseout: resetHighlight,
          click: clickLayer3
        });
      }
  
      function onEachFeatureLayer4(feature, layer) {
        var center = layer.getBounds().getCenter(); // #1
        var marker = L.circle(center, { // #2
            radius: 0,
            weight: 0
          })
          .bindTooltip("<b>" + feature.properties.name + "</b>", { // #3
            permanent: true, // #4 
            direction: 'center', // #5
            className: 'my-leaflet-tooltip' // #6
          })
          .addTo(mymap); // #7
        listMarkerLayer4.push(marker); // #8
  
        layer.on({
          mouseover: highlightFeature,
          mouseout: resetHighlight
        });
      }
  
      function addMarkerLayer(listMarkerLayer) {
        listMarkerLayer.forEach(function (marker) {
          mymap.addLayer(marker);
        });
      }
  
      function removeMarkerLayer(listMarkerLayer) {
        listMarkerLayer.forEach(function (marker) {
          mymap.removeLayer(marker);
        });
      }
  
      geojsonLayer1 = L.geoJSON(areaLayer1, {
        style: styleLayer1,
        onEachFeature: onEachFeatureLayer1
      }).addTo(mymap);
  
      mymap.fitBounds(geojsonLayer1.getBounds());
  
      backButton = L.easyButton('fa-arrow-left', function (btn, map) {
        if (mymap.hasLayer(geojsonLayer4)) {
          listMarkerLayer4.forEach(function (marker) {
            mymap.removeLayer(marker);
          });
          listMarkerLayer3.forEach(function (marker) {
            mymap.addLayer(marker);
          });
  
          mymap.removeLayer(geojsonLayer4);
          mymap.addLayer(geojsonLayer3);
          mymap.fitBounds(geojsonLayer3.getBounds());
        } else if (mymap.hasLayer(geojsonLayer3)) {
          listMarkerLayer2.forEach(function (marker) {
            mymap.addLayer(marker);
          });
          listMarkerLayer3.forEach(function (marker) {
            mymap.removeLayer(marker);
          });
          mymap.removeLayer(geojsonLayer3);
          mymap.addLayer(geojsonLayer2);
          mymap.addLayer(hopitalPointLayer);
          mymap.fitBounds(geojsonLayer2.getBounds());
        } else {
          listMarkerLayer1.forEach(function (marker) {
            mymap.addLayer(marker);
          });
          listMarkerLayer2.forEach(function (marker) {
            mymap.removeLayer(marker);
          });
  
          backButton.removeFrom(mymap);
          mymap.removeLayer(geojsonLayer2);
          mymap.removeLayer(hopitalPointLayer);
          mymap.addLayer(geojsonLayer1);
          mymap.fitBounds(geojsonLayer1.getBounds());
        }
      });
  
      var legend = L.control({
        position: 'bottomright'
      });
      legend.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'info legend');
        div.innerHTML = '<i style="background:' + getColor(0) + '"></i>0-40<br>' +
          '<i style="background:' + getColor(40) + '"></i>40-60<br>' +
          '<i style="background:' + getColor(60) + '"></i>60-94<br>' +
          '<i style="background:' + getColor(95) + '"></i>95-100<br>';
        return div;
      };
      legend.addTo(mymap);
  
      var info = L.control();
  
      info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
      }
  
      info.update = function (props) {
        this._div.innerHTML = '<h4>MOPH KPI' + (props ?
          '<b>' + props.name + '</b><br />' + props.data :
          'เลื่อนเมาส์(Mouse Over)ไปบนแผนที่');
  
      }
  
      info.addTo(mymap);
    </script>
  