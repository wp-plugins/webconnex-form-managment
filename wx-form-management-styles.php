<?php
    header("Content-type: text/css; charset: UTF-8");
    $background = '#7BB045';
    if($_GET['background']) {
      $background = '#'.$_GET['background'];
    }
    $color = '#FFF';
    if($_GET['color']) {
      $color = '#'.$_GET['color'];
    }
?>
a.wx-button, a.wx-button:hover {
  color: <?php echo $color; ?>;
  background: <?php echo $background; ?>;
  opacity: 0.8;
  padding: 1em;
  border: none;
  text-decoration: none;

}
a.wx-button:hover {
  opacity: 1;
  -webkit-animation: highlight 1s 1;
  -moz-animation: highlight 1s 1;
  -ms-animation: highlight 1s 1;
  -o-animation: highlight 1s 1;
  animation: highlight 1s 1;
}
