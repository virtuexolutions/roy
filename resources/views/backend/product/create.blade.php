@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input  type="text" name="title" placeholder="Enter title" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Type <span class="text-danger">*</span></label>
          <input  type="text" name="type" placeholder="Enter type"  value="{{old('type')}}" class="form-control">
          @error('type')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Sku <span class="text-danger">*</span></label>
          <input type="text" name="sku" placeholder="Enter sku"  value="{{old('sku')}}" class="form-control">
          @error('sku')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">designer <span class="text-danger">*</span></label>
          <input type="text" name="designer" placeholder="Enter designer"  value="{{old('designer')}}" class="form-control">
          @error('designer')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">gender <span class="text-danger">*</span></label>
          <input type="text" name="gender" placeholder="Enter gender"  value="{{old('gender')}}" class="form-control">
          @error('gender')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">year introduced <span class="text-danger">*</span></label>
          <input type="text" name="year_introduced" placeholder="Enter year introduced"  value="{{old('year_introduced')}}" class="form-control">
          @error('year_introduced')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">recommended use <span class="text-danger">*</span></label>
          <input type="text" name="recommended_use" placeholder="Enter recommended use"  value="{{old('recommended_use')}}" class="form-control">
          @error('recommended_use')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">MSRP <span class="text-danger">*</span></label>
          <input type="text" name="msrp" placeholder="Enter msrp"  value="{{old('msrp')}}" class="form-control">
          @error('msrp')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">URL <span class="text-danger">*</span></label>
          <input type="text" name="url" placeholder="Enter url"  value="{{old('url')}}" class="form-control">
          @error('url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">upc <span class="text-danger">*</span></label>
          <input type="text" name="upc" placeholder="Enter upc"  value="{{old('upc')}}" class="form-control">
          @error('upc')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id"  onchange="sub_cat()" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group " id='parent_cat_div'>
          <label for="parent_id">Sub Category</label>
          <select id="sub_cat_id"  onchange="child_cat()" class="form-control" name="sub_cat_id">
              <option value="">Select Sub Category</option>
          </select>
        </div>
        
        <div class="form-group " id='parent_cat_div'>
          <label for="parent_id">Child Category</label>
          <select id="child_category" class="form-control" name="child_cat_id">
              <option value="">Select Sub Category</option>
          </select>
        </div>

        

        <div class="form-group">
          <label for="price" class="col-form-label">Price<span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="brand_id">Brand</label>
          {{-- {{$brands}} --}}
		      <select id="brand_id" class="form-control" name="brand_id">
              <option value="">Select Brand</option>
          </select>
        </div>

        

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{old('stock')}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Note</label>
          <textarea class="form-control" id="summary" name="notes"></textarea>
          @error('notes')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>        


        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Large Image <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="large_image" value="{{old('large_image')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>


        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Small Image <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfmm" data-input="thumbnaild" data-preview="holderr" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnaild" class="form-control" type="text" name="small_image" value="{{old('small_image')}}">
        </div>
        <div id="holderr" style="margin-top:15px;max-height:100px;"></div>
          @error('small_image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
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
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
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
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
    // $('select').selectpicker();

</script>

<script>
  function sub_cat()
  {
    var parentCategoryId = $('#cat_id').val();
    var childCategorySelect = document.getElementById('sub_cat_id');
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
    var parentCategoryId = $('#sub_cat_id').val();
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