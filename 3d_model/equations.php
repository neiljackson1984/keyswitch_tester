<?php

setParameterSetId("5b5441aa6d21469c911a55f1e85aa11c");


$millimeter = 1;
$inch = 25.4 * $millimeter;
$mm = $millimeter;

$degree = 1;
$radian = 180/pi();

$batteryCompartment = new stdclass;
$c = $batteryCompartment;

$c->batteryCavity->extent->x = 55 * $mm;
$c->batteryCavity->extent->y = 20 * $mm;
$c->batteryCavity->extent->z = 35 * $mm;

$c->lid->extent->x = $c->batteryCavity->extent->x + 2*13*$mm;
$c->lid->extent->y = $c->batteryCavity->extent->y + 2*13*$mm;
$c->lid->extent->z = 0.2 * $mm;

$c->lidPocketOffset = 0.3 * $mm; //the gap between the walls of the lid pocket and the lid.

$c->wallThickness = 1.8*$mm;

unset($c);

$keyswitchTester = new stdclass;
$c = $keyswitchTester;
$c->box->extent->x = 200 * $mm;
$c->box->extent->y = 300 * $mm;
$c->box->extent->z = 100 * $mm;
$c->box->wallThickness = 4 * $mm;
unset($c);

?>