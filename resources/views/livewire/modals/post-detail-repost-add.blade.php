<div class="report-ads" style="display:block">
    <div class="rpt-wrap">
        <div class="d-flex justify-content-between">
            <p style="margin-top:-10px; font-size:22px">Reporing {{ $post['name'] }}</p>
            <button class="closeBtn" wire:click="$emit('closeModal');" onclick="enableScroll();">X</button>
        </div>
        <hr class="mt-0 mb-3">
        @if ($success)
            <div class="alert alert-success" role="alert">
                Your report has been sent successfully.
            </div>
        @elseif($errorMessage)
            <div class="alert alert-danger" role="alert">
                You cannot report your post.
            </div>
        @else
            <form method="post" wire:submit.prevent="submitReport">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio1"
                        wire:model.defer="reportOption" value="This is illegal/fraudulent">
                    <label class="form-check-label report-user-check" for="radio1">
                        This is illegal/fraudulent
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio2"
                        wire:model.defer="reportOption" value="This ad is spam">
                    <label class="form-check-label report-user-check" for="radio2">
                        This ad is spam
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio3"
                        wire:model.defer="reportOption" value="This ad is a duplicate">
                    <label class="form-check-label report-user-check" for="radio3">
                        This ad is a duplicate
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio4"
                        wire:model.defer="reportOption" value="This ad is in the wrong category">
                    <label class="form-check-label report-user-check" for="radio4">
                        This ad is in the wrong category
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio5"
                        wire:model.defer="reportOption" value="The ad goes against posting rules">
                    <label class="form-check-label report-user-check" for="radio5">
                        The ad goes against posting rules
                    </label>
                </div>
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

