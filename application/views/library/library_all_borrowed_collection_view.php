<!-- page content -->

                                                                                                                                                                                                                <div class="contact-agile">
<div class="faq">
    <div class="container">
        <div class="row" style="margin-bottom: 3vw">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>Collection</h2>
                <?php if ($this->nativesession->get('error')): ?>
                    <div  class="alert alert-error">
                        <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
                    </div>
                <?php endif; ?>
                <?php if (validation_errors()): ?>
                    <div  class="alert alert-error">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->nativesession->get('success')): ?>
                    <div  class="alert alert-success">
                        <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($top2navigation)): ?>
            <?php $this->load->view($top2navigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
<!--                                <th width="11%">Number</th>-->
                                <th width="5%">ID</th>
                                <th width="15%">Name</th>
                                <th width="10%">Role</th>
                                <th width="10%">Borrowed Date</th>
                                <th width="10%">Returned Date</th>
                                <th width="10%">Status</th>
                                <th width="15%">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($borrowed) {
                                foreach ($borrowed as $bcollection) {
                            ?>
                                    <tr>
<!--                                        <td>--><?php //echo $collection['lcid'] ?><!--</td>-->
                                        <td><?php echo $bcollection['userid'] ?></td>
                                        <td><?php echo $bcollection['firstname'] ?></td>
                                        <td><?php echo $bcollection['usertype'] ?></td>
                                        <td><?php echo $bcollection['borrowed_date'] ?></td>
                                        <td><?php echo $bcollection['returned_date'] ?></td>
                                        <td><?php echo $bcollection['status'] ?></td>
                                        <td>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($bcollection['lbid'],'libborrowed');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/library/editBorrowedCollection/<?php echo $encrypted ?>" class="btn-primary btn" ><i class="fa fa-edit"></i> Edit</a>
                                            <a href="<?php echo base_url() ?>index.php/library/deleteCollection/<?php echo $encrypted?>" class="btn-primary btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>

                            <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#example').dataTable();
    });
</script>
<script>
    document.getElementById("libmenu_collection").className = "active";
</script>
<!-- /page content -->