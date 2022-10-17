<meta charset="utf-8">
<title>CodeIgniter Login System | CodexWorld</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="" />
<meta name="keywords" content="" />

<link href="//fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900iSlabo+27px&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">

<!-- Stylesheet file -->
<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all" />

<?php if($this->uri->segment(1) != '' && $this->uri->segment(1) != 'login' && $this->uri->segment(1) != 'registration' && $this->uri->segment(1) != 'forgotPassword' && $this->uri->segment(1) != 'resetPassword'){ ?>
<link href="<?php echo base_url('assets/css/account.css'); ?>" rel="stylesheet" type="text/css" media="all" />

<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

<!-- script-for-menu -->
<script>
$(document).ready(function(){
    $( "span.menu" ).click(function() {
        $( "ul.nav1" ).slideToggle( 300, function() {
            // Animation complete.
        });
    });
});
</script>
<!-- /script-for-menu -->	
<?php } ?>