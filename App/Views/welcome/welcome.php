<div class="container-fluid">
    <div class="row">
        <form action="/mvc_oop/" method="post" enctype="multipart/form-data">
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
    </div>
</div>