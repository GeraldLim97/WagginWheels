<link rel="stylesheet" href="styles/rating.css">
<?php function rating($star) {
    return join("",array_map(function($x) use ($star) {return "<span id='filter' class='".(($star > $x)?"checked":"blank")."'> ★ </span>";}, range(0, 4)));
} ?>

