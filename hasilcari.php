<?php function svideo(){$search = strtok($_GET['q'], '/');$maxhistory = 88;$lastsearchfile = 'lastsearch.txt';echo '<div id="radius" class="tengah" align="center">';$lastsearch = @file($lastsearchfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);if($search) $history[] = $search;if(is_array($lastsearch)) {$i=count($history);foreach($lastsearch as $k => $v) {if($v != $search && $i < $maxhistory) {$history[] = $v;$i++;}}}if($history) {file_put_contents($lastsearchfile, join("\n", $history));foreach($history as $key=>$value)$history[$key] = '<a href="'.$originalhost.'/search/'.urlencode($value).'" title="'.$value.'">'.ucwords(str_replace('-', ' ', $value)).'</a>';echo join(' <font size="4">|</font> ', $history);}}echo ''.svideo().'</div>';
