@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Category</h5>
    <div class="card-body">
      <form method="post" action="{{route('child_category.update',$category->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$category->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        {{-- {{$category}} --}}

      <div class="form-group" id='parent_cat_div'>
          <label for="parent_id">Parent Category</label>
          <select name="cat_id" id="cat_id" class="form-control" onchange="sub_cat()">
              <option value="">--Select any category--</option>
              @foreach($parent_cats as $key=>$parent_cat)
              
                  <option value='{{$parent_cat->id}}' {{(($parent_cat->id==$category->cat_id) ? 'selected' : '')}}>{{$parent_cat->title}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group" id=''>
          <label for="parent_id">Sub Category</label>
          <select name="sub_cat_id" id="sub_category" class="form-control">
            @if($category->sub_cat_info)
              <option value="{{$category->sub_cat_info->id}}">{{$category->sub_cat_info->title}}</option>
              @endif
          </select>
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo</label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
              <input id="thumbnail" readonly class="form-control" type="text" name="photo" value="{{$category->photo}}">
          </div>
          <div id="holder" style="margin-top:15px;max-height:100px;">
            <img style="margin-top:15px;max-height:100px;" src="{{$category->photo}}" alt="">
          </div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active" {{(($category->status=='active')? 'selected' : '')}}>Active</option>
              <option value="inactive" {{(($category->status=='inactive')? 'selected' : '')}}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');
</script>
<script>
  function sub_cat(){
  var parentCategoryId = $('#cat_id').val();
  //alert(parentCategoryId);
        var childCategorySelect = document.getElementById('sub_category');

        // Clear the child category select options
        childCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';

        // Make an AJAX request to get the child categories
        if (parentCategoryId) {
            var url = '/admin/sub_categries/' + parentCategoryId;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Populate the child category select options
                    data.forEach(function (childCategory) {
                        var option = document.createElement('option');
                        option.value = childCategory.id;
                        option.text = childCategory.title;
                        childCategorySelect.appendChild(option);
                    });
                });
        }
}
</script>
@endpush