<!-- page content -->

                                                                                                                                                                                                                <div class="contact-agile">
<div class="faq">
    <div class="container">
        <div class="row" style="margin-bottom: 3vw">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>Collection Borrower</h2>
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
                                <th width="40%">Name</th>
                                <th >User Type</th>
                                <th width="15%">Borrowed Date</th>
                                <th width="5%">Status</th>
<!--                                <th width="5%">Borrowed</th>-->
<!--                                <th width="15%">Action</th>-->

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($colBorrowed) {
                                foreach ($colBorrowed as $cb) {
                            ?>
                                    <tr>
<!--                                        <td>--><?php //echo $collection['lcid'] ?><!--</td>-->
                                        <td><?php echo ucwords($cb['firstname'].' '.$cb['lastname']) ?></td>
                                        <td><?php echo $cb['usertype'] ?></td>
                                        <td><?php echo $cb['borrowed_date'] ?></td>
                                        <td><?php echo $cb['status'] ?></td>


<!--                                        <td>-->
<!--                                            --><?php
//                                            $encrypted = $this->general->encryptParaID($cb['lcid'],'collection');
//                                            ?>
<!--                                            <a href="--><?php //echo base_url() ?><!--index.php/library/editBorrowedCollection/--><?php //echo $encrypted ?><!--" class="btn-primary btn" ><i class="fa fa-edit"></i> Edit</a>-->
<!--                                        </td>-->
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