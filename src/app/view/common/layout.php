<!DOCTYPE html>
<html>

<head>
    <?php include_once __DIR__ . "/meta.php";?>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="___epii_content" style="display:none">
        <div class="content" style="padding-top: 20px;"><?php echo $__CONTENT__; ?></div>
    </div>
    <div id="___epii_loading">
        <?php echo $_ui_["page_loading"]; ?>
    </div>

    <!-- ./wrapper -->
    <?php include_once __DIR__ . "/script.php";?>
    <script>
        window.onEpiiInit(function() {
            <?php echo $_ui_["page_loading_finish"]; ?>
            try {
                    if(window.top.addEpiiAdminListener){
                        window.top.addEpiiAdminListener(window);
                    }
                } catch (error) {
                    
                }
        });
        try {
            if(window.top.isDarkTheme){
            let isDarkTheme = window.top.isDarkTheme();
            if(isDarkTheme){
                 document.body.style.backgroundColor = "transparent";
                document.body.style.color = "#fff";
            }
        } 
        } catch (error) {
            
        }
       

       

    </script>
</body>

</html>