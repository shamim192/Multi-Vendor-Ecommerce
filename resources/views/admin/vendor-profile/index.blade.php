@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vendor Profile</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Vendor Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.vendor-profile.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group">
                                    <label class="d-block">Preview</label>
                                    <img width="200px" src="{{ asset($profile->banner) }}" alt="">
                                </div>

                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" name="banner"
                                        class="form-control @error('banner') is-invalid @enderror"">
                                    @error('banner')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{ $profile->phone }}"
                                        class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ $profile->email }}"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{ $profile->address }}"
                                        class="form-control @error('address') is-invalid @enderror">
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control summernote @error('description') is-invalid @enderror" name="description">{!! $profile->description !!}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="fb_link" value="{{ $profile->fb_link }}"
                                        class="form-control @error('fb_link') is-invalid @enderror">
                                    @error('fb_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" name="tw_link" value="{{ $profile->tw_link }}"
                                        class="form-control @error('tw_link') is-invalid @enderror">
                                    @error('tw_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="insta_link" value="{{ $profile->insta_link }}"
                                        class="form-control @error('insta_link') is-invalid @enderror">
                                    @error('insta_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
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
