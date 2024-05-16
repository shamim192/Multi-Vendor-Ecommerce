@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror"">                                                                       
                                    @error('banner')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" name="type" value="{{ old('type') }}"
                                        class="form-control @error('type') is-invalid @enderror">
                                    @error('type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Starting Price</label>
                                    <input type="text" name="starting_price" value="{{ old('starting_price') }}"
                                        class="form-control @error('starting_price') is-invalid @enderror">                                                                           
                                    @error('starting_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label>Button Url</label>
                                    <input type="text" name="btn_url" value="{{ old('btn_url') }}"
                                        class="form-control @error('btn_url') is-invalid @enderror">                                                                           
                                    @error('btn_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label>Serial</label>
                                    <input type="text" name="serial"
                                        class="form-control @error('serial') is-invalid @enderror"
                                        value="{{ old('serial') }}">                                                                           
                                    @error('serial')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
