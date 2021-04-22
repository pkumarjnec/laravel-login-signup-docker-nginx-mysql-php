<div class="row no-gutters card resetpassword resetForm  @if ($activePage == 'reset') @else d-none @endif ">
    <form class="col card-wrapper frmReset" name="frmReset">
        @csrf
        <div class="row no-gutters align-items-sm-start image">
            <img src="{{asset('/images/maknify-logo.svg')}}">
        </div>
        <div class="row no-gutters align-items-sm-start title">
            <h4>Reset Password</h4>
        </div>
        <div class="row no-gutters field">
            <div class="col form-group">
                <label>Email Address  <span class="red">*</span></label>
                <div class="row no-gutters form-group--wrapper">
                    <input type="email" class="form-control" name="emailid" placeholder="example@domain.com" autocomplete="off" value="@if ($username != '') {{$username}} @endif">
                    <div class="focusinput"></div>
                </div>
            </div>
        </div>
        <div class="row no-gutters field">
            <div class="col form-group">
                <label>New Password  <span class="red">*</span></label>
                <div class="row no-gutters form-group--wrapper">
                    <input type="password" class="form-control" name="password" placeholder="New password" autocomplete="off">
                    <div class="focusinput"></div>
                    <div class="input-group-append">
                        <span class="input-group-text symbol2"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters align-items-center action">
            <button id="reset-btn" class="btn ls-btn g-recaptcha" data-sitekey="6LdN7JwaAAAAAHvRsmwHnNwrY1VQDtnTix0x_qz2" data-callback='resetPassword' data-action='submit'>Reset</button>
        </div>
    </form>
</div>