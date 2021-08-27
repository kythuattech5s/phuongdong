var MAPMAKER = (function(){
    var arr = [];
    var map;
    var init= function(){
        var item = $('.location');
        item.each(function(index, el) {
            var lat = Number($(el).attr('data-lat'));
            var lng = Number($(el).attr('data-lng'));
            var data = {
                lat: lat,
                lng: lng,
                name: $(el).find('h4').text(),
                address: $(el).find('.address').text(),
                time: $(el).find('.time_open').text(),
            }
            arr.push(data);
        });
    }
    var initClick = function (){
        var marr=null;
        $(document).on('click', '.location', function(event) {
            event.preventDefault();
            if(marr!=null) marr.setMap(null);
            item.removeClass('act');
            $(this).addClass('act');
            var lat = Number($(this).attr('data-lat'));
            var lng = Number($(this).attr('data-lng'));
            var zoomLevel = 16.0;
            map.setZoom(16);
            map.setCenter({lat: lat  ,lng: lng});
            address= $(this).find('.address').text();
            name= $(this).find('h4').text();
            time= $(this).find('.time_open').text();
            var latlng = new google.maps.LatLng(lat,lng);
            marr=createMarker(latlng,name,address,time);
        });
    }

    var createMarkerBig = function (latlng,add, phone,mail,name,web) {
        var image = {
            url: $('#map').attr('data-icon'),
            scaledSize: new google.maps.Size(31, 45),
            origin: new google.maps.Point(0,0),
            anchor: new google.maps.Point(15, 45)
        };
        var marker = new google.maps.Marker({
            position: latlng,
            icon:image,
            map: map,
        });
        var infowindow = new google.maps.InfoWindow({
          content: '<div class="map-small">'
          +'<div class="name-info">'+name
          +'</div>'
          +'<div class="map-info">Add: '+add+'</div>'
          +(mail!=null && mail.length>0?'<div class="mail-info">Email: '+mail+'</div>':'')
          +'<div class="phone-info">Phone: '+phone+'</div>'
          +'</div>',
      });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
      });
        return marker;
    }
    var createMarker=function(latlng,add, phone,mail,name,web) {
        var image = {
            url: $('#map').attr('data-icon'),
            scaledSize: new google.maps.Size(20,30),
            origin: new google.maps.Point(0,0),
            anchor: new google.maps.Point(3, 3)
        };
        var marker = new google.maps.Marker({
            position: latlng,
            icon:image,
            map: map,
        });

        return marker;
    }
    var createPolygon = function(map,coor){
     var bermudaTriangle = new google.maps.Polygon({
        paths: coor,
        strokeColor: '#0066b3',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#0066b3',
        fillOpacity: 0.7
    });
     bermudaTriangle.setMap(map);
 }
 var initVietNam = function (){


 }
 var loadJS = function(){
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBh16xwFFIntwxL302r6eYss6nbkxNMsJo&callback=MAPMAKER._';
    document.body.appendChild(script);
}
var initMap = function(){
    var m = document.getElementById('map');
    if(m){

        var markers = [];
        map = new google.maps.Map(m, {
            zoom: 6,
        });
        var selected = $(".location").first();
        var lat= 16.0472484;
        var lng= 108.1716863;
        if(selected.length>0){
            selected.click(function(event){
                lat = Number($(this).attr('data-lat'));
                lng = Number($(this).attr('data-lng'));
                if(lat!='' && lng !=''){
                    map.setCenter({lat: lat  ,lng: lng});
                    map.setZoom(10);
                }
                else{
                    lat= 21.0364493 ;
                    lng= 105.7845041;
                    map.setCenter({lat: lat  ,lng: lng});
                    map.setZoom(10);

                }
            })
        }
        else{
            map.setCenter({lat: lat  ,lng: lng});
            map.setZoom(5);
        }
        map.setCenter({lat: lat  ,lng: lng});

        for (var i = 0; i < arr.length; i++) {
            var latlng = new google.maps.LatLng(arr[i].lat,arr[i].lng);
            var data = arr[i].address;
            markers[i] = createMarker(latlng, arr[i].name, arr[i].address, arr[i].time,);
        }
    }
}
return {
    _:function(){
        init();
        initMap();
    },
    initClick :function(){
        initClick();
    },
    loadJS:function(){
        loadJS();
    }
}
})();
window.addEventListener('load',function(){
    MAPMAKER.loadJS();
});