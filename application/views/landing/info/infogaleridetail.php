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
        </div>
    </div>
</div>