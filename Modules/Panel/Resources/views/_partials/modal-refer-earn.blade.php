<!-- refer and earn modal -->
<div class="modal fade" id="newInviteModal" tabindex="-1" aria-labelledby="referEarnTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-refer-earn">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-0">
        <div class="px-sm-4 mx-50">
          <h1 class="text-center mb-1" id="referEarnTitle">Refer & Earn Bonus Points</h1>
          <p class="text-center mb-5">
            Invite your friend to Lightline Research, if they sign up & verify their accounts,
            <br />
            you will 5 bonus points
          </p>

          <div class="row mb-4">
            <div class="col-12 col-lg-4">
              <div class="d-flex justify-content-center mb-1">
                <div class="
                    modal-refer-earn-step
                    d-flex
                    width-100
                    height-100
                    rounded-circle
                    justify-content-center
                    align-items-center
                    bg-light-primary
                  ">
                  <i data-feather="message-square"></i>
                </div>
              </div>
              <div class="text-center">
                {{-- <h6 class="fw-bolder mb-1">Send Invitation 🤟🏻</h6> --}}
                <p>Send your referral link to your friend</p>
              </div>
            </div>
            <div class="col-12 col-lg-4">
              <div class="d-flex justify-content-center mb-1">
                <div class="
                    modal-refer-earn-step
                    d-flex
                    width-100
                    height-100
                    rounded-circle
                    justify-content-center
                    align-items-center
                    bg-light-primary
                  ">
                  <i data-feather="clipboard"></i>
                </div>
              </div>
              <div class="text-center">
                {{-- <h6 class="fw-bolder mb-1">Registration 👩🏻‍💻</h6> --}}
                <p>Let them register and join our panel</p>
              </div>
            </div>
            <div class="col-12 col-lg-4">
              <div class="d-flex justify-content-center mb-1">
                <div class="
                    modal-refer-earn-step
                    d-flex
                    width-100
                    height-100
                    rounded-circle
                    justify-content-center
                    align-items-center
                    bg-light-primary
                  ">
                  <i data-feather="award"></i>
                </div>
              </div>
              <div class="text-center">
                {{-- <h6 class="fw-bolder mb-1">Earn Points 🎉</h6> --}}
                <p>Get 5 points upon verification of the account</p>
              </div>
            </div>
          </div>
        </div>

        <div class="px-sm-5 mx-50">
          <h4 class="fw-bolder mt-5 mb-1">Invite your friends and family</h4>

          <div class="row">
            <div class="col-12 col-sm-12 mb-1">
              <label class="form-label" for="modalRnFEmail">
                Enter your friends' email addresses separated by commas and invite them to join Lightline Research 😍
              </label>
              <textarea cols="12" class="form-control" placeholder="example@domain.com" name="emails"
                id="emails"></textarea>
              <input type="hidden" id="myRefLink" value="{{ $ref_link }}">
              <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
              <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            </div>
            <div class="col-12 col-sm-4 mb-1">
              <button type="submit" id="send_invites" class="btn btn-primary w-100">Send Invites</button>
            </div>
          </div>
          <h4 class="fw-bolder mt-4 mb-1">Share the referral link</h4>
          <form class="row g-1" onsubmit="return false">
            <div class="col-lg-12">
              <label class="form-label" for="modalRnFLink">
                You can also copy and send it or share it on your social media. 🥳
              </label>
              <div class="input-group input-group-merge">
                <input type="text" name="ref_link" id="refLink" readonly class="form-control" value="{{ $ref_link }}" />
                <button class="input-group-text" id="basic-addon33" onclick="myFunction()">Copy Link</button>
              </div>
            </div>

        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<!-- / refer and earn modal -->