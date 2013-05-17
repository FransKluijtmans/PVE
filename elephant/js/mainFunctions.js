/**
 * Vanilla Masonry v1.0.5
 * Dynamic layouts for the flip-side of CSS Floats
 * http://vanilla-masonry.desandro.com
 *
 * Licensed under the MIT license.
 * Copyright 2012 David DeSandro

  $(function(){
	var $container = $('.thumbnails');
	$container.imagesLoaded( function(){
		$container.masonry({
			itemSelector : '.masonry-box',
			//isFitWidth: true,
			columnWidth: 100
			//columnWidth: function( containerWidth ) {
			//    return containerWidth / 7;
			//  }
		});
	});
}); */
//$(document).ready(function() {
	if ($('#Admin_wachtwoord').length) { // implies *not* zero
		$('#Admin_wachtwoord').passwordCheck();
	}
	
	$(document).bind('dragover', function (e) {
        var dropZone = $('#dropzone'),
        timeout = window.dropZoneTimeout;
        if (!timeout) {
            dropZone.addClass('in');
        } else {
            clearTimeout(timeout);
        }

        if (e.target === dropZone[0]) {
            dropZone.addClass('hover');
        } else {
            dropZone.removeClass('hover');
        }

        window.dropZoneTimeout = setTimeout(function () {
            window.dropZoneTimeout = null;
            dropZone.removeClass('in hover');
        }, 100);
    });
	$(document).bind('drop dragover', function (e) {
        e.preventDefault();
    });

    //checkall functionality
    $("table").children( "thead" ).delegate("#checkedRow_all", "change", function(){
    //$("#checkedRow_all").change(function(){
        alert('aa');
        if($(this).is(':checked')) {
            $("input[type='checkbox']:not(:checked)").attr("checked", true);
            //$(this).attr("checked", true);
            //$("input[type='checkbox']").parent().parent().css('background-color', '#88cfff');
        }else{
            $("input[type='checkbox']:checked").removeAttr("checked");
            //$(this).removeAttr("checked");
            //$("input[type='checkbox']").parent().parent().stop(true, true).effect();
            //$("input[type='checkbox']").parent().parent().css('background-color', 'inherit');
        } 

    });

//});

    jQuery(document).on('click','#buttonAddMediaArtivity',function() {
        var idMediaItem = $('.selectedThumb').attr('id');
        var idMedia = $('#optionid').val();
        $('#'+idMedia).val(idMediaItem);

        
        if(!confirm('Weet je zeker dat je '+$(this).parent().parent().children(':nth-child(1)').text()+' wil toevoegen aan deze optie?')) return false;
        var th = this,
        afterDelete = function(link,success,data){ if(success) $("#statusMsg").html(data); };
        jQuery('#leden-grid').yiiGridView('update', {
            type: 'POST',
            url: jQuery(this).attr('href'),
            success: function(data) {
                jQuery('#leden-grid').yiiGridView('update');
                afterDelete(th, true, data);
            },
            error: function(XHR) {
                return afterDelete(th, false, XHR);
            }
        });
        return false;
    }); 
    //buttonAddMediaArtivity