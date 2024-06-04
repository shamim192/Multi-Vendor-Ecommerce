@extends('vendor.layouts.master')

@section('content')
    <!--=============================
                    DASHBOARD START
                  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Shop profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.shop-profile.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group wsus_input">
                                    <label class="d-block">Preview</label>
                                    <img width="200px" src="{{ asset($profile->banner) }}" alt="">
                                </div>

                                <div class="form-group wsus_input">
                                    <label>Banner</label>
                                    <input type="file" name="banner"
                                        class="form-control @error('banner') is-invalid @enderror"">
                                    @error('banner')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group wsus_input">
                                    <label>Shop Name</label>
                                    <input type="text" name="shop_name" value="{{ $profile->shop_name }}"
                                        class="form-control @error('shop_name') is-invalid @enderror">
                                    @error('shop_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group wsus_input">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{ $profile->phone }}"
                                        class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group wsus_input">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ $profile->email }}"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group wsus_input">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{ $profile->address }}"
                                        class="form-control @error('address') is-invalid @enderror">
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group wsus_input">
                                    <label>Description</label>
                                    <textarea class="form-control summernote @error('description') is-invalid @enderror" name="description">{!! $profile->description !!}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group wsus_input mt-2">
                                    <label>Facebook</label>
                                    <input type="text" name="fb_link" value="{{ $profile->fb_link }}"
                                        class="form-control @error('fb_link') is-invalid @enderror">
                                    @error('fb_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group wsus_input">
                                    <label>Twitter</label>
                                    <input type="text" name="tw_link" value="{{ $profile->tw_link }}"
                                        class="form-control @error('tw_link') is-invalid @enderror">
                                    @error('tw_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group wsus_input">
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
        </div>
    </section>
    <!--=============================
                    DASHBOARD START
                  ==============================-->
@endsection
