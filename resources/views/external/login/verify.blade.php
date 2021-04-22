<div class="row no-gutters card verify verifyForm d-none">
    <form class="col card-wrapper frmVerify" name="frmVerify">
        @csrf
        <div class="row no-gutters align-items-sm-start image">
            <img src="{{asset('/images/maknify-logo.svg')}}">
        </div>
        <div class="row no-gutters align-items-sm-start title">
            <h4>Verify Email Address</h4>
        </div>
        <div class="row no-gutters field">
            <div class="col form-group">
                <label>Verification code
                    <span class="red">*</span>
                </label>
                <div class="row no-gutters form-group--wrapper mb-2">
                    <input type="password" onkeydown="checkValidation($(this));" name="code" class="code form-control" placeholder="Enter verification code" autocomplete="off">
                    <div class="focusinput"></div>
                </div>
                <span class="w-100" style="font-size: 14px; color: #6B6B6B; font-style: italic;">Please check your email for verification code.</span>
            </div>
        </div>
        <div class="row no-gutters align-items-center justify-content-center action">
            <p class="signuplink mt-4">Didn't you receive an email? <span onclick="resendEmail();">Resend Email</span></p>
        </div>
        <div class="row no-gutters align-items-center action">
            <button id="verify-btn" class="btn ls-btn g-recaptcha" data-sitekey="6LdN7JwaAAAAAHvRsmwHnNwrY1VQDtnTix0x_qz2" data-callback='verify' data-action='submit'>Verify</button>
            <input type="hidden" id="token" name="token">
        </div>
    </form>
</div>
