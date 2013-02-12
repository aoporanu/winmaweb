<?php
class MessageTable extends Doctrine_Table
{
	public static function getInstance() {
		return Doctrine_Core::getTable('Message');
	}

	/**
	 * Returns an array with all the messages received by an user
	 * 
	 * @param Int $user_id
	 * @return array
	 */
	public function getSentMessages($user_id) {
		return $this->createQuery()
			->select('m.created, m.body, u.username, m.receiver_id, m.read, m.subject')
			->from('Message m')
			->leftJoin('m.User u on u.id = m.receiver_id')
			->where('m.sender_id = ?', $user_id)
			->andWhere('m.sender_deleted = 0')
			->orderBy('m.created desc');
	}
	
	/**
	 * Return an array with all the messages received by an user.
	 * 
	 * @param Int user_id
	 * @return array
	 */
	public function getReceivedMessages($user_id) {
		return Doctrine_Query::create()
			->select('m.created, m.body, u.username, m.sender_id, m.subject, m.read')
			->from('Message m')
			->leftJoin('m.User u on u.id = m.sender_id')
			->where('m.receiver_id = ?', $user_id)
			->addWhere('m.reader_deleted = ?', '0')
			->orderBy('m.created desc');
	}
	
	/**
	 * Function returns a message by id.
	 * 
	 * @param Int id
	 * @return array
	 */
	public function getMessage($id) {
		return Doctrine_Query::create()
			->select('m.created, m.subject, m.body, m.receiver_id, m.created')
			->from('Message m')
			->where('m.id = ?', $id);
	}

	public function getUnreadMessages($id) {
		return Doctrine_Query::create()
			->select('COUNT(*)')
			->from('Message m')
			->where('m.read = 0')
			->addWhere('m.receiver_id = ?', $id);
	}
} 