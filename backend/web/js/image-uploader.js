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

    //Отправка всех файлов
    $('#sendall').click(function() {
        $('#files').children().each(function(index, div) {
            var
                    _div = $(div);
            if (!_div.data('submited'))
                _div.data().submit();
        })
    })

    //Отображение кнопок
    $('#files').on('mouseenter', '.uploadcontainer', function() {
        $(this).find('.buttons').fadeIn('fast');
    });

    //Скрытие кнопок
    $('#files').on('mouseleave', '.uploadcontainer', function() {
        $(this).find('.buttons').fadeOut('fast');
    });

    //отправка одного файла
    $('#files').on('click', '.upload', function() {
        $(this).parents('.uploadcontainer').data().submit();
    });

    //удаление файла
    $('#files').on('click', '.delete', function() {
        $(this).parents('.uploadcontainer').remove();
    });

    $("#files").sortable({
        opacity: 0.6,
        cursor: 'move',
        handle: "img",
        axis: 'y'
    });

    //Вывоводит уведомления
    function pushMessage(where, text) {
        var message = $('<div class="alert alert-danger" style="display: none;"/>');
        $(where).append(message
                .append($('<span/>').text(text)).fadeIn(function() {
            setTimeout(function() {
                message.fadeOut(function() {
                    message.remove();
                });
            }, 5000);
        }));
    }

    //Шаблон контейнера
    var ImageContainerTemplate = $('<div class="uploadcontainer clearfix"/>')
            .append($('<div class="img-thumbnail"/>')
                    .append($('<span class="label label-primary"/>'))
                    .append($('<div class="buttons"/>')
                            .append($('<button class="btn btn-danger btn-xs delete"/>')
                                    .append($('<i class="fa fa-minus"></i>')))
                            .append($('<button class="btn btn-primary btn-xs upload"/>')
                                    .append($('<i class="fa fa-upload"></i>')))))
            .append($('<div class="summary"/>')
                    .append($('<form/>')
                            .append($('<div class="form-group"/>')
                                    .append($('<input class="form-control input-sm" name="File[title]" placeholder="комментарий"/>')))
                            .append($('<div class="form-group"/>')
                                    .append($('<input class="form-control input-sm" name="File[source]" placeholder="источник"/>')))
                            .append($('<div class="form-group"/>')
                                    .append($('<input class="form-control input-sm" name="File[url]" placeholder="url"/>')))
                            .append($('<div class="form-group"/>')
                                    .append($('<input class="form-control input-sm" name="File[author]" placeholder="автор"/>')))
                            ));


    //Инициализация плагина
    $('#fileupload').fileupload({
        dataType: 'json',
        autoUpload: false //Отправка только ручками
                //добавление файлов
    }).on('fileuploadadd', function(e, data) {
        $.each(data.files, function(index, file) {
            if (!file.type.length || !(/^image\/(gif|jpe?g|png)$/i).test(file.type)) {
                pushMessage('#messages', file.name + ': Выбран не верный формат.');
                return false;
            }
            var container = ImageContainerTemplate.clone(true);
            data.context = container;
            //генерация preview
            loadImage(
                    file,
                    function(img) {
                        var
                                span = container.find('.img-thumbnail span');
                        $(img).insertBefore(span.text(file.name));
                    },
                    {
                        maxWidth: 300,
                        maxHeight: 255
                    });
            $('#files').append(container.data(data));
            $('#files').sortable('refresh');
        });

    }).on('fileuploadsubmit', function(e, data) {
        //Проверка комментария
        var
                input = data.context.find('input[name="File[title]"]');
        if (input.val() === '') {
            data
            input.parent().addClass('has-error');
            pushMessage(data.context.find('.summary'), 'Необходимо заполнить комментарий');
            return false;
        }
        $('.progress').fadeIn();
        
        input.parent().removeClass('has-error');
        data.context.find('.upload').css('display', 'none');
        //Отправка дополнительных данных
        data.formData = data.context.find('form').serializeArray();

    }).on('fileuploadprogressall', function(e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('.progress-bar').css(
                'width',
                progress + '%'
                );
        //при полном прогрессе скрываем progressbar
        if (progress === 100) {
            $('.progress').fadeOut(function() {
                $('.progress-bar').css('width', '0%');
            });
        }

    }).on('fileuploaddone', function(e, data) {
        if (data.result.error) {
            data.context.find('.upload').css('display', 'inline');
            pushMessage(data.context.find('.summary'), data.result.name + ': ' + data.result.error);
        } else {
            data.context.data('submited', true);
        }

    }).on('fileuploadfail', function(e, data) {
        $.each(data.files, function(index, file) {
            data.context.find('.upload').css('display', 'inline');
            pushMessage(data.context.find('.summary'), file.name + ': ' + file.error);
        });

    }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
});