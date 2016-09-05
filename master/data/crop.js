jQuery(document).ready(function($)
{
	var preview_size = [1140, 560],
		aspect_ratio = preview_size[0] / preview_size[1],
			
		$image = $(".img-container img"),
		$x = $("#img-1-x"),
		$y = $("#img-1-y"),
		$w = $("#img-1-w"),
		$h = $("#img-1-h");

	
	// Plugin Initialization
	$image.cropper({
		aspectRatio: aspect_ratio,
		preview: '#img-preview',
		done: function(data)
		{
			$x.text( data.x );
			$y.text( data.y );
			$w.text( data.width );
			$h.text( data.height );
		}
	});
	
	// Preview Image Setup (based on defined crop width and height
	$("#img-preview").css({
		width: preview_size[0] / 4,
		height: preview_size[1] / 4
	});
	

/*	
	$("#crop-img").on('click', function(ev)
	{
		ev.preventDefault();
		window.open($(this).attr('href') + "?x=" + $x.text() + "&y=" + $y.text() + "&w=" + $w.text() + "&h=" + $h.text() + "&tw=" + preview_size[0] + "&th=" + preview_size[1] );

	});
*/


	var imagemurl = $('#sliderurl').val();
	var sliderid 	= $('#sliderid').val();

	$("#crop-img").on('click', function(ev)
	{

		ev.preventDefault();
		$.ajax({
			url: 'data/crop-image.php',
			type: 'POST',
			data: 'urlimg=' + imagemurl + '&x=' + $x.text() + '&y=' + $y.text() + '&w=' + $w.text() + '&h=' + $h.text() + '&tw=' + preview_size[0] + '&th=' + preview_size[1],
			success: function(rpt){
				//location.reload();
				window.location='painel.php?exe=slider/index';
				//alert(rpt);
			}

		});		

	});

	

});


