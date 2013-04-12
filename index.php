<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Seymour Dev</title>
<!-- Optimization for iOS -->
<!--
<link rel="stylesheet" media="only screen and (width: 320px)" href="/style/style-ios.css" />
<link rel="stylesheet" media="only screen and (width: 480px)" href="/style/style-ios-landscape.css" />
<link rel="stylesheet" media="only screen and (width: 768px)" href="/style/style.css" />
<link rel="stylesheet" media="only screen and (min-width: 961px)" href="/style/style.css" />
-->
<link rel="stylesheet" href="/style/style.css" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" />
<script language="javascript">
var userAgent = navigator["userAgent"]["toLowerCase"]();
if (userAgent["indexOf"]("iphone") == -1 && userAgent["indexOf"]("ipad") == -1 && userAgent["indexOf"]("ipod") == -1 && userAgent["indexOf"]("ios") == -1 && userAgent["indexOf"]("mobile") == -1) {
	var imgs = document.getElementsByTagName("img");
	for (i=0;i<imgs.length;i++) {
		var src = imgs[i].src;
		if (src.search(/@2x.[A-z]+$/) > -1) {
			var srcname = src.slice(0,src.search(/@2x.[A-z]+$/));
			var srcsuffix = src.slice(src.search(/@2x.[A-z]+$/)+3);
			imgs[i].src = srcname + srcsuffix;
		}
	}
}
</script>
<!--[if IE 6]>
<meta http-equiv="refresh" content="0;url=/warning" />
<![endif]-->
<!--[if IE 7]>
<meta http-equiv="refresh" content="0;url=/warning" />
<![endif]-->
<!--[if IE 8]>
<meta http-equiv="refresh" content="0;url=/warning" />
<![endif]-->
</head>
<body>
<div id="wrapper">

<?php
// Set vars
$server_name = "http://".$_SERVER['SERVER_NAME'];
$url_this = $server_name.$_GET['path'];
if (substr($url_this, strlen($url_this)-1,1) != '/') $url_this = $url_this."/";
$root = "/var/www/vdl.seymourdev.com";
$dir = $root.$_GET['path'];

// Header begins
echo "<div id=\"header\">";

$dirname = $dir;
if (substr($dirname, strlen($dirname)-1,1) === '/') $dirname = substr($dirname, 0, strlen($dirname)-1);
$dirname = substr($dirname, strripos($dirname, '/')+1);
$handle = @opendir($dir."/") or die("无法打开 ".$dirname." <a href=\"/\">返回🏠</a>");
if ($dirname === 'vdl.seymourdev.com') {
$dirname = 'Plastic Beach (YouTube & Vimeo)';
}
echo "<h1>".$dirname." 中的文件:</h1>";

echo "<a href=\"new.php\"><emoji>🆕</emoji>添加新的视频下载</a>";
echo "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
echo "<a href=\"javascript:history.go(-1);\"><emoji>◀</emoji>后退</a>";
echo "&nbsp;&nbsp;&nbsp;";
echo "<a href=\"javascript:history.go(0);\"><emoji>🔄</emoji>刷新</a>";
echo "&nbsp;&nbsp;&nbsp;";
echo "<a href=\"javascript:history.go(1);\">前进<emoji>▶</emoji></a>";

if (strlen($dir) > strlen($root)) {
echo "&nbsp;&nbsp;&nbsp;";
$url_last_folder = substr($url_this, 0, strripos($url_this, "/"));
$url_last_folder = substr($url_last_folder, 0, strripos($url_last_folder, "/")+1);
echo "<a href=\"$url_last_folder\">向上一层<emoji>⬆</emoji></a>";
}

echo "</div>";
//Header ends

// Main begins
echo "<div id=\"main\">";

echo "<ul style='list-style-type: none;'>";
while ($file = readdir($handle)) {
    if ($file != "." && $file != ".." && $file != "index.php" && $file != ".index.php.swp" && $file != "icons" && $file != "style" && $file != "new.php" && $file != "log.txt") {
        echo "<li class=\"file\">";
        echo "<a href=\"".$url_this.rawurlencode($file)."\">";
        
        // decide file type & set icons
        $filetype = 'unknown';
        if(is_dir($dir."/".$file)) {
            $filetype = 'dir';
        }
        else {
            $extpos = strripos($file, ".");
            if ($extpos != 0) {
                $filetype = substr($file, strripos($file, ".")+1);
            }
        }
        if (file_exists("$root/icons/$filetype.png")) {
      	    echo "<img class=\"icon\" src=\"/icons/$filetype.png\" alt=\"\" />";
        }
        else {
            echo "<img class=\"icon\" src=\"/icons/unknown.png\" alt=\"\" />";
        }
        echo " $file";
        echo "</a></li>";
    }
}
echo "</ul>";

echo "</div>";
// Main ends

closedir($handle);
?>

<script language="javascript">
var userAgent = navigator["userAgent"]["toLowerCase"]();
if (userAgent["indexOf"]("iphone") == -1 && userAgent["indexOf"]("ipad") == -1 && userAgent["indexOf"]("ipod") == -1 && userAgent["indexOf"]("ios") == -1 && userAgent["indexOf"]("mobile") == -1) {
	var imgs = document.getElementsByTagName("img");
	for (i=0;i<imgs.length;i++) {
		var src = imgs[i].src;
		if (src.search(/@2x.[A-z]+$/) > -1) {
			var srcname = src.slice(0,src.search(/@2x.[A-z]+$/));
			var srcsuffix = src.slice(src.search(/@2x.[A-z]+$/)+3);
			imgs[i].src = srcname + srcsuffix;
		}
	}
}
</script>

<div id="footer">
    <div id="footer-link"></div>
    <div id="footer-info">
        <p>"<a href="/">Plastic Beach (YouTube & Vimeo)</a>" 文件分享系统 | Designed and Created By Alex Rezit</p>
        <br />
        <p id="copyright">Copyright © 2011-2012 <a href="http://seymourdev.com/about">Seymour Dev Team</a> 保留一切权利.</p>
        <br />
        <ul id="protocol">
            <li>
                <a href="legal.php" class="first"><span>使用条款</span></a>
            </li><li>
                <a href="privacy.php"><span>隐私政策</span></a>
            </li>
        </ul>
    </div>
</div>

</div>
</body>
</html>
