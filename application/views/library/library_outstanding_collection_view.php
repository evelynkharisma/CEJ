<!-- page content -->

<div class="faq">
    <div class="container">
        <div class="row" style="margin-bottom: 3vw">
            <div class="col-md-12 col-sm-12 col-xs-12">
<!--                <h2>Borrowed Collection</h2>-->
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


        <div class="row" style="margin-bottom: 3vw">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>Outstanding Collections</h2>
            </div>
        </div>

        <a href="<?php echo base_url() ?>index.php/library/" class="btn-success btn set-right" style="margin-bottom: 2vw"><i class="fa fa-bell"></i> Notify All</a>
<!--        <a href="--><?php //echo base_url() ?><!--index.php/library/addBorrowedCollection" class="btn btn-primary lib-top-btn" style="margin-bottom: 2vw">Add Borrowing Collection</a>-->

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
                                <th width="10%">Collection</th>
                                <th width="15%">Borrowed Date</th>
                                <th width="15%">Due Date</th>
<!--                                <th width="15%">Status</th>-->
                                <th width="15%">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($borrowed as $bcollection) {
                                $date1=date_create($bcollection['borrowed_date']);
                                $date2=date_create(date("Y-m-d"));
                                $diff=date_diff($date1,$date2);
                                $late = $diff->format("%a");
                                $period = 0;

                                if($borrowSetting) {
                                    foreach ($borrowSetting as $bs) {
                                        if($bs['borrowCategory']==$bcollection['borrowCategory']) {
                                            $period= $bs['borrowingPeriod'];
                                        }

                                    }
                                }

                                if($late>$period AND strcmp($bcollection['status'], "Returned")) {
                                    ?>
                                    <tr>
                                        <td><?php echo $bcollection['userid'] ?></td>
                                        <td><?php echo $bcollection['firstname'] ?></td>
                                        <td><?php echo $bcollection['usertype'] ?></td>
                                        <td><?php echo $bcollection['lcid'] ?></td>
                                        <td><?php echo date('d M Y', strtotime($bcollection['borrowed_date'])) ?></td>
                                        <td><?php
                                            $date=date_create($bcollection['borrowed_date']);
                                            if($borrowSetting) {
                                                foreach ($borrowSetting as $bs) {
                                                    if($bcollection['borrowCategory']==$bs['borrowCategory']){
                                                        $period = $bs['borrowingPeriod'];
                                                        date_add($date,date_interval_create_from_date_string($period." days"));
                                                        echo date('d M Y', strtotime(date_format($date,"Y-m-d")));
//                                                        echo date('d M Y', strtotime($bcollection['returned_date']));
                                                    }

                                                }
                                            }

                                            ?>
                                        </td>

<!--                                        </td>-->
                                        <td>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($bcollection['lbid'],'libborrowed');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/library/editBorrowedCollection/<?php echo $encrypted ?>" class="btn-success btn" ><i class="fa fa-bell"></i> Notify</a>
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
    document.getElementById("libmenu_borrowing").className = "active";
</script>
<!-- /page content -->