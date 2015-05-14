(function( $ ) {
  'use strict';
  $(document).ready(function($){
    $('.wx-color-picker').wpColorPicker({
      palettes: false,
      mode: 'hsv',
      controls: {
        horiz: 'v', 
        vert: 's',
        strip: 'h'
      },
    });
    $('#wx-type').change(function(){
      if($(this).val() == 'embed') {
        $('.wx-type-options').hide();
      }
      else {
        $('.wx-type-options').show();
      }
    });
  });  
})( jQuery );
function wx_add_shortcode() 
{
  var url = jQuery('#wx-url').val();
  var type = jQuery('#wx-type').val();
  var buttonText = jQuery('#wx-button-text').val();
  var buttonText = jQuery('#wx-button-text').val();
  var buttonColor = jQuery('#wx-button-color').val();
  var buttonBackground = jQuery('#wx-button-background').val();
  
  var error = '';
  if(!url) {
    error += 'Please enter a valid url.\n';
  }
  if(type !== 'embed' && buttonText === '') {
    error += 'Please enter some text for the button\n';
  }
  
  if(error !== '') {
    alert(error);   
  }
  else {
    tinymce.execCommand('mceInsertContent',false,'[wxform url="'+url+'" type="'+type+'" bg="'+buttonBackground+'"  fg="'+buttonColor+'"]'+buttonText+'[/wxform]');
    tb_remove();
  }
}