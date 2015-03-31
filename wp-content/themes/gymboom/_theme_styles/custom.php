<?php header("content-type: text/css");

$color = $_GET['color'];
$footer_bg = $_GET['footer_bg'];
$bottom_bg = $_GET['bottom_bg'];

function html2rgb($color) {
    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
                                 $color[2].$color[3],
                                 $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    else
        return false;

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return array($r, $g, $b);
}

function rgb2html($r, $g=-1, $b=-1)
{
    if (is_array($r) && sizeof($r) == 3)
        list($r, $g, $b) = $r;

    $r = intval($r); $g = intval($g);
    $b = intval($b);

    $r = dechex($r<0?0:($r>255?255:$r));
    $g = dechex($g<0?0:($g>255?255:$g));
    $b = dechex($b<0?0:($b>255?255:$b));

    $color = (strlen($r) < 2?'0':'').$r;
    $color .= (strlen($g) < 2?'0':'').$g;
    $color .= (strlen($b) < 2?'0':'').$b;
    return $color;
}

$rgb = html2rgb($color);
$rgb_dark = ($rgb[0] - 20).','.($rgb[1] - 20).','.($rgb[2] - 20);
$rgb_darker = ($rgb[0] - 45).','.($rgb[1] - 45).','.($rgb[2] - 45);
$rgb_light = ($rgb[0] + 20).','.($rgb[1] + 20).','.($rgb[2] + 20);

$rgb_light = explode(',',$rgb_light);
$color_light = rgb2html($rgb_light[0],$rgb_light[1],$rgb_light[2]);

$rgb_dark = explode(',',$rgb_dark);
$color_dark = rgb2html($rgb_dark[0],$rgb_dark[1],$rgb_dark[2]);

$rgb_darker = explode(',',$rgb_darker);
$color_darker = rgb2html($rgb_darker[0],$rgb_darker[1],$rgb_darker[2]);

$font_headings = $_GET['font_headings'];
$font_main = $_GET['font_main'];
$font_buttons = $_GET['font_buttons'];

if (strstr($font_headings,':')){
	$font_headings = explode(':',$font_headings);
	$font_headings = "'".$font_headings[0]."'";
}

if (strstr($font_main,':')){
	$font_main = explode(':',$font_main);
	$font_main = "'".$font_main[0]."'";
}

if (strstr($font_buttons,':')){
	$font_buttons = explode(':',$font_buttons);
	$font_buttons = "'".$font_buttons[0]."'";
} ?>

/* Main Font */
body
{ font-family: <?php echo $font_main; ?>; font-weight:400; }

/* Headings Font */
#features h2,
.recent-widget h3, .text-slider h2,
#content h1,#content h2,
#content .gallery .title,
table.calendar thead th
{ font-family: <?php echo $font_headings; ?>; font-weight:400; }

/* Button Font */
.widget-button, .button-small,
.gb-button, header nav > ul > li.custom a,
.gb-button strong,
.gb-button.grey,
.continue
{ font-family: <?php echo $font_buttons; ?>; font-weight:400; }

/* Customize the colors! */

a,
#features h2,
.recent-widget h3,
.text-slider h2,
#content h2,
#content .gallery a:hover { color:#<?php echo $color; ?>; }

header nav .dropdown li:hover,
#bottom span.next:hover,
#bottom span.prev:hover,
#slider .flex-direction-nav a:hover,
#testimonials .flex-direction-nav a:hover,
#pagination a:hover,
table.calendar thead th { border-color: #<?php echo $color; ?>; }

footer span.next:hover,
footer span.prev:hover { border-color: #<?php echo $color; ?> !important; }

header nav .dropdown li:hover,
#slider .elements .top-corner,
#slider .elements .bottom-corner,
.no-rgba header nav .dropdown li:hover,
#pagination a:hover,
#filters span.active,
#filters span.active:hover,
header #mobile-nav .mobile-nav-toggle,
header #mobile-nav li.current a { background: #<?php echo $color; ?>; }

#bottom span.next:hover,
#bottom span.prev:hover,
#slider .flex-direction-nav a:hover,
#testimonials .flex-direction-nav a:hover,
.widget-button, .button-small,
#respond input#submit,
#searchform input.button,
#aec-modal-container .aec-title,
table.calendar thead th a.cal-nav { background-color: #<?php echo $color; ?> !important; }

footer span.next:hover,
footer span.prev:hover { background-color: #<?php echo $color; ?> !important; }

.gb-button,
table.calendar thead th,
header nav > ul > li.custom a {
	background-color: #<?php echo $color; ?>;
}
.gb-button:hover,
header nav > ul > li.custom a:hover {
	background-color: #<?php echo $color_dark; ?>;
}

footer .top,
footer ul.widgets span.prev,
footer ul.widgets span.next,
footer .upcoming-widget li a,
footer .mobile-calendar li a {
	background-color: #<?php echo $footer_bg; ?>;
}

footer .bottom {
	background-color: #<?php echo $bottom_bg; ?>;
}