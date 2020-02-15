(function ($) {
    "use strict";
    var textarea = document.querySelector('textarea');
    $("#save_image").click(function(e){
      var logo = $('#blah-logo').attr('src');
      var iso = $('#blah-iso').attr('src');
      var service = $('#blah-service').attr('src');
      var imageData = {"logo":logo, "iso":iso, "service":service};
      if(logo ==''){
        alert('por favor seleccione la imagen del logo');
      }else if(iso ==''){
        alert('por favor seleccione imagen iso');
      }else if(service ==''){
        alert('seleccione imagen de servicio');
      }else{      
        $.ajax({
          type: 'post',
          url: 'save_image.php',
          dataType: "json",
          data: {imageData: imageData},
          success:function(data) {
            alert(data);
          }
        })
      }
    });
    // adding event to TextArea for autosize of textarea
    textarea.addEventListener('keydown', autosize);                
    function autosize(){
        var el = this;
        setTimeout(function(){
            el.style.cssText = 'height:auto; padding:0';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        },0);
    }    
})(jQuery);

function readURL_logo(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah-logo').attr('src', e.target.result);
          $('#imageOne').prop('checked', true);
          $('#imageOne').val(e.target.result);
          //console.log($('#logo-image').val())
      };
      reader.readAsDataURL(input.files[0]);
  }
}
function readURL_iso(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {   
          $('#blah-iso').attr('src', e.target.result);
          $('#imageTwo').val(e.target.result);
          $('#imageTwo').prop('checked', true);
      };

      reader.readAsDataURL(input.files[0]);
  }
}
function readURL_service(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah-service').attr('src', e.target.result);
          $('#imageThree').val(e.target.result);
          $('#imageThree').prop('checked', true);
      };
      reader.readAsDataURL(input.files[0]);
  }
}
var logo1 = $('#blah-logo').attr('src');
var iso1 = $('#blah-iso').attr('src');
var service1 = $('#blah-service').attr('src');
$('#imageOne').prop('checked', true);
$('#imageOne').val(logo1);
$('#imageTwo').val(iso1);
$('#imageTwo').prop('checked', true);
$('#imageThree').val(service1);
$('#imageThree').prop('checked', true);