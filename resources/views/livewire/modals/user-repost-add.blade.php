<div class="report-ads" style="display:block">
    <div class="rpt-wrap">
        <div class="d-flex justify-content-between">
            <p style="margin-top:-10px; font-size:22px">Reporing GH Estates</p>
            <button class="closeBtn" wire:click="$emit('closeModal')">X</button>
        </div>
        <hr class="mt-0 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio1">
            <label class="form-check-label report-user-check" for="radio1">
                This is illegal/fraudulent
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio2">
            <label class="form-check-label report-user-check" for="radio2">
                Abusive language
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio3">
            <label class="form-check-label report-user-check" for="radio3">
                Content is in the wrong category
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio4">
            <label class="form-check-label report-user-check" for="radio4">
                Other, please indicate what
            </label>
          </div>
        <div class="rpt-textarea">
            <textarea rows="1" placeholder="Please provide more information"></textarea>
        </div>
        {{-- <button class="cencelBtn">Cancel</button> --}}
        <button class="submitBtn1">Send</button>
    </div>
</div>