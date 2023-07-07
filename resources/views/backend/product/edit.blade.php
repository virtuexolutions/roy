@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.update',$product->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input  type="text" name="title" placeholder="Enter title"  value="{{$product->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Type <span class="text-danger">*</span></label>
          <input  type="text" name="type" placeholder="Enter type"  value="{{$product->type}}" class="form-control">
          @error('type')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">SKU <span class="text-danger">*</span></label>
          <input  type="text" name="sku" placeholder="Enter sku"  value="{{$product->sku}}" class="form-control">
          @error('sku')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Designer <span class="text-danger">*</span></label>
          <input  type="text" name="designer" placeholder="Enter Designer"  value="{{$product->designer}}" class="form-control">
          @error('designer')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Gender <span class="text-danger">*</span></label>
          <input  type="text" name="gender" placeholder="Enter Gender"  value="{{$product->gender}}" class="form-control">
          @error('gender')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
       
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Year Introduced <span class="text-danger">*</span></label>
          <input  type="text" name="year_introduced" placeholder="Enter Year Introduced"  value="{{$product->year_introduced}}" class="form-control">
          @error('year_introduced')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Recommended Use <span class="text-danger">*</span></label>
          <input  type="text" name="recommended_use" placeholder="Enter Recommended Use"  value="{{$product->recommended_use}}" class="form-control">
          @error('recommended_use')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">MSRP <span class="text-danger">*</span></label>
          <input  type="text" name="msrp" placeholder="Enter Recommended Use"  value="{{$product->msrp}}" class="form-control">
          @error('msrp')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">URL <span class="text-danger">*</span></label>
          <input type="text" name="url" placeholder="Enter url"  value="{{$product->url}}" class="form-control">
          @error('url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Upc <span class="text-danger">*</span></label>
          <input type="text" name="upc" placeholder="Enter upc"  value="{{old('upc')}}" class="form-control">
          @error('upc')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" onchange="sub_cat()" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>
        
        
        <div class="form-group" id=''>
          <label for="parent_id">Sub Category</label>
          <select name="sub_cat_id" onchange="child_cat()" id="sub_category" class="form-control">
            @if($product->sub_cat_info)
              <option value="{{$product->sub_cat_info->id}}">{{$product->sub_cat_info->title}}</option>
              @endif
          </select>
        </div>
        
        <div class="form-group" id=''>
          <label for="parent_id">Child Category</label>
          <select name="child_cat_id" id="child_category" class="form-control">

            @if($product->child_cat_info)
              <option value="">{{$product->child_cat_info->title}}</option>
              @endif
          </select>
        </div>
        
        <div class="form-group">
          <label for="price" class="col-form-label">Price<span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{$product->wholsale_price}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="brand_id">Brand</label>
          {{-- {{$brands}} --}}
		      <select id="brand_id" class="form-control" name="brand_id">
              <option value="{{$product->brand_id}}">{{$product->brands->title}}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{$product->stock}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="description" class="col-form-label">Note</label>
          <textarea class="form-control" id="summary" name="notes">{{$product->notes}}</textarea>
          @error('notes')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>        
        
        

        
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Large Image <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                  <i class="fas fa-image"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="large_image" value="{{$product->large_image}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;">
          <img src="{{$product->large_image}}" width="150" alt=""></div>
          @error('large_image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <br>	
        <br>	
        
        
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Small Image <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfmm" data-input="thumbnaill" data-preview="holderr" class="btn btn-primary text-white">
                  <i class="fas fa-image"></i> Choose
                  </a>
              </span>
              <input id="thumbnaill" class="form-control" type="text" name="large_image" value="{{$product->small_image}}">
          </div>
          <div id="holderr" style="margin-top:15px;max-height:100px;">
            <img src="{{$product->small_image}}" width="150" alt=""></div>
          </div>
          @error('large_image')
            <span class="text-danger">{{$message}}</span>
          @enderror
          <br><br>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Active</option>
            <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Inactive</option>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')

<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');
    $('#lfmm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 100
      });
  
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
</script>


<script>
   function sub_cat()
  {
    var parentCategoryId = $('#cat_id').val();
    // alert(parentCategoryId);
    var childCategorySelect = document.getElementById('sub_category');
    childCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';
    
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
    getbrand(parentCategoryId);
  }

  function getbrand(parentCategoryId){
		var brandSelect = document.getElementById('brand_id');
	 
	brandSelect.innerHTML = '<option value="">Select Brand</option>';
	var brandurl = '/admin/fetch_brand/' + parentCategoryId;
     //alert(brandurl);
	fetch(brandurl)
    .then(responsee => responsee.json())
    .then(data => {
        // Populate the child category select options
        data.forEach(function (brand) {
            var brandoption = document.createElement('option');
            brandoption.value = brand.id;
            brandoption.text = brand.title;
            brandSelect.appendChild(brandoption);
        });
    });
	}

  // show child category
  function child_cat()
  {
    var parentCategoryId = $('#sub_category').val();
    var childCategorySelect = document.getElementById('child_category');
      
    childCategorySelect.innerHTML = '<option value="">Select Child Category</option>';
    if (parentCategoryId) 
    {
      var url = '/admin/child_categries/' + parentCategoryId;

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