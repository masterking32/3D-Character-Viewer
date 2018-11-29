<?php
session_start();
$race = "human";
$gender = "male";
$hair_style = "1";
$class = "1";
$skin_style = "1";
$hair_color = "1";


$leg_ll = false;
if(!empty($_SESSION["m_race"]))
{
	if($_SESSION["m_race"] == 1)
	{
		$race = "human";
	}elseif($_SESSION["m_race"] == 2)
	{
		$race = "orc";
	}elseif($_SESSION["m_race"] == 3)
	{
		$race = "dwarf";
	}elseif($_SESSION["m_race"] == 4)
	{
		$race = "nightelf";
	}elseif($_SESSION["m_race"] == 5)
	{
		$race = "scourge";
	}elseif($_SESSION["m_race"] == 6)
	{
		$race = "tauren";
	}elseif($_SESSION["m_race"] == 7)
	{
		$race = "gnome";
	}elseif($_SESSION["m_race"] == 8)
	{
		$race = "troll";
	}elseif($_SESSION["m_race"] == 10)
	{
		$race = "bloodelf";
	}elseif($_SESSION["m_race"] == 11)
	{
		$race = "draenei";
	}
}
if(!empty($_SESSION["m_gender"]))
{
	if($_SESSION["m_gender"] == 1)
	{
		$gender = "male";
	}elseif($_SESSION["m_gender"] == 2)
	{
		$gender = "female";
	}
}
if(!empty($_SESSION["m_hair_style"]))
{
	if(is_numeric($_SESSION["m_hair_style"]))
	{
		$hair_style = $_SESSION["m_hair_style"];
	}
}
if(!empty($_SESSION["m_class"]))
{
	if(is_numeric($_SESSION["m_class"]))
	{
		$class = $_SESSION["m_class"];
	}
}
if(!empty($_SESSION["m_skin_style"]))
{
	if(is_numeric($_SESSION["m_skin_style"]))
	{
		$skin_style = $_SESSION["m_skin_style"];
	}
}
if(!empty($_SESSION["m_hair_color"]))
{
	if(is_numeric($_SESSION["m_hair_color"]))
	{
		$hair_color = $_SESSION["m_hair_color"];
	}
}

class MyDB extends SQLite3 {
  function __construct() {
	  if(file_exists("armory.db"))
	  {  
		$this->open('armory.db');
	  }else{
		die("db open error!");
	  }
  }
}
$db = new MyDB();
if(!$db) {
  die($db->lastErrorMsg());
}
$itemDisplayInfo = array();
function GetItemModelData($displayId, $row = null) {
	global $itemDisplayInfo,$db;
	if(isset($itemDisplayInfo[$row]) && isset($itemDisplayInfo[$row][$displayId])) {
		return $itemDisplayInfo[$row][$displayId];
	}
	if($row == null) {
		$ret = $db->query("SELECT * FROM `armory_itemdisplayinfo` WHERE `displayid`='$displayId'");
		$row_sql = $ret->fetchArray(SQLITE3_ASSOC);
		$data = $row_sql;
	}
	else {
		$ret = $db->query("SELECT `$row` FROM `armory_itemdisplayinfo` WHERE `displayid`='$displayId'");
		$row_sql = $ret->fetchArray(SQLITE3_ASSOC);
		$data = $row_sql[$row];
	}
	if($data) {
		if(!isset($itemDisplayInfo[$row])) {
			$itemDisplayInfo[$row] = array();
		}
		$itemDisplayInfo[$row][$displayId] = $data;
		return $data;
	}
	return false;
}
function GetModelSuffix($name) {
	$suffixes = array('_u.png', '_m.png', '_f.png');
	$use_suffix = false;
	foreach($suffixes as $suff) {
		if(@file_exists('models/' . $name . $suff)) {
			$use_suffix = $suff;
		}
	}
	if($use_suffix) {
		return $use_suffix;
	}
	return '_u.png';
}
if(!empty($_SESSION["shirt"])) {
	$displayId = $_SESSION["shirt"];
    if(GetItemModelData($displayId, 'texture_2')) {
        /**
         * Shirt (armupper)
         **/
        $subtexture_data['shirt_au'] = array(
            'prefix' => 'item/texturecomponents/armuppertexture/',
            'file'   => GetItemModelData($displayId, 'texture_2'),
            'fileBackup' => GetItemModelData($displayId, 'texture_2'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => '0.0',
            'y' => '0.0'
        );
        $subtexture_data['shirt_au']['suffixFile'] = GetModelSuffix($subtexture_data['shirt_au']['prefix'] . $subtexture_data['shirt_au']['file']);
        $subtexture_data['shirt_au']['suffixFileBackup'] = GetModelSuffix($subtexture_data['shirt_au']['prefix'] . $subtexture_data['shirt_au']['fileBackup']);

        /**
         * Shirt (armlower)
         **/
        $subtexture_data['shirt_al'] = array(
            'prefix' => 'item/texturecomponents/armlowertexture/',
            'file'   => GetItemModelData($displayId, 'visual_1'),
            'fileBackup' => GetItemModelData($displayId, 'visual_1'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => '0.0',
            'y' => 0.25
        );
        $subtexture_data['shirt_al']['suffixFile'] = GetModelSuffix($subtexture_data['shirt_al']['prefix'] . $subtexture_data['shirt_al']['file']);
        $subtexture_data['shirt_al']['suffixFileBackup'] = GetModelSuffix($subtexture_data['shirt_al']['prefix'] . $subtexture_data['shirt_al']['fileBackup']);

        /**
         * Shirt (torsoupper)
         **/
        $subtexture_data['shirt_tu'] = array(
            'prefix' => 'item/texturecomponents/torsouppertexture/',
            'file'   => GetItemModelData($displayId, 'visual_3'),
            'fileBackup' => GetItemModelData($displayId, 'visual_3'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => 0.5,
            'y' => '0.0'
        );
        $subtexture_data['shirt_tu']['suffixFile'] = GetModelSuffix($subtexture_data['shirt_tu']['prefix'] . $subtexture_data['shirt_tu']['file']);
        $subtexture_data['shirt_tu']['suffixFileBackup'] = GetModelSuffix($subtexture_data['shirt_tu']['prefix'] . $subtexture_data['shirt_tu']['fileBackup']);

        /**
         * Shirt (torsolower)
         **/
        $subtexture_data['shirt_tl'] = array(
            'prefix' => 'item/texturecomponents/torsolowertexture/',
            'file'   => GetItemModelData($displayId, 'visual_4'),
            'fileBackup' => GetItemModelData($displayId, 'visual_4'),
            'h' => 0.125,
            'w' => 0.5,
            'x' => 0.5,
            'y' => 0.25
        );

        $subtexture_data['shirt_tl']['suffixFile'] = GetModelSuffix($subtexture_data['shirt_tl']['prefix'] . $subtexture_data['shirt_tl']['file']);
        $subtexture_data['shirt_tl']['suffixFileBackup'] = GetModelSuffix($subtexture_data['shirt_tl']['prefix'] . $subtexture_data['shirt_tl']['fileBackup']);
    }
}

if(!empty($_SESSION["chest"])) {
	$displayId = $_SESSION["chest"];
    if(GetItemModelData($displayId, 'visual_3')) {
        /**
         * Chest (armupper)
         **/
        $subtexture_data['chest_au'] = array(
            'prefix' => 'item/texturecomponents/armuppertexture/',
            'file'   => GetItemModelData($displayId, 'texture_2'),
            'fileBackup' => GetItemModelData($displayId, 'texture_2'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => '0.0',
            'y' => '0.0'
        );
        $subtexture_data['chest_au']['suffixFile'] = GetModelSuffix($subtexture_data['chest_au']['prefix'] . $subtexture_data['chest_au']['file']);
        $subtexture_data['chest_au']['suffixFileBackup'] = GetModelSuffix($subtexture_data['chest_au']['prefix'] . $subtexture_data['chest_au']['fileBackup']);

        /**
         * Chest (armlower)
         **/
        $subtexture_data['chest_al'] = array(
            'prefix' => 'item/texturecomponents/armlowertexture/',
            'file'   => GetItemModelData($displayId, 'visual_1'),
            'fileBackup' => GetItemModelData($displayId, 'visual_1'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => '0.0',
            'y' => 0.25
        );
        $subtexture_data['chest_al']['suffixFile'] = GetModelSuffix($subtexture_data['chest_al']['prefix'] . $subtexture_data['chest_al']['file']);
        $subtexture_data['chest_al']['suffixFileBackup'] = GetModelSuffix($subtexture_data['chest_al']['prefix'] . $subtexture_data['chest_al']['fileBackup']);

        /**
         * Chest (torsoupper)
         **/
        $subtexture_data['chest_tu'] = array(
            'prefix' => 'item/texturecomponents/torsouppertexture/',
            'file'   => GetItemModelData($displayId, 'visual_3'),
            'fileBackup' => GetItemModelData($displayId, 'visual_3'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => '0.5',
            'y' => '0.0'
        );
        $subtexture_data['chest_tu']['suffixFile'] = GetModelSuffix($subtexture_data['chest_tu']['prefix'] . $subtexture_data['chest_tu']['file']);
        $subtexture_data['chest_tu']['suffixFileBackup'] = GetModelSuffix($subtexture_data['chest_tu']['prefix'] . $subtexture_data['chest_tu']['fileBackup']);

        /**
         * Chest (torsolower)
         **/
        $subtexture_data['chest_tl'] = array(
            'prefix' => 'item/texturecomponents/torsolowertexture/',
            'file'   => GetItemModelData($displayId, 'visual_4'),
            'fileBackup' => GetItemModelData($displayId, 'visual_4'),
            'h' => 0.125,
            'w' => 0.5,
            'x' => 0.5,
            'y' => 0.25
        );
        $subtexture_data['chest_tl']['suffixFile'] = GetModelSuffix($subtexture_data['chest_tl']['prefix'] . $subtexture_data['chest_tl']['file']);
        $subtexture_data['chest_tl']['suffixFileBackup'] = GetModelSuffix($subtexture_data['chest_tl']['prefix'] . $subtexture_data['chest_tl']['fileBackup']);

        /**
         * Chest (legupper)
         **/
        $subtexture_data['chest_lu'] = array(
            'prefix' => 'item/texturecomponents/leguppertexture/',
            'file'   => GetItemModelData($displayId, 'visual_5'),
            'fileBackup' => GetItemModelData($displayId, 'visual_5'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => 0.5,
            'y' => 0.375
        );
        $subtexture_data['chest_lu']['suffixFile'] = GetModelSuffix($subtexture_data['chest_lu']['prefix'] . $subtexture_data['chest_lu']['file']);
        $subtexture_data['chest_lu']['suffixFileBackup'] = GetModelSuffix($subtexture_data['chest_lu']['prefix'] . $subtexture_data['chest_lu']['fileBackup']);

        /**
         * Chest (leglower)
         **/
        $subtexture_data['chest_ll'] = array(
            'prefix' => 'item/texturecomponents/leglowertexture/',
            'file'   => GetItemModelData($displayId, 'visual_6'),
            'fileBackup' => GetItemModelData($displayId, 'visual_6'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => 0.5,
            'y' => 0.625
        );
        $subtexture_data['chest_ll']['suffixFile'] = GetModelSuffix($subtexture_data['chest_ll']['prefix'] . $subtexture_data['chest_ll']['file']);
        $subtexture_data['chest_ll']['suffixFileBackup'] = GetModelSuffix($subtexture_data['chest_ll']['prefix'] . $subtexture_data['chest_ll']['fileBackup']);
    }
}
if(!empty($_SESSION["wrist"])) {
	$displayId = $_SESSION["wrist"];
    if(GetItemModelData($displayId, 'visual_1')) {
        /**
         * Bracers (armlower)
         **/
        $subtexture_data['bracers_al'] = array(
            'prefix' => 'item/texturecomponents/armlowertexture/',
            'file'   => GetItemModelData($displayId, 'visual_1'),
            'fileBackup' => GetItemModelData($displayId, 'visual_1'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => '0.0',
            'y' => 0.25
        );
        $subtexture_data['bracers_al']['suffixFile'] = GetModelSuffix($subtexture_data['bracers_al']['prefix'] . $subtexture_data['bracers_al']['file']);
        $subtexture_data['bracers_al']['suffixFileBackup'] = GetModelSuffix($subtexture_data['bracers_al']['prefix'] . $subtexture_data['bracers_al']['fileBackup']);
    }
}
if(!empty($_SESSION["hands"])) {
	$displayId = $_SESSION["hands"];
    if(GetItemModelData($displayId, 'visual_1')) {
        /**
         * Gloves (armlower)
         **/
        $subtexture_data['gloves_al'] = array(
            'prefix' => 'item/texturecomponents/armlowertexture/',
            'file'   => GetItemModelData($displayId, 'visual_1'),
            'fileBackup' => GetItemModelData($displayId, 'visual_1'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => '0.0',
            'y' => 0.25
        );
        $subtexture_data['gloves_al']['suffixFile'] = GetModelSuffix($subtexture_data['gloves_al']['prefix'] . $subtexture_data['gloves_al']['file']);
        $subtexture_data['gloves_al']['suffixFileBackup'] = GetModelSuffix($subtexture_data['gloves_al']['prefix'] . $subtexture_data['gloves_al']['fileBackup']);

        /**
         * Hand (main)
         **/
        $subtexture_data['hand'] = array(
            'prefix' => 'item/texturecomponents/handtexture/',
            'file'   => GetItemModelData($displayId, 'visual_2'),
            'fileBackup' => GetItemModelData($displayId, 'visual_2'),
            'h' => 0.125,
            'w' => 0.5,
            'x' => '0.0',
            'y' => 0.5
        );
        $subtexture_data['hand']['suffixFile'] = GetModelSuffix($subtexture_data['hand']['prefix'] . $subtexture_data['hand']['file']);
        $subtexture_data['hand']['suffixFileBackup'] = GetModelSuffix($subtexture_data['hand']['prefix'] . $subtexture_data['hand']['fileBackup']);
    }
}
if(!empty($_SESSION["tabard"])) {
	$displayId = $_SESSION["tabard"];
    if(GetItemModelData($displayId, 'visual_3')) {
        /**
         * Tabard (torsoupper)
         **/
        $subtexture_data['tabard_tu'] = array(
            'prefix' => 'item/texturecomponents/torsouppertexture/',
            'file'   => GetItemModelData($displayId, 'visual_3'),
            'fileBackup' => GetItemModelData($displayId, 'visual_3'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => 0.5,
            'y' => '0.0'
        );
        $subtexture_data['tabard_tu']['suffixFile'] = GetModelSuffix($subtexture_data['tabard_tu']['prefix'] . $subtexture_data['tabard_tu']['file']);
        $subtexture_data['tabard_tu']['suffixFileBackup'] = GetModelSuffix($subtexture_data['tabard_tu']['prefix'] . $subtexture_data['tabard_tu']['fileBackup']);

        /**
         * Tabard (torsolower)
         **/
        $subtexture_data['tabard_tl'] = array(
            'prefix' => 'item/texturecomponents/torsolowertexture/',
            'file'   => GetItemModelData($displayId, 'visual_4'),
            'fileBackup' => GetItemModelData($displayId, 'visual_4'),
            'h' => 0.125,
            'w' => 0.5,
            'x' => 0.5,
            'y' => 0.25
        );
        $subtexture_data['tabard_tl']['suffixFile'] = GetModelSuffix($subtexture_data['tabard_tl']['prefix'] . $subtexture_data['tabard_tl']['file']);
        $subtexture_data['tabard_tl']['suffixFileBackup'] = GetModelSuffix($subtexture_data['tabard_tl']['prefix'] . $subtexture_data['tabard_tl']['fileBackup']);
    }
}
if(!empty($_SESSION["legs"])) {
	$displayId = $_SESSION["legs"];
    if(GetItemModelData($displayId, 'visual_5') && (!isset($subtexture_data['chest_lu']) || !isset($subtexture_data['chest_lu']['file']) || $subtexture_data['chest_lu']['file'] === false || $subtexture_data['chest_lu']['file'] === null) ) {
        /**
         * Leg (legupper)
         **/
        $subtexture_data['leg_lu'] = array(
            'prefix' => 'item/texturecomponents/leguppertexture/',
            'file'   => GetItemModelData($displayId, 'visual_5'),
            'fileBackup' => GetItemModelData($displayId, 'visual_5'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => 0.5,
            'y' => 0.375
        );
        $subtexture_data['leg_lu']['suffixFile'] = GetModelSuffix($subtexture_data['leg_lu']['prefix'] . $subtexture_data['leg_lu']['file']);
        $subtexture_data['leg_lu']['suffixFileBackup'] = GetModelSuffix($subtexture_data['leg_lu']['prefix'] . $subtexture_data['leg_lu']['fileBackup']);

        /**
         * Leg (leglower)
         **/
        $subtexture_data['leg_ll'] = array(
            'prefix' => 'item/texturecomponents/leglowertexture/',
            'file'   => GetItemModelData($displayId, 'visual_6'),
            'fileBackup' => GetItemModelData($displayId, 'visual_6'),
            'h' => 0.25,
            'w' => 0.5,
            'x' => 0.5,
            'y' => 0.625
        );
        $subtexture_data['leg_ll']['suffixFile'] = GetModelSuffix($subtexture_data['leg_ll']['prefix'] . $subtexture_data['leg_ll']['file']);
        $subtexture_data['leg_ll']['suffixFileBackup'] = GetModelSuffix($subtexture_data['leg_ll']['prefix'] . $subtexture_data['leg_ll']['fileBackup']);
    }
}
if(!empty($subtexture_data['leg_ll']))
{
	$leg_ll = true;
}
if(!empty($_SESSION["belt"])) {
	$displayId = $_SESSION["belt"];
    if(GetItemModelData($displayId, null)) {
        /**
         * Belt (torsolower)
         **/
        $subtexture_data['belt_tl'] = array(
                'prefix' => 'item/texturecomponents/torsolowertexture/',
                'file'   => GetItemModelData($displayId, 'visual_4'),
                'fileBackup' => GetItemModelData($displayId, 'visual_4'),
                'h' => 0.125,
                'w' => 0.5,
                'x' => 0.5,
                'y' => 0.25
        );
        $subtexture_data['belt_tl']['suffixFile'] = GetModelSuffix($subtexture_data['belt_tl']['prefix'] . $subtexture_data['belt_tl']['file']);
        $subtexture_data['belt_tl']['suffixFileBackup'] = GetModelSuffix($subtexture_data['belt_tl']['prefix'] . $subtexture_data['belt_tl']['fileBackup']);

        /**
         * Belt (legupper)
         **/
        $subtexture_data['belt_lu'] = array(
                'prefix' => 'item/texturecomponents/leguppertexture/',
                'file'   => GetItemModelData($displayId, 'visual_5'),
                'fileBackup' => GetItemModelData($displayId, 'visual_5'),
                'h' => 0.25,
                'w' => 0.5,
                'x' => 0.5,
                'y' => 0.375
        );
        $subtexture_data['belt_lu']['suffixFile'] = GetModelSuffix($subtexture_data['belt_lu']['prefix'] . $subtexture_data['belt_lu']['file']);
        $subtexture_data['belt_lu']['suffixFileBackup'] = GetModelSuffix($subtexture_data['belt_lu']['prefix'] . $subtexture_data['belt_lu']['fileBackup']);
    }
}
if(!empty($_SESSION["boots"])) {
	$displayId = $_SESSION["boots"];
    if(GetItemModelData($displayId, 'visual_7')) {
        /**
         * Boot (leglower)
         **/
        if (isset($subtexture_data['leg_ll'])) // Prevents boot textures going through robes
        {
            $subtexture_data['boot_ll'] = array(
                'prefix' => 'item/texturecomponents/leglowertexture/',
                'file'   => GetItemModelData($displayId, 'visual_6'),
                'fileBackup' => GetItemModelData($displayId, 'visual_6'),
                'h' => 0.25,
                'w' => 0.5,
                'x' => 0.5,
                'y' => 0.625
            );
            $subtexture_data['boot_ll']['suffixFile'] = GetModelSuffix($subtexture_data['boot_ll']['prefix'] . $subtexture_data['boot_ll']['file']);
            $subtexture_data['boot_ll']['suffixFileBackup'] = GetModelSuffix($subtexture_data['boot_ll']['prefix'] . $subtexture_data['boot_ll']['fileBackup']);
        }

        /**
         * Boot (foot)
         **/
        $subtexture_data['boot_fo'] = array(
            'prefix' => 'item/texturecomponents/foottexture/',
            'file'   => GetItemModelData($displayId, 'visual_7'),
            'fileBackup' => GetItemModelData($displayId, 'visual_7'),
            'h' => 0.125,
            'w' => 0.5,
            'x' => 0.5,
            'y' => 0.875
        );
        $subtexture_data['boot_fo']['suffixFile'] = GetModelSuffix($subtexture_data['boot_fo']['prefix'] . $subtexture_data['boot_fo']['file']);
        $subtexture_data['boot_fo']['suffixFileBackup'] = GetModelSuffix($subtexture_data['boot_fo']['prefix'] . $subtexture_data['boot_fo']['fileBackup']);
    }
}


if(!empty($_SESSION["head"])) {
	$displayId = $_SESSION["head"];
	if(GetItemModelData($displayId, 'modelName_1')) {
		/**
		 * Helm (texture)
		 **/
		$model_data_attachment['helm_texture'] = array(
			'linkPoint' => 11,
			'type' => 'none',
			'modelFile' => 'item/objectcomponents/head/'.GetItemModelData($displayId, 'modelName_1').'_'.$gender.'.m2',
			'skinFile' => 'item/objectcomponents/head/'.GetItemModelData($displayId, 'modelName_1').'_'.$gender.'00.skin',
			'texture' => 'item/objectcomponents/head/'.GetItemModelData($displayId, 'modelTexture_1').'.png',
		);
		if($model_data_attachment['helm_texture']['texture'] == 'item/objectcomponents/head/.png') {
			unset($model_data_attachment['helm_texture']);
		}
	}
}
if(!empty($_SESSION["back"])) {
	$displayId = $_SESSION["back"];
    if(GetItemModelData($displayId, 'modelTexture_1')) {
        /**
         * Back (texture)
         **/
        $model_data_texture['back_texture'] = array(
            'file' => 'item/objectcomponents/cape/'.GetItemModelData($displayId, 'modelTexture_1').'.png'
        );
        if($model_data_texture['back_texture']['file'] == 'item/objectcomponents/cape/.png') {
            unset($model_data_texture['back_texture']);
        }
    }
}
if(!empty($_SESSION["spaulders"])) {
	$displayId = $_SESSION["spaulders"];
    /**
     * Shoulders (texture)
     **/
    if(GetItemModelData($displayId, 'modelName_1')) {
        $model_data_attachment['left_shoulder_texture'] = array(
            'linkPoint' => 6,
            'type' => 'none',
            'modelFile' => 'item/objectcomponents/shoulder/'.GetItemModelData($displayId, 'modelName_1').'.m2',
            'skinFile' => 'item/objectcomponents/shoulder/'.GetItemModelData($displayId, 'modelName_1').'00.skin',   // What does 00 means?
            'texture' => 'item/objectcomponents/shoulder/'.GetItemModelData($displayId, 'modelTexture_1').'.png',
        );
        $model_data_attachment['right_shoulder_texture'] = array(
            'linkPoint' => 5,
            'type' => 'none',
            'modelFile' => 'item/objectcomponents/shoulder/'.GetItemModelData($displayId, 'modelName_2').'.m2',
            'skinFile' => 'item/objectcomponents/shoulder/'.GetItemModelData($displayId, 'modelName_2').'00.skin',   // What does 00 means?
            'texture' => 'item/objectcomponents/shoulder/'.GetItemModelData($displayId, 'modelTexture_2').'.png',
        );
        if($model_data_attachment['left_shoulder_texture']['texture'] == 'item/objectcomponents/shoulder/.png') {
            unset($model_data_attachment['left_shoulder_texture']);
            unset($model_data_attachment['right_shoulder_texture']);
        }
    }
}
if(!empty($_SESSION["mainhand"])) {
	$displayId = $_SESSION["mainhand"];
    if(GetItemModelData($displayId, 'modelName_1')) {
        /**
         * Main hand (texture)
         **/
        $model_data_attachment['main_hand_texture'] = array(
            'linkPoint' => 1,
            'type' => 'melee',
            'modelFile' => 'item/objectcomponents/weapon/'.GetItemModelData($displayId, 'modelName_1').'.m2',
            'skinFile' => 'item/objectcomponents/weapon/'.GetItemModelData($displayId, 'modelName_1').'00.skin',   // What does 00 means?
            'texture' => 'item/objectcomponents/weapon/'.GetItemModelData($displayId, 'modelTexture_1').'.png',
        );
        if($model_data_attachment['main_hand_texture']['texture'] == 'item/objectcomponents/weapon/.png') {
            unset($model_data_attachment['main_hand_texture']);
        }
    }
}
/**
 * Off hand (texture)
 **/
if(!empty($_SESSION["offhand"])) {
	$displayId = $_SESSION["offhand"];
    if(file_exists('item/objectcomponents/shield/'.GetItemModelData($displayId, 'modelName_1').'.m2')) {
    	$model_data_attachment['off_hand_texture'] = array(
	   		'linkPoint' => 0,
	    	'type' => 'melee',
	    	'modelFile' => 'item/objectcomponents/shield/'.GetItemModelData($displayId, 'modelName_1').'.m2',
	    	'skinFile' => 'item/objectcomponents/shield/'.GetItemModelData($displayId, 'modelName_1').'00.skin',   // What does 00 means?
	    	'texture' => 'item/objectcomponents/shield/'.GetItemModelData($displayId, 'modelTexture_1').'.png',
    	);
		if($model_data_attachment['off_hand_texture']['texture'] == 'item/objectcomponents/shield/.png') {
		    unset($model_data_attachment['off_hand_texture']);
		   	$model_data['use_shield'] = false;
		}
	    else {
	    	$model_data['use_shield'] = true;
	    }
    }
    else {
    	$model_data_attachment['off_hand_texture'] = array(
    			'linkPoint' => 2,
    			'type' => 'melee',
    			'modelFile' => 'item/objectcomponents/weapon/'.GetItemModelData($displayId, 'modelName_1').'.m2',
    			'skinFile'  => 'item/objectcomponents/weapon/'.GetItemModelData($displayId, 'modelName_1').'00.skin',   // What does 00 means?
    			'texture'   => 'item/objectcomponents/weapon/'.GetItemModelData($displayId, 'modelTexture_1').'.png',
    	);
    	if($model_data_attachment['off_hand_texture']['texture'] == 'item/objectcomponents/weapon/.png') {
    		unset($model_data_attachment['off_hand_texture']);
    	}
    }
}

header ("Content-Type:text/xml");

$skin_style_padded = sprintf("%02d", $skin_style);
$hair_color_padded = sprintf("%02d", $hair_color);
?><?xml version="1.0" encoding="UTF-8"?>
<page globalSearch="1" lang="en_gb" requestUrl="get-model.xml">
	<tabInfo tab="character" tabGroup="character" tabUrl=""/>
	<character>
		<models>
			<model baseY="1.2" facedY="1.9" id="0" 
				modelFile="character/<?php echo $race; ?>/<?php echo $gender; ?>/<?php echo $race; ?><?php echo $gender; ?>.m2" name="base" scale="1.45" 
				skinFile="character/<?php echo $race; ?>/<?php echo $gender; ?>/<?php echo $race; ?><?php echo $gender; ?>00.skin">
			<components>
				<component n="100"/>
				<component n="200"/>
				<component n="801"/>
				<component n="401"/>
				<component n="601"/>
				<component n="<?php echo $hair_style; ?>"/>
				<component n="901"/>
				<component n="302"/>
				<component n="1600"/>
				<component n="1201"/>
				<component n="702"/>
				<component n="1001"/>
				<component n="1401"/>
				<component n="1501"/>
				<component n="0"/>
				<component n="101"/>
				<component n="301"/>
				<component n="1101"/>
				<component n="502"/>
				<component n="1502"/>
				<?php 
					if(empty($leg_ll))
					{
						echo '<component n="1301"/>';
						echo '<component n="502"/>';
					}else{
						echo '<component n="1302"/>';
						echo '<component n="500"/>';
					}
				?>
				<?php 
					if($race == 10)
					{
						echo '<component n="1702"/>';
					}
				?>
				<?php 
					if($class == 6)
					{
						echo '<component n="1703"/>';
					}
				?>
			</components>
			<textures>
				<texture file="character/<?php echo $race; ?>/<?php echo $gender; ?>/<?php echo $race; ?><?php echo $gender; ?>skin00_<?php echo $skin_style_padded; ?>.png" id="1">
					<?php
						foreach($subtexture_data as $model) {
							if(is_array($model) && !empty($model['file']) && !empty($model['fileBackup'])) {
								echo '<subTexture file="'.$model['prefix'].$model['file']. $model['suffixFile'].'" fileBackup="'.$model['prefix'].$model['fileBackup']. $model['suffixFileBackup'].'"';
								echo ' h="'.$model['h'].'" w="'.$model['w'].'" x="'.$model['x'].'" y="'.$model['y'].'" />';
							}
						}
					?>
				</texture>
				<texture file="character/<?php echo $race; ?>/hair00_<?php echo $hair_color_padded; ?>.png" id="6"/>
			</textures>
			<attachments>
				<?php
					foreach($model_data_attachment as $model) {
						echo '<attachment linkPoint="'.$model['linkPoint'].'" type="'.$model['type'].'" modelFile="'.$model['modelFile'].'"';
						echo ' skinFile="'.$model['skinFile'].'" texture="'.$model['texture'].'" />'; //attachments
					}
				?>
			</attachments>
			<animations>
				<animation id="0" key="stand" weapons="melee"/>
				<animation id="69" key="dance" weapons="no"/>
				<animation id="70" key="laugh" weapons="no"/>
				<animation id="82" key="flex" weapons="no"/>
				<animation id="78" key="chicken" weapons="no"/>
				<animation id="120" key="crouch" weapons="no"/>
				<animation id="60" key="talk" weapons="no"/>
				<animation id="67" key="wave" weapons="no"/>
				<animation id="73" key="rude" weapons="no"/>
				<animation id="76" key="kiss" weapons="no"/>
				<animation id="77" key="cry" weapons="no"/>
				<animation id="84" key="point" weapons="no"/>
				<animation id="113" key="salute" weapons="melee"/>
				<animation id="185" key="yes" weapons="no"/>
				<animation id="186" key="no" weapons="no"/>
				<animation id="195" key="train" weapons="no"/>
				<animation id="51" key="readyspelldirected" weapons="no"/>
				<animation id="52" key="readyspellomni" weapons="no"/>
				<animation id="53" key="castdirected" weapons="no"/>
				<animation id="54" key="castomni" weapons="no"/>
				<animation id="108" key="readythrown" weapons="no"/><animation id="107" key="attackthrown" weapons="no"/>
			</animations>
				</model>
			</models>
		</character>
</page>