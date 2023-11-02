<section class="list-products profile-page">
    <div class="wrapper">
        <div class="list-container">
            <div class="list-box mt-3">
                <div class="products-links mt-0">
                    <div class="d-flex bg-white border-2 border rounded-top py-2 pb-0 resIcon  ">
                        <div class="col-3 col-sm-1 col-md-1 text-center promote-hignlight-icn">
                            <img src="/public/img/svg/topAd/top_ad_khojbro_100_100.svg" alt="" class="p-2 w-65">
                        </div>
                        <div class="col-9 col-sm-11 col-md-11 promote-hignlight-icn2">
                            <p class="proAdTitle pl-2">Top Ad <span class="notmobBtn">- </span><a href="javascript:void(0)" class="topAdModal notmobBtn" wire:model.defer="topAdModal"
                                    wire:click="$emit('openModal', 'modals.top-ad-modal')">See example</a>
                                    <a href="javascript:void(0)" class="topAdModal float-end text-decoration-none text-white mobBtn" wire:model.defer="urgentAdModal"
                                wire:click="$emit('openModal', 'modals.top-ad-modal')">?</a></p>
                            <p class="proAdDesc">Feature your ad in rotation on top of Category Pages.</p>
                        </div>
                    </div>
                    <div class="d-flex bg-white border-top-0 border-2 border rounded-bottom p-2 mb-4 radioBtns">
                        <div class="col radioBtn text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-4 border" type="radio" name="topAd" id="topAd1"
                                    value="7">
                                <label class="form-check-label pt-1 font19" for="topAd1">7 Days ( <strong><i
                                            class="fa-solid fa-indian-rupee-sign"></i> 599)</strong></label>
                            </div>
                        </div>
                        <div class="col radioBtn text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-4 border" type="radio" name="topAd" id="topAd2"
                                    value="15">
                                <label class="form-check-label pt-1 font19" for="topAd2">15 Days ( <strong><i
                                            class="fa-solid fa-indian-rupee-sign"></i> 799)</strong></label>
                            </div>
                        </div>
                        <div class="col radioBtn text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-4 border" type="radio" name="topAd" id="topAd3"
                                    value="31">
                                <label class="form-check-label pt-1 font19" for="topAd3">31 Days ( <strong><i
                                            class="fa-solid fa-indian-rupee-sign"></i> 999)</strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex bg-white border-2 border rounded-top py-2 pb-0 resIcon ">
                        <div class="col-3 col-sm-1 col-md-1 text-center promote-hignlight-icn">
                            <img src="/public/img/svg/highlightAd/highlight_ad_khojbro_100_100.svg" alt=""
                                class="p-2 w-65">
                        </div>
                        <div class="col-9 col-sm-11 col-md-11 promote-hignlight-icn2">
                            <p class="proAdTitle">Highlight Ad <span class="notmobBtn">- </span><a href="javascript:void(0)" class="highlightAdModal notmobBtn"
                                    wire:model.defer="highlightAdModal"
                                    wire:click="$emit('openModal', 'modals.highlight-ad-modal')">See example</a>
                                    <a href="javascript:void(0)" class="highlightAdModal float-end text-decoration-none text-white mobBtn" wire:model.defer="urgentAdModal"
                                wire:click="$emit('openModal', 'modals.highlight-ad-modal')">?</a></p>
                            <p class="proAdDesc">Get maximum attention and more replies.</p>
                        </div>
                    </div>
                    <div class="d-flex bg-white border-top-0 border-2 border rounded-bottom p-2 mb-4 radioBtns">
                        <div class="col radioBtn text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-4 border" type="radio" name="highlightAd"
                                    id="highlightAd1" value="7">
                                <label class="form-check-label pt-1 font19" for="highlightAd1">7 Days ( <strong><i
                                            class="fa-solid fa-indian-rupee-sign"></i> 599)</strong></label>
                            </div>
                        </div>
                        <div class="col radioBtn text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-4 border" type="radio" name="highlightAd"
                                    id="highlightAd2" value="15">
                                <label class="form-check-label pt-1 font19" for="highlightAd2">15 Days ( <strong><i
                                            class="fa-solid fa-indian-rupee-sign"></i> 799)</strong></label>
                            </div>
                        </div>
                        <div class="col radioBtn text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-4 border" type="radio" name="highlightAd"
                                    id="highlightAd3" value="31">
                                <label class="form-check-label pt-1 font19" for="highlightAd3">31 Days ( <strong><i
                                            class="fa-solid fa-indian-rupee-sign"></i> 999)</strong></label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex bg-white border-2 border rounded-top py-2 pb-0 resIcon ">
                        <div class="col-3 col-sm-1 col-md-1  text-center promote-hignlight-icn">
                            <img src="/public/img/svg/urgentAd/urgent_ad_khojbro_100_100.svg" alt="" class="p-2 w-65">
                        </div>
                        <div class="col-9 col-sm-9 col-md-9 promote-hignlight-icn2">
                            <p class="proAdTitle">Urgent Ad <span class="notmobBtn">- </span><a href="javascript:void(0)" class="urgentAdModal notmobBtn"
                                    wire:model.defer="urgentAdModal"
                                    wire:click="$emit('openModal', 'modals.urgent-ad-modal') ">See example</a>
                            <a href="javascript:void(0)" class="urgentAdModal float-end text-decoration-none text-white mobBtn" wire:model.defer="urgentAdModal"
                                wire:click="$emit('openModal', 'modals.urgent-ad-modal')">?</a></p>
                            <p class="proAdDesc">Show people you're ready to sell ASAP.</p>
                        </div>
                    </div>
                    <div class="d-flex bg-white border-top-0 border-2 border rounded-bottom p-2 mb-4 radioBtns">
                        <div class="col radioBtn text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-4 border" type="radio" name="urgentAd"
                                    id="urgentAd1" value="7">
                                <label class="form-check-label pt-1 font19" for="urgentAd1">7 Days
                                    ( <strong>
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                         599)
                                    </strong>
                                </label>
                            </div>
                        </div>
                        <div class="col radioBtn text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-4 border" type="radio" name="urgentAd"
                                    id="urgentAd2" value="15">
                                <label class="form-check-label pt-1 font19" for="urgentAd2">15 Days
                                    ( <strong><i class="fa-solid fa-indian-rupee-sign"></i>
                                         799)
                                    </strong>
                                </label>
                            </div>
                        </div>
                        <div class="col radioBtn text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border-4 border" type="radio" name="urgentAd"
                                    id="urgentAd3" value="31">
                                <label class="form-check-label pt-1 font19" for="urgentAd3">31 Days
                                    ( <strong>
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                         999)
                                    </strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="products-details proTotal">
                    <div class="bg-white border-2 border rounded-2 text-center align-items-center">
                        <h3 class="my-4"><strong>Promotions</strong></h3>
                        <p class="my-4">
                            <strong>Total:
                                <i class="fa-solid fa-indian-rupee-sign ml-1"></i>
                                188.00
                            </strong>
                        </p>
                        <a href="{{ route('cart-page') }}"
                            class="btn rounded-0 p-3 w-100 rounded-bottom border-0 btnTotal">
                            PAY NOW
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>