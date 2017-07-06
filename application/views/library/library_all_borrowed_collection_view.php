<!-- page content -->

<div class="faq">
    <div class="container">
        <div class="row" style="margin-bottom: 3vw">
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 1vw">
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
                <h2>Borrowed Collections</h2>
            </div>
        </div>

        <?php if (!empty($top2subnavigation)): ?>
            <?php $this->load->view($top2subnavigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>

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
<!--                                <th width="10%">Returned Date</th>-->
                                <th width="15%">Status</th>
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

                                if(strcmp($bcollection['status'], "Borrowed")==0) {
                                    ?>
                                    <tr>
                                        <!--                                        <td>-->
                                        <?php //echo $collection['lcid'] ?><!--</td>-->
                                        <td><?php echo $bcollection['userid'] ?></td>
                                        <td><?php echo $bcollection['firstname'] ?></td>
                                        <td><?php echo $bcollection['usertype'] ?></td>
                                        <td><?php echo $bcollection['lcid'] ?></td>
                                        <td><?php echo date('d M Y', strtotime($bcollection['borrowed_date'])) ?></td>
                                        <!--                                        <td>-->
                                        <?php //echo $bcollection['returned_date'] ?><!--</td>-->

                                        <?php
                                        if ($late > $period AND strcmp($bcollection['status'], "Returned")) {
                                            echo '<td style="color: red"> <strong>' . $bcollection['status'] . ' - Overdue</strong>';
                                        } else {
                                            echo '<td>' . $bcollection['status'];
                                        }
                                        ?>
                                        </td>
                                        <td>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($bcollection['lbid'], 'libborrowed');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/library/editBorrowedCollection/<?php echo $encrypted ?>"
                                               class="btn-primary btn"><i class="fa fa-eye"></i> View</a>
                                            <a href="<?php echo base_url() ?>index.php/library/deleteBorrowedCollection/<?php echo $encrypted ?>"
                                               class="btn-primary btn"
                                               onclick="return confirm('Are you sure want to delete this?');"><i
                                                        class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            if($borrowed) {
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