
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
            <div class>
                <label>Video:</label>
                <div>
                    <?php foreach ($video as $a => $b) { ?>
                        <video controls poster="/images/w3html5.gif" style="width:100%">
                            <source src="<?= base_url(PATH_PUBLIC_ATTACH . 'info/' . $b->name); ?>">
                            Your browser does not support the video tag.
                        </video>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
