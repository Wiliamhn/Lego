@extends('front.layout.master')
@section('title','Thông tin người dùng')
@section('body')

<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #f5f7fa; padding: 15px;margin-top:100px;">
  <div style="background: white; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); padding: 30px; width: 100%; max-width: 900px;">

    <div class="app-main__inner" style="margin: 0;">
      <div class="app-page-title" style="margin-bottom: 20px;">
          <div class="page-title-wrapper">
              <div class="page-title-heading">
                  <div class="page-title-icon">
                      <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                  </div>
                  <div>
                      
                  </div>
              </div>
          </div>
      </div>

      <div class="row" style="margin: 0;">
          <div class="col-md-12" style="padding: 0;">
              <div class="main-card mb-3 card" style="box-shadow: none; border: none;">
                  <div class="card-body" style="padding: 0;">
                      <form method="post" action="{{ route('account.update') }}" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          @include('admin.components.notification')

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="image" class="col-md-3 text-md-right col-form-label">Ảnh đại diện</label>
                              <div class="col-md-9 col-xl-8">
                                  <img style="height: 200px; cursor: pointer;" class="thumbnail rounded-circle" data-toggle="tooltip" title="Click to change the image" data-placement="bottom" src="front1/img/user/{{$user->avatar ?? '_default-user.png'}}" alt="Avatar">
                                  <input name="image" type="file" onchange="changeImg(this)" class="image form-control-file" style="display: none;" value="">
                                  <input type="hidden" name="image_old" value="{{$user->avatar}}">
                                  <small class="form-text text-muted">Click vào hình ảnh để thay đổi (bắt buộc)</small>
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="name" class="col-md-3 text-md-right col-form-label">Tên tài khoản</label>
                              <div class="col-md-9 col-xl-8">
                                  <input required name="name" id="name" placeholder="Name" type="text" class="form-control" value="{{ $user->name }}">
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                              <div class="col-md-9 col-xl-8">
                                  <input required name="email" id="email" placeholder="Email" type="email" class="form-control" value="{{$user->email}}">
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="password" class="col-md-3 text-md-right col-form-label">Password</label>
                              <div class="col-md-9 col-xl-8">
                                  <input name="password" id="password" placeholder="Password" type="password" class="form-control" value="">
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="password_confirmation" class="col-md-3 text-md-right col-form-label">Confirm Password</label>
                              <div class="col-md-9 col-xl-8">
                                  <input name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" type="password" class="form-control" value="">
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="company_name" class="col-md-3 text-md-right col-form-label">Tên doanh nghiệp</label>
                              <div class="col-md-9 col-xl-8">
                                  <input name="company_name" id="company_name" placeholder="Company Name" type="text" class="form-control" value="{{$user->company_name}}">
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="country" class="col-md-3 text-md-right col-form-label">Quốc gia</label>
                              <div class="col-md-9 col-xl-8">
                                  <input name="country" id="country" placeholder="Country" type="text" class="form-control" value="{{$user->country}}">
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="street_address" class="col-md-3 text-md-right col-form-label">Địa chỉ</label>
                              <div class="col-md-9 col-xl-8">
                                  <input name="street_address" id="street_address" placeholder="Street Address" type="text" class="form-control" value="{{$user->street_address}}">
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="postcode_zip" class="col-md-3 text-md-right col-form-label">Mã bưu điện</label>
                              <div class="col-md-9 col-xl-8">
                                  <input name="postcode_zip" id="postcode_zip" placeholder="Postcode Zip" type="text" class="form-control" value="{{$user->postcode_zip}}">
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="town_city" class="col-md-3 text-md-right col-form-label">Thành phố</label>
                              <div class="col-md-9 col-xl-8">
                                  <input name="town_city" id="town_city" placeholder="Town City" type="text" class="form-control" value="{{$user->town_city}}">
                              </div>
                          </div>

                          <div class="position-relative row form-group" style="margin-bottom: 15px;">
                              <label for="phone" class="col-md-3 text-md-right col-form-label">Điện thoại</label>
                              <div class="col-md-9 col-xl-8">
                                  <input required name="phone" id="phone" placeholder="Phone" type="tel" class="form-control" value="{{$user->phone}}">
                              </div>
                          </div>


                        

                          <div class="position-relative row form-group mb-1" style="margin-top: 20px;">
                              <div class="col-md-9 col-xl-8 offset-md-2">
                                  <a href="." class="border-0 btn btn-outline-danger mr-1">
                                      <span class="btn-icon-wrapper pr-1 opacity-8">
                                          <i class="fa fa-times fa-w-20"></i>
                                      </span>
                                      <span>Quay lại</span>
                                  </a>

                                  <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                                      <span class="btn-icon-wrapper pr-2 opacity-8">
                                          <i class="fa fa-download fa-w-20"></i>
                                      </span>
                                      <span>Lưu</span>
                                  </button>
                              </div>
                          </div>

                      </form>
                  </div>
              </div>
          </div>
      </div>

    </div>

  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.thumbnail').addEventListener('click', function() {
      document.querySelector('input[name="image"]').click();
    });
  });

  function changeImg(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.querySelector('.thumbnail').src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

  
@endsection

