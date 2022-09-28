<div class="col-md-9 contact-form">
    <input type="hidden" name="action" value="{{ route($controllerName . '.send')}}">
    <div class="col-md-12 contact-title">
        <h4>Contact Form</h4>
    </div>
    <div class="col-md-4 ">
        <form class="register-form" role="form">
            <div class="form-group">
                <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                <input type="text" name='name' class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <form class="register-form" role="form">
            <div class="form-group">
                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                <input type="email" name='email' class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <form class="register-form" role="form">
            <div class="form-group">
                <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
                <input type="text" name="title" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="Title">
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <form class="register-form" role="form">
            <div class="form-group">
                <label class="info-title" for="exampleInputComments">Your Comments <span>*</span></label>
                <textarea name="content" class="form-control unicase-form-control" id="exampleInputComments"></textarea>
            </div>
        </form>
    </div>
    <div class="col-md-12 outer-bottom-small m-t-20">
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button" onclick="submitContact()">Send Message</button>
    </div>
</div>