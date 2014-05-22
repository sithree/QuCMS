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

    //svar sections = eval($('#fileupload').data('SectionName'));

    //Отправка всех файлов
    $('.sendall').click(function() {
        $(this).parents('.fileupload-widget').find('.uploadcontainer').each(function(index, div) {
            var
                    _div = $(div);
            if (!_div.data('submited'))
                _div.data().submit();
            return false;
        });
    });
    //Отображение кнопок
    $('.files').on('mouseenter', '.uploadcontainer', function() {
        $(this).find('.buttons').fadeIn('fast');
    });
    //Скрытие кнопок
    $('.files').on('mouseleave', '.uploadcontainer', function() {
        $(this).find('.buttons').fadeOut('fast');
    });
    //отправка одного файла
    $('.files').on('click', '.upload', function() {
        $(this).parents('.fileupload-widget').find('form').yiiActiveForm('submitForm');
    });
    //удаление файла
    $('.files').on('click', '.delete', function() {
        $(this).parents('.uploadcontainer').remove();
    });
    $('.fileupload-widget').each(function(index, element) {
        var _element = $(element);
        if (_element.find('.fileupload').attr('multiple') === 'multiple') {
            _element.find('.files').sortable({
                opacity: 0.6,
                cursor: 'move',
                handle: "img",
                axis: 'y'
            });
        }
    });
    //Вывоводит уведомления
    function pushMessage(where, text) {
        where.children().remove();
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

    function validator(container) {
        container.find('form').submit(function() {
            $(this).parents('.uploadcontainer').data().submit();
            return false;
        });
        container.find('form').yiiActiveForm({
            title: {
                validateOnChange: true,
                name: 'ImageInfo[title]',
                container: '.test-title',
                input: 'input[name="ImageInfo[title]"]',
                validate: function(attribute, value, messages) {
                    yii.validation.required(value, messages, {
                        message: 'Message'
                    });
                    yii.validation.string(value, messages, {
                        skipOnEmpty: true,
                        message: 'Message',
                        max: 255,
                        tooLong: "Слишком длинно"
                    });
                }},
            source: {
                validateOnChange: true,
                name: 'ImageSource[source]',
                container: '.test-source',
                input: 'input[name="ImageSource[source]"]',
                validate: function(attribute, value, messages) {
                    yii.validation.string(value, messages, {
                        skipOnEmpty: true,
                        message: 'Message',
                        max: 255,
                        tooLong: "Слишком длинно"
                    });
                }},
            url: {
                validateOnChange: true,
                name: 'ImageSource[url]',
                container: '.test-url',
                input: 'input[name="ImageSource[url]"]',
                validate: function(attribute, value, messages) {
                    yii.validation.url(value, messages, {
                        skipOnEmpty: true,
                        message: 'Message',
                        defaultScheme: true,
                        //enableIDN: true
                    });
                    yii.validation.string(value, messages, {
                        skipOnEmpty: true,
                        message: 'Message',
                        max: 512,
                        tooLong: "Слишком длинно"
                    });
                }},
            author: {
                validateOnChange: true,
                name: 'ImageSource[author]',
                container: '.test-author',
                input: 'input[name="ImageSource[author]"]',
                validate: function(attribute, value, messages) {
                    yii.validation.string(value, messages, {
                        skipOnEmpty: true,
                        message: 'Message',
                        max: 255,
                        tooLong: "Слишком длинно"
                    });
                }},
        }, {
            errorCssClass: 'has-error',
            successCssClass: 'has-success',
            afterValidate: function($form, attribute, message) {
                if (message.undefined !== undefined)
                    pushMessage($form.find('.messages'), message.undefined[0]);
            }
        });
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
                            .append($('<div class="form-group test-title"/>')
                                    .append($('<input class="form-control input-sm" name="ImageInfo[title]" placeholder="комментарий"/>')))
                            .append($('<div class="form-group test-source"/>')
                                    .append($('<input class="form-control input-sm" name="ImageSource[source]" placeholder="источник"/>')))
                            .append($('<div class="form-group test-url"/>')
                                    .append($('<input class="form-control input-sm" name="ImageSource[url]" placeholder="url"/>')))
                            .append($('<div class="form-group test-author"/>')
                                    .append($('<input class="form-control input-sm" name="ImageSource[author]" placeholder="автор"/>')))
                            .append($('<div class=sections/>'))
                            .append($('<div class=messages/>'))
                            ));
    $('.fileupload-widget').each(function(index, div) {
        var
                _div = $(div),
                _form = $(_div.data('formselector')),
                container = $('<div/>'),
                data = _div.data();
        _form.append(container);
        _form.submit(function() {
            container.children().remove();
            _div.find('.uploadcontainer').each(function(index, image) {
                if (!$(image).data('submited')) {
                    //return false;
                }
                container.append($('<input/>')
                        //.attr('hidden', 'hidden')
                        .attr('name', data.object + '[' + data.property + '][]').val($(image).data().files[0].name));
            });
            return false;
        });
    });
    //Инициализация плагина
    $('.fileupload').fileupload({
        dataType: 'json',
        autoUpload: false //Отправка только ручками
                //добавление файлов
    }).on('fileuploadadd', function(e, data) {
        var
                _this = $(this),
                _container = _this.parents('.fileupload-widget');
        $.each(data.files, function(index, file) {
            if (!file.type.length || !(/^image\/(gif|jpe?g|png)$/i).test(file.type)) {
                pushMessage(_container.find('.messages'), file.name + ': Выбран не верный формат.');
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
            if (_this.attr('multiple') !== 'multiple') {
                _container.find('.uploadcontainer').remove();
            }
            _container.find('.files').append(container.data(data));
            validator(container);

            var sectionContainer = container.find('.sections');
            _container.data('settings').sections.forEach(function(section) {
                sectionContainer.append($('<input hidden name="sections[]"/>').val(section));
            });

            if (_this.attr('multiple') === 'multiple') {
                _container.find('.files').sortable('refresh');
            }
        });
    }).on('fileuploadsubmit', function(e, data) {
        
        if (!$(this).parents('.fileupload-widget').find('form').yiiActiveForm('data').validated) {
            return false;
        }
        $(this).parents('.fileupload-widget').find('.progress').fadeIn();
        data.context.find('.upload').css('display', 'none');
        //Отправка дополнительных данных
        data.formData = data.context.find('form').serializeArray();
    }).on('fileuploadprogressall', function(e, data) {
        var
                progress = parseInt(data.loaded / data.total * 100, 10),
                _container = $(this).parents('.fileupload-widget');
        _container.find('.progress-bar').css(
                'width',
                progress + '%'
                );
        //при полном прогрессе скрываем progressbar
        if (progress === 100) {
            _container.find('.progress').fadeOut(function() {
                _container.find('.progress-bar').css('width', '0%');
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
    $('.fileupload').each(function(index, element) {
        var _fileUpload = $(element);
        _fileUpload.fileupload('option', 'dropZone', _fileUpload.parents('.fileupload-widget'));
    });
});