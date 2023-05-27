function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: {lat: 35.6799795, lng: 139.7398836} // 適当な座標
    });
  
    google.maps.event.addListener(map, 'click', event => clickListener(event, map));
  }
  
  
  function clickListener(event, map) {
    const lat = event.latLng.lat();
    const lng = event.latLng.lng();
    const marker = new google.maps.Marker({
      position: {lat, lng},
      map
    });
  }
  initMap()
