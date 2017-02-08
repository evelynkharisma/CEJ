<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SMS</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/login_style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/font-awesome/css/font-awesome.min.css"/>

</head>
<body>
    <div class="welcome-container">
        <?php if (!empty($content)): ?>
            <?php $this->load->view($content); ?>
        <?php else: ?>
            Page not found !
        <?php endif; ?>
    </div>
    </body>
</html>