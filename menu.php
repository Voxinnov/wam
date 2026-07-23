<?php 
include("autoload.php");
$db     =   new MySql();
$db->connect();	 
$cont	=	new Location();
			     
$get_cont	=	$cont->getLocation();
?>       <header>
            <!-- start navigation -->
            <nav class="navbar navbar-default bootsnav background-white header-light navbar-scroll-top navbar-expand-lg nav-box-width">
                <div class="container nav-header-container">
                    <!-- start logo -->
                    <div class="col-auto pl-lg-0">
                        <a href="index.php" title="WAM" class="logo"><img src="images/logo.png" data-rjs="images/logo.png" alt="WAM" class="logo-light default" ></a>
                    </div>
                    <!-- end logo -->
                    <div class="col accordion-menu pr-0 pr-md-3">
                        <button type="button" class="navbar-toggler collapsed desktop_icon" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
                            <span class="sr-only">toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-collapse collapse justify-content-end" id="navbar-collapse-toggle-1">
                            <ul id="accordion" class="nav navbar-nav no-margin alt-font text-normal" data-in="fadeIn" data-out="fadeOut">
                                <!-- start menu item -->
                                   <li class=" ">
                                    <a href="index.php">Home</a>
                                    
                                    <!-- start sub menu -->
                                </li>
                              
								   <li class=" "><a href="about.php">About</a>
                                </li>
                             <li class=" "><a href="portfolio.php">Portfolio</a>
                                </li>
								<li class=" "><a href="videos.php">Videos</a>
                                </li>
								<li class=" "><a href="activities.php">Activity</a>
                                </li>
								<li class=" "><a href="officebearers.php">Office Bearers	</a>
                                </li>
								<li class=" "><a href="contact.php">contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto pr-lg-0">
                     
                    </div>
                </div>
            </nav>
            <!-- end navigation --> 
        </header>