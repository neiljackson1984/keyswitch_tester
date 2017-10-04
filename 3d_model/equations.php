<?php

setParameterSetId("5b5441aa6d21469c911a55f1e85aa11c");

//for the following reference to deepcopy to work, you need to acquire the 
// deepcopy library using composer.  To do this,
// create a file named composer.json with the following contents
//   {
//       "require": {
//           "myclabs/deep-copy": "^1.5"
//       }
//   }
// then run "composer update" on the command line (this assumes that composer is installed (See https://getcomposer.org/doc/00-intro.md).
//to use deep copy, for example:
//$myCopy = (new DeepCopy())->copy($originalObject); 

require __DIR__ . '/vendor/autoload.php';
use DeepCopy\DeepCopy;

$millimeter = 1;
$inch = 25.4 * $millimeter;
$mm = $millimeter;

$degree = 1;
$radian = 180/pi();
$newlineForSldworksText = "\r\n";

{//panelMountM12Connector
	$panelMountM12Connector->cutout->widthAcrossFlats = 13.95 * $mm; //datasheet recommends 13.5mm
	$panelMountM12Connector->cutout->diameter = 16 * $mm;
	$panelMountM12Connector->minimumAllowedLocalPanelThicknessBelowFlange = 3.1 * $mm;
	$panelMountM12Connector->maximumAllowedLocalPanelThicknessBelowFlange = 3.6 * $mm;
	$panelMountM12Connector->localPanelNeighborhood->diameter = 23.3 * $mm; //a circle of this diameter will be big enough to allow the nut to spin freely.
	$panelMountM12Connector->flangeSinkDepthBelowPanelExterior = 2* $mm;
	$panelMountM12Connector->flangePocketClearance = 0.3* $mm;
}

{//panelMountLED
	$panelMountLED->protrusionBeyondPanel = 0 * $mm;
}

{ //preferredScrew: 
	$preferredScrew->pilotHole->diameter = 3.1* $mm;
	$preferredScrew->clampingMeat->minimumAllowedDiameter = 12 * $mm;  //clamping meat is a region in the object containing the threaded (pilot) hole.
	$preferredScrew->clampingMeat->minimumAllowedLength = 15 * $mm;
	$preferredScrew->clearanceHole->diameter = 4.4 * $mm;
	$preferredScrew->counterSink->diameter = 8.3 * $mm;//7.95 * $mm + 0.1 * $mm;
	$preferredScrew->counterSink->coneAngle = 90 * $degree;
	$preferredScrew->clampingDiameter = 12  * $mm; //clamping dimaeter is the diameter of a region in the object containing the clearance hole.
}

{
	
	$m4Threads->closeFitClearanceDiameter = 0.257 * $inch + 0.5 * $mm;
	//$m4Threads->pitchDiameter = 3.8 * $mm; //this is purely cosmetic for the model on screen - has no bearing on the output solid of iterest.
	$m4Threads->majorDiameter = 4 * $mm; //this is purely cosmetic for the model on screen - has no bearing on the output solid of iterest.
	$m4Threads->pilotHoleDiameter = 3.3 * $mm;
	$m4Threads->pitch = 0.7 * $mm;


	$m4HexNut->threads = $m4Threads;
	$m4HexNut->diameterAcrossFlats = 7 * $mm;
	$m4HexNut->thickness = 3.2 * $mm;


	$embeddableNut->nut = $m4HexNut;
	$embeddableNut->nutCaveThickness = $embeddableNut->nut->thickness + 1.0*$mm;
	$embeddableNut->embedmentCylinder->diameter = 2 * $embeddableNut->nut->diameterAcrossFlats;
	$embeddableNut->embedmentCylinder->height = 2.8 * $embeddableNut->nut->thickness;
	$embeddableNut->nutChamberMargin = 0.4 * $mm;
	$embeddableNut->nutCaveToolLength = 5 * $embeddableNut->nut->diameterAcrossFlats;
	$embeddableNut->retentionBarb->prominence = $embeddableNut->nutChamberMargin + 0.15 * $mm;
	$embeddableNut->retentionBarb->lockAngle = 60 * $degree;
	$embeddableNut->retentionBarb->rampAngle = 35 * $degree;
	$embeddableNut->retentionBarb->peakRoundingRadius = 1/5 * $embeddableNut->retentionBarb->prominence;
	$embeddableNut->plugMask->offset = 0.003 * $inch; //this is the gap to leave between the walls of the nut slot and the surface of the plug which will stick into the nut slot.

}

$preferredEngravingDepth = 0.7 * $mm;

$keyswitchTester = new stdclass;
$keyswitchTester->box = new stdclass;
$batteryCompartment = new stdclass;
$keyswitchTester->box->wallThickness = 3.3 * $mm;

{ $c = $batteryCompartment;
	
	$c->lidBindingScrew = (new DeepCopy())->copy($preferredScrew);

	$c->wallThickness = 3*$mm;

	$c->batteryCavity->extent->z = 18.5 * $mm;
	$c->batteryCavity->extent->y = 55 * $mm;
	$c->batteryCavity->extent->x = 27.5 * $mm;

	$c->lid->engravedText->rawString = "9-VOLT" . $newlineForSldworksText . "BATTERY";
	$c->lid->engravedText->lines = explode($newlineForSldworksText, $c->lid->engravedText->rawString);
	//$c->lid->engravedText->lines = array_merge($c->lid->engravedText->lines, ["","","",""]); //make sure that some array entries exist to avoid solidworks evaluation errors.
	$c->lid->engravedText->fontHeight = 8 * $mm;
	$c->lid->engravedText->lineSpacingFactor = 1.4;
	$c->lid->engravedText->lineSpacing = $c->lid->engravedText->lineSpacingFactor * $c->lid->engravedText->fontHeight;
	$c->lid->engravedText->textBlockHeight = $c->lid->engravedText->fontHeight * count($c->lid->engravedText->lines) + $c->lid->engravedText->fontHeight * ($c->lid->engravedText->lineSpacingFactor - 1) * (count($c->lid->engravedText->lines)-1);
	$c->lid->engravedText->engravingDepth = $preferredEngravingDepth;
	//="externalParameters.this.lid.engravedText.engravingDepth"
	//$PRP:"externalParameters.this.lid.engravedText.lines[0]"
	//$PRP:"externalParameters.this.lid.engravedText.lines[1]"
	
	$c->lid->extent->z = $keyswitchTester->box->wallThickness;
	$c->lidPocket->extent->z = $c->lid->extent->z + 0.3*$mm;

	$c->lidPocketOffset = 0.7 * $mm; //the gap between the walls of the lid pocket and the lid.

	$c->lidOverlapThatIsNotDeterminedByMountHoles = 3*$mm;
	$c->lidMountHoleOrientationSpecifier = "x";

	if($c->lidMountHoleOrientationSpecifier == "y")
	{
		$c->lid->extent->y = $c->batteryCavity->extent->y + 2*$c->lidOverlapThatIsNotDeterminedByMountHoles;
		$c->lidBindingScrews->interval->x = $c->batteryCavity->extent->x + $c->lidBindingScrew->clampingMeat->minimumAllowedDiameter;
		$c->lidBindingScrews->interval->y = $c->lid->extent->y - $c->lidBindingScrew->clampingDiameter;
		$c->lid->extent->x = $c->lidBindingScrews->interval->x + $c->lidBindingScrew->clampingDiameter;
	} else {
		$c->lid->extent->x = $c->batteryCavity->extent->x + 2*$c->lidOverlapThatIsNotDeterminedByMountHoles;
		$c->lidBindingScrews->interval->y = $c->batteryCavity->extent->y + $c->lidBindingScrew->clampingMeat->minimumAllowedDiameter;
		$c->lidBindingScrews->interval->x = $c->lid->extent->x - $c->lidBindingScrew->clampingDiameter;
		$c->lid->extent->y = $c->lidBindingScrews->interval->y + $c->lidBindingScrew->clampingDiameter;
	}

	$c->lid->cornerRoundingRadius = $c->lidBindingScrew->clampingDiameter/2;

	$c->lidPocket->extent->x = $c->lid->extent->x + 2*$c->lidPocketOffset;
	$c->lidPocket->extent->y = $c->lid->extent->y + 2*$c->lidPocketOffset;


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
}


{ $c = $keyswitchTester->box;
	$c->textEngravingDepth = $preferredEngravingDepth;
	$c->extent->x = 50 * $mm;
	$c->extent->y = 90 * $mm;
	$c->extent->z = 50 * $mm;
	$c->cornerRoundingRadius = 13 * $mm;

	$c->lidBindingScrew = (new DeepCopy())->copy($preferredScrew);

	$c->lidBindingScrew->clampingDiameter = 13 * $mm;
	
	$c->lidBindingScrew->offsetFromEdge = max([$c->lidBindingScrew->clampingMeat->minimumAllowedDiameter/2, $c->lidBindingScrew->clampingDiameter/2]);
	//$c->lidBindingScrew->offsetFromEdge = max([$c->lidBindingScrew->offsetFromEdge, $c->cornerRoundingRadius]);

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
}

?>