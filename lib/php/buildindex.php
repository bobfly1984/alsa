<?php
// buildindex.php 20130811 (C) Mark Constable (AGPL-3.0)
//
// Get a list of *.md files in a directory and create a Bootstrap3 compatible
// 3 pane listing of links to include within a div with a class of "container".

if (PHP_SAPI !== 'cli') return;

$files = glob('../md/*.md');

$num_files = count($files);
$div_one = ceil($num_files / 2);

//$div_one = ceil($num_files / 3);
//$div_two = ceil($div_one * 2);

$links = '';

for($i = 0; $i < $num_files; $i++) {
//    if ($i == $div_one or $i == $div_two) {
    if ($i == $div_one) {
        $links .= '
        </div>
        <div class="col-lg-4">';
    }
    $link = pathinfo($files[$i], PATHINFO_FILENAME);
    $links .= '
          <a href="/'.$link.'">'.$link.'</a><br>';
}

$output = <<<EOM
<?php
/* DO NOT EDIT. Auto generated by buildindex.php. */
return '
      <div class="row">
        <div class="col-lg-6">$links
        </div>
      </div>';
EOM;

file_put_contents('navigation.php', $output);
