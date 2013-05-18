<?php

/**
* Listen for code events
*/
class Akinak_ShowNodeModerators_Listen
{

/**
* Load controller
*
* @param	string			$class
* @param	array			array
*
* @return	void
*/
public static function load_class($class, array &$extend)
{
	if ($class == 'XenForo_ControllerPublic_Forum')
		{
			$extend[] = 'Akinak_ShowNodeModerators_ControllerPublic_Forum';
		}
	if ($class == 'XenForo_Model_Moderator')
	{
		$extend[] = 'Akinak_ShowNodeModerators_Model_Moderator';
	}
	if ($class == 'XenForo_ControllerPublic_Index')
	{
		$extend[] = 'Akinak_ShowNodeModerators_ControllerPublic_Index';
	}

}

}