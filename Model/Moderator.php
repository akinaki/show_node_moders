<?php

/**
 * Model for moderators.
 *
 * @package XenForo_Moderator
 */
class Akinak_ShowNodeModerators_Model_Moderator extends XFCP_Akinak_ShowNodeModerators_Model_Moderator
{

	public function getNodeModersByForum($forum)
	{
		$cacheItem = 'nodemoders_' . $forum['node_id'];
		$cache = XenForo_Application::getCache();
		$cacheData = ($cache ? $cache->load($cacheItem) : false);
		if ($cacheData !== false)
		{
			$moderators=unserialize($cacheData);
		}
		else
		{
		$conditions = array('content' => array('node', $forum['node_id']));
		$moderators = $this->getContentModerators($conditions);

		$depth = $forum['depth'];
		while ($depth > 1)
		{
		$forum = $this->getModelFromCache('XenForo_Model_Forum')->getForumById($forum['parent_node_id']);
		$conditions = array('content' => array('node', $forum['node_id']));
		$moderators = array_merge($moderators,$this->getContentModerators($conditions));
		$depth = $forum['depth'];
		}

		$conditions = array('content' => array('node', $forum['parent_node_id']));
		$moderators = array_merge($moderators,$this->getContentModerators($conditions));

	if ($cache!=false)
	{
		$cache->save(serialize($moderators), $cacheItem, array());
	}
	}
		return $moderators;
	}
}