function getAllPath(){
  this.datas;
  $.ajax({
    method: "GET",
    beforeSend: function() {
      $("#loading").fadeIn(1000);
    },
    // url: "../service/get-all-path.php",
    url: "../backend/path.php",
    data: {}
  }).done(function(result) {
    $("#loading").fadeOut();
    this.datas = result;
    console.log(this.datas);
    allpasarCallback(JSON.parse(this.datas));
  });
}
