<?php

setParameterSetId("5b5441aa6d21469c911a55f1e85aa11c");


$millimeter = 1;
$inch = 25.4 * $millimeter;
$mm = $millimeter;

$degree = 1;
$radian = 180/pi();


$preferredScrew->pilotHole->diameter = 2.8* $mm;
$preferredScrew->clampingMeat->minimumAllowedDiameter = 10.5 * $mm;  //clamping meat is a region in the object containing the threaded (pilot) hole.
$preferredScrew->clampingMeat->minimumAllowedLength = 12 * $mm;
$preferredScrew->clearanceHole->diameter = 4.4 * $mm;
$preferredScrew->counterSink->diameter = 7.95 * $mm;
$preferredScrew->counterSink->coneAngle = 90 * $degree;
$preferredScrew->clampingDiameter = 12  * $mm; //clamping dimaeter is the diameter of a region in the object containing the clearance hole.


$batteryCompartment = new stdclass;
$c = $batteryCompartment;

$c->lidBindingScrew = clone $preferredScrew;



$c->wallThickness = 3*$mm;
$c->batteryCavity->extent->x = 55 * $mm;
$c->batteryCavity->extent->y = 40 * $mm;
$c->batteryCavity->extent->z = 35 * $mm;


$c->lid->extent->y = $c->batteryCavity->extent->y + 2*3*$mm;
$c->lid->extent->z = 3.3  * $mm;

$c->lidPocketOffset = 0.7 * $mm; //the gap between the walls of the lid pocket and the lid.



$c->lidBindingScrews->interval->x = $c->batteryCavity->extent->x + $c->lidBindingScrew->clampingMeat->minimumAllowedDiameter;
$c->lidBindingScrews->interval->y = $c->lid->extent->y - $c->lidBindingScrew->clampingDiameter;


$c->lid->extent->x = $c->lidBindingScrews->interval->x + $c->lidBindingScrew->clampingDiameter;
$c->lid->cornerRoundingRadius = $c->lidBindingScrew->clampingDiameter/2;

$c->lidPocket->extent->x = $c->lid->extent->x + 2*$c->lidPocketOffset;
$c->lidPocket->extent->y = $c->lid->extent->y + 2*$c->lidPocketOffset;
$c->lidPocket->extent->z = $c->lid->extent->z + 0.3*$mm;

$c->extent->z = $c->lid->extent->z + $c->batteryCavity->extent->z + $c->wallThickness;
$c->extent->x = max([
	$c->batteryCavity->extent->x + 2*$c->wallThickness,
	$c->lidPocket->extent->x + 2*$c->wallThickness
]);
$c->extent->y = max([
	$c->batteryCavity->extent->y + 2*$c->wallThickness,
	$c->lidPocket->extent->y + 2*$c->wallThickness
]);



unset($c);

$keyswitchTester = new stdclass;
$keyswitchTester->box = new stdclass;
$c = $keyswitchTester->box;
$c->extent->x = 75 * $mm;
$c->extent->y = 95 * $mm;
$c->extent->z = 70 * $mm;
$c->wallThickness = 3.3 * $mm;
$c->cornerRoundingRadius = 13 * $mm;

$c->lidBindingScrew = clone clone $preferredScrew;

$c->lidBindingScrew->offsetFromEdge = max([$c->lidBindingScrew->clampingMeat->minimumAllowedDiameter/2, $c->lidBindingScrew->clampingDiameter/2]);
$c->lidBindingScrew->offsetFromEdge = max([$c->lidBindingScrew->offsetFromEdge, $c->cornerRoundingRadius]);

if($c->lidBindingScrew->offsetFromEdge < $c->cornerRoundingRadius)
{
	$c->lidBindingScrews->interval->x = $c->extent->x - 2*$c->cornerRoundingRadius + 2* ($c->cornerRoundingRadius - $c->lidBindingScrew->offsetFromEdge)*(1/sqrt(2));
	$c->lidBindingScrews->interval->y = $c->extent->y - 2*$c->cornerRoundingRadius + 2* ($c->cornerRoundingRadius - $c->lidBindingScrew->offsetFromEdge)*(1/sqrt(2));
} else {
	$c->lidBindingScrews->interval->x = $c->extent->x - 2*$c->lidBindingScrew->offsetFromEdge;
	$c->lidBindingScrews->interval->y = $c->extent->y - 2*$c->lidBindingScrew->offsetFromEdge;
}

$c->interiorStrengtheningFillet->radius = 7 * $mm;

unset($c);

?>