<?php $privilege = $this->general->checkPrivilege($this->nativesession->get('librole'), 'p0038');
if($privilege == 1){?>
<div class="row" style="margin-bottom: 3vw">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
<!--                <a href="--><?php //echo base_url() ?><!--index.php/library/outstandingCollection" class="btn btn-primary lib-top-btn" style="margin-bottom: 2vw"><i class="fa fa-eye"></i>View Outstanding Collection</a>-->
                <a href="<?php echo base_url() ?>index.php/library/addBorrowedCollection" class="btn btn-primary lib-top-btn" style="margin-bottom: 2vw"><i class="fa fa-plus"></i>Add Borrowing Collection</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>