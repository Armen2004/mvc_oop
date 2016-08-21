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
        var count = 1;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            //Only pics
            if (!file.type.match('image')) continue;

            if (this.files[0].size < 2097152) {

                var picReader = new FileReader();
                picReader.addEventListener("load", function () {

                    output.append(createOptionFields(count, this.result, file.name));
                    showSlider("#slider_" + count, "#amount_" + count);
                    count++;

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
            image.addClass($(this).val());
        } else {
            image.removeClass($(this).val())
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

    $(document).on("change", ".effect-size", function () {
        console.log($(this).val())
    });

    function createOptionFields(count, image, name) {
        return '<div class="col-xs-12 effect-border" data-image-id-effects="' + count + '">' +
                    '<h2 class="text-center">Image ' + count + '</h2>' +
                    '<div class="col-xs-2">' +
                        '<div class="row"><input type="checkbox" class="img-effect" name="effect" value="blur"> Blur</div>' +
                        '<div class="row"><input type="checkbox" class="img-effect" name="effect" value="brightness"> Brightness</div>' +
                        '<div class="row"><input type="checkbox" class="img-effect" name="effect" value="contrast"> Contrast</div>' +
                        '<div class="row"><input type="checkbox" class="img-effect" name="effect" value="grayscale"> Grayscale</div>' +
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
                result.children('div').find('img[data-image-id="' + image_id + '"]').css('border-radius', ui.value);
            }
        });

        $(procents).val($(sliders).slider("value"));
    }

})
