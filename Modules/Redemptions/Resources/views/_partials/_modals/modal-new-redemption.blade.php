<!-- Edit User Modal -->
<div class="modal fade" id="newRedemptionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 pt-50">
        <div class="text-center mb-2">
          <h1 class="mb-1">Redeem Points</h1>
          <p>Minimum points redeemable is 50.</p>
        </div>
        @if($user_points->points_balance >= 50)
        {{-- <form class="row gy-1 pt-75"> --}}
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <div class="row">
            <div class="col-md-6">
              <label class="form-label" for="modalEditUserFirstName">Points Balance</label>
              <input type="number" id="points_balance" class="form-control" readonly
                value="{{ $user_points->points_balance }}" />
            </div>
            <div class="col-md-6">
              <label class="form-label" for="modalEditUserLastName">Points to Redeem</label>
              <input type="number" min="50" id="redeem_points" class="form-control" />
            </div>
            {{-- <div class="col-12">
              <label class="form-label" for="modalEditUserName">New Points Balance</label>
              <input type="number" id="new_balance" class="form-control" />
            </div> --}}
            <div class="col-12 mt-2 pt-50">
              <button type="submit" id="redeemPointsBtn" class="btn btn-primary me-1">Redeem Points</button>
            </div>
          </div>
          {{--
        </form> --}}
        @endif
      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->