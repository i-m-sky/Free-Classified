<footer>
    <div class="footer-top">
        <div class="wrapper">
            <div class="row w-100 ">
                <div class="col-lg-6 col-sm-6  ft-content-box">
                    <div>
                        <a class="" href="/"><img class="ft-logo" height="auto" width="147px" src="/img/adpost.png"
                                alt="logo" /></a>
                    </div>
                    <p class="footer-about-text text-wrap">
                        Free CLASSIFIEDS, local classified ads for property,
                        vehicals, jobs, services, pets, rent, sell & more.
                    </p>

                    <!-- <div class="ft-social-icon">
                        <span>
                            <a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </span>
                        <span>
                            <a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i>
                            </a>
                        </span>
                        <span>
                            <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        </span>
                        <span>
                            <a href="#" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                        </span>
                    </div> -->

                </div>
                <div class="col-lg-3 col-sm-3  ft-content-box">
                    <label class="footer-label">About us</label>
                    <div class="footer-menu-ul">
                        <ul>
                            <li><a href="#">About Adpost</a></li>
                            <li><a href="#">Advertise With Us</a></li>
                            <li><a href="#">Safety Tips</a></li>
                            <li><a href="{{ route('cookies-policy') }}">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3  ft-content-box">
                    <label class="footer-label">Help & Contact</label>
                    <div class="footer-menu-ul">
                        <ul>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="{{ route('terms-condition') }}">Terms & Conditions</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>

                </div>
                <!-- <div class="col-lg-2 col-md-6 ft-content-box">
                    <label class="footer-label">Mobile Apps</label>
                    <div class="d-flex flex-column">


                        <a href="#" style="height: 50px;margin-bottom: 20px;"><img height="40px"
                                src="{{ config('global_variables.asset_url') }}/img/app-store-badge.svg"
                                class="app-store-img" /></a>
                        <a href="#" style="height: 50px;"><img height="40px"
                                src="{{ config('global_variables.asset_url') }}/img/google-play-badge.svg"
                                class="app-store-img" /></a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="wrapper">
            <div class="row ">
                <div class="col-md-6">
                    <h6>© 2023 Adpost. All rights reserved.</h6>
                </div>
                <div class="col-md-6" style="padding-right: 60px;">
                    <h6 class="text-end">
                        <img style="width:18px" src='{{ config('global_variables.asset_url') }}/img/globe-search.png'
                            alt="" />
                        Adpost Network
                    </h6>
                </div>
            </div>
        </div>
    </div>
</footer>