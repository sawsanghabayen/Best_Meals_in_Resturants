<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            background-image: url({{asset('authregister/images/baraa.jpg')}});
            
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | Restaurant</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('authregister/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('authregister/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form id="create-form">
                        <h2 class="form-title">Create account Resturant</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        {{-- <div class="form-group">
                            <label for="mobile">{{__('cms.mobile')}}</label>
                            <input type="text" class="form-control" id="mobile" placeholder="{{__('cms.mobile')}}">
                        </div> --}}
                        <div class="form-group">
                            <input type="text" class="form-input" id="mobile" name="mobile" placeholder="Mobile Number"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" id="telephone" name="Telephone" placeholder="Telephone Number"/>
                        </div>
                    
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <label>{{__('cms.city')}}</label>
                            <select class="form-input" id="city_id">
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="address">{{__('cms.address')}}</label>
                     
                        <input type="text" class="form-input" id="address" placeholder="{{__('cms.address')}}">
                        <br>
                        <div class="form-group">
                            <label for="resturant_image">Resturant Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="resturant_image">
                                    <label class="custom-file-label" for="resturant_image">Choose file</label>
                                </div>
            
                            </div>
                        </div>
                        <p class="loginhere">
                            Have already an account ? <a href="{{route('cms.login','resturant')}}" class="loginhere-link">Login here</a>
                        </p>
                    </div>

                    
                       
                    <div class="form-group">
                        <button type="button" onclick="performStore()" id="submit" class="form-submit" >Sign up</button>
                    </div>
                    </form>
                  
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{asset('authregister/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('authregister/js/main.js')}}"></script>
    <script>
        function performStore() {
            var formData = new FormData();
        formData.append('name', document.getElementById('name').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value);
        formData.append('mobile', document.getElementById('mobile').value);
        formData.append('telephone', document.getElementById('telephone').value);
        formData.append('city_id', document.getElementById('city_id').value);
        formData.append('address', document.getElementById('address').value);
        formData.append('image',document.getElementById('resturant_image').files[0]);


        axios.post('/front/resturant',formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-resturant').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>