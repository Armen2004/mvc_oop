$(document).ready(function () {

    var result = $('#result');

    $('#clear, #result').hide();

    if (window.File && window.FileList && window.FileReader) {
        $(document).on("change", "#file", handleFileSelect);
    } else {
        console.log("Your browser does not support File API");
    }

    function handleFileSelect() {
        var files = event.target.files; //FileList object
        var output = $("#result");
        var count = 1, j = 0;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            //Only pics
            if (!file.type.match('image')) continue;

            if (this.files[0].size < 2097152) {

                var picReader = new FileReader();
                picReader.addEventListener("load", function () {

                    output.append(createOptionFields(count, this.result, files[j].name));
                    showSlider("#slider_" + count, "#amount_" + count);
                    if (files.length == count) {
                        getStyles();
                    }
                    count++;
                    j++;
                });
                //Read the image
                $('#clear, #result').show();

                picReader.readAsDataURL(file);
            } else {
                alert("Image Size is too big. Minimum size is 2MB.");
                $(this).val("");
            }
        }
    }


    $(document).on("click", "#file", function (e) {
        $('#result').html('');
        $('.effect-border').parent().remove();
        $('#result').hide();
        $('#clear').hide();
        $(this).val("");
    });

    $(document).on("click", "#clear", function () {
        $('#result').html('');
        $('.effect-border').parent().remove();
        $('#result').hide();
        $('#file').val("");
        $(this).hide();
    });

    $(document).on("change", ".img-effect", function () {
        var image_id = $(this).closest(".effect-border").data('image-id-effects');
        var image = result.children('div').find('img[data-image-id="' + image_id + '"]');
        if ($(this).is(":checked")) {
            image.css('filter', $(this).val() + "(" + $(this).data('effect-value') + ")");
            image.css('-webkit-filter', $(this).val() + "(" + $(this).data('effect-value') + ")");
        } else {
            image.css('filter', "");
            image.css('-webkit-filter', "");
        }
    });

    $(document).on("change", ".width", function () {
        var image_id = $(this).closest(".effect-border").data('image-id-effects');
        result.children('div').find('img[data-image-id="' + image_id + '"]').css('width', $(this).val());
    });

    $(document).on("change", ".height", function () {
        var image_id = $(this).closest(".effect-border").data('image-id-effects');
        result.children('div').find('img[data-image-id="' + image_id + '"]').css('height', $(this).val());
    });

    $(document).on("submit", "#upload-file", function (event) {
        event.preventDefault();
        var formData = new FormData();
        var totalFiles = $("#file").prop("files").length;
        for (var i = 0; i < totalFiles; i++) {
            formData.append(i, $("#file").prop("files")[i]);
            formData.append(i, result.children('div').find('img[title="' + $("#file").prop("files")[i].name + '"]').attr('style'));
        }

        $.ajax({
            type: "POST",
            url: location.href,
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#clear').click();
                getImages()
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $(document).on("submit", "#newStyle", function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: location.href + 'add-new-style',
            data: $('form').serialize(),
            dataType: "json",
            success: function (response) {
                $('.effects').append('<div class="row"><input type="checkbox" class="img-effect" name="effect" value="' + response.style_name.toLowerCase() + '" data-effect-name="' + response.style_name.toLowerCase() + '" data-effect-value="' + response.style_text + '">' + response.style_name + '</div>');
                $('#style_name').val('');
                $('#style_text').val('');
            },
            error: function (error) {
                console.log(error)
            }
        });
        $('#myModal').modal('hide')
    });

    getImages()

})

function createOptionFields(count, image, name) {
    return '<div class="col-xs-12 effect-border" data-image-id-effects="' + count + '">' +
        '<h2 class="text-center">Image ' + count + '</h2>' +
        '<div class="col-xs-2">' +
        '<div class="row"><a class="btn btn-success add-effect" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a></div>' +
        '<div class="effects"></div>' +
        '</div>' +
        '<div class="col-xs-10">' +
        '<div class="row">' +
        '<label class="col-xs-2 no-padding text-right">Radius ' +
        '<input id="amount_' + count + '" class="amount" readonly />' +
        '</label>' +
        '<div class="col-xs-10">' +
        '<div id="slider_' + count + '"></div>' +
        '</div>' +
        '</div>' +
        '<div class="row">' +
        '<div class="col-xs-12">' +
        '<div class="form-group">' +
        '<label for="size" class="col-xs-2 no-padding text-right">Size</label>' +
        '<div class="col-xs-5">' +
        '<input type="number" class="form-control width" placeholder="Width">' +
        '</div>' +
        '<div class="col-xs-5">' +
        '<input type="number" class="form-control height" placeholder="Height">' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="thumbnail">' +
        '<img class="img-responsive" data-image-id="' + count + '" src="' + image + '" title="' + name + '"/>' +
        '</div>';

}

function showSlider(sliders, procents) {
    $(sliders).slider({
        range: "max",
        min: 0,
        max: 100,
        value: 0,
        animate: true,
        slide: function (event, ui) {
            $(procents).val(ui.value);

            var image_id = $(this).closest(".effect-border").data('image-id-effects');
            $('#result').children('div').find('img[data-image-id="' + image_id + '"]').css('border-radius', ui.value);
        }
    });

    $(procents).val($(sliders).slider("value"));
}

function getStyles() {
    $.ajax({
        type: "POST",
        url: location.href + 'get-styles',
        dataType: "json",
        success: function (response) {
            if (response.length > 0) {
                var effects = $('.effects');
                $.each(response, function (index, value) {
                    effects.append('<div class="row"><input type="checkbox" class="img-effect" name="effect" value="' + value.style_name.toLowerCase() + '" data-effect-name="' + value.style_name.toLowerCase() + '" data-effect-value="' + value.style_text + '">' + value.style_name + '</div>');
                })
            }
        },
        error: function (error) {
            console.log(error)
        }
    });
}

function getImages(){
    $.ajax({
        type: "POST",
        url: location.href + 'get-images',
        dataType: "json",
        success: function (response) {
            var images = $('.images');
            images.html('');
            if (response.length > 0) {
                images.removeClass('hidden');
                $.each(response, function (index, value) {
                    images.append(
                        '<div class="col-md-4">' +
                            '<img class="img-responsive" src="' + value.image_path + '" style="' + value.image_style + '" title="' + value.image_name + '"/>' +
                        '</div>'
                    );
                })
            }else{
                images.addClass('hidden');
            }
        },
        error: function (error) {
            console.log(error)
        }
    });
}