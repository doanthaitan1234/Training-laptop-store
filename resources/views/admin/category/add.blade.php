<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="actionCagoryModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Create') }} {{ __('Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="category-create">
                    <div class="form-group">
                        <label for="name" class="col-form-label">{{ __('Category Name') }}</label>
                        <input name="name" type="text" class="form-control add-name-input"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btnAdd">{{ __('Add') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
