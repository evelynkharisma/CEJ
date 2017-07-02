<?php $privilege = $this->general->checkPrivilege($this->nativesession->get('librole'), 'p0035');
if($privilege == 1){?>
<div class="row" style="margin-bottom: 3vw">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <a href="<?php echo base_url() ?>index.php/library/collection" class="btn btn-primary lib-top-btn">Search Collection</a>
                <a href="<?php echo base_url() ?>index.php/library/allCollection" class="btn btn-primary lib-top-btn">View Collections</a>
                <a href="<?php echo base_url() ?>index.php/library/addCollection" class="btn btn-primary lib-top-btn">Add Collection</a>
                <a href="<?php echo base_url() ?>index.php/library/allBorrowedCollection" class="btn btn-primary lib-top-btn">View Borrowed Collections</a>
                <a href="<?php echo base_url() ?>index.php/library/addBorrowedCollection" class="btn btn-primary lib-top-btn">Add Borrowing Collection</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>