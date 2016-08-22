<div class="container-fluid">
    <div class="row">
<!--        <form action="/--><?//= BASE; ?><!--/" method="post" enctype="multipart/form-data">-->
        <form id="upload-file">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="input-group">
                    <input type="file" accept='image/*' name="file[]" multiple class="form-control" id="file" required>
                    <div class="input-group-btn">
                        <input type="submit" value="Save" name="submit" class="btn btn-primary btn-">
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <button type="button" id="clear">Clear</button>
                <div id="result"></div>
            </div>
        </form>
        <div class="col-md-12 images hidden">
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add New Style</h4>
            </div>
            <div class="modal-body">
<!--                <form action="/--><?//= BASE; ?><!--/add-new-style" method="post">-->
                <form id="newStyle">
                    <div class="form-group">
                        <input type="text" class="form-control" name="style_name" id="style_name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="style_text" id="style_text" cols="30" rows="10" placeholder="Style"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>