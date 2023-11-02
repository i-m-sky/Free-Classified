<div class="report-ads" style="display:block">
    <div class="rpt-wrap">
        <div class="d-flex justify-content-between">
            <p style="margin-top:-10px; font-size:22px">Reporing {{ $user['name'] }}</p>
            <button class="closeBtn" wire:click="$emit('closeModal')">X</button>
        </div>
        <hr class="mt-0 mb-3">
        @if ($success)
            <div class="alert alert-success" role="alert">
                Your report has been sent successfully.
            </div>
        @elseif($errorMessage)
            <div class="alert alert-danger" role="alert">
                You cannot report your self.
            </div>
        @else
            <form method="post" wire:submit.prevent="submitReport">
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio1"
                        wire:model.defer="reportOption" value="Spam">
                    <label class="form-check-label report-user-check" for="radio1">
                    Spam
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio2"
                        wire:model.defer="reportOption" value="Fraud">
                    <label class="form-check-label report-user-check" for="radio2">
                    Fraud
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio3"
                        wire:model.defer="reportOption" value="Inappropriate Profile Picture">
                    <label class="form-check-label report-user-check" for="radio3">
                    Inappropriate Profile Picture
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio4"
                        wire:model.defer="reportOption" value="This User Is Threatening Me">
                    <label class="form-check-label report-user-check" for="radio4">
                        This User Is Threatening Me
                    </label>
                </div><div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio5"
                        wire:model.defer="reportOption" value="This User Is Insulting Me">
                    <label class="form-check-label report-user-check" for="radio5">
                        This User Is Insulting Me
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio6"
                        wire:model.defer="reportOption" value="Other">
                    <label class="form-check-label report-user-check" for="radio6">
                        Other
                    </label>
                </div>
                <!-- <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio1"
                        wire:model.defer="reportOption" value="This is illegal/fraudulent">
                    <label class="form-check-label report-user-check" for="radio1">
                        This is illegal/fraudulent
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio2"
                        wire:model.defer="reportOption" value="Abusive language">
                    <label class="form-check-label report-user-check" for="radio2">
                        Abusive language
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio3"
                        wire:model.defer="reportOption" value="Content is in the wrong category">
                    <label class="form-check-label report-user-check" for="radio3">
                        Content is in the wrong category
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio4"
                        wire:model.defer="reportOption" value="Other, please indicate what">
                    <label class="form-check-label report-user-check" for="radio4">
                        Other, please indicate what
                    </label>
                </div> -->
                @error('reportOption')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div class="rpt-textarea">
                    <textarea rows="2" placeholder="Please provide more information" wire:model.defer="comment"></textarea>
                    @error('comment')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button class="submitBtn1" type="submit">Send</button>
            </form>
        @endif
    </div>
</div>
