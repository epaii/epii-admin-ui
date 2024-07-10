<?php

function replaceFirst($search, $replace, $subject)
{
    $searchLen = strlen($search);
    if (($pos = strpos($subject, $search)) !== false) {
        return substr_replace($subject, $replace, $pos, $searchLen);
    }
    return $subject;
}

$html = file_get_contents($_ui_["xxAdmin_static_url_pre"] . "index.html");

$injectDataString = "<script>window.__php__admin_data__ =  " . json_encode($_ui_) . " ;</script>";
$html = replaceFirst("<script", $injectDataString . "<script", $html);

$html = str_replace(["src=\"/", "src=\"./"], "src=\"" . $_ui_["xxAdmin_static_url_pre"], $html);
$html = str_replace(["href=\"/", "href=\"./"], "href=\"" . $_ui_["xxAdmin_static_url_pre"], $html); 
$html = replaceFirst("<head>",  "<head><link rel=\"stylesheet\" href=\"https://epiiadmin-js.chinacloudsites.cn/js/plugins/font-awesome/css/font-awesome.min.css\"><link rel=\"stylesheet\" href=\"https://epiiadmin-js.chinacloudsites.cn/css/ionicons.min.css\">", $html);


$fontFace = <<<XLX

@font-face {
    font-family: 'FontAwesome';
    src: url('https://epiiadmin-js.chinacloudsites.cn/js/plugins/font-awesome/fonts//fontawesome-webfont.eot?v=4.7.0');
    src: url('https://epiiadmin-js.chinacloudsites.cn/js/plugins/font-awesome/fonts//fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'), url('https://epiiadmin-js.chinacloudsites.cn/js/plugins/font-awesome/fonts//fontawesome-webfont.woff2?v=4.7.0') format('woff2'), url('https://epiiadmin-js.chinacloudsites.cn/js/plugins/font-awesome/fonts//fontawesome-webfont.woff?v=4.7.0') format('woff'), url('https://epiiadmin-js.chinacloudsites.cn/js/plugins/font-awesome/fonts//fontawesome-webfont.ttf?v=4.7.0') format('truetype'), url('https://epiiadmin-js.chinacloudsites.cn/js/plugins/font-awesome/fonts//fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
    font-weight: normal;
    font-style: normal;
}
XLX;

$html = str_replace("<style>", "<style>" .$fontFace, $html);


echo $html;
