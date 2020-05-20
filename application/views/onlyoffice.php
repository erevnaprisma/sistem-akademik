<script type="text/javascript" src="http://admin.siedu.id:9090/web-apps/apps/api/documents/api.js"></script>
<div id="placeholder"></div>

<script>
    config = {
        "document": {
            "fileType": '<?= explode('.',$_GET['key'])[1] ?>',
            "key": '<?= $_GET['key'] ?>',
            "title": '<?= $_GET['key'] ?>',
            "url": "<?= base_url('assets/public/attach/' . $_GET['action']."/".$_GET['key'])?>"
        },
        "documentType": "text",
        "editorConfig": {
            "callbackUrl": "<?= base_url("onlyoffice/edit/".$_GET['action']) ?>"
        }
    };
    var docEditor = new DocsAPI.DocEditor("placeholder", config);
</script>
