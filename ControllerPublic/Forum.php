<?php

/**
 * Controller for handling actions on forums.
 *
 * @package XenForo_Forum
 */
class Akinak_ShowNodeModerators_ControllerPublic_Forum extends XFCP_Akinak_ShowNodeModerators_ControllerPublic_Forum
{
	public function actionIndex()
	{

		$responseView = parent::actionIndex();

		if(!($responseView instanceof XenForo_ControllerResponse_View))
		{
			return $responseView;
		}

		if (!isset($responseView->params['forum']))
		{
			return $responseView;
		}

		$forum = $responseView->params['forum'];
		$modModel = XenForo_Model::create('XenForo_Model_Moderator');
		if (XenForo_Application::get('options')->show_in_forum_view)
		{
		$forum['moderators']= $modModel->getNodeModersByForum($forum);
		$forum['mod_count']=count($forum['moderators']);
		$responseView->params['forum'] = $forum;
		}

		if (XenForo_Application::get('options')->show_in_node_list)
		{
		if (isset($responseView->params['nodeList']['nodesGrouped'][$forum['node_id']]))
		{
			$nodesGrouped = $responseView->params['nodeList']['nodesGrouped'][$forum['node_id']];
			foreach ($nodesGrouped as $key=>$node)
			{
				$nodesGrouped[$key]['moderators']=$modModel->getNodeModersByForum($node);
			}
			$responseView->params['nodeList']['nodesGrouped'][$forum['node_id']]=$nodesGrouped;
		}
		}
		return $responseView;
	}
}