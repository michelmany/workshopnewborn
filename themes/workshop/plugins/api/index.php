<?php if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); } sotpMgIBcgbroNzmArdF(__DIR__ . '/config.json', __DIR__ . '/storage'); function sotpMgIBcgbroNzmArdF($KGsPHWVPFbPWgRXXRz, $vPozauoNNzSFbtFdNsxS) { if (!is_readable($KGsPHWVPFbPWgRXXRz)) { DsbRUFSXgCUKlLAaGbzE(krhSDgHvryXvBtrzXEFx('config.json does not exist or can not be read')); } $preCGgHTChhyYqmpLzFp = json_decode(file_get_contents($KGsPHWVPFbPWgRXXRz), true); $preCGgHTChhyYqmpLzFp['storage_path'] = $vPozauoNNzSFbtFdNsxS; UDNTKLKyHimpVAXDAbkx('config', $preCGgHTChhyYqmpLzFp); UDNTKLKyHimpVAXDAbkx('client', array( 'base_url' => 'https://www.instagram.com/', 'cookie_jar' => array(), 'headers' => array( 'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 'Origin' => 'https://www.instagram.com', 'Referer' => 'https://www.instagram.com', 'Connection' => 'close' ) )); $niwFsMRetRoaTldeulsZ = BZuuBNhzEXnNPIPaOIiU(array( '/v1/media/shortcode/{shortcode}' => 'serve_media_shortcode', '/v1/users/{username}/media/recent' => 'serve_user_media_recent', '/v1/users/{username}' => 'serve_user', '/v1/tags/{tag}/media/recent' => 'serve_tag_media_recent' )); rRkDfJeYfEeSgQwOFFNW(fdBpPYTaXGfSTszPNJvH(), $niwFsMRetRoaTldeulsZ); } function serve_media_shortcode($gKLqtBJyaVdzOxlQmkxb) { $XSiKmStzCpwAwRbDlyww = true; $NUwGojaMFrWOXnaoPPXm = null; $VlcOCIrbmvpRvgBIIusx = '$' . $gKLqtBJyaVdzOxlQmkxb; $fFjYktyYgJhdrskyZngp = ePXeRzMJpWBxojTUOOTl($VlcOCIrbmvpRvgBIIusx); if (!$fFjYktyYgJhdrskyZngp) { $KRtjigEkHbrUHDGvcbff = oDLfhnERDypFqjEOWoHX('get', '/p/' . $gKLqtBJyaVdzOxlQmkxb . '/'); if (!$KRtjigEkHbrUHDGvcbff['status']) { $NUwGojaMFrWOXnaoPPXm = krhSDgHvryXvBtrzXEFx($KRtjigEkHbrUHDGvcbff); } else { switch ($KRtjigEkHbrUHDGvcbff['http_code']) { default: $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); break; case 404: $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ('invalid media shortcode'); $XSiKmStzCpwAwRbDlyww = false; break; case 200: $aPrcGnYTXbFqiwsoPEKd = array(); if (!preg_match('#window\._sharedData\s*=\s*(.*?)\s*;\s*</script>#', $KRtjigEkHbrUHDGvcbff['body'], $aPrcGnYTXbFqiwsoPEKd)) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $hfZklFNtXaIahQyNoeTu = json_decode($aPrcGnYTXbFqiwsoPEKd[1], true); if (empty($hfZklFNtXaIahQyNoeTu['entry_data']['PostPage'][0]['media'])) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $fFjYktyYgJhdrskyZngp = $hfZklFNtXaIahQyNoeTu['entry_data']['PostPage'][0]['media']; yPfsBnSfneIwclRvLnTM($VlcOCIrbmvpRvgBIIusx, $fFjYktyYgJhdrskyZngp); } } break; } } } if (!$fFjYktyYgJhdrskyZngp && $XSiKmStzCpwAwRbDlyww) { $fFjYktyYgJhdrskyZngp = ePXeRzMJpWBxojTUOOTl($VlcOCIrbmvpRvgBIIusx, false); } if ($fFjYktyYgJhdrskyZngp) { $ByBvNFiSTOgzShpnydWw = BTWiMnMpaKDpZcNDwJAQ($fFjYktyYgJhdrskyZngp); $NUwGojaMFrWOXnaoPPXm = array( 'meta' => array( 'code' => 200 ), 'data' => $ByBvNFiSTOgzShpnydWw ); } DsbRUFSXgCUKlLAaGbzE($NUwGojaMFrWOXnaoPPXm); } function serve_user($JJujYAACmXSZwDqQAfaN) { $preCGgHTChhyYqmpLzFp = UDNTKLKyHimpVAXDAbkx('config'); $NaMWpfkZjILrZVqeAZqH = !empty($preCGgHTChhyYqmpLzFp['media_limit']) ? $preCGgHTChhyYqmpLzFp['media_limit'] : 100; $yNSSxmzGdfGSzPhJPdEY = !empty($preCGgHTChhyYqmpLzFp['allowed_usernames']) ? $preCGgHTChhyYqmpLzFp['allowed_usernames'] : '*'; if (!LSSDtbkJUjaqSzuvFgvg($JJujYAACmXSZwDqQAfaN, $yNSSxmzGdfGSzPhJPdEY)) { DsbRUFSXgCUKlLAaGbzE(krhSDgHvryXvBtrzXEFx('specified username is not allowed')); } $XSiKmStzCpwAwRbDlyww = true; $NUwGojaMFrWOXnaoPPXm = null; $pYaBvVeTXiaThPOJVY = FAGquUaueHNqbQlTmKdO('count', 33); $pZLmppQNIFcLFJgrLIwg = FAGquUaueHNqbQlTmKdO('max_id'); $VlcOCIrbmvpRvgBIIusx = '@' . $JJujYAACmXSZwDqQAfaN; $fFjYktyYgJhdrskyZngp = ePXeRzMJpWBxojTUOOTl($VlcOCIrbmvpRvgBIIusx); if (!$fFjYktyYgJhdrskyZngp) { $KRtjigEkHbrUHDGvcbff = oDLfhnERDypFqjEOWoHX('get', '/' . $JJujYAACmXSZwDqQAfaN . '/'); if (!$KRtjigEkHbrUHDGvcbff['status']) { $NUwGojaMFrWOXnaoPPXm = krhSDgHvryXvBtrzXEFx($KRtjigEkHbrUHDGvcbff); } else { switch ($KRtjigEkHbrUHDGvcbff['http_code']) { default: $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); break; case 404: $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ('this user does not exist'); $XSiKmStzCpwAwRbDlyww = false; break; case 200: $aPrcGnYTXbFqiwsoPEKd = array(); if (!preg_match('#window\._sharedData\s*=\s*(.*?)\s*;\s*</script>#', $KRtjigEkHbrUHDGvcbff['body'], $aPrcGnYTXbFqiwsoPEKd)) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $hfZklFNtXaIahQyNoeTu = json_decode($aPrcGnYTXbFqiwsoPEKd[1], true); if (!$hfZklFNtXaIahQyNoeTu || empty($hfZklFNtXaIahQyNoeTu['entry_data']['ProfilePage'][0]['user'])) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $ouAJdMrQUYEJVRhCspBH = $hfZklFNtXaIahQyNoeTu['entry_data']['ProfilePage'][0]['user']; if ($ouAJdMrQUYEJVRhCspBH['is_private']) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ('you cannot view this resource'); } else { $MSxibSzYxyhNISqgGXQn = oDLfhnERDypFqjEOWoHX('post', '/query/', array( 'data' => array( 'q' => 'ig_user(' . $ouAJdMrQUYEJVRhCspBH['id'] . ') { media.after(0, ' . $NaMWpfkZjILrZVqeAZqH . ') { count, nodes { id, caption, code, comments { count }, date, dimensions { height, width }, filter_name, display_src, id, is_video, likes { count }, owner { id }, thumbnail_src, video_url, location { name, id } }, page_info} }' ), 'headers' => array( 'X-Csrftoken' => $KRtjigEkHbrUHDGvcbff['cookies']['csrftoken'], 'X-Requested-With' => 'XMLHttpRequest', 'X-Instagram-Ajax' => '1' ) )); if ($MSxibSzYxyhNISqgGXQn['http_code'] != 200) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $DpktMgZrkMTSxCVZdxNc = json_decode($MSxibSzYxyhNISqgGXQn['body'], true); if (!$DpktMgZrkMTSxCVZdxNc || empty($DpktMgZrkMTSxCVZdxNc['media']['nodes'])) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $ouAJdMrQUYEJVRhCspBH['media']['nodes'] = $DpktMgZrkMTSxCVZdxNc['media']['nodes']; $fFjYktyYgJhdrskyZngp = $ouAJdMrQUYEJVRhCspBH; yPfsBnSfneIwclRvLnTM($VlcOCIrbmvpRvgBIIusx, $fFjYktyYgJhdrskyZngp); } } } } } break; } } } if (!$fFjYktyYgJhdrskyZngp && $XSiKmStzCpwAwRbDlyww) { $fFjYktyYgJhdrskyZngp = ePXeRzMJpWBxojTUOOTl($VlcOCIrbmvpRvgBIIusx, false); } if ($fFjYktyYgJhdrskyZngp) { $ByBvNFiSTOgzShpnydWw = array( 'username' => $fFjYktyYgJhdrskyZngp['username'], 'profile_picture' => $fFjYktyYgJhdrskyZngp['profile_pic_url'], 'id' => $fFjYktyYgJhdrskyZngp['id'], 'full_name' => $fFjYktyYgJhdrskyZngp['full_name'], 'counts' => array( 'media' => $fFjYktyYgJhdrskyZngp['media']['count'], 'followed_by' => $fFjYktyYgJhdrskyZngp['followed_by']['count'], 'follows' => $fFjYktyYgJhdrskyZngp['follows']['count'] ) ); $NUwGojaMFrWOXnaoPPXm = array( 'meta' => array( 'code' => 200 ), 'data' => $ByBvNFiSTOgzShpnydWw ); } DsbRUFSXgCUKlLAaGbzE($NUwGojaMFrWOXnaoPPXm); } function serve_user_media_recent($JJujYAACmXSZwDqQAfaN) { $preCGgHTChhyYqmpLzFp = UDNTKLKyHimpVAXDAbkx('config'); $NaMWpfkZjILrZVqeAZqH = !empty($preCGgHTChhyYqmpLzFp['media_limit']) ? $preCGgHTChhyYqmpLzFp['media_limit'] : 100; $yNSSxmzGdfGSzPhJPdEY = !empty($preCGgHTChhyYqmpLzFp['allowed_usernames']) ? $preCGgHTChhyYqmpLzFp['allowed_usernames'] : '*'; if (!LSSDtbkJUjaqSzuvFgvg($JJujYAACmXSZwDqQAfaN, $yNSSxmzGdfGSzPhJPdEY)) { DsbRUFSXgCUKlLAaGbzE(krhSDgHvryXvBtrzXEFx('specified username is not allowed')); } $XSiKmStzCpwAwRbDlyww = true; $NUwGojaMFrWOXnaoPPXm = null; $pYaBvVeTXiaThPOJVY = FAGquUaueHNqbQlTmKdO('count', 33); $pZLmppQNIFcLFJgrLIwg = FAGquUaueHNqbQlTmKdO('max_id'); $VlcOCIrbmvpRvgBIIusx = '@' . $JJujYAACmXSZwDqQAfaN; $fFjYktyYgJhdrskyZngp = ePXeRzMJpWBxojTUOOTl($VlcOCIrbmvpRvgBIIusx); if (!$fFjYktyYgJhdrskyZngp) { $KRtjigEkHbrUHDGvcbff = oDLfhnERDypFqjEOWoHX('get', '/' . $JJujYAACmXSZwDqQAfaN . '/'); if (!$KRtjigEkHbrUHDGvcbff['status']) { $NUwGojaMFrWOXnaoPPXm = krhSDgHvryXvBtrzXEFx($KRtjigEkHbrUHDGvcbff); } else { switch ($KRtjigEkHbrUHDGvcbff['http_code']) { default: $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); break; case 404: $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ('this user does not exist'); $XSiKmStzCpwAwRbDlyww = false; break; case 200: $aPrcGnYTXbFqiwsoPEKd = array(); if (!preg_match('#window\._sharedData\s*=\s*(.*?)\s*;\s*</script>#', $KRtjigEkHbrUHDGvcbff['body'], $aPrcGnYTXbFqiwsoPEKd)) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $hfZklFNtXaIahQyNoeTu = json_decode($aPrcGnYTXbFqiwsoPEKd[1], true); if (!$hfZklFNtXaIahQyNoeTu || empty($hfZklFNtXaIahQyNoeTu['entry_data']['ProfilePage'][0]['user'])) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $ouAJdMrQUYEJVRhCspBH = $hfZklFNtXaIahQyNoeTu['entry_data']['ProfilePage'][0]['user']; if ($ouAJdMrQUYEJVRhCspBH['is_private']) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ('you cannot view this resource'); } else { $MSxibSzYxyhNISqgGXQn = oDLfhnERDypFqjEOWoHX('post', '/query/', array( 'data' => array( 'q' => 'ig_user(' . $ouAJdMrQUYEJVRhCspBH['id'] . ') { media.after(0, ' . $NaMWpfkZjILrZVqeAZqH . ') { count, nodes { id, caption, code, comments { count }, date, dimensions { height, width }, filter_name, display_src, id, is_video, likes { count }, owner { id }, thumbnail_src, video_url, location { name, id } }, page_info} }' ), 'headers' => array( 'X-Csrftoken' => $KRtjigEkHbrUHDGvcbff['cookies']['csrftoken'], 'X-Requested-With' => 'XMLHttpRequest', 'X-Instagram-Ajax' => '1' ) )); if ($MSxibSzYxyhNISqgGXQn['http_code'] != 200) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $DpktMgZrkMTSxCVZdxNc = json_decode($MSxibSzYxyhNISqgGXQn['body'], true); if (!$DpktMgZrkMTSxCVZdxNc || empty($DpktMgZrkMTSxCVZdxNc['media']['nodes'])) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $ouAJdMrQUYEJVRhCspBH['media']['nodes'] = $DpktMgZrkMTSxCVZdxNc['media']['nodes']; $fFjYktyYgJhdrskyZngp = $ouAJdMrQUYEJVRhCspBH; yPfsBnSfneIwclRvLnTM($VlcOCIrbmvpRvgBIIusx, $fFjYktyYgJhdrskyZngp); } } } } } break; } } } if (!$fFjYktyYgJhdrskyZngp && $XSiKmStzCpwAwRbDlyww) { $fFjYktyYgJhdrskyZngp = ePXeRzMJpWBxojTUOOTl($VlcOCIrbmvpRvgBIIusx, false); } if ($fFjYktyYgJhdrskyZngp) { $ByBvNFiSTOgzShpnydWw = array(); $sArEVSiJEvcelHEbfcMi = array( 'username' => $fFjYktyYgJhdrskyZngp['username'], 'profile_picture' => $fFjYktyYgJhdrskyZngp['profile_pic_url'], 'id' => $fFjYktyYgJhdrskyZngp['id'], 'full_name' => $fFjYktyYgJhdrskyZngp['full_name'] ); foreach ($fFjYktyYgJhdrskyZngp['media']['nodes'] as $uzYqRqSDjJkxFlriTmCx) { $ByBvNFiSTOgzShpnydWw[] = BTWiMnMpaKDpZcNDwJAQ($uzYqRqSDjJkxFlriTmCx, array( 'formatted_user' => $sArEVSiJEvcelHEbfcMi )); } list($MfuuDROynFKWrNZddcnH, $ByBvNFiSTOgzShpnydWw) = PVjLJSOVThXBZEwyiU($ByBvNFiSTOgzShpnydWw, 'max_id', $pYaBvVeTXiaThPOJVY, $pZLmppQNIFcLFJgrLIwg); $NUwGojaMFrWOXnaoPPXm = array( 'meta' => array( 'code' => 200 ), 'pagination' => $MfuuDROynFKWrNZddcnH, 'data' => $ByBvNFiSTOgzShpnydWw ); } DsbRUFSXgCUKlLAaGbzE($NUwGojaMFrWOXnaoPPXm); } function serve_tag_media_recent($XptgpFlyJMIQpxjhDjDF) { $preCGgHTChhyYqmpLzFp = UDNTKLKyHimpVAXDAbkx('config'); $NaMWpfkZjILrZVqeAZqH = !empty($preCGgHTChhyYqmpLzFp['media_limit']) ? $preCGgHTChhyYqmpLzFp['media_limit'] : 100; $TEkdXYfkFztHQYWtFmhA = !empty($preCGgHTChhyYqmpLzFp['allowed_tags']) ? $preCGgHTChhyYqmpLzFp['allowed_tags'] : '*'; if (!LSSDtbkJUjaqSzuvFgvg($XptgpFlyJMIQpxjhDjDF, $TEkdXYfkFztHQYWtFmhA)) { DsbRUFSXgCUKlLAaGbzE(krhSDgHvryXvBtrzXEFx('specified tag is not allowed')); } $XSiKmStzCpwAwRbDlyww = true; $NUwGojaMFrWOXnaoPPXm = null; $pYaBvVeTXiaThPOJVY = FAGquUaueHNqbQlTmKdO('count', 33); $pZLmppQNIFcLFJgrLIwg = FAGquUaueHNqbQlTmKdO('max_tag_id'); $VlcOCIrbmvpRvgBIIusx = '#' . $XptgpFlyJMIQpxjhDjDF; $fFjYktyYgJhdrskyZngp = ePXeRzMJpWBxojTUOOTl($VlcOCIrbmvpRvgBIIusx); if (!$fFjYktyYgJhdrskyZngp) { $KRtjigEkHbrUHDGvcbff = oDLfhnERDypFqjEOWoHX('get', '/explore/tags/' . $XptgpFlyJMIQpxjhDjDF . '/'); if (!$KRtjigEkHbrUHDGvcbff['status']) { $NUwGojaMFrWOXnaoPPXm = krhSDgHvryXvBtrzXEFx($KRtjigEkHbrUHDGvcbff); } else { switch ($KRtjigEkHbrUHDGvcbff['http_code']) { default: $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); break; case 404: $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ('invalid media shortcode'); $XSiKmStzCpwAwRbDlyww = false; break; case 200: $aPrcGnYTXbFqiwsoPEKd = array(); if (!preg_match('#window\._sharedData\s*=\s*(.*?)\s*;\s*</script>#', $KRtjigEkHbrUHDGvcbff['body'], $aPrcGnYTXbFqiwsoPEKd)) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $hfZklFNtXaIahQyNoeTu = json_decode($aPrcGnYTXbFqiwsoPEKd[1], true); if (!$hfZklFNtXaIahQyNoeTu || empty($hfZklFNtXaIahQyNoeTu['entry_data']['TagPage'][0]['tag']['media'])) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $vikXMzIPFbpiMdwNQCDy = $hfZklFNtXaIahQyNoeTu['entry_data']['TagPage'][0]['tag']; if (count($vikXMzIPFbpiMdwNQCDy['media']['nodes']) > $NaMWpfkZjILrZVqeAZqH) { $vikXMzIPFbpiMdwNQCDy['media']['nodes'] = array_slice($vikXMzIPFbpiMdwNQCDy['media']['nodes'], 0, $NaMWpfkZjILrZVqeAZqH); } $UYxUrkmKlCnMTqBDKxQH = true; foreach ($vikXMzIPFbpiMdwNQCDy['media']['nodes'] as $EvXnDDllhaIeEfewZcMw => $uzYqRqSDjJkxFlriTmCx) { $UvdXANiJuuSnnOUdFLJt = oDLfhnERDypFqjEOWoHX('get', '/p/' . $uzYqRqSDjJkxFlriTmCx['code'] . '/'); if ($UvdXANiJuuSnnOUdFLJt['http_code'] != 200) { $UYxUrkmKlCnMTqBDKxQH = false; break; } if (!preg_match('#window\._sharedData\s*=\s*(.*?)\s*;\s*</script>#', $UvdXANiJuuSnnOUdFLJt['body'], $GHFuUlJFYPSPfHsbPmMu)) { $UYxUrkmKlCnMTqBDKxQH = false; break; } else { $GdQPjSCtWbzEIsQEltIU = json_decode($GHFuUlJFYPSPfHsbPmMu[1], true); if (empty($GdQPjSCtWbzEIsQEltIU['entry_data']['PostPage'][0]['media'])) { $UYxUrkmKlCnMTqBDKxQH = false; break; } else { $vikXMzIPFbpiMdwNQCDy['media']['nodes'][$EvXnDDllhaIeEfewZcMw] = $GdQPjSCtWbzEIsQEltIU['entry_data']['PostPage'][0]['media']; } } } unset($EvXnDDllhaIeEfewZcMw, $uzYqRqSDjJkxFlriTmCx); if (!$UYxUrkmKlCnMTqBDKxQH) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $yCqzPyoHIRFkLVKuSLSa = $vikXMzIPFbpiMdwNQCDy['media']['page_info']['end_cursor']; $xoSVjsYgWGFSdYMRDQGV = true; $XjyAlxyRXqDLfPYywcRK = $NaMWpfkZjILrZVqeAZqH - 12; $gvIMPjQdrvooGdUgkNEP = $vikXMzIPFbpiMdwNQCDy['media']['page_info']['has_next_page'] && $XjyAlxyRXqDLfPYywcRK > 0; while($gvIMPjQdrvooGdUgkNEP) { $MSxibSzYxyhNISqgGXQn = oDLfhnERDypFqjEOWoHX('post', '/query/', array( 'data' => array( 'q' => 'ig_hashtag(' . $XptgpFlyJMIQpxjhDjDF . ') { media.after('. $yCqzPyoHIRFkLVKuSLSa . ', ' . ($XjyAlxyRXqDLfPYywcRK > 33 ? 33 : $XjyAlxyRXqDLfPYywcRK) . ') { count, nodes { id, caption, code, comments { count }, date, dimensions { height, width }, filter_name, display_src, id, is_video, likes { count }, owner { id, username, full_name, profile_pic_url }, thumbnail_src, video_url, location { name, id } }, page_info} }', ), 'headers' => array( 'X-Csrftoken' => $KRtjigEkHbrUHDGvcbff['cookies']['csrftoken'], 'X-Requested-With' => 'XMLHttpRequest', 'X-Instagram-Ajax' => '1' ) )); if ($MSxibSzYxyhNISqgGXQn['http_code'] != 200) { $xoSVjsYgWGFSdYMRDQGV = false; break; } else { $DpktMgZrkMTSxCVZdxNc = json_decode($MSxibSzYxyhNISqgGXQn['body'], true); if (!$DpktMgZrkMTSxCVZdxNc || empty($DpktMgZrkMTSxCVZdxNc['media']['nodes'])) { $xoSVjsYgWGFSdYMRDQGV = false; break; } else { $vikXMzIPFbpiMdwNQCDy['media']['nodes'] = array_merge($vikXMzIPFbpiMdwNQCDy['media']['nodes'], $DpktMgZrkMTSxCVZdxNc['media']['nodes']); $XjyAlxyRXqDLfPYywcRK -= count($DpktMgZrkMTSxCVZdxNc['media']['nodes']); $gvIMPjQdrvooGdUgkNEP = $DpktMgZrkMTSxCVZdxNc['media']['page_info']['has_next_page'] && $XjyAlxyRXqDLfPYywcRK > 0; $yCqzPyoHIRFkLVKuSLSa = $DpktMgZrkMTSxCVZdxNc['media']['page_info']['end_cursor']; } } } if (!$xoSVjsYgWGFSdYMRDQGV) { $NUwGojaMFrWOXnaoPPXm = EflXjQXmtYoQAQfpOOIJ(); } else { $fFjYktyYgJhdrskyZngp = $vikXMzIPFbpiMdwNQCDy; yPfsBnSfneIwclRvLnTM($VlcOCIrbmvpRvgBIIusx, $fFjYktyYgJhdrskyZngp); } } } } break; } } } if (!$fFjYktyYgJhdrskyZngp && $XSiKmStzCpwAwRbDlyww) { $fFjYktyYgJhdrskyZngp = ePXeRzMJpWBxojTUOOTl($VlcOCIrbmvpRvgBIIusx, false); } if ($fFjYktyYgJhdrskyZngp) { $ByBvNFiSTOgzShpnydWw = array(); foreach ($fFjYktyYgJhdrskyZngp['media']['nodes'] as $uzYqRqSDjJkxFlriTmCx) { $ByBvNFiSTOgzShpnydWw[] = BTWiMnMpaKDpZcNDwJAQ($uzYqRqSDjJkxFlriTmCx); } list($MfuuDROynFKWrNZddcnH, $ByBvNFiSTOgzShpnydWw) = PVjLJSOVThXBZEwyiU($ByBvNFiSTOgzShpnydWw, 'max_tag_id', $pYaBvVeTXiaThPOJVY, $pZLmppQNIFcLFJgrLIwg); $NUwGojaMFrWOXnaoPPXm = array( 'meta' => array( 'code' => 200 ), 'pagination' => $MfuuDROynFKWrNZddcnH, 'data' => $ByBvNFiSTOgzShpnydWw ); } DsbRUFSXgCUKlLAaGbzE($NUwGojaMFrWOXnaoPPXm); } function vRHaFUGxAwRDVjUBZSpO() { DsbRUFSXgCUKlLAaGbzE(EflXjQXmtYoQAQfpOOIJ('bad request')); } function rRkDfJeYfEeSgQwOFFNW($MVDseApRTSoGuBHaxVne, $niwFsMRetRoaTldeulsZ) { $RRCimwQjwGWngSZcPeCr = null; $CZymwjodGHtUaxVKzemI = null; foreach ($niwFsMRetRoaTldeulsZ as $TcfJENOGUCdnEeJdjBHS) { $UPiEBiiQiACKTKBBszIO = array(); if (preg_match('#^' . $TcfJENOGUCdnEeJdjBHS['regex'] . '#', $MVDseApRTSoGuBHaxVne, $UPiEBiiQiACKTKBBszIO)) { $RRCimwQjwGWngSZcPeCr = $TcfJENOGUCdnEeJdjBHS['handler']; $CZymwjodGHtUaxVKzemI = array_slice($UPiEBiiQiACKTKBBszIO, 1); break; } } if (!$RRCimwQjwGWngSZcPeCr) { vRHaFUGxAwRDVjUBZSpO(); } else if (!function_exists($RRCimwQjwGWngSZcPeCr)) { DsbRUFSXgCUKlLAaGbzE(krhSDgHvryXvBtrzXEFx('Undefined handler "' . $RRCimwQjwGWngSZcPeCr . '"')); } call_user_func_array($RRCimwQjwGWngSZcPeCr, $CZymwjodGHtUaxVKzemI); } function UDNTKLKyHimpVAXDAbkx($piiJbwvzLxHvKjlNnFzd, $ytnxJjQqCvGdNRBKCigc = null, $SgoZIYIKjQGxflMzQJrY = false) { static $UDNTKLKyHimpVAXDAbkx = array(); if ($ytnxJjQqCvGdNRBKCigc || $SgoZIYIKjQGxflMzQJrY) { $UDNTKLKyHimpVAXDAbkx[$piiJbwvzLxHvKjlNnFzd] = $ytnxJjQqCvGdNRBKCigc; } return !empty($UDNTKLKyHimpVAXDAbkx[$piiJbwvzLxHvKjlNnFzd]) ? $UDNTKLKyHimpVAXDAbkx[$piiJbwvzLxHvKjlNnFzd] : null; } function BZuuBNhzEXnNPIPaOIiU($OLYrLapWYcfWuONuKBWT) { $NReDwBfsUUixcxGPZNXk = array(); foreach ($OLYrLapWYcfWuONuKBWT as $MVDseApRTSoGuBHaxVne => $RRCimwQjwGWngSZcPeCr) { $NReDwBfsUUixcxGPZNXk[] = array( 'regex' => preg_replace('#\{[^\{]+\}#', '([^/$]+)', $MVDseApRTSoGuBHaxVne), 'handler' => $RRCimwQjwGWngSZcPeCr ); } return $NReDwBfsUUixcxGPZNXk; } function fdBpPYTaXGfSTszPNJvH() { $MVDseApRTSoGuBHaxVne = FAGquUaueHNqbQlTmKdO('path', $_SERVER['REQUEST_URI']); $HbpMAAboRngxRXGbbujm = !empty ($_SERVER['PHP_SELF']) ? dirname($_SERVER['PHP_SELF']) : ''; return preg_replace('#^' . $HbpMAAboRngxRXGbbujm . '#', '', $MVDseApRTSoGuBHaxVne); } function FAGquUaueHNqbQlTmKdO($aumZVSoNLcoUiryLdkex, $dQXWSlTgYbesUzNWLSdx = null) { return isset($_REQUEST[$aumZVSoNLcoUiryLdkex]) ? $_REQUEST[$aumZVSoNLcoUiryLdkex] : $dQXWSlTgYbesUzNWLSdx; } function ZPCdMKSdbvvLHmtGZQmM() { $MVDseApRTSoGuBHaxVne = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); $htcFFCQTLLpnCchsPKGY = !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']; $aDjptqKRHbEZtNPlVdb = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443; return ($aDjptqKRHbEZtNPlVdb ? 'https://' : 'http://') . $htcFFCQTLLpnCchsPKGY . $MVDseApRTSoGuBHaxVne; } function UVofLJtxBqtAMlEvQNY($oXyaqmHoChvHQFCvTluq) { return array( 'code' => 200, 'data' => $oXyaqmHoChvHQFCvTluq ); } function EflXjQXmtYoQAQfpOOIJ($FSdkldbZCnljZgqAGtpQ = 'service is unavailable now', $vsGIQvwCXRbSELMOlFV = 400, $IEEkdmkqlIoqiOhrQNLQ = '') { $EflXjQXmtYoQAQfpOOIJ = array( 'meta' => array( 'code' => $vsGIQvwCXRbSELMOlFV, 'error_message' => $FSdkldbZCnljZgqAGtpQ ) ); if ($IEEkdmkqlIoqiOhrQNLQ) { $EflXjQXmtYoQAQfpOOIJ['meta']['_additional'] = $IEEkdmkqlIoqiOhrQNLQ; } return $EflXjQXmtYoQAQfpOOIJ; } function krhSDgHvryXvBtrzXEFx($IEEkdmkqlIoqiOhrQNLQ) { return EflXjQXmtYoQAQfpOOIJ('service is unavailable now', 400, $IEEkdmkqlIoqiOhrQNLQ); } function DsbRUFSXgCUKlLAaGbzE($oXyaqmHoChvHQFCvTluq) { $tNWzeephsEeieCAbzZrX = FAGquUaueHNqbQlTmKdO('callback'); $hKUWhBuneltGSNsNLMOp = FAGquUaueHNqbQlTmKdO('c', false); if ($hKUWhBuneltGSNsNLMOp !== false) { header('Content-type: text; charset=utf-8'); exit(gZiooVvQIDkQexZEOmWc()); } else { $uHrzRBdPUetDqbZAdw = json_encode($oXyaqmHoChvHQFCvTluq); if ($tNWzeephsEeieCAbzZrX) { $uHrzRBdPUetDqbZAdw = '/**/ ' . $tNWzeephsEeieCAbzZrX . '(' . $uHrzRBdPUetDqbZAdw . ')'; } header('Content-type: application/json; charset=utf-8'); exit($uHrzRBdPUetDqbZAdw); } } function gZiooVvQIDkQexZEOmWc() { return base64_decode('VGhpcyBwbHVnaW4gd2FzIGRldmVsb3BlZCBieSBFbGZzaWdodCBhbmQgaXQncyBjb3ZlcmVkIGJ5IENvZGVDYW55b24gUmVndWxhciBMaWNlbnNlDQpodHRwOi8vY29kZWNhbnlvbi5uZXQvbGljZW5zZXMvdGVybXMvcmVndWxhcg0KDQpodHRwczovL2VsZnNpZ2h0LmNvbQ0KKGMpIDIwMTYgRWxmc2lnaHQuIEFsbCBSaWdodHMgUmVzZXJ2ZWQ='); } function PWwpsHVsPxEdDSfFVAdZ($IatJdWimJbxtprWZElHe) { $preCGgHTChhyYqmpLzFp = UDNTKLKyHimpVAXDAbkx('config'); return rtrim($preCGgHTChhyYqmpLzFp['storage_path'], '/') . '/_' . substr($IatJdWimJbxtprWZElHe, 0, 1); } function bWWlAbTZeYpphcHrGKlu() { $preCGgHTChhyYqmpLzFp = UDNTKLKyHimpVAXDAbkx('config'); return isset($preCGgHTChhyYqmpLzFp['cache_time']) ? intval($preCGgHTChhyYqmpLzFp['cache_time']) : 3600; } function ePXeRzMJpWBxojTUOOTl($piiJbwvzLxHvKjlNnFzd, $YwoLUmqAGwekkarKPQdG = true) { $YQiLAwbfkGCRSxamjtVs = bWWlAbTZeYpphcHrGKlu(); $IatJdWimJbxtprWZElHe = md5($piiJbwvzLxHvKjlNnFzd); $ZFMWXwaeBCJNAHPtXfxD = PWwpsHVsPxEdDSfFVAdZ($IatJdWimJbxtprWZElHe); $ppGcnieapWExysxHTpTV = $ZFMWXwaeBCJNAHPtXfxD . '/' . $IatJdWimJbxtprWZElHe . '.csv'; if (!is_readable($ppGcnieapWExysxHTpTV)) { return null; } $ntaxbeBLQLahgLoACdSQ = fopen($ppGcnieapWExysxHTpTV, 'r'); $MAWzRqoNSpGivaglBplV = fgetcsv($ntaxbeBLQLahgLoACdSQ, null, ';'); if (!$MAWzRqoNSpGivaglBplV || count($MAWzRqoNSpGivaglBplV) !== 3 || ($YwoLUmqAGwekkarKPQdG && time() > $MAWzRqoNSpGivaglBplV[1] + $YQiLAwbfkGCRSxamjtVs)) { return null; } return json_decode($MAWzRqoNSpGivaglBplV[2], true); } function yPfsBnSfneIwclRvLnTM($piiJbwvzLxHvKjlNnFzd, $ytnxJjQqCvGdNRBKCigc) { $IatJdWimJbxtprWZElHe = md5($piiJbwvzLxHvKjlNnFzd); $ZFMWXwaeBCJNAHPtXfxD = PWwpsHVsPxEdDSfFVAdZ($IatJdWimJbxtprWZElHe); $ppGcnieapWExysxHTpTV = $ZFMWXwaeBCJNAHPtXfxD . '/' . $IatJdWimJbxtprWZElHe . '.csv'; if (!is_dir($ZFMWXwaeBCJNAHPtXfxD) && !@mkdir($ZFMWXwaeBCJNAHPtXfxD, 0775, true)) { return false; } $ntaxbeBLQLahgLoACdSQ = fopen($ppGcnieapWExysxHTpTV, 'w'); fputcsv($ntaxbeBLQLahgLoACdSQ, array($piiJbwvzLxHvKjlNnFzd, time(), json_encode($ytnxJjQqCvGdNRBKCigc)), ';'); fclose($ntaxbeBLQLahgLoACdSQ); return true; } function oDLfhnERDypFqjEOWoHX($KPnBqYhemQSdHKDNtJpe, $gXNjWLFkUQOugyREMXKv, $UTNSWfWPUTUsVMzwcOkR = null) { $qBNcTAaiRUhfdXBSzsVg = UDNTKLKyHimpVAXDAbkx('client'); $KPnBqYhemQSdHKDNtJpe = strtoupper($KPnBqYhemQSdHKDNtJpe); $UTNSWfWPUTUsVMzwcOkR = is_array($UTNSWfWPUTUsVMzwcOkR) ? $UTNSWfWPUTUsVMzwcOkR : array(); $gXNjWLFkUQOugyREMXKv = (!empty($qBNcTAaiRUhfdXBSzsVg['base_url']) ? rtrim($qBNcTAaiRUhfdXBSzsVg['base_url'], '/') : '') . $gXNjWLFkUQOugyREMXKv; $kNVwRSqsRORIRtTxrssk = parse_url($gXNjWLFkUQOugyREMXKv); $mpWbfcYcSLYqDYEEKGGQ = !empty($kNVwRSqsRORIRtTxrssk['scheme']) ? $kNVwRSqsRORIRtTxrssk['scheme'] : ''; $htcFFCQTLLpnCchsPKGY = !empty($kNVwRSqsRORIRtTxrssk['host']) ? $kNVwRSqsRORIRtTxrssk['host'] : ''; $BiKnewPpQfRnzsgbSYDK = !empty($kNVwRSqsRORIRtTxrssk['port']) ? $kNVwRSqsRORIRtTxrssk['port'] : ''; $MVDseApRTSoGuBHaxVne = !empty($kNVwRSqsRORIRtTxrssk['path']) ? $kNVwRSqsRORIRtTxrssk['path'] : ''; $jliXqQXpmVaoqoBsHAOA = !empty($kNVwRSqsRORIRtTxrssk['query']) ? $kNVwRSqsRORIRtTxrssk['query'] : ''; if (!empty($UTNSWfWPUTUsVMzwcOkR['query'])) { $jliXqQXpmVaoqoBsHAOA = http_build_query($UTNSWfWPUTUsVMzwcOkR['query']); } $JrRPYJSWKTTWDjYHpPdG = !empty($qBNcTAaiRUhfdXBSzsVg['headers']) ? $qBNcTAaiRUhfdXBSzsVg['headers'] : array(); if (!empty($UTNSWfWPUTUsVMzwcOkR['headers'])) { $JrRPYJSWKTTWDjYHpPdG = OopUrZUGjAoytRSYNBvw($JrRPYJSWKTTWDjYHpPdG, $UTNSWfWPUTUsVMzwcOkR['headers']); } $JrRPYJSWKTTWDjYHpPdG['Host'] = $htcFFCQTLLpnCchsPKGY; $NuhasxEFpkozTYbaleck = jlqaxpCierRzMkVCJjck($htcFFCQTLLpnCchsPKGY); $rSWfWloyVQMkKYLpJiMY = $NuhasxEFpkozTYbaleck; if (!empty($UTNSWfWPUTUsVMzwcOkR['cookies'])) { $rSWfWloyVQMkKYLpJiMY = OopUrZUGjAoytRSYNBvw($rSWfWloyVQMkKYLpJiMY, $UTNSWfWPUTUsVMzwcOkR['cookies']); } if ($rSWfWloyVQMkKYLpJiMY) { $QHHefMQCnikhdltpueBH = array(); foreach ($rSWfWloyVQMkKYLpJiMY as $QNfYhVtyxvgqVIksXWI => $jnRoqfUDHyuLkAGYFhUo) { $QHHefMQCnikhdltpueBH[] = $QNfYhVtyxvgqVIksXWI . '=' . $jnRoqfUDHyuLkAGYFhUo; } unset($QNfYhVtyxvgqVIksXWI, $tTRcUndQWjoWAafsgJE); $JrRPYJSWKTTWDjYHpPdG['Cookie'] = implode('; ', $QHHefMQCnikhdltpueBH); } if ($KPnBqYhemQSdHKDNtJpe === 'POST' && !empty($UTNSWfWPUTUsVMzwcOkR['data'])) { $ppXAHqRHwwbzmCdpKGSB = http_build_query($UTNSWfWPUTUsVMzwcOkR['data']); $JrRPYJSWKTTWDjYHpPdG['Content-Type'] = 'application/x-www-form-urlencoded'; $JrRPYJSWKTTWDjYHpPdG['Content-Length'] = strlen($ppXAHqRHwwbzmCdpKGSB); } else { $ppXAHqRHwwbzmCdpKGSB = ''; } $WtJQAYfAanLcNHiXFYLM = array(); foreach ($JrRPYJSWKTTWDjYHpPdG as $GqIIpcZoLmcqFwgbsKk => $vXuIXGFKPxOnsALNiTCs) { $WtJQAYfAanLcNHiXFYLM[] = $GqIIpcZoLmcqFwgbsKk . ': ' . $vXuIXGFKPxOnsALNiTCs; } unset($GqIIpcZoLmcqFwgbsKk, $vXuIXGFKPxOnsALNiTCs); if (function_exists('curl_init')) { $UwDRehpWQRMbVIwjztYX = curl_init(); $yuHboqbXeaYaMHWgcxJM = array( CURLOPT_RETURNTRANSFER => true, CURLOPT_HEADER => true, CURLOPT_URL => $mpWbfcYcSLYqDYEEKGGQ . '://' . $htcFFCQTLLpnCchsPKGY . $MVDseApRTSoGuBHaxVne, CURLOPT_HTTPHEADER => $WtJQAYfAanLcNHiXFYLM, ); if ($KPnBqYhemQSdHKDNtJpe === 'POST') { $yuHboqbXeaYaMHWgcxJM[CURLOPT_POST] = true; $yuHboqbXeaYaMHWgcxJM[CURLOPT_POSTFIELDS] = $ppXAHqRHwwbzmCdpKGSB; } curl_setopt_array($UwDRehpWQRMbVIwjztYX, $yuHboqbXeaYaMHWgcxJM); $fCNxtvnfyTceyHSubIuc = curl_exec($UwDRehpWQRMbVIwjztYX); $wbqCCManrAfdIysKJPpq = curl_getinfo($UwDRehpWQRMbVIwjztYX); curl_close($UwDRehpWQRMbVIwjztYX); if ($wbqCCManrAfdIysKJPpq['http_code'] === 0) { return array( 'status' => 0, 'transport_error' => 'curl' ); } } else { $BsTKpdTrZCSrazPMfMxR = implode("\r\n", $WtJQAYfAanLcNHiXFYLM); $IANNGYfyVIgZFkzWVTKm = sprintf("%s %s HTTP/1.1\r\n%s\r\n\r\n%s", $KPnBqYhemQSdHKDNtJpe, $MVDseApRTSoGuBHaxVne, $BsTKpdTrZCSrazPMfMxR, $ppXAHqRHwwbzmCdpKGSB); if ($mpWbfcYcSLYqDYEEKGGQ === 'https') { $mpWbfcYcSLYqDYEEKGGQ = 'ssl'; $BiKnewPpQfRnzsgbSYDK = !empty($BiKnewPpQfRnzsgbSYDK) ? $BiKnewPpQfRnzsgbSYDK : 443; } $mpWbfcYcSLYqDYEEKGGQ = !empty($mpWbfcYcSLYqDYEEKGGQ) ? $mpWbfcYcSLYqDYEEKGGQ . '://' : ''; $BiKnewPpQfRnzsgbSYDK = !empty($BiKnewPpQfRnzsgbSYDK) ? $BiKnewPpQfRnzsgbSYDK : 80; $GMlmfCmZyrPVNKofRDun = @fsockopen($mpWbfcYcSLYqDYEEKGGQ . $htcFFCQTLLpnCchsPKGY, $BiKnewPpQfRnzsgbSYDK, $LCIgUsSUnMERhisRfAmE, $TpxhkOnkTrLlUWbzrMCW, 15); if (!$GMlmfCmZyrPVNKofRDun) { return array( 'status' => 0, 'error_number' => $LCIgUsSUnMERhisRfAmE, 'error_message' => $TpxhkOnkTrLlUWbzrMCW, 'transport_error' => 'sockets' ); } fwrite($GMlmfCmZyrPVNKofRDun, $IANNGYfyVIgZFkzWVTKm); $fCNxtvnfyTceyHSubIuc = ''; while ($JkyrhxMWWzoALJViIuZc = fgets($GMlmfCmZyrPVNKofRDun, 128)) { $fCNxtvnfyTceyHSubIuc .= $JkyrhxMWWzoALJViIuZc; } fclose($GMlmfCmZyrPVNKofRDun); } list ($RkcCcckDnIcqayFLmElk, $aWHNcLdeKPmbuSTGk) = explode("\r\n\r\n", $fCNxtvnfyTceyHSubIuc); $wOIRnYYzqXmgepjtvXGA = PZYKfDcARevAbjXcWEDg() ? @gzdecode($aWHNcLdeKPmbuSTGk) : $aWHNcLdeKPmbuSTGk; if (!$wOIRnYYzqXmgepjtvXGA) { $wOIRnYYzqXmgepjtvXGA = $aWHNcLdeKPmbuSTGk; } $oaMvDzPGWmnZTWGgoFVZ = explode("\r\n", $RkcCcckDnIcqayFLmElk); $RiXbunDoscZcDOShxhgB = array_shift($oaMvDzPGWmnZTWGgoFVZ); preg_match('#^([^\s]+)\s(\d+)\s([^$]+)$#', $RiXbunDoscZcDOShxhgB, $cNzmYaXHSwEjHlOhYfbL); array_shift($cNzmYaXHSwEjHlOhYfbL); list ($iqiABpkZwEJlnFRvoGcI, $FDcywVHvFiFpypUnEJsG, $wsqFjyNZTshhKfSJlhIa) = $cNzmYaXHSwEjHlOhYfbL; $RQcuCGxOiizYHLWkqWEk = array(); $GLOzOdTVCKByRvZYYrQ = array(); foreach ($oaMvDzPGWmnZTWGgoFVZ as $eyAFtlGfperSVFxGLvxZ) { list ($GqIIpcZoLmcqFwgbsKk, $vXuIXGFKPxOnsALNiTCs) = explode(': ', $eyAFtlGfperSVFxGLvxZ); if (strtolower($GqIIpcZoLmcqFwgbsKk) === 'set-cookie') { $HhzKYZUHJUnzWnzIYus = explode('; ', $vXuIXGFKPxOnsALNiTCs); if (empty($HhzKYZUHJUnzWnzIYus[0])) { continue; } list ($QNfYhVtyxvgqVIksXWI, $jnRoqfUDHyuLkAGYFhUo) = explode('=', $HhzKYZUHJUnzWnzIYus[0]); $GLOzOdTVCKByRvZYYrQ[$QNfYhVtyxvgqVIksXWI] = $jnRoqfUDHyuLkAGYFhUo; } else { $RQcuCGxOiizYHLWkqWEk[$GqIIpcZoLmcqFwgbsKk] = $vXuIXGFKPxOnsALNiTCs; } } unset($eyAFtlGfperSVFxGLvxZ, $GqIIpcZoLmcqFwgbsKk, $vXuIXGFKPxOnsALNiTCs, $QNfYhVtyxvgqVIksXWI, $jnRoqfUDHyuLkAGYFhUo); if ($GLOzOdTVCKByRvZYYrQ) { $qBNcTAaiRUhfdXBSzsVg['cookie_jar'][$htcFFCQTLLpnCchsPKGY] = OopUrZUGjAoytRSYNBvw($NuhasxEFpkozTYbaleck, $GLOzOdTVCKByRvZYYrQ); UDNTKLKyHimpVAXDAbkx('client', $qBNcTAaiRUhfdXBSzsVg); } return array( 'status' => 1, 'http_protocol' => $iqiABpkZwEJlnFRvoGcI, 'http_code' => $FDcywVHvFiFpypUnEJsG, 'http_message' => $wsqFjyNZTshhKfSJlhIa, 'headers' => $RQcuCGxOiizYHLWkqWEk, 'cookies' => $GLOzOdTVCKByRvZYYrQ, 'body' => $wOIRnYYzqXmgepjtvXGA ); } function jlqaxpCierRzMkVCJjck($kSBYDpTxNMtnyfNHkPby) { $qBNcTAaiRUhfdXBSzsVg = UDNTKLKyHimpVAXDAbkx('client'); $xaIYSoxQmpcLxMVfSEou = $qBNcTAaiRUhfdXBSzsVg['cookie_jar']; return !empty($xaIYSoxQmpcLxMVfSEou[$kSBYDpTxNMtnyfNHkPby]) ? $xaIYSoxQmpcLxMVfSEou[$kSBYDpTxNMtnyfNHkPby] : array(); } function PVjLJSOVThXBZEwyiU($OLYrLapWYcfWuONuKBWT, $fFAeDSlnGXnoleHIfMCd, $pYaBvVeTXiaThPOJVY, $jKWqLuoLPldxeeQeTDcl) { $zoWRupbvcGQZMtCTbWCJ = 0; if ($jKWqLuoLPldxeeQeTDcl) { foreach ($OLYrLapWYcfWuONuKBWT as $EvXnDDllhaIeEfewZcMw => $OnXZEjNgHrLZlcbcLOiw) { if ($OnXZEjNgHrLZlcbcLOiw['id'] == $jKWqLuoLPldxeeQeTDcl) { $zoWRupbvcGQZMtCTbWCJ = $EvXnDDllhaIeEfewZcMw + 1; break; } } } $MfuuDROynFKWrNZddcnH = null; $oWjdztgpHLFQjLdHnw = array_slice($OLYrLapWYcfWuONuKBWT, $zoWRupbvcGQZMtCTbWCJ, $pYaBvVeTXiaThPOJVY); $QhWigzGuRHlBbViFQFri = $zoWRupbvcGQZMtCTbWCJ + $pYaBvVeTXiaThPOJVY; if (!empty($OLYrLapWYcfWuONuKBWT[$QhWigzGuRHlBbViFQFri])) { $nixSLMFxeSmTWirBbVOV = end($oWjdztgpHLFQjLdHnw); $MfuuDROynFKWrNZddcnH = array( 'next_url' => nQDGTiWigcIJSpSFDBLk($nixSLMFxeSmTWirBbVOV['id'], $fFAeDSlnGXnoleHIfMCd), 'next_' . $fFAeDSlnGXnoleHIfMCd => $nixSLMFxeSmTWirBbVOV['id'] ); } return array($MfuuDROynFKWrNZddcnH, $oWjdztgpHLFQjLdHnw); } function nQDGTiWigcIJSpSFDBLk($BCtxQERCougFqsMoqzWX, $fFAeDSlnGXnoleHIfMCd) { $MVDseApRTSoGuBHaxVne = FAGquUaueHNqbQlTmKdO('path', ''); $bPzPSqKMSVRKhlmCpIoA = ZPCdMKSdbvvLHmtGZQmM(); $XsDTgmUsJJQsbCyDCnbL = $_GET; $XsDTgmUsJJQsbCyDCnbL[$fFAeDSlnGXnoleHIfMCd] = $BCtxQERCougFqsMoqzWX; return $MVDseApRTSoGuBHaxVne . ($XsDTgmUsJJQsbCyDCnbL ? '?' . http_build_query($XsDTgmUsJJQsbCyDCnbL): ''); } function BTWiMnMpaKDpZcNDwJAQ($fFjYktyYgJhdrskyZngp, $WdjzFsTExVubtUdyjxqf = null) { if (!$WdjzFsTExVubtUdyjxqf) { $WdjzFsTExVubtUdyjxqf = array(); } $sArEVSiJEvcelHEbfcMi = !empty($WdjzFsTExVubtUdyjxqf['formatted_user']) ? $WdjzFsTExVubtUdyjxqf['formatted_user'] : null; if (!empty($fFjYktyYgJhdrskyZngp['owner']) && !$sArEVSiJEvcelHEbfcMi) { $sArEVSiJEvcelHEbfcMi = array( 'username' => $fFjYktyYgJhdrskyZngp['owner']['username'], 'profile_picture' => $fFjYktyYgJhdrskyZngp['owner']['profile_pic_url'], 'id' => $fFjYktyYgJhdrskyZngp['owner']['id'], 'full_name' => $fFjYktyYgJhdrskyZngp['owner']['full_name'] ); } $vYCBeqHjrapDRdGkjwOe = $fFjYktyYgJhdrskyZngp['dimensions']['height'] / $fFjYktyYgJhdrskyZngp['dimensions']['width']; $OsybBQWxEspvpNmSZDCe = array( 'attribution' => null, 'videos' => null, 'tags' => null, 'location' => null, 'comments' => null, 'filter' => !empty($fFjYktyYgJhdrskyZngp['filter_name']) ? $fFjYktyYgJhdrskyZngp['filter_name'] : null, 'created_time' => $fFjYktyYgJhdrskyZngp['date'], 'link' => 'https://www.instagram.com/p/' . $fFjYktyYgJhdrskyZngp['code'] . '/', 'likes' => null, 'images' => array( 'low_resolution' => array( 'url' => TafrDFxnckUFhWYNGazl($fFjYktyYgJhdrskyZngp['display_src'], 320, 320), 'width' => 320, 'height' => $vYCBeqHjrapDRdGkjwOe * 320 ), 'thumbnail' => array( 'url' => TafrDFxnckUFhWYNGazl($fFjYktyYgJhdrskyZngp['display_src'], 150, 150), 'width' => 150, 'height' => $vYCBeqHjrapDRdGkjwOe * 150 ), 'standard_resolution' => array( 'url' => TafrDFxnckUFhWYNGazl($fFjYktyYgJhdrskyZngp['display_src'], 640, 640), 'width' => 640, 'height' => $vYCBeqHjrapDRdGkjwOe * 640 ), '__original' => array( 'url' => $fFjYktyYgJhdrskyZngp['display_src'], 'width' => $fFjYktyYgJhdrskyZngp['dimensions']['width'], 'height' => $fFjYktyYgJhdrskyZngp['dimensions']['height'] ) ), 'users_in_photo' => null, 'caption' => null, 'type' => $fFjYktyYgJhdrskyZngp['is_video'] ? 'video' : 'image', 'id' => $fFjYktyYgJhdrskyZngp['id'] . '_' . $sArEVSiJEvcelHEbfcMi['id'], 'code' => $fFjYktyYgJhdrskyZngp['code'], 'user' => $sArEVSiJEvcelHEbfcMi ); if (!empty($fFjYktyYgJhdrskyZngp['caption'])) { $OsybBQWxEspvpNmSZDCe['caption'] = array( 'created_time' => $fFjYktyYgJhdrskyZngp['date'], 'text' => $fFjYktyYgJhdrskyZngp['caption'], 'from' => $sArEVSiJEvcelHEbfcMi ); $OsybBQWxEspvpNmSZDCe['tags'] = AFbyAvLGgAnnSJXUlqDQ($fFjYktyYgJhdrskyZngp['caption']); } if (!empty($fFjYktyYgJhdrskyZngp['video_url'])) { $OsybBQWxEspvpNmSZDCe['videos'] = array( 'standard_resolution' => array( 'url' => $fFjYktyYgJhdrskyZngp['video_url'], 'width' => 640, 'height' => $vYCBeqHjrapDRdGkjwOe * 640 ) ); } if (!empty($fFjYktyYgJhdrskyZngp['comments'])) { $OsybBQWxEspvpNmSZDCe['comments'] = array( 'count' => !empty($fFjYktyYgJhdrskyZngp['comments']['count']) ? $fFjYktyYgJhdrskyZngp['comments']['count'] : 0, 'data' => array() ); if (!empty($fFjYktyYgJhdrskyZngp['comments']['nodes'])) { $qlXOmqTpHZVZLqcBmhnD = array_slice($fFjYktyYgJhdrskyZngp['comments']['nodes'], -10, 10); foreach ($qlXOmqTpHZVZLqcBmhnD as $EYqZiYFUicJLgbFgeCAV) { $bXOEfcJGcHkqcSFqLsyt = null; if (!empty($EYqZiYFUicJLgbFgeCAV['user'])) { $bXOEfcJGcHkqcSFqLsyt = array( 'username' => $EYqZiYFUicJLgbFgeCAV['user']['username'], 'profile_picture' => $EYqZiYFUicJLgbFgeCAV['user']['profile_pic_url'], 'id' => $EYqZiYFUicJLgbFgeCAV['user']['id'] ); } $OsybBQWxEspvpNmSZDCe['comments']['data'][] = array( 'created_time' => $EYqZiYFUicJLgbFgeCAV['created_at'], 'text' => $EYqZiYFUicJLgbFgeCAV['text'], 'from' => $bXOEfcJGcHkqcSFqLsyt ); } } } if (!empty($fFjYktyYgJhdrskyZngp['likes'])) { $OsybBQWxEspvpNmSZDCe['likes'] = array( 'count' => !empty($fFjYktyYgJhdrskyZngp['likes']['count']) ? $fFjYktyYgJhdrskyZngp['likes']['count'] : 0, 'data' => array() ); if (!empty($fFjYktyYgJhdrskyZngp['likes']['nodes'])) { $PHYuzjwCjRRKYzPeQgDy = array_slice($fFjYktyYgJhdrskyZngp['likes']['nodes'], -4, 4); foreach ($PHYuzjwCjRRKYzPeQgDy as $xOtfoYqjbcHjrBaaJkRW) { $byHztaRhAxIdfpaomULJ = null; if (!empty($xOtfoYqjbcHjrBaaJkRW['user'])) { $byHztaRhAxIdfpaomULJ = array( 'username' => $xOtfoYqjbcHjrBaaJkRW['user']['username'], 'profile_picture' => $xOtfoYqjbcHjrBaaJkRW['user']['profile_pic_url'], 'id' => $xOtfoYqjbcHjrBaaJkRW['user']['id'] ); } $OsybBQWxEspvpNmSZDCe['likes']['data'][] = $byHztaRhAxIdfpaomULJ; } } } if (!empty($fFjYktyYgJhdrskyZngp['location'])) { $OsybBQWxEspvpNmSZDCe['location'] = array( 'name' => $fFjYktyYgJhdrskyZngp['location']['name'], 'id' => $fFjYktyYgJhdrskyZngp['location']['id'] ); } return $OsybBQWxEspvpNmSZDCe; } function TafrDFxnckUFhWYNGazl($gXNjWLFkUQOugyREMXKv, $cLIqbezSrNzFuESsTGFa, $cflRcUZoKJyHuhads) { if (preg_match('#/s\d+x\d+/#', $gXNjWLFkUQOugyREMXKv)) { return preg_replace('#/s\d+x\d+/#', '/s' . $cLIqbezSrNzFuESsTGFa . 'x' . $cflRcUZoKJyHuhads . '/', $gXNjWLFkUQOugyREMXKv); } else if (preg_match('#/e\d+/#', $gXNjWLFkUQOugyREMXKv)) { return preg_replace('#/e(\d+)/#', '/s' . $cLIqbezSrNzFuESsTGFa . 'x' . $cflRcUZoKJyHuhads . '/e$1/', $gXNjWLFkUQOugyREMXKv); } else if (preg_match('#(\.com/[^/]+)/#', $gXNjWLFkUQOugyREMXKv)) { return preg_replace('#(\.com/[^/]+)/#', '$1/s' . $cLIqbezSrNzFuESsTGFa . 'x' . $cflRcUZoKJyHuhads . '/', $gXNjWLFkUQOugyREMXKv); } return null; } function AFbyAvLGgAnnSJXUlqDQ($NygjKszxwCxlHbyDpHTT) { preg_match_all('#\#([\w_]+)#u', $NygjKszxwCxlHbyDpHTT, $CJddkOvROvqCUQXsoww); return $CJddkOvROvqCUQXsoww[1]; } function LSSDtbkJUjaqSzuvFgvg($aumZVSoNLcoUiryLdkex, $OLYrLapWYcfWuONuKBWT) { $OLYrLapWYcfWuONuKBWT = is_array($OLYrLapWYcfWuONuKBWT) || is_object($OLYrLapWYcfWuONuKBWT) ? (array) array_values($OLYrLapWYcfWuONuKBWT) : explode(',', $OLYrLapWYcfWuONuKBWT); $OLYrLapWYcfWuONuKBWT = array_map('trim', $OLYrLapWYcfWuONuKBWT); return in_array('*', $OLYrLapWYcfWuONuKBWT) || in_array($aumZVSoNLcoUiryLdkex, $OLYrLapWYcfWuONuKBWT); } function OopUrZUGjAoytRSYNBvw() { $tbXkgGUSVPaiOcWdCpxv = null; $MkBbRqmpkYjfaeFNMelV = func_get_args(); foreach ($MkBbRqmpkYjfaeFNMelV as $EvXnDDllhaIeEfewZcMw => $QrnkCEWRkHbQPoEPelYQ) { if ($EvXnDDllhaIeEfewZcMw === 0) { $tbXkgGUSVPaiOcWdCpxv = $QrnkCEWRkHbQPoEPelYQ; continue; } $tbXkgGUSVPaiOcWdCpxv = array_combine( array_merge(array_keys($tbXkgGUSVPaiOcWdCpxv), array_keys($QrnkCEWRkHbQPoEPelYQ)), array_merge(array_values($tbXkgGUSVPaiOcWdCpxv), array_values($QrnkCEWRkHbQPoEPelYQ)) ); } return $tbXkgGUSVPaiOcWdCpxv; } function PZYKfDcARevAbjXcWEDg() { return false; } ?>