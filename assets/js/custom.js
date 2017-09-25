jQuery(document).ready(function($) {
	$('.navicon').click(function(){
		if($('.main-wrapper').hasClass('open-menu')) {
			$('.main-wrapper').removeClass('open-menu').css({'width':'100%'});
				$('.mobile-menu-wrap').hide();
		} else {
			$('.main-wrapper').addClass('open-menu').width($(window).width());
			$('.mobile-menu-wrap').show();
		}
	});
	$('.toggle-check .per-plan-checkbox-box').click(function(){
		if ($(this).children('i.fa').hasClass('checked')) {
			$(this).children('i.fa').removeClass('checked');
		} else {
			$(this).children('i.fa').addClass('checked');
                        
		}
	});
        
//        console.log('ok');
        $("#frm1").submit(function(e) {
//            alert("hello");
//            e.preventDefault();
             $("i.checked").each(function(){
//                alert($(this).attr('data-attr'));
//                $("input:text").val($(this).attr('data-attr'));
                var option_val = '<input name="option_id[]" value="' + $(this).attr('data-attr') + '">';
                        //console.log(option_val);
                $('#case_id').append(option_val);
            });
        });
});

