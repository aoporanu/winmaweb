<?php
class FriendsTable extends Doctrine_Table
{
	public static function getInstance() {
		return Doctrine_Core::getTable('Friend');
	}
	
	/**
	 * 
	 * @param Int $id the id of the logged-in user
	 */
	public function getPendingFriends($id) {
		return Doctrine_Query::create()
			->select('f.user_id, f.friends_id, u.username, um.file_name, um.dir, um.ext, um.id')
			->from('Friend f')
			->leftJoin('f.User u ON u.id = f.friends_id')
			->leftJoin('u.UserMedia um ON um.user_id = u.id')
			->where('f.pending = ?', 1)
			->andWhere('f.user_id = ?', $id)
			->groupBy('u.id');
	}
}
