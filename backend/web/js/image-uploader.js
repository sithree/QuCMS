'use strict';
(function($) {
    function ImageUploader(widget) {
        this.self = this;
        this.widget = widget;
        this.progressBar = widget.find('.progress-bar');

        this.send = function(e, data) {
            progressBar.fadeIn();
        };

        this.always = function(e, data) {
            progressBar.fadeOut().css('width', '0%');
        };

        this.progress = function(e, data) {
            progress = parseInt(data.loaded / data.total * 100, 10);
            progressBar.css('width', progress + '%');
        };
    }

    var methods = {
        init: function(options) {
            //settings.self = this;
            //settings.files = this.find(settings.filesSelector);
            //settings.tmp = $(settings.template);
            return this.each(function() {
                var
                        $this = $(this),
                        input = $this.find('image-uploader'),
                        imageUploader = $.extend(new ImageUploader($this), options);
                //input.data('imageUploader', settings);
                input.fileupload({
                    dataType: 'json',
                    singleFileUploads: false,
                    send: imageUploader.send,
                    always: imageUploader.always,
                    progressall: imageUploader.progress
                });

//                if (input.attr('multiple') === 'multiple') {
//                    settings.files.sortable({
//                        opacity: 0.6,
//                        cursor: 'move'
//                                //handle: "img"
//                    });
//                    settings.files.disableSelection();
//                }
            });
        },
        destroy: function() {
            return this;
        }
    };

    $.fn.imageUploader = function(method) {
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Метод с именем ' + method + ' не существует для jQuery.imageUploader');
        }
    };

    var addImage = function(e, data) {
        var
                $this = $(this),
                settings = $this.data('imageUploader'),
                container = settings.tmp.clone(),
                image = container.find(settings.imageSelector).removeAttr('id'),
                label = container.find(settings.labelSelector).removeAttr('id'),
                _delete = container.find(settings.deleteButtonSelector).removeAttr('id');
        data.context = container;
        $.each(data.files, function(index, file) {
            label.text(file.name);
            if ($this.attr('multiple') !== 'multiple') {
                settings.files.children().remove();
            }

            if (settings.templateOptions.renameIds) {
                settings.templateOptions.renameIds(container.find('form'), 10);
            }

            settings.files.append($('<li/>').append(container));

            if (settings.templateOptions.initForm) {
                settings.templateOptions.initForm(container.find('form'), 10);
            }

            _delete.on('click.imageUploader', function() {
                container.remove();
            });

            container.find('form').on('submit', function() {
                var fmdata = $(this).yiiActiveForm('data');
                if (!fmdata.validated) {
                    return false;
                }
                fmdata.validated = fmdata.submitting = false;
                data.submit();
            });
        });
    };

}
)(jQuery);


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
                // _container.find('.files').sortable('refresh');
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