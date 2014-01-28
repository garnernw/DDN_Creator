<!DOCTYPE html>
<?php $xml = simplexml_load_file("../DDN/xml/elian.xml"); ?>

<?php
$ItemWeight = null;
$EquipmentWeight = null;
$ConsumableWeight = null;

foreach ($xml->items->item as $item) {
    $ItemWeight = ($item->weight) + $ItemWeight;
}
foreach ($xml->equipments->equipment as $equipment) {
    $EquipmentWeight = ($equipment->weight) + $EquipmentWeight;
}
foreach ($xml->consumables->consumable as $consumable) {
    $ConsumableWeight = (($consumable->weight) * ($consumable->quantity)) + $ConsumableWeight;
}
?>
<!-- ************************************************** -->
<!-- REMINDERS:											-->
<!-- ++ Table header goes in Caption Tag				-->
<!-- ************************************************** -->

<? include 'menu.php'; ?>

<div id="body">
<? echo "<h1>{$xml->general->name}</h1>";  ?>
<? var_dump ($ConsumableWeight); ?>
<? echo "<br />"; ?>
<? var_dump ($xml->consumables->consumable->weight); ?>
<table class="layout">
<tr>
<!-- General -->
<td>
<table id="general">
	<caption>General</caption>
	<tr>
		<th>Name</th>
		<th>Player</th>
		<th>Alignment</th>
		<th>Deity</th>
		<th>Race</th>
		<th>Class</th>
	</tr>
	<tr>
<? echo <<<END
\t\t<td>{$xml->general->name}</td>
\t\t<td>{$xml->general->player}</td>
\t\t<td>{$xml->general->alignment}</td>
\t\t<td>{$xml->general->deity}</td>
\t\t<td>{$xml->general->race}</td>
\t\t<td>{$xml->general->class}</td>
END;
?>
	</tr>
	<tr>
		<th>Gender</th>
		<th>Hair</th>
		<th>Eyes</th>
		<th>Size</th>
		<th>Height</th>
		<th>Weight</th>
	</tr>
	<tr>
<? echo <<<END
\t\t<td>{$xml->general->gender}</td>
\t\t<td>{$xml->general->hair}</td>
\t\t<td>{$xml->general->eyes}</td>
\t\t<td>{$xml->general->size}</td>
\t\t<td>{$xml->general->height}</td>
\t\t<td>{$xml->general->weight}</td>
END;
?>
	</tr>
</table>
</td>

<!-- Attributes -->
<td>
<table id="attributes">
	<caption>Attributes</caption>
	<tr>
		<th>Name</th>
		<th>Value</th>
		<th>Mod</th>
	</tr>

<? foreach ($xml->attributes->attribute as $attribute) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$attribute->name}</td>\n";
	echo "\t\t<td>{$attribute->value}</td>\n";
	$v=($attribute->value);
	$mod=floor(($v-10)/2);
	echo "\t\t<td>{$mod}</td>\n";
	echo "\t</tr>\n";
} ?>
</table>
</td>

<!-- Details -->
<td>
<table id="details">
	<caption>Details</caption>
	<tr>
		<th>Level</th>
		<th>Exp</th>
		<th>Next Level</th>
		<th>Initiative</th>
		<th>Speed</th>
	</tr>
	<tr>
<? echo <<<END
\t\t<td>{$xml->general->level}</td>
\t\t<td>{$xml->general->exp}</td>
\t\t<td>{$xml->general->nextlevel}</td>
\t\t<td>{$xml->general->initiative}</td>
\t\t<td>{$xml->general->speed}</td>
END;
?>
	</tr>
	<tr>
		<th>Proficiency Bonus</th>
		<th>Vision</th>
		<th>Carry</th>
		<th>Max Carry</th>
		<th>Max Move</th>
	</tr>
	<tr>
<? echo <<<END
\t\t<td>{$xml->general->proficiencybonus}</td>
\t\t<td>{$xml->general->vision}</td>
\t\t<td>{$xml->general->carry}</td>
\t\t<td>{$xml->general->maxcarry}</td>
\t\t<td>{$xml->general->maxmove}</td>
END;
?>
	</tr>
	<tr>
		<th>Max Hit Points</th>
		<th>Hit Dice</th>
		<th>Hit Dice Count</th>
		<th>Background</th>
		<th>Current Weight</th>
	</tr>
<tr>
<? $TotalWeight = $EquipmentWeight+$ItemWeight+$ConsumableWeight;
echo <<<END
\t\t<td>{$xml->general->maxhitpoints}</td>
\t\t<td>{$xml->general->hitdice}</td>
\t\t<td>{$xml->general->hitdicecount}</td>
\t\t<td>{$xml->general->background}</td>
\t\t<td>$TotalWeight</td>
END;
?>
	</tr>
</table>
</td>
</tr>
</table>
<br />

<table class="layout">
<tr>
<!-- Racial Traits -->
<td>
<table id="traits">
	<caption>Racial Traits</caption>
	<tr>
		<th>Name</th>
		<th>Description</th>
	</tr>

<? foreach ($xml->traits->trait as $trait) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$trait->name}</td>\n";
	echo "\t\t<td>{$trait->description}</td>\n";
	echo "\t</tr>\n";
} ?>
</table>
</td>

<td>
<!-- Background -->
<table id="background">
	<caption>Background</caption>
	<tr>
		<th>Type</th>
		<th>Description</th>
	</tr>
<?php echo <<<END
<tr>
	<td>{$xml->background->bgtrait}</td>
	<td>{$xml->background->description}</td>
</tr>
<tr>
	<td>Proficiencies</td>
	<td>{$xml->background->bgproficiencies}</td>
</tr>
<tr>
	<td>Languages</td>
	<td>{$xml->background->bglanguages}</td>
</tr>
<tr>
	<td>Equipment</td>
	<td>{$xml->background->bgequipment}</td>
</tr>
END;
?>
	
	
</table>
</td>
</tr>
</table>
<br />

<table class="layout">
<tr>

<!-- Class Features -->
<td>
<table id="features">
	<caption>Class Features</caption>
	<tr>
		<th>Name</th>
		<th>Description</th>
	</tr>

<? foreach ($xml->features->feature as $feature) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$feature->name}</td>\n";
	echo "\t\t<td>{$feature->description}</td>\n";
	echo "\t</tr>\n";
} ?>
</table><br />
</td>

<!-- Languages -->
<td>
<table id="languages">
	<caption>Languages</caption>
	<tr>
		<th>Name</th>
	</tr>
<? foreach ($xml->languages->language as $language) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$language->name}</td>\n";
	echo "\t</tr>\n";
} ?>
</table>
</td>

<!-- Proficiencies -->
<td>
<table id="proficiencies">
	<caption>Proficiencies</caption>
	<tr>
		<th>Name</th>
	</tr>

<? foreach ($xml->proficiencies->proficient as $proficient) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$proficient->name}</td>\n";
	echo "\t</tr>\n";
} ?>
</table>
<br>
</td>
</tr>
</table>
<br />

<table class="layout">
<tr>

<!-- Skills -->
<td>
<table id="skills">
	<caption>Skills</caption>
	<tr>
		<th>Trained</th>
		<th>Name</th>
		<th>Mod</th>
		<th>Trained</th>
		<th>Name</th>
		<th>Mod</th>
		<th>Trained</th>
		<th>Name</th>
		<th>Mod</th>
	</tr>
	<tr>
<? $i = 0;
	foreach ($xml->skills->skill as $skill) {
	echo "\t\t<td>";
	if ($skill->trained == "True") {
		echo "XXX"; }
	else echo "   ";
	echo "</td>\n\t\t<td>";
	echo $skill->name . "(" . $skill->attribute . ")";
	echo "</td>\n\t\t<td>";
	if ($skill->trained == "True") {
		$attribute = $skill->attribute;
		switch ($attribute) {
		case "STR": 
			$att = $xml->attributes->attribute[0]->mod;
			break;
		case "DEX": 
			$att = $xml->attributes->attribute[1]->mod;
			break;
		case "CON": 
			$att = $xml->attributes->attribute[2]->mod;
			break;
		case "INT": 
			$att = $xml->attributes->attribute[3]->mod;
			break;
		case "WIS": 
			$att = $xml->attributes->attribute[4]->mod;
			break;
		case "CHA": 
			$att = $xml->attributes->attribute[5]->mod;
			break;
		}
		$skillmod = $xml->general->proficiencybonus + $att;
	}
	else $skillmod = 0;
	echo "+" . $skillmod . "</td>\n";
	$i++;
	if ($i == 3) {
		echo "\t</tr>\n\t<tr>";
		$i = 0;
	}
}	?>
	</tr>
</table>
</td>

<td>
<!-- Feats -->
<table id="feats">
	<caption>Feats</caption>
	<tr>
		<th>Name</th>
		<th>Description</th>
	</tr>
	<? foreach ($xml->feats->feat as $feat) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$feat->name}</td>\n";
	echo "\t\t<td>{$feat->description}</td>\n";
	echo "\t</tr>\n";
	} ?>
</table>
</td>
</tr>
</table>
<br />

<table class="layout">
<tr>
<!-- Equipment -->
<td>
<table id="equipment">
	<caption>Equipment</caption>
	<tr>
		<th>Name</th>
		<th>Weight</th>
		<th>Location</th>
		<th>Damage</th>
		<th>Damage Type</th>
		<th>AC Bonus</th>
		<th>Description</th>
	</tr>

<? foreach ($xml->equipments->equipment as $equipment) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$equipment->name}</td>\n";
	echo "\t\t<td>{$equipment->weight}</td>\n";
	echo "\t\t<td>{$equipment->location}</td>\n";
	echo "\t\t<td>{$equipment->damage}</td>\n";
	echo "\t\t<td>{$equipment->damagetype}</td>\n";
	echo "\t\t<td>{$equipment->ACBonus}</td>\n";
	echo "\t\t<td>{$equipment->description}</td>\n";
	echo "\t</tr>\n";
} ?>

<? echo <<<END
\t<tr>\n
\t\t<td>Total Weight</td>
\t\t<td>$EquipmentWeight</td>
\t</tr>
END;
?>
</table>
</td>

<!-- Armor -->
<td>
<table id="armor">
	<caption>Armor</caption>
<? foreach ($xml->armors->armor as $armor) {
	echo "\t<tr>\n";
    echo "\t\t<th>{$armor->name}</th>\n";
	echo "\t</tr>\n";
	echo "\t<tr>\n";
	echo "\t\t<td>{$armor->value}</td>\n";
	echo "\t</tr>\n";
} ?>
</table>
</td>
</tr>
</table>
<br />

<table class="layout">
<tr>
<!-- Spells -->
<td>
<table id="spells">
	<caption>Spells</caption>
	<tr>
		<th>Name</th>
		<th>Level</th>
		<th>Range</th>
		<th>Action</th>
		<th>Duration</th>
		<th>Effect</th>
		<th>Prepared</th>
	</tr>

<? foreach ($xml->spells->spell as $spell) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$spell->name}</td>\n";
	echo "\t\t<td>{$spell->level}</td>\n";
	echo "\t\t<td>{$spell->range}</td>\n";
	echo "\t\t<td>{$spell->action}</td>\n";
	echo "\t\t<td>{$spell->duration}</td>\n";
	echo "\t\t<td>{$spell->effect}</td>\n";
	echo "\t\t<td>{$spell->prepared}</td>\n";
	echo "\t</tr>\n";
} ?>
</table>
</td>
</tr>
</table>
<br />

<table class="layout">
<tr>
<!-- Items -->
<td>
<table id="items">
	<caption>Items</caption>
	<tr>
		<th>Name</th>
		<th>Weight</th>
		<th>Location</th>
		<th>Description</th>
	</tr>

<? foreach ($xml->items->item as $item) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$item->name}</td>\n";
	echo "\t\t<td>{$item->weight}</td>\n";
	echo "\t\t<td>{$item->location}</td>\n";
	echo "\t\t<td>{$item->description}</td>\n";
	echo "\t</tr>\n";
} ?>

<? echo <<<END
\t<tr>\n
\t\t<td>Total Weight</td>
\t\t<td>$ItemWeight</td>
\t</tr>
END;
?>
</table>
</td>

<!-- Money -->
<td>
<table id="money">
	<caption>Money</caption>
		<tr>
			<th>Copper</th>
			<?php echo "<td>{$xml->monies->money->value}</td>\n"; ?>
		</tr>
		<tr>
			<th>Silver</th>
			<?php echo "<td>{$xml->monies->money->value}</td>\n"; ?>
		</tr>
		<tr>
			<th>Gold</th>
			<?php echo "<td>{$xml->monies->money->value}</td>\n"; ?>
		</tr>
		<tr>
			<th>Platinum</th>
			<?php echo "<td>{$xml->monies->money->value}</td>\n"; ?>
		</tr>
		<tr>
			<th>Runic</th>
			<?php echo "<td>{$xml->monies->money->value}</td>\n"; ?>
		</tr>
		<tr>
			<th>Mithril</th>
			<?php echo "<td>{$xml->monies->money->value}</td>\n"; ?>
		</tr>
		<tr>
			<th>Astral Diamond</th>
			<?php echo "<td>{$xml->monies->money->value}</td>\n"; ?>
		</tr>
</table>
</td>
</tr>
</table>
<br />

<table class="layout">
<tr>
<!-- Consumables -->
<td>
<table id="consumables">
	<caption>Consumables</caption>
	<tr>
		<th>Name</th>
		<th>Weight</th>
		<th>Quantity</th>
	</tr>

<? foreach ($xml->consumables->consumable as $consumable) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$consumable->name}</td>\n";
	echo "\t\t<td>{$consumable->weight}</td>\n";
	echo "\t\t<td>{$consumable->quantity}</td>\n";
	echo "\t</tr>\n";
} ?>

<? echo <<<END
\t<tr>\n
\t\t<td>Total Weight</td>
\t\t<td>$ConsumableWeight</td>
\t</tr>
END;
?>
</table>
</td>

<!-- Treasure -->
<td>
<table id="treasures">
	<caption>Treasures</caption>
	<tr>
		<th>Name</th>
		<th>Weight</th>
		<th>Description</th>
	</tr>

<? foreach ($xml->treasures->treasure as $treasure) {
	echo "\t<tr>\n";
	echo "\t\t<td>{$treasure->name}</td>\n";
	echo "\t\t<td>{$treasure->weight}</td>\n";
	echo "\t\t<td>{$treasure->description}</td>\n";
	echo "\t</tr>\n";
} ?>
</table>
</td>
</tr>
</table>
<br />

<table class="layout">
<tr>
<!-- Campaign Notes -->
<td>
<table id="campaignnotes">
<caption>Campaign Notes</caption>
<tr>
	<th>Description</th>
</tr>
<tr>
	<td>
<?php echo <<<END
{$xml->general->campaignnotes}
"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
END;
	?>
	</td>
</tr>
</table>
</td>
</table>

<table class="layout">
<tr>
<!-- Character Notes -->
<td>
<table id="characternotes">
<caption>Character Notes</caption>
<tr>
	<th>Description</th>
</tr>
<tr>
<?php echo <<<END
<td>
{$xml->general->characternotes}
"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
</td>
END;
?>
</tr>
</table>
</td>
</tr>
</tr>
</table>

<br /><br />
<br /><br />
<h1>Copyright "The Creative Team at Hooters Shenandoah" 2014</h1><br />
</div>
<!-- end body stuff -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
		if ($.browser.msie && $.browser.version.substr(0,1)<7)
		{
		$('li').has('ul').mouseover(function(){
			$(this).children('ul').css('visibility','visible');
			}).mouseout(function(){
			$(this).children('ul').css('visibility','hidden');
			});
		}

		/* Mobile */
		$('#menu-wrap').prepend('<div id="menu-trigger">Menu</div>');		
		$("#menu-trigger").on("click", function(){
			$("#menu").slideToggle();
		});

		// iPad
		var isiPad = navigator.userAgent.match(/iPad/i) != null;
		if (isiPad) $('#menu ul').addClass('no-transition');      
    });          
</script>
</body>
</html>