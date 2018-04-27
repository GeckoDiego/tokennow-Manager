@include('templates.app')
@section('content')
    <form class="form-signin needs-validation" novalidate>
      <img class="mb-4" src="http://167.114.47.35/webB/images/logo-aiorix-light.svg" alt="" width="300">
      <p>Please complete all fields to join</p>
      
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">person</i></span>
        </div>
        <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" required />
      </div>      

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">mail_outline</i></span>
        </div>
        <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">vpn_key</i></span>
        </div>
        <input type="text" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required />
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">security</i></span>
        </div>
        <input type="text" class="form-control" placeholder="Repeat Password" aria-label="Repeat Password" aria-describedby="basic-addon1">
      </div>
      
      <div class="detail">
        Enter the email address of the person who referred you
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">supervisor_account</i></span>
        </div>
        <input type="text" class="form-control" placeholder="referral Email" aria-label="referral Email" aria-describedby="basic-addon1">
      </div>

      <div class="detail">
        Please enter an ERC20 compatible wallet in your profile to receive the tokens. If you do not know how to create an ERC20 wallet <a href="">Click here</a>
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">fingerprint</i></span>
        </div>
        <input type="text" class="form-control" placeholder="Wallet ERC20" aria-label="Wallet ERC20" aria-describedby="basic-addon1">
      </div>

      <button class="btn btn-lg btn-info btn-block" type="submit">Sign Up</button>

      <div class="detail last">
        By submitting this information you confirm that you agree with Terms and Conditions. Please be aware that we don’t register clients from US, China, Singapore, Iran, North Korea and Syria.        
      </div>
      
      <p class="mt-5 mb-3 text-muted"><img src="http://167.114.47.35/webB/images/poweredbytokennow.svg" alt="" width="150"></p>
    </form>