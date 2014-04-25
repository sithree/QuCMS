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
    $('#sidebar-menu a+ul').prev().click(function() {
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
        if ($(this).closest('li').find('ul').children().length === 0) {
            return true;
        } else {
            return false;
        }
    });

    $('#sidebar-menu a[href!="#"]').click(function() {
        $('#sidebar-menu li').removeClass('active');
        $(this).parents('li').addClass('active');
    });

    function toPage(link, pushState, data, method) {
        //$("#loading").fadeIn("fast");
        $.ajax({
            success: function(result) {
                if (result.status === 200) {
                    $('.body.content.rows.scroll-y').html(result.html);
                    //$("#loading").fadeOut("fast");

                    if (pushState) {
                        history.pushState(null, result.title, result.url);
                    }
                    $.ajax({
                        success: function(result) {
                            $('#yii-debug-toolbar').replaceWith(result);
                        },
                        url: result.debug,
                        cache: false
                    });
                }
                else if (result.status === 302)
                    toPage(result.url, true, '', 'GET');
            },
            dataType: 'json',
            url: link,
            cache: false,
            type: method,
            data: data
        });
    }

    window.onpopstate = function() {
        toPage(document.location, false, '', 'GET');
    };

    $(document).on('click', 'a:not(.noajax)'// .grid-view thead a, .grid-view .pagination a'
            , function() {
                var link = $(this).attr('href');
                toPage(link, true, '', 'GET');
                return false;
            });

    $(document).on('click', 'button.ajax', function() {
        form = $(this).parents('form');
        action = form.attr('action');
        toPage(action === '' ? document.location : action, $(this).data('history'), form.serialize(), form.attr('method'));
        return false;
    });


});