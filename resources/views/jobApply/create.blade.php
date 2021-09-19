@extends('layouts.app')
@section('content')

<div class="container">
     <div class=" text-center mt-3 ">
        <h2>Можете поучавстовать в проекте, оставьте свои данные и мы сами свяжемся с вами</h2>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form method="POST" action="{{ route('projectHelp.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">Имя *</label> <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required."> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_email">Email *</label> <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required."> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="form_message">Оставьте сообщение *</label> <textarea id="form_message" name="message" class="form-control" placeholder="Write your message here." rows="4" required="required" data-error="Оставьте сообщение."></textarea> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="file_path">CV</label> <input  id="file_path" type="file" name="file_path" required="required" data-error="Valid file is required."> </div>
                                    </div>
                                    <div class="col-md-12"> <input type="submit" class="btn btn-success btn-send pt-2 btn-block " value="Send Message"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
    <div class=" text-center mt-3 ">
        <h2>Или же может помочь нам материально</h2>
    </div>
    <div class=" text-center mt-4 ">
        <a href="https://www.donationalerts.com/r/fami2"><h5>https://www.donationalerts.com/r/fami2</h5></a>
    </div>
</div>

@endsection