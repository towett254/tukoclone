









<?php 


if (!empty($_GET['admin']) ) {
 // $ref = $_GET['ref'];
$this->load->view('front_temp/head.php');
$this->load->view('front_temp/header.php');
  $this->load->view('front_temp/login.php');
  $this->load->view('front_temp/footer.php');

  die();
}else{
    //echo "ref is missing";

    //die();
}


?>s



    <?php $this->load->view('front_temp/head.php'); ?>



    <?php $this->load->view('front_temp/header.php'); ?>




                    <div class="col-md-6 col-lg-4 mb-7">
                        <div class="card border-0 rounded-lg shadow-light h-100">
                            <img src="<?php echo base_url(); ?>assets/img/blog/blog-06.jpg" class="card-img-top" alt="...">
                            <div class="card-body p-5">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a href="#!" class="label font-weight-bold">Design</a>
                                    <span class="small">24th November</span>
                                </div>

                                <div class="border-bottom border-light mb-4 pb-4">
                                    <a href="#!"><h5>How to find the right design?</h5></a>
                                    <p>A good design is impressive and useful in fulfilling its purpose.</p>
                                    <a href="<?php echo base_url('index.php/details'); ?>">read more</a>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">

                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo base_url(); ?>assets/img/testmonials/t-5.jpg" class="rounded-circle sm-avatar" alt="...">

                                        <div class="ml-3">
                                            <span class="small"><span class="font-weight-bold">By: </span>James Batie</span>
                                        </div>
                                    </div>

                                    <a href="#!" class="bg-danger-10 py-1 px-2 rounded-pill text-danger small">
                                        <i class="fas fa-heart mr-1"></i>23
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <!-- End Blog -->

        

            </div>
        </section>




    <?php //$this->load->view('front_temp/newsletter.php'); ?>

    <?php $this->load->view('front_temp/footer.php'); ?>





    <?php //$this->load->view('front_temp/login.php'); ?>




