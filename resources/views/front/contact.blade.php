@extends('front.parent')

@section('styles')
<style>
.send-message  {
  margin-top: 10px;
}
</style>
@endsection
@section('content')
  

     <div class="send-message">
      <div  style=" padding-top: 100px;" class="container">
        <div class="row">
          <div class="col-md-12">
            <div>
              <h2>Send us a Message</h2>
            </div>
            <br>
          </div>
          <div class="col-md-8">
            <div class="contact-form">
              <form id="contact-form">
                {{-- @csrf --}}
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input type="text" class="form-control" id="name" placeholder="Full Name" >
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input  type="email" class="form-control" id="email" placeholder="E-Mail Address" >
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input type="text" class="form-control" id="subject" placeholder="Subject" >
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <textarea  rows="6" class="form-control" id="message" placeholder="Your Message"></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button style="margin-bottom:30px " onclick="performStoreContact()" class="filled-button">Send Message</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

    @endsection
    @section('scripts')

  <!-- jQuery -->
  <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>


<script>

function performStoreContact() {
      axios.post('/front/contacts', {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            subject: document.getElementById('subject').value,
            message: document.getElementById('message').value,

        })
      .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('contact-form').reset();

        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });

    }
 </script>
 @endsection

    
  