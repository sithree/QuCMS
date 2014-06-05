'use strict';
(function($) {
    function ImageUploader(widgetContainer, options) {
        this.widgetContainer = widgetContainer;
        this.input = '.image-uploader';
        this.progressBar = '.progress';
        this.progressLine = '.progress-bar';
        this.files = '.files';
        this.index = 0;
        this.storagePath = location.pathname.replace(/[.//]/g, '_') + '_' + this.widgetContainer.attr('id');

        this._ctor = function() {
            var strVal = localStorage[this.storagePath];
            this.addImages(strVal === undefined ? [] : JSON.parse(strVal));
        };

        this.remove = function(container) {
            container.remove();
        };

        this.start = function(e, data) {
            this.progressLine.css('width', '0%');
            this.progressBar.show();
        }.bind(this);

        this.stop = function(e, data) {
            this.progressBar.fadeOut(2000);
        }.bind(this);

        this.progress = function(e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            this.progressLine.css('width', progress + '%');
        }.bind(this);
        
        this.changeSort = function(e, data) {
            this.save();
        }.bind(this);

        this.addImages = function(files) {
            var self = this;
            $.each(files, function() {
                if (self.input.attr('multiple') !== 'multiple' && self.files.find('li').length > 0) {
                    self.remove(self.files.find('li'));
                }
                var container = self.template.clone().hide();
                container.find(self.imageSelector).removeAttr('id').attr('src', this.url).load(function() {
                    container.show();
                });
                container.find(self.labelSelector).removeAttr('id').text(this.name);
                container.find(self.deleteButtonSelector).removeAttr('id').on('click.imageUploader', function() {
                    self.remove(container.parent());
                    self.save();
                });

                if (self.templateOptions.renameIds) {
                    self.templateOptions.renameIds(container.find('form'), self.index);
                }

                $('<li/>')
                        .data('file.imageUploader', this)
                        .append(container)
                        .appendTo(self.files);

                if (self.templateOptions.initForm) {
                    self.templateOptions.initForm(container.find('form'), self.index);
                }
                self.index++;
            });
        };

        this.save = function() {
            var
                    values = [],
                    li = this.files.find('li');
            this.files.find('li').each(function() {
                values.push($(this).data('file.imageUploader'));
            });
            localStorage[this.storagePath] = JSON.stringify(values);
        };

        this.done = function(e, data) {
            this.addImages(data.result.files);
            this.save();
        }.bind(this);

        this.fail = function(e, data) {
            alert(data);
        }.bind(this);

        $.extend(this, options);

        this.input = this.widgetContainer.find(this.input);
        this.progressBar = this.widgetContainer.find(this.progressBar);
        this.progressLine = this.widgetContainer.find(this.progressLine);
        this.files = this.widgetContainer.find(this.files);
        this.template = $(this.template);

        this.input.fileupload({
            dataType: 'json',
            singleFileUploads: false,
            start: this.start,
            stop: this.stop,
            progressall: this.progress,
            done: this.done,
            fail: this.fail
        });

        if (this.input.attr('multiple') === 'multiple') {
            this.files.sortable({
                opacity: 0.6,
                cursor: 'move',
                update: this.changeSort
                        //handle: "img"
            });
            this.files.disableSelection();
        }
        this._ctor();
        delete this._ctor;
    }

    var methods = {
        init: function(options) {
            return this.each(function() {
                new ImageUploader($(this), options);
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
        $.each(data.files, function(index, file) {
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
});