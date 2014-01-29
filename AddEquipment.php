<h1>Add Equipment Form</h1>
<?php 
if (isset($_POST["name"])) {
    PostData();
}
?>
<form action="" method="post">
    <p>Name: <input type="text" name="name" /></p>
	<p>Description: <input type="text" name="description" /></p>
	<p>Weight: <input type="text" name="weight" /></p>
	<p>Location: <input type="text" name="location" /></p>
	<p>Damage: <input type="text" name="damage" /></p>
    <p>Damage Type: <input type="text" name="damagetype" /></p>
    <p>AC Bonus: <input type="text" name="acbonus" /></p>
    <p><input type="submit" value="Add" name="add" /></p>
</form>

<?php function PostData()
{
$name = $_POST['name'];
$description = $_POST['description'];
$weight = $_POST['weight'];
$location = $_POST['location'];
$damage = $_POST['damage'];
$damagetype = $_POST['damagetype'];
$ACBonus = $_POST['ACBonus'];

$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load('xml/equipment.xml');

$element = $xml->getElementsByTagName('equipment')->item(0);

$name = $element->getElementsByTagName('name')->item(0);
$description = $element->getElementsByTagName('description')->item(0);
$weight = $element->getElementsByTagName('weight')->item(0);
$location = $element->getElementsByTagName('location')->item(0);
$damage = $element->getElementsByTagName('damage')->item(0);
$damagetype = $element->getElementsByTagName('damagetype')->item(0);
$ACBonus = $element->getElementsByTagName('ACBonus')->item(0);

$newItem = $xml->createElement('equipment');

$newItem->appendChild($xml->createElement('name', $_POST['name']));
$newItem->appendChild($xml->createElement('description', $_POST['description']));
$newItem->appendChild($xml->createElement('weight', $_POST['weight']));
$newItem->appendChild($xml->createElement('location', $_POST['location']));
$newItem->appendChild($xml->createElement('damage', $_POST['damage']));
$newItem->appendChild($xml->createElement('damagetype', $_POST['damagetype']));
$newItem->appendChild($xml->createElement('ACBonus', $_POST['ACBonus']));

$xml->getElementsByTagName('equipments')->item(0)->appendChild($newItem);

$xml->save('xml/equipment.xml');

$_POST = array();
}
?>