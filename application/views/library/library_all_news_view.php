<!-- page content -->

                                                                                                                                                                                                                <div class="contact-agile">
<div class="faq">
    <div class="container">
        <div class="row" style="margin-bottom: 3vw">
            <div class="col-md-12 col-sm-12 col-xs-12">
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

                <h2>News</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
<!--                                <th width="11%">Number</th>-->
                                <th width="5%">No</th>
                                <th width="65%">Title</th>
                                <th width="10%">Date</th>
                                <th width="20%">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($news) {
                                $i=1;
                                foreach ($news as $n) {
                            ?>
                                    <tr>
<!--                                        <td>--><?php //echo $n['lcid'] ?><!--</td>-->
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $n['title'] ?></td>
                                        <td><?php echo date('d M Y', strtotime($n['date']))?></td>
                                        <td>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($n['newsid'],'libnews');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/library/editNews/<?php echo $encrypted ?>" class="btn-primary btn" ><i class="fa fa-edit"></i> Edit</a>
                                            <a href="<?php echo base_url() ?>index.php/library/deleteNews/<?php echo $encrypted?>" class="btn-primary btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>

                            <?php
                                    $i++;
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
<!-- /page content -->