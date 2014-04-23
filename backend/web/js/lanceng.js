$(document).ready(function() {
    $(window).load(function() {
        $("#loading").fadeOut("slow");
    });

    $('.slimscroller').slimscroll({
        height: 'auto',
        size: '3px',
        railOpacity: 0.3,
        wheelStep: 5
    });

//	//TOOLTIP
//	$('.tooltips').tooltip({
//	  selector: "[data-toggle=tooltip]",
//	  container: "body"
//	})

//	//RESPONSIVE SIDEBAR
    $("button.show-sidebar").click(function() {
        $("div.left").toggleClass("mobile-sidebar");
        $("div.right").toggleClass("mobile-content");
        $("div.logo-brand").toggleClass("logo-brand-toggle");
    });

    //$('#sidebar-menu .dropdown-menu').removeClass('dropdown-menu');

    //SIDEBAR MENU
    $('#sidebar-menu a[href="#"]').click(function() {
        $('#sidebar-menu li').removeClass('selected');
        $(this).closest('li').addClass('selected');
        var checkElement = $(this).next();
        if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('selected');
            checkElement.slideUp('fast');
        }
        if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('#sidebar-menu ul ul:visible').slideUp('fast');
            checkElement.slideDown('fast');
        }
        if ($(this).closest('li').find('ul').children().length == 0) {
            return true;
        } else {
            return false;
        }
    });

    function toPage(link, pushState) {
        $("#loading").fadeIn("fast");
        $.ajax({
            'success': function(result) {
                $('.container.body.content.rows.scroll-y').html(result.html);
                $("#loading").fadeOut("fast");
                if (pushState){
                    history.pushState(null, result.title, link);
                }
            },
            dataType: 'json',
            'url': link,
            'cache': false
        });
    }

    window.onpopstate = function() {
        toPage(document.location, false);
    };

    $('#sidebar-menu a[href!="#"]').click(function() {
        var link = $(this).attr('href');        
        toPage(link, true);
        return false;
    });


});