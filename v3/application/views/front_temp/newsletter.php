        <!-- NEWSLETTER
        ================================================== -->
        <section class="border-top border-light">
            <div class="container">

                <div class="text-center mb-5 mb-lg-7 mt-0 mt-lg-5 mt-xl-0">
                    <h3 class="h2 mb-3">Don't miss a thing</h3>
                    <p class="w-100 w-md-80 w-lg-50 mx-auto">Cool tips, elements and other useful resources from design.</p>
                </div>

                <div class="w-100 w-md-80 w-lg-50 mx-auto">

                    <!-- start form here -->

                    <form class="quform newsletter-form" action="<?php echo base_url(); ?>assets/libs/quform/newsletter.php" method="post" enctype="multipart/form-data" onclick="">

                        <div class="quform-elements text-center">

                            <div class="row">

                                <!-- Begin Text input element -->
                                <div class="col-md-12">
                                    <div class="quform-element form-group">
                                        <div class="quform-input">
                                            <input class="rounded-pill form-control" id="email" type="text" name="email" placeholder="Enter your email address" />
                                        </div>
                                    </div>
                                </div>
                                <!-- End Text input element -->

                                <!-- Begin Submit button -->
                                <div class="col-md-12">
                                    <div class="quform-submit-inner">
                                        <button class="btn btn-white text-primary m-0 px-4" type="submit"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                    <div class="quform-loading-wrap"><span class="quform-loading"></span></div>
                                </div>
                                <!-- End Submit button -->

                                <div class="col-md-12">
                                    <span class="d-inline-block">Enter your e-mail to get the latest news.</span>
                                </div>

                            </div>

                        </div>

                    </form>

                    <!-- end form here -->

                </div>

            </div>

        </section>
