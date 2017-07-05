<?php $privilege = $this->general->checkPrivilege($this->nativesession->get('librole'), 'p0035');
if($privilege == 1){?>
<div class="row" style="margin-bottom: 3vw">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <a href="<?php echo base_url() ?>index.php/library/allBorrowedCollection" class="btn btn-primary lib-top-btn">Borrowed Collections</a>
<!--                <a href="--><?php //echo base_url() ?><!--index.php/library/addBorrowedCollection" class="btn btn-primary lib-top-btn">Add Borrowing Collection</a>-->
                <a href="<?php echo base_url() ?>index.php/library/allBorrowingSetting" class="btn btn-primary lib-top-btn">Borrowing Setting</a>
<!--                <a href="--><?php //echo base_url() ?><!--index.php/library/addBorrowedCollection" class="btn btn-primary lib-top-btn">Add Borrowing Collection</a>-->
                <a href="<?php echo base_url() ?>index.php/library/allFineSetting" class="btn btn-primary lib-top-btn">Fine Setting</a>
<!--                <a href="--><?php //echo base_url() ?><!--index.php/library/addBorrowedCollection" class="btn btn-primary lib-top-btn">Add Fine Setting</a>-->
            </div>
        </div>
    </div>
</div>
<?php } ?>