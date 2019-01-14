<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $_ui_["site_title"]; ?></title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo $_ui_["static_url_pre"]; ?>js/plugins/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo $_ui_["static_url_pre"]; ?>css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo $_ui_["static_url_pre"]; ?>css/adminlte_ws.css">
<link rel="stylesheet" href="<?php echo $_ui_["static_url_pre"]; ?>js/plugins/bootStrap-addTabs/bootstrap.addtabs.css"
      type="text/css"
      media="screen"/>
<link rel="stylesheet" href="<?php echo $_ui_["static_url_pre"]; ?>css/epii.css">


<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<?php if (isset($_ui_["css"])) {
    foreach ($_ui_["css"] as $css) {

        ?>
        <link rel="stylesheet" href="<?php echo $css; ?>">
    <?php };
} ?>

<script>
    var Args = window.Args = <?php echo $_ui_["epiiargs_data"]; ?>;
    window.onEpiiInit = function (callback) {
        if (!window.epiiInitFunctions) {
            window.epiiInitFunctions = [];
        }
        window.epiiInitFunctions.push(callback);
    };

</script>