'use strict';
$(function() {
//    var showPreview = function(coords)
//    {
//        var rx = 100 / coords.w;
//        var ry = 100 / coords.h;
//        $('#preview').css({
//            width: Math.round(rx * 500) + 'px',
//            height: Math.round(ry * 370) + 'px',
//            marginLeft: '-' + Math.round(rx * coords.x) + 'px',
//            marginTop: '-' + Math.round(ry * coords.y) + 'px'
//        });
//    };

//    $('#fileupload').on('change', function(e) {
//        var container = $('<div/>');
//        loadImage(
//                e.target.files[0],
//                function(img) {
//                    container.append(img);
//                    $('#files-test').append(container);
//                    $(img).Jcrop({
//                        onChange: showPreview,
//                        onSelect: showPreview,
//                        aspectRatio: 1
//                    });
//                    container.append(loadingImage);
//                },
//                {
//                    maxWidth: 600,
//                    canvas: true
//                }
//        );
//        loadImage(
//                e.target.files[0],
//                function(img) {
//                    $(img).attr('id', 'preview');
//                    $('<div style="width: 100px; height: 100px; overflow: hidden; margin-left: 5px;">')
//                            .append(img)
//                            .appendTo(container);
//                },
//                {
//                    maxWidth: 600
//                }
//        );
//        $('#files-test').append(container);
//    });

    var sections = eval($('#fileupload').data('SectionName'));

    $('#sendall').click(function() {
        var files = [];
        $('#files').children().each(function(index, div) {
            var _div = $(div);
            files.push(_div.data().files[_div.data('index')]);
        })
        $('#fileupload').fileupload('send', {files: files});
    })

    $('#files').on('mouseenter', '.uploadcontainer', function() {
        $(this).find('.buttons').fadeIn('fast');
    });

    $('#files').on('mouseleave', '.uploadcontainer', function() {
        $(this).find('.buttons').fadeOut('fast');
    });

    $('#files').on('click', '.upload', function() {
        var
                _this = $(this),
                parent = _this.parents('.uploadcontainer'),
                data = parent.data();
        data.formData = {
            title: parent.find('textarea').val()
        };
        $('.progress').fadeIn();
        data.submit();
        _this.remove();
    });

    $('#files').on('click', '.delete', function() {
        var
                container = $(this).parents('.uploadcontainer'),
                parent = container.parent();
        parent.data().abort();
        parent.splice(container.data('index'));
        if (parent.children().length = 1) {
            parent.remove();
        }
        else {
            container.remove();
        }
    });

    var ImageContainerTemplate = $('<div class="uploadcontainer clearfix"/>')
            .append(
                    $('<div class="img-thumbnail"/>'),
                    $('<div class="summary"/>')
                    .append($('<textarea class="form-control" name="image[title]"/>')));

    $('#fileupload').fileupload({
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        singleFileUploads: false,
    }).on('fileuploadadd', function(e, data) {
        var item = $('<div/>');
        data.context = item;
        $.each(data.files, function(index, file) {
            var container = ImageContainerTemplate.clone(true);
            loadImage(
                    file,
                    function(img) {
                        var
                                _img = $(img),
                                imgContainer = container.find('.img-thumbnail'),
                                fileName = file.name;
                        container.find('textarea').height(_img.height() - 12);
                        imgContainer.append(_img);
                        if (fileName.length > 9) {
                            fileName = fileName.substr(0, 5) + '~' + fileName.substr(-4, 4);
                        }
                        imgContainer.append($('<span class="label label-primary"/>').text(fileName));
                        imgContainer.append($('<div class="buttons"/>').append($('<button class="btn btn-danger btn-xs delete"/>')
                                .append($('<i class="fa fa-minus"></i>')))
                                .append($('<button class="btn btn-primary btn-xs upload"/>')
                                        .append($('<i class="fa fa-upload"></i>')))
                                );
                    },
                    {
                        maxWidth: 100,
                        maxHeight: 100
                    });
            container.data('index', index);
            item.append(container);
        });
        $('#files').append(item.data(data));
    }).on('fileuploadprocessalways', function(e, data) {
        var index = data.index,
                file = data.files[index],
                node = $(data.context.children()[index]);
        if (file.preview) {
            node
                    .prepend('<br>')
                    .prepend(file.preview);
        }
        if (file.error) {
            node
                    .append('<br>')
                    .append($('<span class=\"text-danger\"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                    .text('Upload')
                    .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function(e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('.progress-bar').css(
                'width',
                progress + '%'
                );
    }).on('fileuploaddone', function(e, data) {
        $('.progress').fadeOut(function() {
            $('.progress-bar').css('width', '0%');
        });
        $.each(data.result.files, function(index, file) {
            if (file.url) {
                var link = $('<a>')
                        .attr('target', '_blank')
                        .prop('href', file.url);
                $(data.context.children()[index])
                        .wrap(link);
            } else if (file.error) {
                var message = $('<div class="alert alert-danger" style="display: none;"/>');
                $('#messages').append(message
                        .append($('<span/>').text(file.name + ': ' + file.error)).fadeIn(function() {
                    setTimeout(function() {
                        message.fadeOut(function() {
                            message.remove();
                        });
                    }, 5000);
                }));
            }
        });
    }).on('fileuploadfail', function(e, data) {
        $.each(data.files, function(index, file) {
            $(data.context).append($('<div class="alert alert-danger"/>')
                    .append('<span/>').text('Не удалось отправить файл - ' + file.Name));
        });
    }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
});