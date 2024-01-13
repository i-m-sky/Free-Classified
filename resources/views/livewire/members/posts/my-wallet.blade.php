<div class="products-links">
    <div class="card myWalletCard">
        <div class="card-header d-flex justify-content-between user-wallet-card-head">
            <h2>My Wallet</h2>
            <div class="UserWallet">
                <span class="wlt-icon">
                    <img class="walletPic" src="{{url('/public/img/wallet.png')}}">
                </span>
                <span class="wallet-amount">
                    <h4 >₹ 5,000</h4>
                    <small>Active</small>
                </span>                
            </div>
        </div>
        <div class="card-body user-wallet-card-head">
            <p class="head-para">Get the most out of Locanto by adding money to your Wallet. It's easy to use and offers a faster way to get Premium Feature</p>

            <h5 class="strong-head-para"><strong>Use your balance to:</strong></h5>

            <div class="UpgradeButton">
                <button class="btn upgradeBtn">
                    <!-- <img src="{{url('/public/img/ads.png')}}">Upgrade your ads -->
                    <i class="fa fa-desktop" aria-hidden="true"></i> Upgrade your ads
                </button>
                <button class="btn uploadBtn" data-toggle="modal" data-target="#uploadMoneyModel">
                    <i class="fa fa-plus" aria-hidden="true"></i> Upload Money
                </button>
            </div>

            <h3 class="pt-5">Wallet transaction history</h3>

            <div class="dropdownBox">
                <div class="dropdownSelectBox">
                    <select class="form-select timePeriod"> 
                       <option>Time Period</option>
                       <option>2</option>
                       <option>4</option>
                       <option>6</option>
                    </select>
                
                    <select class="form-select allTransaction">
                       <option>All transaction</option>
                       <option>One</option>
                       <option>Two</option>
                       <option>Three</option>
                    </select>
                </div>
            </div>
            <div class="productListingHeading">
                <p class="removeMargin">TRANSACTION</p>
                <p class="removeMargin">AMOUNT</p>
            </div>
            <div class="productListing">
                <div class="Listing-wrap">
                    <div class="product">
                        <!-- <h6>MAY 2023</h6> -->
                        <strong>Paid for top & highlight ad</strong>
                        <span class="mutedColor">18 May, 10:56 AM</span>
                        <br>
                        <span class="mutedColor">Order ID : 112334322295</span>
                        <span class="mutedColor">Transaction ID : 43565321234</span>
                    </div>
                    <p class="mutedColor loss"> -₹ 2412</p>
                </div>
            </div> 
            <div class="productListing">
                <div class="Listing-wrap">
                    <div class="product">
                        <!-- <h6>MAY 2023</h6> -->
                        <strong>Added to wallet</strong>
                        <span class="mutedColor">18 May, 10:56 AM</span>
                        <br>
                        <span class="mutedColor">From kotak bank</span>
                        <span class="mutedColor">Transaction ID : 43565321234</span>
                    </div>
                    <p class="mutedColor profit"> +₹ 2412</p>
                </div>
            </div>
            <div class="productListing">
                <div class="Listing-wrap">
                    <div class="product">
                        <!-- <h6>MAY 2023</h6> -->
                        <strong>Paid for top & highlight ad</strong>
                        <span class="mutedColor">18 May, 10:56 AM</span>
                        <br>
                        <span class="mutedColor">Order ID : 112334322295</span>
                        <span class="mutedColor">Transaction ID : 43565321234</span>
                    </div>
                    <p class="mutedColor profit"> +₹ 2416</p>
                </div>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Modal -->
<div class="modal fade" id="uploadMoneyModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg wallet-adon-popup" role="document">
    <div class="modal-content modalContent">
      <div class="modal-body">
            <h3 style="text-align: center;">Adpost Wallet</h3>
            <p id="modelParagraph2">Select how much you would want to add to your wallet.</p>
            <div class="transaction-list">
                <div class="row modelBody col-sm-8 pricemenu-option">
                    <div class="col-sm-6 pricemenu-option-price">
                        <div class="radioInput wallet-radioInput">
                            <input type="radio" class="form-check-input border-4 border option-checkbox" name="amount" id="amount1">
                            <label class="option-amt" for="#amount1"> ₹ 1,000 </label>
                        </div>
                    </div>
                    <div class="col-sm-6 pricemenu-option-price">
                        <div class="radioInput wallet-radioInput">
                            <input type="radio" class="form-check-input border-4 border option-checkbox" name="amount" id="amount2">
                            <label class="option-amt" for="#amount2"> ₹ 3,000 </label>
                        </div>
                    </div>
                    <div class="col-sm-6 pricemenu-option-price">
                        <div class="radioInput wallet-radioInput">
                            <input type="radio" class="form-check-input border-4 border option-checkbox" name="amount" id="amount3">
                            <label class="option-amt" for="#amount3"> ₹ 7,000 </label>
                        </div>
                    </div>
                    <div class="col-sm-6 pricemenu-option-price">
                        <div class="radioInput wallet-radioInput" for="#amount4">
                            <input type="radio" class="form-check-input border-4 border option-checkbox" name="amount" id="amount4">
                            <label class="option-amt" for="#amount4"> ₹ 15,000 </label>
                        </div>
                    </div>
                    <div class="termsAndCond">
                        <input type="checkbox" class="termsAndCond-checkbox">
                        <label class="term-cond-wallet">
                            I hereby accept the 
                            <a href="#" class="termsAndCond-checkbox-link">Adpost Term of Use</a> 
                        </label>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer modalFooter"> 
        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
        <button type="button" class="saveData">Add Money</button>
      </div>
    </div>
  </div>
</div>













