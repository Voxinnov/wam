 <footer class="footer-standard-dark bg-extra-dark-gray"> 
            <div class="footer-widget-area padding-five-tb sm-padding-30px-tb">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 widget border-right border-color-medium-dark-gray md-no-border-right md-margin-30px-bottom sm-text-center">
                            <!-- start logo -->
                         <div class="widget-title alt-font text-small text-medium-gray text-uppercase margin-10px-bottom font-weight-600"><img src="images/logo.png"  alt="WAM" class="logo-light default"  style="width:100%"></div>
                           
                            <!-- end logo -->
							<?php $Objabtft  = new About();
                    $abtContentft= $Objabtft->getAbout(); ?>
                            <p class="text-small width-95 sm-width-100"> <?php  $contn= strip_tags($abtContentft[0]['about_wam_dscrptn']);
                            if(strlen($contn)>150)
                            {
                                $subcon=substr($contn, 0, 150);
                                $contn = substr($subcon, 0, strrpos($subcon, ' '));
                            }
                         echo $contn; echo" ...";?><a href="about.php">Read More</a></p>
                            <!-- start social media -->
                            <div class="social-icon-style-8 d-inline-block vertical-align-middle">
                                <ul class="small-icon no-margin-bottom">
                                    <li><a class="facebook text-white-2" href="<?php echo $get[0]["cnt_fb"];?>" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a class="twitter text-white-2" href="<?php echo $get[0]["cnt_twtr"];?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                   <li><a class="instagram text-white-2" href="<?php echo $get[0]["cnt_insta"];?>" target="_blank"><i class="fab fa-instagram no-margin-right" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <!-- end social media -->
                        </div>
                        <!-- start additional links -->
                        <div class="col-lg-3 col-md-6 widget border-right border-color-medium-dark-gray padding-45px-left md-padding-15px-left md-no-border-right md-margin-30px-bottom text-center text-md-left">
                            <div class="widget-title alt-font text-small text-medium-gray text-uppercase margin-10px-bottom font-weight-600">Quick Links</div>
                            <ul class="list-unstyled">
                                <li><a class="text-small" href="about.php">About</a></li>
                                <li><a class="text-small" href="portfolio.php">Portfolio</a></li>
                                <li><a class="text-small" href="newsandevents.php">News & Events</a></li>
                                <li><a class="text-small" href="activities.php">Activity</a></li>
                                <li><a class="text-small" href="officebearers.php">Office Bearers</a></li>
                                <li><a class="text-small" href="classifieds.php">Classifieds</a></li>
                                <li><a class="text-small" target="_blank" href="WAM_Constition_2021-22_updated__lock_.pdf">Constition</a></li>
                            </ul>
                        </div>
                        <!-- end additional links -->
                        <!-- start contact information -->
                        <div class="col-lg-3 col-md-6 widget border-right border-color-medium-dark-gray padding-45px-left md-padding-15px-left md-clear-both md-no-border-right sm-margin-30px-bottom text-center text-md-left">
                            <div class="widget-title alt-font text-small text-medium-gray text-uppercase margin-10px-bottom font-weight-600">Contact Info</div>
                            <p class="text-small d-block margin-15px-bottom width-80 sm-width-100"><?php  echo $get_cont[0]["cnt_adrs"]; ?></p>
                            <div class="text-small">Email: <a href="mailto:<?php echo $get_cont[0]["cnt_email"]; ?>"><?php  echo $get_cont[0]["cnt_email"]; ?></a></div>

                        </div>
                        <!-- end contact information -->
                        <!-- start instagram -->
                        <div class="col-lg-3 col-md-6 widget padding-45px-left md-padding-15px-left text-center text-md-left">
                            <div class="widget-title alt-font text-small text-medium-gray text-uppercase margin-20px-bottom font-weight-600">Location</div>
                            <div class="">
                               <iframe src="<?php  echo  $get_cont[0]["cnt_lcn"];  ?>" width="100%" height="150" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                        <!-- end instagram -->
                    </div>
                </div>
            </div>
            <div class="bg-dark-footer padding-50px-tb text-center sm-padding-30px-tb">
                <div class="container">
                    <div class="row">
                        <!-- start copyright -->
                        <div class="col-md-6 text-md-left text-small text-center">&copy; 2021 WAM is Proudly Developed by <a href="http://www.voxinnov.com/" target="_blank" class="text-dark-gray">VOXINNOV</a></div>
                        <div class="col-md-6 text-md-right text-small text-center">
                            <a href="termsandconditions.php" class="text-dark-gray">Terms and Condition</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="privacypolicy.php" class="text-dark-gray">Privacy Policy</a>
                        </div>
                        <!-- end copyright -->
                    </div>
                </div>
            </div>
        </footer>
        