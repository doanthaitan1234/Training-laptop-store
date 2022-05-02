<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit') }} {{ __('Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="col-form-label">{{ __('Category Name') }}
                        </label>
                    <input name="name" type="text" class="form-control edit-name-input" 
                         maxlength="200">
                        <div class="alert alert-danger name-error d-none"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btnUpdate">{{ __('Update') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
