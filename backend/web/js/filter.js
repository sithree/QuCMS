//$(document).on('mouseout', '.condition-block', function() {
//$(this).removeClass('hover');
//});
$(function() {
    $('#filter').mouseover(function(e) {
        var target = $(e.target);
        if (!target.is('.condition, .condition-block')) {
            target = $(e.target).parents('.condition, .condition-block').first();
        }
        if (!target.is('.hover')) {
            $('.condition-block.hover').removeClass('hover');
            target.addClass('hover');
        }
    });
    $('.condition-block .items').sortable({
        opacity: 0.6,
        cursor: 'move',
        placeholder: 'drop-placeholder',
        connectWith: '.condition-block .items'
    });
});

