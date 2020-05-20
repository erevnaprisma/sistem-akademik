<div class="callout callout-default">
    <div class="row">
        <div class="col-md-3">
            <label>Dari</label>
            <div>
                <img src="" alt="">
            </div>
            <label><?= $detail->created_by_name ?></label>
            <br>
            <label><?= date("d-m-y", strtotime($detail->created_dt)) ?></label>
            <br>
            <br>
            <label>Kepada</label>
            <br>
            <br>
            <label><?= $detail->kepada ?></label>
        </div>
        <div class="col-md-9">
            <?= $detail->note ?>
            <br>
            <div>
                <label>Gambar:</label>
                <div>
                    <?php foreach ($gambar as $a => $b) { ?>
                    <a href="<?= base_url(PATH_PUBLIC_ATTACH . 'info/' . $b->name); ?>" target="_blank">
                        <img src="<?= base_url(PATH_PUBLIC_ATTACH . 'info/' . $b->name); ?>" alt="" style="width:100px;height:100px;">
                    </a>
                    <?php } ?>
                </div>
            </div>
            <div>
                <label>Dokumen:</label>
                <div>
                    <?php foreach ($dokumen as $a => $b) { ?>
                        <a href="<?= base_url(PATH_PUBLIC_ATTACH . 'info/' . $b->name); ?>" alt="" target="blank"> <?= $b->name ?> </a>
                    <?php } ?>
                </div>
            </div>
            <div>
                <label>Komentar:</label>
                

                            <?php foreach ($komen as $a => $b) { ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <video src="<?= base_url(PATH_PUBLIC_ATTACH . 'img/' . $b->name); ?>" alt="" style="width:50;height:50;">
                                        <br>
                                        <label for=""><?= $b->created_by_name?></label>
                                        <label for=""><?= $b->created_dt_name ?></label>
                                    </div>
                                    <div class="col-md-9">
                                        <?= $b->name ?>
                                    </div>
                                </div>
                            <?php } ?>

                   
                    
                </div>
            </div>
        </div>
    </div>
</div>