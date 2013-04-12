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

<div id="main">
    <?php

    function get_date()
    {
        return date('F jS Y - h:i:s A');
    }

    function get_ip()
    {
        $ip = '';
        if (getenv('HTTP_CLIENT_IP')) {
               $ip = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
               $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('REMOTE_ADDR')) {
               $ip = getenv('REMOTE_ADDR');
        } else {
               $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function get_os() {
        $os = $_SERVER['HTTP_USER_AGENT'];
        if(strpos($os,"Windows NT 5.0")) $os="Windows 2000";
        elseif(strpos($os,"Windows NT 5.1")) $os="Windows XP";
        elseif(strpos($os,"Windows NT 5.2")) $os="Windows 2003";
        elseif(strpos($os,"Windows NT 6.0")) $os="Windows Vista";
        elseif(strpos($os,"Windows NT")) $os="Windows NT";
        elseif(strpos($os,"Windows 9")) $os="Windows 98";
        elseif(strpos($os,"unix")) $os="Unix";
        elseif(strpos($os,"linux")) $os="Linux";
        elseif(strpos($os,"SunOS")) $os="SunOS";
        elseif(strpos($os,"BSD")) $os="FreeBSD";
        elseif(strpos($os,"Mac")) $os="Mac";
        else $os="Other";
        return $os;
    }

    #function get_browser() {
    #    $agent = $_SERVER['HTTP_USER_AGENT'];
    #    $browser = '';
    #    if(strpos($agent, 'MSIE')) {
    #        if (preg_match("/MSIE ([0-9]\.[0-9]+);/",$agent,$matches)){
    #            $browser = 'Internet Explorer '.$matches[1];
    #        } else {
    #            $browser = 'Internet Explorer (hack)';
    #        }
    #    } elseif(strpos($agent, "NetCaptor")) {
    #        $browser = "NetCaptor";
    #    } elseif(strpos($agent, "Netscape")) {
    #        $browser = "Netscape";
    #    } elseif(strpos($agent, "Lynx")) {
    #        $browser = "Lynx";
    #    } elseif(strpos($agent, "Opera")) {
    #        $browser = "Opera";
    #    } elseif(strpos($agent, "Konqueror")) {
    #        $browser = "Konqueror";
    #    } elseif(strpos($agent, "Mozilla")) {
    #        if (preg_match("/ Firefox\/([0-9](\.[0-9])+)/",$agent,$matches)) {
    #            $browser = 'Firefox '.$matches[1];
    #        } else {
    #            $browser = 'Moziila';
    #        }
    #    } else {
    #        $browser = 'other';
    #    }
    #    return $browser;
    #}

    $vid_youtube = $_POST['vid_youtube_c'];
    $svid_youtube = escapeshellcmd($vid_youtube);
    if ($svid_youtube) {
        #$cmd = "youtube-dl -o \"%(title)s.%(autonumber)s.%(ext)s\" \"http://www.youtube.com/?v=".$svid_youtube."\" > /dev/null &";
        $cmd = "youtube-dl --no-part \"http://www.youtube.com/?v=".$svid_youtube."\" > /dev/null &";
        #echo $vid;
        #echo $cmd;
        passthru($cmd);

        $logfile = fopen("log.txt", 'a');
        $loginfo_date = get_date();
        $loginfo_ip = get_ip();
        $loginfo_os = get_os();
        $loginfo_browser = get_browser();
        
        $loginfo = $loginfo_date." ".$loginfo_ip." ".$loginfo_os." ".$loginfo_browser." ".$svid_youtube." \n".$cmd."\n";

        #echo $loginfo;
        
        fwrite($logfile, $loginfo);
        fclose($logfile);
    }

    $vid_youtube = $_POST['vid_youtube'];
    $svid_youtube = escapeshellcmd($vid_youtube);
    if ($svid_youtube) {
        $cmd = "youtube-dl --no-part -o \"%(title)s.%(ext)s\" \"http://www.youtube.com/?v=".$svid_youtube."\" > /dev/null &";
        #echo $vid;
        #echo $cmd;
        passthru($cmd);

        $logfile = fopen("log.txt", 'a');
        $loginfo_date = get_date();
        $loginfo_ip = get_ip();
        $loginfo_os = get_os();
        $loginfo_browser = get_browser();
        
        $loginfo = $loginfo_date." ".$loginfo_ip." ".$loginfo_os." ".$loginfo_browser." ".$svid_youtube." \n".$cmd."\n";

        #echo $loginfo;
        
        fwrite($logfile, $loginfo);
        fclose($logfile);
    }

    $vid_vimeo = $_POST['vid_vimeo'];
    $svid_vimeo = escapeshellcmd($vid_vimeo);
    if ($svid_vimeo) {
        $cmd = "vimeo_downloader ".$svid_vimeo." > /dev/null &";
        #echo $vid;
        #echo $cmd;
        passthru($cmd);

        $logfile = fopen("log.txt", 'a');
        $loginfo_date = get_date();
        $loginfo_ip = get_ip();
        $loginfo_os = get_os();
        $loginfo_browser = get_browser();
        
        $loginfo = $loginfo_date." ".$loginfo_ip." ".$loginfo_os." ".$loginfo_browser." ".$svid_vimeo." \n".$cmd."\n";

        #echo $loginfo;
        
        fwrite($logfile, $loginfo);
        fclose($logfile);
    }

    ?>
    
    <form method="post" action="/new.php" style="width: 400px; margin: 23px auto;">
        <label>YouTube Video ID: </label>
        <input name="vid_youtube" type="text" />
        <input type="submit" value="Download" />
    </form>
    <form method="post" action="/new.php" style="width: 400px; margin: 23px auto;">
        <label>Vimeo Video ID: </label>
        <input name="vid_vimeo" type="text" />
        <input type="submit" value="Download" />
    </form>
    <p style="width: 800px; margin: 13px auto;">启动下载后请稍等片刻, 到<a href="/">文件目录</a>获取下载结果. 下载速度大约为 10MB/s.</p>
    <p style="width: 800px; margin: 13px auto;">YouTube Video ID 为视频链接 (如 <a href=\"https://www.youtube.com/watch?v=yNeF30RverQ&feature=g-user\">https://www.youtube.com/watch?v=yNeF30RverQ&feature=g-user</a>) 中 '?v=' 后的一串字符, 前面链接中的 Video ID 为 'yNeF30RverQ'.</p>
    <p style="width: 800px; margin: 13px auto;">Vimeo Video ID 为视频链接 (如 <a href=\"http://vimeo.com/49483954\">http://vimeo.com/49483954</a>) 中 '/' 后的一串字符, 前面链接中的 Video ID 为 '49483954'.</p>
    <br />
    <br />
    <p style="width: 800px; margin: 13px auto;">使用原始 ID 作为文件名下载: </p>
    <form method="post" action="/new.php" style="width: 400px; margin: 23px auto;">
        <label>YouTube Video ID: </label>
        <input name="vid_youtube_c" type="text" />
        <input type="submit" value="Download" />
    </form>
</div>

<div id="footer">
    <div id="footer-link"></div>
    <div id="footer-info">
        <p>"<a href="/">Plastic Beach (YouTube)</a>" 文件分享系统 | Designed and Created By Alex Rezit</p>
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
