<div class="row no-gutters card info profileForm d-none">
    <form class="col card-wrapper frmProfile" name="frmProfile">
        @csrf
        <div class="row no-gutters align-items-sm-start image">
            <img src="{{asset('/images/maknify-logo.svg')}}">
        </div>
        <div class="row no-gutters align-items-sm-start title">
            <h4>Tell us about Yourself</h4>
        </div>
        <div class="row no-gutters field combofield">
            <label>Full Name <span class="red">*</span></label>
            <div class="col form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="First name & Last name" autocomplete="off">
            </div>
        </div>
        <div class="row no-gutters field combofield">
            <label>Mobile No. (Optional)</label>
            <div class="col form-group">
                <input type="text" data-skip="1" name="mobile_no" data-name="Mobile No." class="form-control" placeholder="Your Mobile No." autocomplete="off">
            </div>
        </div>
        <div class="row no-gutters field">
            <div class="col form-group">
                <label>Please add your business name (Optional)</label>
                <input type="text" name="company_name" data-skip="1" data-name="Business / Company Name"  class="form-control" placeholder="Please add your business name" autocomplete="off">
            </div>
            <span class="w-100 mt-2 d-none" style="font-size: 14px; color: #6B6B6B; font-style: italic;">Please Add if own a Business</span>
        </div>
        <div class="row no-gutters align-items-center action">
            <button id="profile-btn" class="btn ls-btn g-recaptcha" data-sitekey="6LdN7JwaAAAAAHvRsmwHnNwrY1VQDtnTix0x_qz2" data-callback='profile' data-action='submit'>Proceed</button>
        </div>
    </form>
</div>