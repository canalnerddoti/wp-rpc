var image_field;
var ad_field;
var image_preview;
jQuery( document ).ready( function($) {
	//about me widget
	$(document).on('click', 'button.about-me-photo', function(){
        image_field = $('.photo-url');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

        window.send_to_editor = function(html) {
	        imgurl = $('img', html).attr('src');
	        image_field.val(imgurl);	        
	        tb_remove();
	    }	
        return false;
    });
    
    
});
