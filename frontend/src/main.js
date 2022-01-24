import App from './App.svelte';
const app = new App({
	target: document.body,
	props: {}
});

export default app;

import 'ol/ol.css';
import Map from 'ol/Map';
import OSM from 'ol/source/OSM';
import TileLayer from 'ol/layer/Tile';
import View from 'ol/View';
import {fromLonLat} from 'ol/proj';


const map = new Map({
  layers: [
    new TileLayer({
      source: new OSM(),
    }),
  ],
  target: 'map',
  view: new View({
    center: fromLonLat([19.361255, 52.7306794]),
    zoom: 6,
  }),
});

document.getElementById('zoom-out').onclick = function () {
  const view = map.getView();
  const zoom = view.getZoom();
  view.setZoom(zoom - 1);
};

document.getElementById('zoom-in').onclick = function () {
  const view = map.getView();
  const zoom = view.getZoom();
  view.setZoom(zoom + 1);
};

var layer = new ol.layer.Vector({
  source: new ol.source.Vector({
      features: [
          new ol.Feature({
              geometry: new ol.geom.Point(ol.proj.fromLonLat([19.361255, 52.7306794]))
          })
      ]
  })
});
map.addLayer(layer);


var container = document.getElementById('popup');
 var content = document.getElementById('popup-content');
 var closer = document.getElementById('popup-closer');

 var overlay = new ol.Overlay({
     element: container,
     autoPan: true,
     autoPanAnimation: {
         duration: 250
     }
 });
 map.addOverlay(overlay);

 closer.onclick = function() {
     overlay.setPosition(undefined);
     closer.blur();
     return false;
 };

 map.on('singleclick', function (event) {
  if (map.hasFeatureAtPixel(event.pixel) === true) {
      var coordinate = event.coordinate;

      content.innerHTML = '<b>Hello world!</b><br />I am a popup.';
      overlay.setPosition(coordinate);
  } else {
      overlay.setPosition(undefined);
      closer.blur();
  }
});