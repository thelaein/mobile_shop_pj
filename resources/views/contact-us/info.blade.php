@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 ">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1749.3397663725239!2d96.07197959542134!3d17.007143428425117!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2smm!4v1676648199310!5m2!1sen!2smm"
                    width="100%" height="534" style="border:1px solid lightgray;margin-bottom: 16px; border-radius: 4px"
                    allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card" style="height: 534px;">
                    <div class="card-header bg-secondary">Contact Info.</div>
                    <div class="card-body">
                        <div class="row mb-3 m-lg-4 justify-content-center" >
                            <iframe src="https://embed.lottiefiles.com/animation/83962"></iframe>
                        </div>
                        <div class="row mb-3 m-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-telephone-forward-fill"></i></div>
                                    </div>
                                    <input type="text" disabled class="form-control" name="contact_phone"
                                           value="09 66554433" required></div>
                            </div>
                        </div>
                        <div class="row mb-3 m-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-envelope-at-fill"></i></div>
                                    </div>
                                    <input type="text" disabled class="form-control" name="contact_phone"
                                           value="mobile.store@shopcart.com" required></div>
                            </div>
                        </div>
                        <div class="row mb-3 m-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-house-fill"></i></div>
                                    </div>
                                    <input type="text" disabled class="form-control" name="address"
                                           value="No.127, Dhamaseintar St., Tarmwe, Yangon." required></div>
                            </div>
                        </div>
                        <div class="row mb-3 m-lg-4">
                            <div class="form-group">
                                <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-envelope-at"></i>&nbsp;Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <script
        src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
    </script>
@endsection
