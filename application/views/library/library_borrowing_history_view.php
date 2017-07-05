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
                    <h2>Borrowing History</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="container">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <!--                                <th width="11%">Number</th>-->
                                <th width="10%" >ID</th>
                                <th width="50%">Title</th>
                                <th width="20%">Borrowed Date</th>
                                <th width="20%">Returned Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($borrowed) {
                                foreach ($borrowed as $bcollection) {
//                                    echo serialize($bcollection).'<br>';
                                    if(strcmp($bcollection['status'],"Borrowed")) {
                                        ?>
                                        <tr>
                                            <!--                                        <td>-->
                                            <?php //echo $collection['lcid'] ?><!--</td>-->
                                            <td><?php echo $bcollection['lcid'] ?></td>
                                            <td><?php if ($collections) {
                                                    foreach ($collections as $coll) {
                                                        if (strcmp($coll['lcid'], $bcollection['lcid']) == 0) {
                                                            echo $coll['title'];
                                                        }
                                                    }
                                                }
                                                ?></td>
                                            <td><?php echo date('d M Y', strtotime($bcollection['borrowed_date'])) ?></td>
                                            <td><?php echo date('d M Y', strtotime($bcollection['returned_date'])) ?></td>

                                        </tr>
                                        <?php
                                    }
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