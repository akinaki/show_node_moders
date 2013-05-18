<?php

class Akinak_ShowNodeModerators_ControllerPublic_Index extends XFCP_Akinak_ShowNodeModerators_ControllerPublic_Index
{
	public function actionIndex()
	{
		$responseView = parent::actionIndex();
	if (XenForo_Application::get('options')->show_in_node_list)
	{
		$modModel = XenForo_Model::create('XenForo_Model_Moderator');
		if (isset($responseView->params['nodeList']['nodesGrouped']))
		{
		$nodesGrouped = $responseView->params['nodeList']['nodesGrouped'];
		if (is_array($nodesGrouped))
		{
		foreach ($nodesGrouped as $key=>$node)
		{
			if (is_array($node))
			{
			foreach ($node as $key2=>$node2)
			{
		$nodesGrouped[$key][$key2]['moderators']=$modModel->getNodeModersByForum($node2);
			}
			}
		}
		}
		$responseView->params['nodeList']['nodesGrouped']=$nodesGrouped;
		}
	}


	return $responseView;
	}
}