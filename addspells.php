<h1>Add Spells Form</h1>
<form action="" method="post">
    <p>Name: <input type="text" name="name" /></p>
	<p>Level: <input type="text" name="level" /></p>
	<p>Range: <input type="text" name="range" /></p>
	<p>Action: <input type="text" name="action" /></p>
	<p>Duration: <input type="text" name="duration" /></p>
    <p>Effect: <textarea name="effect" /></textarea></p>
    <p><input type="submit" value="Add" name="add" /></p>
</form>

<?php
$name = $_POST['name'];
$effect = $_POST['effect'];
$level = $_POST['level'];
$range = $_POST['range'];
$action = $_POST['action'];
$duration = $_POST['duration'];

$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load('xml/spells.xml');

$element = $xml->getElementsByTagName('spell')->item(0);

$name = $element->getElementsByTagName('name')->item(0);
$effect = $element->getElementsByTagName('effect')->item(0);
$level = $element->getElementsByTagName('level')->item(0);
$range = $element->getElementsByTagName('range')->item(0);
$action = $element->getElementsByTagName('action')->item(0);
$duration = $element->getElementsByTagName('duration')->item(0);

$newItem = $xml->createElement('spell');

$newItem->appendChild($xml->createElement('name', $_POST['name']));
$newItem->appendChild($xml->createElement('effect', $_POST['effect']));
$newItem->appendChild($xml->createElement('level', $_POST['level']));
$newItem->appendChild($xml->createElement('range', $_POST['range']));
$newItem->appendChild($xml->createElement('action', $_POST['action']));
$newItem->appendChild($xml->createElement('duration', $_POST['duration']));

$xml->getElementsByTagName('spells')->item(0)->appendChild($newItem);

$xml->save('xml/spells.xml');

$_POST = array();
?>