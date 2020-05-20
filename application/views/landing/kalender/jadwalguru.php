<form id="guruForm" method="post" action="<?=base_url('api/akademik/guru/'.$action); ?>" class="form-horizontal">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <!-- input states -->
    <div class="form-group">
        <label class="col-md-3">Sekolah</label>
        <div class="col-md-9">
            <select name="id_skl" class="form-control">
                <option value="">Select</option>
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Name</label>
        <div class="col-md-9">
            <input type="text" name="name" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"> Email</label>
        <div class="col-md-9">
            <input type="text" name="email" class="form-control">
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3">Is Active</label>
        <div class="col-md-9">
            <input type="checkbox" name="is_active">
            Yes
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3"></label>
        <div class="col-md-9">
            <button class="btn btn-primary btn-save">Submit</button>
        </div>
    </div>
</form>

<div id="schedule"></div>

<script>
$(function() {
    $('#schedule').jqs({
        mode: 'read',
        days: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        data: [{
            day: 0,
            periods: [{
                "start": "10:00",
                "end": "12:00",
                "title": "A black period",
                "backgroundColor": "rgba(0, 0, 0, 0.5)",
                "borderColor": "#000",
                "textColor": "#fff"
            }]
        }, {
            day: 3,
            periods: [
                ['00:00', '08:30'],
                ['09:00', '12:00']
            ]
        }]
    });

})
</script>