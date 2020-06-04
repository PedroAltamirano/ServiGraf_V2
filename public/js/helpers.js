$(document).on('change', '.fixFloat', function(){
  $(this).val(parseFloat($(this).val()).toFixed(2));
});

$(document).on('click', '.removeRow', function(){
  var button_id = $(this).attr("id");   
  $('#row-'+button_id+'').remove();  
});  