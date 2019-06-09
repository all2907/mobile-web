var marker = function(map){
  this.markers = [];
  this.map = map;
  this.a = 200;
  this.addMarker = function(location, judul, logo, id) {

    var marker = new google.maps.Marker({
      position : location,
      content : id,
      icon : logo,
      title : judul,
      map : this.map
    });
    this.markers.push(marker);
  };
  // this.window_konten = function(marker){
  //   konten =
  //   '<div style="width:400px">'+
  //   '<div class="col-md-12" id="gbr" style="background-image:'+"url('images/"+marker.content+".jpg'"+')">'+
  //   '</div>'+
  //   '<div class="col-md-12" style="text-align:center">'+
  //   '<h3>'+
  //   marker.title+
  //   '</h3>'+
  //   '</div>'+
  //   '<div class="col-md-12">'+
  //
  //   '</div>'+
  //   '</div>';
  // };


  this.setMapOnAll = function(map){
    console.log("ini"+map);
    console.log("itu"+this.markers.length);
    for (var i = 0; i < this.markers.length; i++) {
      this.markers[i].setMap(map);
    }
  }
};
