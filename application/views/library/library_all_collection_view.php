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
                                <th width="10%">ISBN</th>
                                <th >Title</th>
                                <th width="15%">Type</th>
                                <th width="5%">Availability</th>
                                <th width="5%">Borrowed</th>
                                <th width="45%">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($collections) {
                                foreach ($collections as $collection) {
                            ?>
                                    <tr>
<!--                                        <td>--><?php //echo $collection['lcid'] ?><!--</td>-->
                                        <td><?php echo $collection['isbn'] ?></td>
                                        <td><?php echo $collection['title'] ?></td>
                                        <td><?php echo $collection['materialType'] ?></td>
                                        <td><?php echo $collection['stock'] ?></td>
                                        <td><?php
                                            $found = 0;
                                            if($totalborrowed) {
                                                foreach ($totalborrowed as $t) {
                                                    if(strcmp($t['lcid'], $collection['lcid'])==0) {
                                                        echo $t['totalBorrowed'];
                                                        $found = 1;
                                                    }
                                                }
                                            }
                                            if(!$found) {
                                                echo '0';
                                            }
                                            ?></td>

                                        <td>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($collection['lcid'],'collection');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/library/collectionAuthor/<?php echo $encrypted ?>" class="btn-primary btn" ><i class="fa fa-eye"></i> Authors</a>
                                            <a href="<?php echo base_url() ?>index.php/library/collectionSubject/<?php echo $encrypted ?>" class="btn-primary btn" ><i class="fa fa-eye"></i> Subject</a>
                                            <a href="<?php echo base_url() ?>index.php/library/collectionBorrowed/<?php echo $encrypted ?>" class="btn-primary btn" ><i class="fa fa-eye"></i> Borrowed</a>
                                            <a href="<?php echo base_url() ?>index.php/library/editCollection/<?php echo $encrypted ?>" class="btn-primary btn" ><i class="fa fa-edit"></i> Edit</a>
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