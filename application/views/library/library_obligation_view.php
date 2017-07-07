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

        <h2 style="margin-bottom: 2vw">My Obligation</h2>

        <p class="wow fadeInUp animated" data-wow-delay=".5s"><strong>Borrowing Status</strong></p>
        <div class="row bs-docs-example wow fadeInUp animated" data-wow-delay=".5s">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                            <th>Collection Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($borrowed) {
                            foreach ($borrowed as $bcollection) {
                                $collectionData = null;
//                                    echo serialize($bcollection).'<br>';
                                if(strcmp($bcollection['status'],"Borrowed")==0) {
                                    ?>
                                    <tr>
                                        <!--                                        <td>-->
                                        <?php //echo $collection['lcid'] ?><!--</td>-->
                                        <td><?php echo $bcollection['lcid'] ?></td>
                                        <td><?php if ($collections) {
                                                foreach ($collections as $coll) {
                                                    if (strcmp($coll['lcid'], $bcollection['lcid']) == 0) {
                                                        echo $coll['title'];
//                                                        echo serialize($coll);
                                                        $collectionData =$coll;
                                                    }
                                                }
                                            }
                                            ?></td>
                                        <td><?php echo date('d M Y', strtotime($bcollection['borrowed_date'])) ?></td>
                                        <td>
                                            <?php
                                            $date=date_create($bcollection['borrowed_date']);
                                            if($borrowSetting) {
                                                foreach ($borrowSetting as $bs) {
                                                    if($bcollection['borrowCategory']==$bs['borrowCategory']){
                                                        $period = $bs['borrowingPeriod'];
                                                        date_add($date,date_interval_create_from_date_string($period." days"));
                                                        echo date_format($date,"Y-m-d");
//                                                        echo date('d M Y', strtotime($bcollection['returned_date']));
                                                    }

                                                }
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $bcollection['userid']; ?></td>
                                        <td><?php/*
                                        echo $collectionData['materialType'];
                                            */?><!--</td>-->

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


        <p class="wow fadeInUp animated" data-wow-delay=".5s"><strong>Overdue Book(s)</strong></p>
        <div class="row bs-docs-example wow fadeInUp animated" data-wow-delay=".5s">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                            <th>Collection Type</th>
                            <th>Fines</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($borrowed) {
                            foreach ($borrowed as $bcollection) {
                                $collectionData = null;


                                $date1=date_create($bcollection['borrowed_date']);
                                $date2=date_create(date("Y-m-d"));
                                $diff=date_diff($date1,$date2);
                                $borrowedPer = $diff->format("%a");

                                $period = 0;

                                if($borrowSetting) {
                                    foreach ($borrowSetting as $bs) {
                                        if($bs['borrowCategory']==$bcollection['borrowCategory']) {
                                            $period = $bs['borrowingPeriod'];
                                        }
                                    }
                                }
                                $late = $borrowedPer - $period;

                                if(strcmp($bcollection['status'],"Borrowed")==0 AND $late>0 ) {
                                    ?>
                                    <tr>
                                        <td><?php echo $bcollection['lcid'] ?></td>
                                        <td><?php if ($collections) {
                                                foreach ($collections as $coll) {
                                                    if (strcmp($coll['lcid'], $bcollection['lcid']) == 0) {
                                                        echo $coll['title'];
                                                        $collectionData =$coll;
                                                    }
                                                }
                                            }

                                            ?></td>

                                        <td><?php echo date('d M Y', strtotime($bcollection['borrowed_date'])) ?></td>
                                        <td>
                                            <?php
                                            $date=date_create($bcollection['borrowed_date']);
                                            if($borrowSetting) {
                                                foreach ($borrowSetting as $bs) {
                                                    if($bcollection['borrowCategory']==$bs['borrowCategory']){
                                                        $period = $bs['borrowingPeriod'];
                                                        date_add($date,date_interval_create_from_date_string($period." days"));
                                                        echo date_format($date,"Y-m-d");
                                                    }

                                                }
                                            }
                                            ?>
                                        </td>

                                        <td><?php echo $collectionData['materialType']?></td>

                                        <?php


                                        $fine = 0;
                                        if($fines) {
                                            foreach($fines as $f) {
                                                if(strcmp($f['type'],$collectionData['materialType'])==0) {
                                                    $fine =  $f['fine'] *$late;
                                                }
                                            }

                                        }
                                        ?>
                                        <td><?php echo $fine;?></td>

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
        <!--<p class="wow fadeInUp animated" data-wow-delay=".5s"><strong>Lost Book(s)</strong></p>
        <div class="bs-docs-example wow fadeInUp animated" data-wow-delay=".5s">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Borrowed Date</th>
                    <th>Due Date</th>
                    <th>Book Type</th>
                    <th>Fines</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>20130701208</td>
                    <td>Accounting principles: international student version</td>
                    <td>07 February 2017</td>
                    <td>07 February 2017</td>
                    <td>Encyclopedia</td>
                    <td>10,000</td>
                </tr>
                <tr>
                    <td>20130701208</td>
                    <td>Accounting principles: international student version</td>
                    <td>07 February 2017</td>
                    <td>07 February 2017</td>
                    <td>Encyclopedia</td>
                    <td>10,000</td>
                </tr>
                <tr>
                    <td>20130701208</td>
                    <td>Accounting principles: international student version</td>
                    <td>07 February 2017</td>
                    <td>07 February 2017</td>
                    <td>Encyclopedia</td>
                    <td>10,000</td>
                </tr>
                <tr>
                    <td>20130701208</td>
                    <td>Accounting principles: international student version</td>
                    <td>07 February 2017</td>
                    <td>07 February 2017</td>
                    <td>Encyclopedia</td>
                    <td>10,000</td>
                </tr>
                </tbody>
            </table>
        </div>-->
    </div>
</div>