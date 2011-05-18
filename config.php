<?php if(!defined('PLX_ROOT')) exit; ?>
<?php
$humansFilename = $_SERVER["DOCUMENT_ROOT"]."/humans.txt";

if(!empty($_POST)) {
	$plxPlugin->setParam('enabled', $_POST['enabled'], 'string');
	if(! empty($_POST['content']))
		$plxPlugin->setParam('content', $_POST['content'], 'string');
	$plxPlugin->saveParams();
	
	// Disabling humans.txt
	if($_POST['enabled'] == false){
		unlink($humansFilename);
	} elseif( ! empty($_POST['content'])){
		// Writing file
			$handler = fopen($humansFilename, 'w') or die("can't open file");
			fwrite($handler, $_POST['content']);
			fclose($handler);	
	}
	
	// Redirection 
	header('Location: parametres_plugin.php?p=plxhumanstxt');
	exit;
}

if($plxPlugin->getParam('enabled') == true){
// Reading the previous humans.txt
$content = @file_get_contents($humansFilename, FILE_USE_INCLUDE_PATH);
if(empty($content)){
	$content = $plxPlugin->getParam('content');
}
} 

$aStyles["1"] = "Oui";
$aStyles["0"] = "Non";

?>

<h2><?php $plxPlugin->lang('HUMANS_TITLE'); ?></h2>
<p><?php $plxPlugin->lang('HUMANS_DESCRIPTION'); ?></p>
<p><?php $plxPlugin->lang('HUMANS_VISUALIZE'); ?></p>

<form action="parametres_plugin.php?p=plxhumanstxt" method="post">
<fieldset class="withlabel">
	<legend><?php $plxPlugin->lang('HUMANS_FIELDSET'); ?></legend>
	<p class="field">
		<label for="enabled"><?php $plxPlugin->lang('HUMANS_ACTIVATE'); ?></label>
		<?php plxUtils::printSelect('enabled', $aStyles, $plxPlugin->getParam('enabled')); ?>
	</p>
	<p class="field">
	<?php if($plxPlugin->getParam('enabled') == true):?>
	<textarea  name="content" id="" cols="30" rows="10"><?php echo $content; ?></textarea>
	<?php endif;?>
	</p>
	<p><input type="submit" name="submit" value="<?php $plxPlugin->lang('HUMANS_SAVE'); ?>"></p>
</fieldset>
</form>
