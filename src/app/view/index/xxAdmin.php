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
$html = replaceFirst("<head>",  "<head><link rel=\"stylesheet\" href=\"{$_ui_["static_url_pre"]}js/plugins/font-awesome/css/font-awesome.min.css\"><link rel=\"stylesheet\" href=\"{$_ui_["static_url_pre"]}css/ionicons.min.css\">", $html);


$fontFace = <<<XLX

@font-face {
    font-family: 'FontAwesome';
    src: url('{$_ui_["fontawesome_fonts_url_pre"]}fontawesome-webfont.eot?v=4.7.0');
    src: url('{$_ui_["fontawesome_fonts_url_pre"]}fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'), url('{$_ui_["fontawesome_fonts_url_pre"]}fontawesome-webfont.woff2?v=4.7.0') format('woff2'), url('{$_ui_["fontawesome_fonts_url_pre"]}fontawesome-webfont.woff?v=4.7.0') format('woff'), url('{$_ui_["fontawesome_fonts_url_pre"]}fontawesome-webfont.ttf?v=4.7.0') format('truetype'), url('{$_ui_["fontawesome_fonts_url_pre"]}fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
    font-weight: normal;
    font-style: normal;
}
XLX;

$html = str_replace("<style>", "<style>" .$fontFace, $html);


echo $html;
