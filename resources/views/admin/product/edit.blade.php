@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $product->name }}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label class="d-block">Preview</label>
                                    <img width="200px" src="{{ asset($product->thumb_image) }}" alt="">
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="thumb_image"
                                        class="form-control @error('thumb_image') is-invalid @enderror"">
                                    @error('thumb_image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Category</label>
                                            <select id="inputState" name="category_id" class="form-control main-category">
                                                <option>Select</option>
                                                @foreach ($categories as $category)
                                                    <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Sub Category</label>
                                            <select id="inputState" name="sub_category_id"
                                                class="form-control sub-category">
                                                <option>Select</option>
                                                @foreach ($subCategories as $subcategory)
                                                <option {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="inputState">Child Category</label>
                                            <select id="inputState" name="child_category_id"
                                                class="form-control child-category">
                                                <option>Select</option>
                                                @foreach ($childCategories as $childcategory)
                                                <option {{ $product->child_category_id == $childcategory->id ? 'selected' : '' }} value="{{ $childcategory->id }}">{{ $childcategory->name }}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Brand</label>
                                    <select id="inputState" name="brand_id" class="form-control">
                                        <option>Select</option>
                                        @foreach ($brands as $brand)
                                            <option {{ $product->brand_id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" name="sku" value="{{ $product->sku }}"
                                        class="form-control @error('sku') is-invalid @enderror">
                                    @error('sku')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" value="{{ $product->price }}"
                                        class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input type="text" name="offer_price" value="{{ $product->offer_price }}"
                                        class="form-control @error('offer_price') is-invalid @enderror">
                                    @error('offer_price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer Start Date</label>
                                            <input type="text" name="offer_start_date"
                                                value="{{ $product->offer_start_date }}"
                                                class="form-control datepicker @error('offer_start_date') is-invalid @enderror">
                                            @error('offer_start_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer End Date</label>
                                            <input type="text" name="offer_end_date"
                                                value="{{ $product->offer_end_date }}"
                                                class="form-control datepicker @error('offer_end_date') is-invalid @enderror">
                                            @error('offer_end_date')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Stock Quantity</label>
                                    <input type="number" min="0" name="qty" value="{{ $product->qty }}"
                                        class="form-control @error('qty') is-invalid @enderror">
                                    @error('qty')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input type="text" name="video_link" value="{{ $product->video_link }}"
                                        class="form-control @error('video_link') is-invalid @enderror">
                                    @error('video_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control summernote @error('short_description') is-invalid @enderror" name="short_description">{!! $product->short_description !!}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea class="form-control summernote @error('long_description') is-invalid @enderror" name="long_description">{!! $product->long_description !!}</textarea>
                                    @error('long_description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Product Type</label>
                                    <select id="inputState" name="product_type" class="form-control">
                                        <option value="">Select</option>
                                        <option {{ $product->product_type == 'new_arrival' ? 'selected' : '' }}
                                            value="new_arrival">New Arrival</option>
                                        <option {{ $product->product_type == 'featured_product' ? 'selected' : '' }}
                                            value="featured_product">Featured</option>
                                        <option {{ $product->product_type == 'top_product' ? 'selected' : '' }}
                                            value="top_product">Top Product</option>
                                        <option {{ $product->product_type == 'best_product' ? 'selected' : '' }}
                                            value="best_product">Best Product</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SEO Title</label>
                                    <input type="text" name="seo_title" value="{{ $product->seo_title }}"
                                        class="form-control @error('seo_title') is-invalid @enderror">
                                    @error('seo_title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>SEO Description</label>
                                    <textarea class="form-control summernote @error('seo_description') is-invalid @enderror" name="seo_description">{!! $product->seo_description !!}</textarea>
                                    @error('seo_description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" name="status" class="form-control">
                                        <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {

                $('.child-category').html('<option value="">Select</option>')
               
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-subcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.sub-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            // get child categories

            $('body').on('change', '.sub-category', function(e) {

                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-childcategories') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.child-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item) {
                            $('.child-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

        })
    </script>
@endpush
