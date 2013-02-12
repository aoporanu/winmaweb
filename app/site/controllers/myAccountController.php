<?php

class PagerLayoutWithArrows extends Doctrine_Pager_Layout {

	public function display($options = array(), $return = false) {
		$pager = $this->getPager();
		$str = '';

		//First page
		$this->addMaskReplacement('page', '&laquo;', true);
		$options['page_number'] = $pager->getFirstPage();
		$str .= $this->processPage($options);

		//Previous page
		$this->addMaskReplacement('page', '&lsaquo;', true);
		$options['page_number'] = $pager->getPreviousPage();
		$str .= $this->processPage($options);

		//Pages listing
		$this->removeMaskReplacement('page');
		$str .= parent::display($options, true);

		//Next page
		$this->addMaskReplacement('page', '&rsaquo;', true);
		$options['page_number'] = $pager->getNextPage();
		$str .= $this->processPage($options);

		//Last page
		$this->addMaskReplacement('page', '&raquo;', true);
		$options['page_number'] = $pager->getLastPage();
		$str .= $this->processPage($options);

		//No
		$this->addMaskReplacement('page', 'All pages:', true);
		$str .= '<li class="all">Total: ' . $pager->getNumResults() . '</li>';

		//Possible wish to return value instead of print it on screen
		if ($return) {
			return $str;
		}
		echo $str;
	}

}

class myAccountController extends Cms_Controller {

	public function init() {
		if (!$this->user->isAuthenticated()) {
			$this->redirect('/');
		}
		if ($this->user->hasRole('ADMIN')) {
			$this->redirect('/admin');
		}
	}

	public function memberSectionAction() {
		$this->setTemplate('myaccount/memberSection.twig');
		$user = $this->user->getUser()->toArray();
		$user['created_at'] = date("l, d F Y H:i", strtotime($user['created_at']));
		if ($user['last_login'] != '') {
			$last_login = strtotime(date("l, d F Y H:i", strtotime($user['last_login'])));
			$now = strtotime(date("d F Y H:i"));
			$diff = $now - $last_login;
			if ($diff / 60 < 60) {
				$user['last_login'] = round($diff / 60) . " minutes ago";
			} elseif ($diff / (60 * 60) < 24) {
				$user['last_login'] = round($diff / (60 * 60)) . " hours ago";
			} elseif ($diff / (60 * 60 * 24) < 365) {
				$user['last_login'] = round($diff / (60 * 60 * 24)) . " days ago";
			} else {
				$user['last_login'] = round($diff / (60 * 60 * 24 * 365)) . " years ago";
			}
		}
		$addr = $this->user->getUser()->UserAddress->toArray();
		$address = str_replace(' ', '+', $addr['address']);
		$city = str_replace(' ', '+', $addr['city']);
		$url = "http://maps.googleapis.com/maps/api/geocode/xml?address=" . $address . ",+" . $city . "&sensor=false";
		$media = $this->user->getUser()->UserMedia->toArray();
		$country = Doctrine_Query::create()
						->from('Country')
						->select('name')
						->addWhere('active=?', '1')
						->addWhere('id=?', $addr['country_id'])
						->fetchOne(array(), DOCTRINE::HYDRATE_ARRAY);
		$group = UserTable::getInstance()->getUserGroup($user['id']);
		$productResult = Doctrine_Query::create()
						->select('sop.*, p.name, p.slug, p.endtime, p.starttime, pm.file_name, pm.dir, pm.ext, pp.suplier_price, pp.discount, pp.price, u.username')
						->from('ShowOnProfile sop')
						->where('sop.user_id = ?', $this->user->getUser()->id)
						->andWhere('p.endtime > ?', date('Y-m-d H:i:s'))
						->leftJoin('sop.Product p ON p.id = sop.product_id')
						->leftJoin('p.ProductMedia pm ON p.id = pm.product_id')
						->leftJoin('p.ProductPrice pp ON p.id = pp.product_id')
						->leftJoin('sop.User u ON u.id = sop.user_id')
						->execute(array(), Doctrine::HYDRATE_ARRAY);
		if ($this->request->getPost()) {
			$post = $this->request->getPost();
			$user = $this->user->getUser();
			$user->my_status = $post['my_status'];
			$user->save();
			$this->redirect('/my-account');
		}
		// get the xml from googlemaps
		$result = simplexml_load_file($url);
		if ($result->status == "OK") {
			$lat = $result->result->geometry->location->lat;
			$lng = $result->result->geometry->location->lng;
		}
		return array('user' => $user, 'addr' => $addr, 'country' => $country['name'], 'image' => $media[0], 'group' => $group, 'products' => $productResult, 'date' => date('Y-m-d H:i:s'), 'lat' => $lat, 'lng' => $lng);
	}

	public function myBoughtDealsAction() {
		$this->setTemplate('myaccount/myBoughtDeals.twig');
		$page = $this->getParam('page');
		$query = TransactionTable::getInstance()->getSentTransactions(array('sender_id' => $this->user->getUser()->get('id')));
		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/my-bought-deals?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
		$transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$transactionType = array_flip(TransactionTable::$type);
		$transactionType[8] = 'Verification & Test Transaction';
		$transactionType[1] = 'Deal Purchase';
		return array(
				'transactions' => $transactions,
				'transactionType' => $transactionType,
				'pagination' => $pagerLayout->display(array(), true)
		);
	}

	/* function myPendingOffersAction() {
	  $this->setTemplate('myaccount/pendingOffers.twig');
	  $page = $this->getParam('page');
	  $query = Doctrine_Query::create()
	  ->select('p.*, pm.*, pp.*')
	  ->from('Product p')
	  ->leftJoin('ProductMedia pm ON pm.product_id = p.id')
	  ->leftJoin('ProductPrices pp ON pp.product_id = p.id')
	  ->where('p.status = ');
	  $pagerLayout = new PagerLayoutWithArrows(
	  new Doctrine_Pager(
	  $query,
	  $page,
	  10),
	  new Doctrine_Pager_Range_Sliding(array('chunk' => 5)),
	  '/my-account/'
	  );
	  } */

	/* function sendMessageAction() {
	  $this->setTemplate('myaccount/sendMessage.twig');
	  $user = $this->user->getUser()->id;
	  $form = new Zend_Form();
	  $users = $form->createElement('text', 'username');
	  $users->addValidator('NotEmpty', true, array('messages'=>'Cannot be empty'));
	  $body = $form->createElement('textarea', 'body');
	  $form->addElement($users)->addElement($body);
	  if($this->request->getPost()) {
	  if($form->isValid($this->request->getPost())) :
	  // Get recipient id from his username
	  $receiver_id = Doctrine_Query::create()
	  ->select('u.id')
	  ->from('User u')
	  ->where('u.username =?', $_POST['users'])
	  ->execute();
	  // insert a new message with the logged in-user's id
	  // and the id we get from the username we pass as a param.
	  $message = new Message();
	  $message->sender_id = $user;
	  $message->receiver_id = $receiver_id[0]->id;
	  $message->body = $_POST['body'];
	  $message->created = date('Y-m-d H:i:s');
	  $message->save();
	  $success = true;
	  endif;
	  }

	  // Get all usernames to populate the list on the twig template
	  $usernames = Doctrine_Query::create()
	  ->select('u.username')
	  ->from('User u')->execute(array(), Doctrine::HYDRATE_ARRAY);
	  return array(
	  'form'	=> array(
	  'values' 	=> $form->getValues(),
	  'errors' 	=> $form->getMessages(),
	  'success' 	=> (isset($success) ? $success: false)
	  ),
	  'recipient_id' 	=> $receiver_id,
	  'users'			=> $usernames
	  );
	  } */

	function getMessageByIdAction() {
		$this->setTemplate('myaccount/getMessageById.twig');
		$id = $this->getParam('id');
		if ($id) {
			$message = Doctrine_Query::create()
							->select('m.body, m.created, m.subject, u.username')
							->from('Message m')
							->leftJoin('m.User u ON u.id = m.receiver_id')
							->where('m.id = ?', $id)
							->execute(array(), Doctrine::HYDRATE_ARRAY);
			$q = Doctrine_Query::create()
							->update('Message')
							->addWhere('id = ?', $id)
							->set('`read`', '1')
							->execute();
			return array('message' => $message);
		} else {
			return array('message' => 'Couldn\'t find the message with the specified ID.');
		}
	}

	function getUnreadMessagesAction() {
		$this->setTemplate('myaccount/getUnreadMessages.twig');
		$id = $this->user->getUser()->id;
		if ($id) {
			$message = Doctrine_Query::create()
							->select('m.id')
							->from('Message m')
							->where('m.receiver_id = ?', $id)
							->andWhere('m.read = 0')
							->execute(array(), Doctrine::HYDRATE_ARRAY);
			return(array('messages' => $message));
		}
	}

	/**
	 * Use only if you want to permanently delete a message from the database.
	 * 
	 * @see senderDeleteMessageAction,
	 * @see receiverDeleteMessageAction for inbos delete
	 */
	function deleteMessageAction() {
		$this->setTemplate('myaccount/deleteMessage.twig');
		$id = $this->getParam('id');
		if ($id) {
			Doctrine_Query::create()
							->update('Message')
							->addWhere('id = ?', $id)
							->set('`deleted`', '1')
							->execute();
			return array('message' => 'Message ' . $id . ' was deleted.');
		} else {
			return array('Couldn\'t delete message ' . $id);
		}
	}

	/**
	 * Mark the message as deleted from the user's sent message box
	 * 
	 */
	function senderDeleteMessageAction() {
		$this->setTemplate('myaccount/senderDeleteMessage.twig');
		$id = $this->getParam('id');
		if ($id) {
			Doctrine_Query::create()
							->update('Message')
							->addWhere('id = ?', $id)
							->set('sender_deleted', '1')
							->execute();
			return array('message' => 'Message ' . $id . ' has been deleted from your sent messages box');
		} else {
			return array('message' => 'Couldn\'t delete message ' . $id . ' from your sent messages box');
		}
	}

	/**
	 * Mark the message as deleted from the inbox. User who sent the message will still be able to see it
	 * 
	 */
	function receiverDeleteMessageAction() {
		$this->setTemplate('myaccount/receiverDeleteMessage.twig');
		$id = $this->getParam('id');
		if ($id) {
			Doctrine_Query::create()
							->update('Message')
							->addWhere('id = ?', $id)
							->set('reader_deleted', '1')
							->execute();
			return array('message' => 'Message ' . $id . ' was deleted from your inbox.');
		} else {
			return array('message' => 'Couldn\'t delete message ' . $id . ' from your inbox.');
		}
	}

	function myMessengerAction() {
		$this->setTemplate('myaccount/myMessenger.twig');
		$user = $this->user->getUser()->id;
		$form = new Zend_Form();
		$users = $form->createElement('text', 'users');
		$users->setRequired(true);
		$subject = $form->createElement('text', 'subject');
		$body = $form->createElement('textarea', 'body');
		$body->setRequired(true);
		$form->addElement($users)->addElement($subject)->addElement($body);
		if ($this->request->isPost()) {
			if ($form->isValid($this->request->getPost())) {
				// Get recipient id from his username
				$receiver_id = Doctrine_Query::create()
								->select('u.id, u.email')
								->from('User u')
								->where('u.username =?', $_POST['users'])
								->execute();
				// insert a new message with the logged-in user's id
				// and the id we get from the username we pass as a param.
				if (!$receiver_id[0]->id) {
					$success = false;
					return array('message' => 'Wrong username or unexisting user.');
				}
				$approveLink = "http://winmaweb.com/my-account/my-received-messages";
				$message = new Message();
				$message->sender_id = $user;
				$message->receiver_id = $receiver_id[0]->id;
				$message->subject = $_POST['subject'];
				$message->body = $_POST['body'];
				$message->created = date('Y-m-d H:i:s');
				$message->save();
				$contactMessage = "You have received a new message from one of the users of WinMaWeb.<br />To read it, go to your <br /><br />
                        <a href=\"$approveLink\">Inbox</a>";
				require_once 'Swift/swift_required.php';
				$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
				$mailer = Swift_Mailer::newInstance($transport);
				//Create a message
				$message = Swift_Message::newInstance('New message received on WinMaWeb')
								->setFrom(array('office@winmaweb.com' => 'winmaweb'))
								->setBody($contactMessage, 'text/html');
				$message->setTo(array($tsEmail));
				$mailer->send($message);
				$form->reset();
				$success = true;
			} else {
				$success = false;
				$form->addError('You must fill in all the fields.');
			}
		}
		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'success' => (isset($success) ? $success : false)
				),
				'recipient_id' => $receiver_id
		);
	}

	function receivedMessagesAction() {
		$is_ajax = $this->request->getParam('isajaxrequest');

		if (!$is_ajax) {
			$is_ajax = $this->request->isXmlHttpRequest();
		}
		$this->setTemplate('myaccount/messenger/received-messages.twig');
		$page = $this->getParam('page');
		$query = MessageTable::getInstance()->getReceivedMessages($this->user->getUser()->id);
		if (count($query) > 0) {
			$pagerLayout = new PagerLayoutWithArrows(
											new Doctrine_Pager(
															$query, $page, 10
											),
											new Doctrine_Pager_Range_Sliding(array('chunk' => 5)),
											'/my-account/my-received-messages?page={%page_number}'
			);
			$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
			$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
			$messages = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
			return array(
					'messages' => $messages,
					'pagination' => $pagerLayout->display(array(), true)
			);
		} else {
			return(array());
		}
	}

	function sentMessagesAction() {
		$is_ajax = $this->request->getParam('isajaxrequest');

		if (!$is_ajax) {
			$is_ajax = $this->request->isXmlHttpRequest();
		}
		$this->setTemplate('myaccount/messenger/sent-messages.twig');
		$page = $this->getParam('page');
		$query = MessageTable::getInstance()->getSentMessages($this->user->getUser()->id);
		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query, $page, 10
										),
										new Doctrine_Pager_Range_Sliding(array('chunk' => 5)),
										'/my-account/sent-messages?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page%}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
		$messages = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		return array(
				'messages' => $messages,
				'pagination' => $pagerLayout->display(array(), true)
		);
	}

	function sendMessageAction() {
		$this->autocompleteUserAction();
		$this->setTemplate('myaccount/messenger/send-message.twig');
		$user = $this->user->getUser()->id;
		$form = new Zend_Form();
		$users = $form->createElement('text', 'users');
		$users->setRequired(true);
		$subject = $form->createElement('text', 'subject');
		$body = $form->createElement('textarea', 'body');
		$body->setRequired(true);
		$form->addElement($users)->addElement($subject)->addElement($body);
		if ($this->request->isPost()) {
			if ($form->isValid($this->request->getPost())) {
				// Get recipient id from his username
				$receiver_id = Doctrine_Query::create()
								->select('u.id, u.email')
								->from('User u')
								->where('u.username =?', $_POST['users'])
								->execute();
				$toEmail = $receiver_id['0']->email;
				// insert a new message with the logged-in user's id
				// and the id we get from the username we pass as a param.
				if (!$receiver_id[0]->id) {
					$success = false;
					return array('message' => 'Wrong username or unexisting user.');
				}
				$approveLink = "http://winmaweb.com/my-account/my-received-messages";
				$message = new Message();
				$message->sender_id = $user;
				$message->receiver_id = $receiver_id[0]->id;
				$message->subject = $_POST['subject'];
				$message->body = $_POST['body'];
				$message->created = date('Y-m-d H:i:s');
				$message->save();
				$contactMessage = "You have received a new message from one of the users of WinMaWeb.<br />To read it, go to your <br /><br />
                        <a href=\"$approveLink\">Inbox</a>";
				require_once 'Swift/swift_required.php';
				$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
				$mailer = Swift_Mailer::newInstance($transport);
				//Create a message
				$message = Swift_Message::newInstance('New message received on WinMaWeb')
								->setFrom(array('office@winmaweb.com' => 'winmaweb'))
								->setBody($contactMessage, 'text/html');
				$message->setTo(array($toEmail));
				$mailer->send($message);
				$form->reset();
				$success = true;
			} else {
				$success = false;
				$form->addError('You must fill in all the fields.');
			}
		}
		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'success' => (isset($success) ? $success : false)
				),
				'recipient_id' => $receiver_id
		);
	}

	/* function autocompleteUserAction() {
	  $this->setTemplate('myaccount/autocompleteUser.twig');
	  $user = Doctrine_Query::create()
	  ->select('u.username')
	  ->from('User u')
	  ->execute(array(), Doctrine::HYDRATE_ARRAY);
	  foreach($user as $u) {
	  unset($u['id']);
	  $users[] = $u['username'];
	  }
	  file_put_contents('json.json', json_encode($users));
	  return array(
	  'user' => json_encode($users)
	  );
	  } */

	function autocompleteUserAction() {
		$this->setTemplate('myaccount/autocompleteUser.twig');
		$term = $this->request->getParam('q');
		$user = Doctrine_Query::create()
						->select('u.username')
						->from('User u')
						->where('u.username LIKE ?', $term . '%')
						->execute(array(), Doctrine::HYDRATE_ARRAY);
		return array('user' => $user);
	}

	function mySentMessagesAction() {
		$is_ajax = $this->request->getParam('isajaxrequest');

		if (!$is_ajax) {
			$is_ajax = $this->request->isXmlHttpRequest();
		}
		$this->setTemplate('myaccount/sentMessages.twig');
		$page = $this->getParam('page');
		$query = MessageTable::getInstance()->getSentMessages($this->user->getUser()->id);
		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query, $page, 10
										),
										new Doctrine_Pager_Range_Sliding(array('chunk' => 5)),
										'/my-account/my-sent-messages?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page%}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
		$messages = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		return array(
				'messages' => $messages,
				'pagination' => $pagerLayout->display(array(), true)
		);
	}

	function myFriendsAction() {
		$this->setTemplate('myaccount/myFriends.twig');
		$user_id = $this->user->getUser()->id;
		$username = $this->user->getUser()->username;
		$form = new Zend_Form();
		$user = $form->createElement('text', 'users');
		$user->setRequired(true);
		if ($this->request->isPost()) {
			if ($form->isValid($this->request->getPost())) {
				$u_id = Doctrine_Query::create()
								->select('u.id, u.email')
								->from('User u')
								->where('u.username =?', $_POST['users'])
								->execute();
				if (!$u_id[0]->id) {
					$form->addError('Wrong or unexisting username.');
					$success = false;
					return array('message' => 'Wrong or unexisting username.');
				}
				if ($u_id[0]->email) {
					$email = $u_id[0]->email;
				}
				$query1 = Doctrine_Query::create()
								->select('f.user_id, f.friends_id')
								->from('Friend f')
								->where('f.user_id = ?', $user_id)
								->addWhere('f.friends_id = ?', $u_id[0]->id)
								->execute(array(), Doctrine::HYDRATE_ARRAY);
				/*
				 * If we have more than one friendship request to the same user return with the following message.
				 */
				if (count($query1) < 1) {
					$approveLink = "http://winmaweb.com/my-account/my-friendship-requests";
					$friend = new Friend();
					$friend->user_id = $user_id;
					$friend->pending = 1;
					$friend->friends_id = $u_id[0]->id;
					$friend->created_at = date('Y-m-d H:i:s');
					$friend->save();
					$contactMessage = "You have received a friendship request from one of the users of WinMaWeb.<br />To approve or deny it, go to your <br /><br />
                        <a href=\"$approveLink\">My Friendship Requests</a>";
					require_once 'Swift/swift_required.php';
					$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
					$mailer = Swift_Mailer::newInstance($transport);
					//Create a message
					$message = Swift_Message::newInstance('New friendship request on WinMaWeb')
									->setFrom(array('office@winmaweb.com' => 'winmaweb'))
									->setBody($contactMessage, 'text/html');
					$message->setTo(array($email));
					$mailer->send($message);
					$form->reset();
					$success = true;
				} else {
					$success = false;
					$form->addError('You already sent a friend invite to the selected user.');
				}
			} else {
				$success = false;
				$form->addError('There was an error processing your request.');
			}
		}
		$errors = $form->getMessages();
		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'success' => (isset($success) ? $success : false)
				)
		);
	}

	function removePendingRequestAction() {
		$is_ajax = $this->request->getParam('isajaxrequest');

		if (!$is_ajax) {
			$is_ajax = $this->request->isXmlHttpRequest();
		}
		$this->setTemplate('myaccount/removePendingFriendRequest.twig');
		$id = $this->getParam('id');
		$user_id = $this->user->getUser()->id;
		if ($id) {
			$query = Doctrine_Query::create()
							->delete()
							->from('Friend f')
							->where('f.id = ?', $id)
							->execute();
			if ($query) {
				return array('message' => 'Your friend was succesfully removed');
			} else {
				return array('message' => 'Didn\'t remove your friend.' . $id);
			}
		}
	}

	function approveFriendRequestAction() {
		$this->setTemplate('myaccount/approveFriendRequest.twig');
		$id = $this->getParam('id');
		if ($id) {
			$friend_request = Doctrine_Query::create()
							->select('f.user_id, f.friends_id')
							->from('Friend f')
							->where('f.id = ?', $id)
							->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
			$friends = new Friend();
			$friends->user_id = $friend_request['friends_id'];
			$friends->pending = '0';
			$friends->friends_id = $friend_request['user_id'];
			$friends->created_at = date('Y-m-d H:i:s');
			$friends->approved_at = date('Y-m-d H:i:s');
			$friends->save();
			$conn = Doctrine_manager::getInstance()->getCurrentConnection();
			$query = 'UPDATE friends f SET f.pending = 0, f.approved_at = now() WHERE f.id = :id';
			//echo $query;
			$result = $conn->execute($query, array('id' => $id));
			if ($result) {
				return array('message' => 'Friend request ' . $id . ' was marked as approved at ' . date('Y-m-d'));
			} else {
				return array('message' => 'Friend request ' . $id . ' couldn\'t be approved.');
			}
		}
	}

//	function requestFriendshipFormAction() {
//		$this->setTemplate('myaccount/requestFriendshipForm.twig');
//		$user_id = $this->user->getUser()->id;
//		$form = new Zend_Form();
//		$user = $form->createElement('text', 'users');
//		$user->setRequired(true);
//		if($this->request->isPost()) {
//			if($form->isValid($this->request->getPost())) {
//                $friend = new Friend();
//				$friend->user_id = $user_id;
//				$friend->pending = 1;
//				$friend->friends_id = $id;
//				$friend->created_at = date('Y-m-d H:i:s');
//				$friend->save();
//				$form->reset();
//				$success = true;
//			} else {
//				$success = false;
//				$form->addError('There was an error processing your request.');
//			}
//		}
//		return array(
//			'form'	=> array(
//				'values' 	=> $form->getValues(),
//				'errors' 	=> $form->getMessages(),
//				'success' 	=> (isset($success) ? $success: false)
//			)
//		);
//	}

	/**
	 * This will be added as a href to be executed on clicking a link in the user's profile.
	 * 
	 * @param int $id
	 */
	function requestFriendshipAction() {
		$this->setTemplate('myaccount/requestFriendship.twig');
		$id = $this->getParam('id');
		$user_id = $this->user->getUser()->id;

		if ($id) {
			if (!$this->user->isAuthenticated()) {
				return array('message' => 'Please login or reguest a membership');
			}
			$query = Doctrine_Query::create()
							->select('u.username, u.email')
							->from('User u')
							->where('u.id = ?', $id)
							->execute();
			$username = $query[0]->username;
			$email = $query[0]->email;
			$query1 = Doctrine_Query::create()
							->select('f.user_id, f.friends_id')
							->from('Friend f')
							->where('f.user_id = ?', $user_id)
							->addWhere('f.friends_id = ?', $id)
							->execute(array(), Doctrine::HYDRATE_ARRAY);
			/*
			 * If we have more than one friendship request to the same user return with the following message.
			 */
			if (count($query1) == 1) {
				return array('message' => 'You already sent a friendship request to this user.');
				echo 'Am iesit';
			}
			$friend = new Friend();
			$friend->user_id = $user_id;
			$friend->pending = 1;
			$friend->friends_id = $id;
			$friend->created_at = date('Y-m-d H:i:s');
			$approveLink = "http://winmaweb.com/my-account/my-friendship-requests";
			$contactMessage = "You have received a friendship request from one of the users of WinMaWeb.<br />To approve or deny it, go to your <br /><br />
                        <a href=\"$approveLink\">My Friendship Requests</a>";
			require_once 'Swift/swift_required.php';
			$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
			$mailer = Swift_Mailer::newInstance($transport);
			//Create a message
			$message = Swift_Message::newInstance('New friendship request on WinMaWeb')
							->setFrom(array('office@winmaweb.com' => 'winmaweb'))
							->setBody($contactMessage, 'text/html');
			$message->setTo(array($tsEmail));
			$mailer->send($message);
			$friend->save();
			//$mail = new mail($email, 'WinMaWeb requires your attention', 'You received a new friendship request from ' . $username . '. You can visit your <a href="http://winmaweb.com/my-account/list-pending-friends/">pending friends</a> panel to accept or deny this request.');
			return array('message' => 'Your friend request to ' . $username . ' was submitted for approval.');
		} else {
			return array('message' => 'Your friend request to ' . $username . ' can\'t be submitted.');
		}
	}

	function myFriendshipRequestsAction() {
		$this->setTemplate('myaccount/myFriendshipRequests.twig');
		$id = $this->user->getUser()->id;
		$page = $this->getParam('page');
		if ($id) {
			$query = Doctrine_Query::create()
							->select('f.*, u.username, um.file_name, um.ext, um.dir, um.id')
							->from('Friend f')
							->leftJoin('f.User u ON u.id = f.user_id')
							->leftJoin('u.UserMedia um ON um.user_id = u.id')
							->where('f.friends_id = ?', $id)
							->andWhere('f.pending = 1')
							->groupBy('u.id');
			$pagerLayout = new PagerLayoutWithArrows(
											new Doctrine_Pager(
															$query, $page, 10
											),
											new Doctrine_Pager_Range_Sliding(array('chunk' => 5)),
											'my-account/my-friendship-requests?page={%page_number}'
			);
			$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
			$requests = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
			return array('friends' => $requests, 'pagination' => $pagerLayout->display(array(), true));
		}
	}

	function newFriendshipRequestsAction() {
		$this->setTemplate('myaccount/newFriendshipRequests.twig');
		$id = $this->user->getUser()->id;
		$friends = Doctrine_Query::create()
						->select('f.id')
						->from('Friend f')
						->where('f.friends_id = ?', $id)
						->andWhere('f.pending = 1')
						->execute(array(), Doctrine::HYDRATE_ARRAY);
		return array('friends' => $friends);
	}

	function removeFriendAction() {
		$this->setTemplate('myaccount/removeFriend.twig');
		$id = $this->getParam('id');
		$friend_request = Doctrine_Query::create()
						->select('f.user_id, f.friends_id')
						->from('Friend f')
						->where('f.id = ?', $id)
						->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
		$query = Doctrine_Query::create()
						->delete('Friend')
						->addWhere('user_id = ?', $friend_request['friends_id'])
						->addWhere('friends_id = ?', $friend_request['user_id'])
						->execute();
		$query = Doctrine_Query::create()
						->delete('Friend')
						->addWhere('id = ?', $id)
						->execute();
		if ($query) {
			return array('message' => 'Your friend was succesfully removed.');
		} else {
			return array('message' => 'Could not delete friend request ' . $id);
		}
	}

	function listFriendsAction() {
		$this->setTemplate('myaccount/listFriends.twig');
		$page = $this->getParam('page');
		$id = $this->user->getUser()->id;
		$query = Doctrine_Query::create()
						->select('f.id, f.user_id, f.pending, f.friends_id, u.username, um.file_name, um.dir, um.ext, um.id')
						->from('Friend f')
						->leftJoin('f.User u on u.id = f.friends_id')
						->leftJoin('u.UserMedia um on um.user_id = u.id')
						->groupBy('u.id')
						->where('f.user_id = ?', $id)
						->addWhere('f.pending = 0');
		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query, $page, 10
										),
										new Doctrine_Pager_Range_Sliding(array('chunk' => 5)),
										'my-account/list-friends?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$friends = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$users = Doctrine_Query::create()
						->select('*')
						->from('User u')
						->where('u.id = ?', $id)
						->execute(array(), Doctrine::HYDRATE_ARRAY);
		return(array('friends' => $friends, 'user' => $users, 'pagination' => $pagerLayout->display(array(), true)));
	}

	function listPendingFriendsAction() {
		$this->setTemplate('myaccount/listPendingFriends.twig');
		$page = $this->getParam('page');
		$id = $this->user->getUser()->id;
		$query = Doctrine_Query::create()
						->select('f.user_id, f.friends_id, u.username, um.file_name, um.dir, um.ext, um.id')
						->from('Friend f')
						->leftJoin('f.User u ON u.id = f.friends_id')
						->leftJoin('u.UserMedia um ON um.user_id = u.id')
						->where('f.pending = ?', 1)
						->andWhere('f.user_id = ?', $id)
						->groupBy('u.id');
		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager($query, $page, 10),
										new Doctrine_Pager_Range_Sliding(array('chunk' => 5)),
										'my-account/list-pending-friends?page={%page-number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
		$pending = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		return array(
				'friends' => $pending,
				'pagination' => $pagerLayout->display(array(), true)
		);
	}

	public function myVouchersAction() {
		$this->setTemplate('myaccount/myVouchers.twig');
		$page = $this->getParam('page');
		$query = CouponTable::getInstance()->getUserCoupons(array('owner_id' => $this->user->getUser()->get('id')));
		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/my-vouchers?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
		$transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$transactionType = array_flip(TransactionTable::$type);
		$transactionType[8] = 'Verification & Test Transaction';
		$transactionType[1] = 'Deal Purchase';
		return array(
				'transactions' => $transactions,
				'transactionType' => $transactionType,
				'pagination' => $pagerLayout->display(array(), true)
		);
	}

	public function receivedGiftVouchersAction() {
		$this->setTemplate('myaccount/receivedGiftVouchers.twig');
		$page = $this->getParam('page');
		$query = CouponTable::getInstance()->getReceivedGiftCoupons(array('friend_id' => $this->user->getUser()->get('id')));
		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/received-gift-vouchers?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
		$transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$transactionType = array_flip(TransactionTable::$type);
		$transactionType[8] = 'Verification & Test Transaction';
		$transactionType[1] = 'Deal Purchase';
		return array(
				'transactions' => $transactions,
				'transactionType' => $transactionType,
				'pagination' => $pagerLayout->display(array(), true)
		);
	}

	public function myWMWCreditsAction() {
		$this->setTemplate('myaccount/myWMWCredits.twig');
		$page = $this->getParam('page');
		$query = TransactionTable::getInstance()->getNetworkTransactions(array('receiver_id' => $this->user->getUser()->get('id')));
		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/my-wmw-credits?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
		$transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$transactionType = array_flip(TransactionTable::$type);
		$transactionType[8] = 'Verification & Test Transaction';
		$transactionType[1] = 'Deal Purchase';
		return array(
				'transactions' => $transactions,
				'transactionType' => $transactionType,
				'pagination' => $pagerLayout->display(array(), true)
		);
	}

	public function myMoneyAction() {
		$this->setTemplate('myaccount/myMoney.twig');
		$page = $this->getParam('page');
		$spendFee = 0;
		$transfer = 0;
		$spentT = 0;
		if ($this->user->getUser()->get('virtual_wallet') > 0) {
			$spendFee = SiteConfigTable::getInstance()->getSpendFee();
			$spendFee = (int) $spendFee['config_value'];

			//now lets see how much this user spent :x
			$lastTransfer = TransactionTable::getInstance()->getLastTransfer(array('receiver_id' => $this->user->getUser()->get('id')));
			if ($lastTransfer['id']) {
				$spent = TransactionTable::getInstance()->getSpentValue(array('sender_id' => $this->user->getUser()->get('id'),
						'from_date' => $lastTransfer['created_at']));
				if ($spent['spent']) {
					$spentT = -$spent['spent'];
				}
			} else {
				// noone yet
				$spent = TransactionTable::getInstance()->getSpentValue(array('sender_id' => $this->user->getUser()->get('id')));
				if ($spent['spent']) {
					$spentT = -$spent['spent'];
				}
			}
			$ac = $this->getParam('ac');
			$user = $this->user->getUser();

			$howMuch = ceil($user->virtual_wallet * $spendFee / 100);
			if ($howMuch <= $spentT) {
				$transfer = 1;
				if ($ac === 'transfer') {
					$conn = Doctrine_manager::getInstance()->getCurrentConnection();
					$conn->beginTransaction();
					try {
						$user->wallet = $user->wallet + $user->virtual_wallet;
						$vw = $user->virtual_wallet;
						$user->virtual_wallet = 0;
						$user->save();
						$type = TransactionTable::$type;

						$tran = new Transaction();
						$tran->parent_id = 0;
						$tran->transaction_type = $type['transfer-to-wallet'];
						$tran->sender_id = $this->user->getUser()->get('id');
						$tran->receiver_id = $this->user->getUser()->get('id');

						$tran->full_payment = $vw;
						$tran->save();
						$conn->commit();
					} catch (Doctrine_Exception $e) {
						$conn->rollback();
					}
				}
			}
		}
		$query = TransactionTable::getInstance()->getWalletTransactions(array('receiver_id' => $this->user->getUser()->get('id')));
		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/my-money?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
		$transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$transactionType = array_flip(TransactionTable::$type);
		return array(
				'transactions' => $transactions,
				'pagination' => $pagerLayout->display(array(), true),
				'transactionType' => $transactionType,
				'spendFee' => $spendFee,
				'transfer' => $transfer,
				'spent' => $spentT,
				'howmuch' => $howMuch
		);
	}

	public function myNetworkAction() {
		$this->setTemplate('myaccount/myNetwork.twig');
		$userTable = UserTable::getInstance();
		$descendents = $userTable->getDescendentsNumbers(array('user_id' => $this->user->getUser()->get('id')), 5);
		return array('descendents' => $descendents);
	}

	public function viewMyNetworkAction() {
		$this->setTemplate('myaccount/myReferralsVisual.twig');
		$userTable = UserTable::getInstance();
		$ascendents = $userTable->getAscendents(array('user_id' => $this->user->getUser()->get('id')), 4);
		$descendents = $userTable->getDescendents(array('user_id' => $this->user->getUser()->get('id')), 1);
		$asc_desc = $userTable->getAscDesc(array('user_id' => $this->user->getUser()->get('id')), 4);
		return array(
				'ascendents' => $ascendents,
				'descendents' => $descendents,
				'asc_desc' => $asc_desc
		);
	}

	public function buildMyNetworkAction() {
		$this->setTemplate('myaccount/buildMyNetwork.twig');

		$links = Doctrine_Query::create()
						->select('*')
						->from('MyNetwork')
						->execute(array(), Doctrine::HYDRATE_ARRAY);
		return array('_server' => $_SERVER, 'links' => $links);
	}

	public function soldVouchersAction() {
		$this->setTemplate('myaccount/soldVouchers.twig');

		$page = $this->getParam('page');
		$format = $this->getParam('format');
		$query = CouponTable::getInstance()->getAllVouchers(array('receiver_id' => $this->user->getUser()->get('id')));

		if ($format == 'csv') {
			$fisier = ROOT_PATH . '/mda.csv';
			$date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			if ($fp = fopen($fisier, 'w')) {
				fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Number\n");
				foreach ($date as $valori) {
					//fputcsv($fp, $valori['email'], ',', '"');
					fputs($fp, $valori['created_at'] . "," . $valori['expire_at'] . "," . $valori['name'] . "," . $valori['Transaction']['Sender']['first_name'] . $valori['Transaction']['Sender']['last_name'] . ($valori['Friend'] ? '(For Friend: ' . $valori['Friend']['first_name'] . ' ' . $valori['Friend']['last_name'] . ')' : '') . "," . $valori['price'] . "," . $valori['code2'] . "\n");
				}

				fclose($fp);
			}
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"sold_vouchers.csv\"");

			// citire fisier in string si afisare
			echo file_get_contents($fisier);

			die;
		}

		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/sold-vouchers?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

		$transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$transactionType = array_flip(TransactionTable::$type);
		return array(
				'transactions' => $transactions,
				'pagination' => $pagerLayout->display(array(), true),
				'transactionType' => $transactionType,
		);
	}

	public function cashInVouchersAction() {
		$this->setTemplate('myaccount/cashInVouchers.twig');

		$page = $this->getParam('page');
		$form = new Zend_Form();
		$query = CouponTable::getInstance()->getRedeemedCoupons(array('owner_id' => $this->user->getUser()->get('id')));
		$format = $this->getParam('format');
		if ($format == 'csv') {
			$fisier = ROOT_PATH . '/mda.csv';
			$date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			if ($fp = fopen($fisier, 'w')) {
				fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Code\n");
				foreach ($date as $valori) {
					//fputcsv($fp, $valori['email'], ',', '"');
					fputs($fp, $valori['created_at'] . "," . $valori['expire_at'] . "," . $valori['name'] . "," . $valori['Transaction']['Sender']['first_name'] . $valori['Transaction']['Sender']['last_name'] . ($valori['Friend'] ? '(For Friend: ' . $valori['Friend']['first_name'] . ' ' . $valori['Friend']['last_name'] . ')' : '') . "," . $valori['price'] . "," . $valori['code'] . "\n");
				}

				fclose($fp);
			}
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"cash_in_vouchers.csv\"");

			// citire fisier in string si afisare
			echo file_get_contents($fisier);

			die;
		}
		$couponCode = $form->createElement('text', 'coupon_code');
		$couponCode->setRequired(true);

		$form->addElement($couponCode);

		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
				$u = $this->user->getUser();
				if ($u->is_do) {
					$coupon = CouponTable::getInstance()->findOneBy('code', trim($form->getValue('coupon_code')));
					if ($coupon->id) {
						//if ($coupon->owner_id == $this->user->getUser()->get('id')) {
						//    $couponCode->addError('You can not retrive your own coupons');
						//    $form->addElement($couponCode);
						//} else {
						if ($coupon->status == CouponTable::$status['verified']) {
							$couponCode->addError('This Voucher has already been cashed in and the credit has already been transferred to your My Wallet.');
							$form->addElement($couponCode);
						} else {
							$receiver = TransactionTable::getInstance()->createQuery()
											->addWhere('id = ?', $coupon->transaction_id)
											->fetchOne();
							;
							if ($receiver->receiver_id == $this->user->getUser()->get('id')) {
								//now lets add
								$conn = Doctrine_manager::getInstance()->getCurrentConnection();
								$conn->beginTransaction();
								try {
									if ($coupon->status == CouponTable::$status['stand-by']) {
										throw new Exception('No such coupon');
									}
									$delay = SiteConfigTable::getInstance()->getPayoutDelay();
									$delay = $delay['config_value'];
									$mda = explode(' ', $coupon->created_at);
									$date1 = $mda[0];
									$date2 = date('Y-m-d');
									$diff = abs(strtotime($date2) - strtotime($date1));
									$days = floor(($diff) / (60 * 60 * 24));
									if ($days < $delay) {
										throw new Exception('You need to wait ' . ($delay - $days) . ' days until you can cash in the voucher');
									}
									//first lets put on coupon the retriver id
									$coupon->verifier_id = $this->user->getUser()->get('id');
									$coupon->status = CouponTable::$status['verified'];
									$coupon->save();
									//now lets create the transactions, first lets get the do share transaction
									$doTran = TransactionTable::getInstance()
													->getDoShareTransaction(array('parent_id' => $coupon->transaction_id))
													->fetchOne();
									if ($doTran->status == TransactionTable::$status['stand-by-sent']) {
										throw new Exception('This Voucher has already been cashed in and the credit has already been transferred to your My Wallet.');
									}
									$tran = new Transaction();
									$tran->parent_id = $doTran->id;
									$tran->transaction_type = TransactionTable::$type['do-share-do-receive'];
									$tran->sender_id = UserTable::BANK_ID;
									$tran->receiver_id = $this->user->getUser()->get('id');

									$tran->product_name = $coupon->name;
									$tran->product_id = $doTran->product_id;
									$tran->product_price = $doTran->product_price;
									$tran->quantity = $coupon->quantity;

									$tran->full_payment = $doTran->full_payment;
									$tran->save();

									//lets send the money to merchant(agent)
									$hmm = TransactionTable::getInstance()->createQuery()
													->addWhere('parent_id = ?', $doTran->parent_id)
													->addWhere('status = ?', TransactionTable::$status['stand-by'])
													->addWhere('transaction_type = ?', TransactionTable::$type['merchant-commission'])
													->fetchOne();
									$hmm->status = TransactionTable::$status['ok'];
									$hmm->save();

									$sf = SiteConfigTable::getInstance()->getSpendFee();
									$sf = $sf['config_value'];
									$for_virtual = round($hmm->full_payment * $sf / 100, 2);
									$for_w = $hmm->full_payment - $for_virtual;
									$query2 = 'UPDATE user SET virtual_wallet = virtual_wallet + :amount, wallet = wallet + :w WHERE id = :user_id';
									$result2 = $conn->execute($query2, array('user_id' => $hmm->receiver_id, 'amount' => $for_virtual, 'w' => $for_w));

									//lets send the money to level(5)
									$hmm2 = TransactionTable::getInstance()->createQuery()
													->addWhere('parent_id = ?', $doTran->parent_id)
													->addWhere('status = ?', TransactionTable::$status['stand-by'])
													->addWhere('transaction_type = ?', TransactionTable::$type['level-commission'])
													->fetchOne();
									if ($hmm2->id) {
										$hmm2->status = TransactionTable::$status['ok'];
										$hmm2->save();
										$for_virtual = round($hmm->full_payment * $sf / 100, 2);
										$for_w = $hmm->full_payment - $for_virtual;
										$query2 = 'UPDATE user SET virtual_wallet = virtual_wallet + :amount, wallet = wallet + :w WHERE id = :user_id';
										$result2 = $conn->execute($query2, array('user_id' => $hmm2->receiver_id, 'amount' => $for_virtual, 'w' => $for_w));
									}
									//the deal owner get the money in the wallet
									//$thisUser = $this->user->getUser();
									//$thisUser->virtual_wallet = $thisUser->virtual_wallet + $doTran->full_payment;
									//$thisUser->save();
									$query2 = 'UPDATE user SET wallet = wallet + :amount WHERE id = :user_id';
									$result2 = $conn->execute($query2, array('user_id' => $this->user->getUser()->get('id'), 'amount' => $doTran->full_payment));

									//lets update the do share transaction status
									$doTran->status = TransactionTable::$status['stand-by-sent'];
									$doTran->save();

									//all seem ok lets commit
									$conn->commit();
									$this->redirect('/my-account/transactions?view=cash_in_vouchers');
								} catch (Exception $e) {
									if ($e->getMessage()) {
										$couponCode->addError($e->getMessage());
									} else {
										$couponCode->addError('Something went wrong, please try again');
									}
									$form->addElement($couponCode);
									$conn->rollback();
								}
							} else {
								$couponCode->addError('You have attempted to Cash In a Voucher that does not belong to you. WinMaWeb administration has been notified and they will investigate this breach in our Terms and Conditions to take appropriate action. If you think this message was an error please contact Customer Support.');
								$form->addElement($couponCode);
							}
						}
						// }
					} else {
						$couponCode->addError('No such code');
						$form->addElement($couponCode);
					}
				} else {
					$couponCode->addError('You cannot retrive vouchers');
					$form->addElement($couponCode);
				}
			}
		}

		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/transactions?page={%page_number}' . $l
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

		// Fetching users
		$transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$transactionType = array_flip(TransactionTable::$type);

		foreach ($transactions as $key => $transaction) {
			$hmm = Doctrine_Query::create()
							->select('t.*')
							->from('Transaction t')
							->addWhere('t.parent_id = ?', $transaction['transaction_id'])
							->addWhere('t.transaction_type = ?', TransactionTable::$type['do-share'])
							->fetchOne(array(), Doctrine::HYDRATE_ARRAY);

			$transactions[$key]['merchant_share'] = $hmm;
		}
		return array(
				'transactions' => $transactions,
				'pagination' => $pagerLayout->display(array(), true),
				'transactionType' => $transactionType,
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'success' => (isset($success) ? $success : false)
				)
		);
	}

	public function winwinAction() {
		$this->setTemplate('myaccount/winwin.twig');

		return array('asd' => 1);
	}

	public function myrefxxxAction() {
		$this->setTemplate('myaccount/myReferralsVisual.twig');

		/*
		 * First level
		 */
		$userTable = UserTable::getInstance();
		$ascendents = $userTable->getAscendents(array('user_id' => $this->user->getUser()->get('id')), 4);

		$descendents = $userTable->getDescendents(array('user_id' => $this->user->getUser()->get('id')), 1);


		$asc_desc = $userTable->getAscDesc(array('user_id' => $this->user->getUser()->get('id')), 4);

		return array(
				'ascendents' => $ascendents,
				'descendents' => $descendents,
				'asc_desc' => $asc_desc
		);
	}

	function cmp($a, $b) {
		if ($a == $b) {
			return 0;
		}
		return ($a < $b) ? -1 : 1;
	}

	public function myrefAction() {
		$this->setTemplate('myaccount/myReferrals.twig');

		/*
		 * First level
		 */
		$userTable = UserTable::getInstance();
		//$ascendents = $userTable->getAscendents(array('user_id' => $this->user->getUser()->get('id')), 4);
		//$descendents = $userTable->getDescendents(array('user_id' => $this->user->getUser()->get('id')), 5);
		//$asc_desc = $userTable->getAscDesc(array('user_id' => $this->user->getUser()->get('id')), 4);
		$descendents = $userTable->getDescendentsNumbers(array('user_id' => $this->user->getUser()->get('id')), 5);

		return array(
				'descendents' => $descendents
		);
	}

	public function myrefidAction() {
		$this->setTemplate('myaccount/myReferral.twig');
		return array('_server' => $_SERVER);
	}

	public function sendemailsAction() {
		$this->setTemplate('myaccount/sendEmails.twig');

		$last_sent = $this->user->getUser()->get('last_emails_sent');
		if ($last_sent) {
			$sentDate = date('Y-m-d', strtotime($last_sent));
			$currentDate = date('Y-m-d');
			if ($sentDate == $currentDate) {
				return array('stop' => 1);
			}
		}

		$form = new Zend_Form();

		for ($x = 1; $x <= 5; $x++) {
			$email[$x] = $form->createElement('text', 'email_' . $x);
			$email[$x]->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
			$email[$x]->addValidator('emailAddress', false)
							->addFilter('StringToLower');
			if ($x == 1) {
				$email[$x]->setRequired(true);
			}
			$form->addElement($email[$x]);
		}

		$subject = $form->createElement('text', 'subject')
						->setRequired(true);
		$msg = $form->createElement('textarea', 'message');
		$form->addElement($msg)
						->addElement($subject);

		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
				$toSend = array();
				//insert
				$err = 0;
				for ($x = 1; $x <= 5; $x++) {
					$_email[$x] = $form->getValue('email_' . $x);
					if (!empty($_email[$x])) {
						$chk = UserSentEmailsTable::getInstance()->chkEmail(array(
												'user_id' => $this->user->getUser()->get('id'),
												'email' => $_email[$x])
										)
										->fetchOne(array(), Doctrine::HYDRATE_ARRAY);

						if (!is_array($chk)) {
							$toSend[] = $_email[$x];
						} else {
							$email[$x]->addError('You allready sent an invitaton to this email.');
							$err = 1;
						}
					}
				}
				if (count($toSend) && $err == 0) {
					$contactMessage = $form->getValue('message') . '<br /><br />
                        <a href="https://' . $_SERVER['SERVER_ADDR'] . '/request-membership?referral_id=' . $this->user->getUser()->get('ref_id') . '">https://' . $_SERVER['SERVER_ADDR'] . '/request-membership?referral_id=' . $this->user->getUser()->get('ref_id') . '</a>';
					require_once 'Swift/swift_required.php';
					$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
					$mailer = Swift_Mailer::newInstance($transport);
					//Create a message
					$message = Swift_Message::newInstance($form->getValue('subject'))
									->setFrom(array('office@winmaweb.com' => 'winmaweb'))
									->setBody($contactMessage, 'text/html');
					foreach ($toSend as $tsEmail) {
						$ema = new UserSentEmails();
						$ema->set('user_id', $this->user->getUser()->get('id'));
						$ema->set('email', $tsEmail);
						$ema->save();
						$user = $this->user->getUser();
						$user->last_emails_sent = date('Y-m-d H:i:s', time());
						$user->save();
						$message->setTo(array($tsEmail));
						$mailer->send($message);
					}
				}
				$success = true;
			}
		}

		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'success' => (isset($success) ? $success : false)
				)
		);
	}

	public function editAction() {
		$this->setTemplate('myaccount/editaccount.twig');
		$ac = $this->getParam('ac');
		if ($ac == 'photo') {
			return $this->accPhoto();
		}

		$form = new Zend_Form();
		// Create and configure username element:
		$is_private = $form->createElement('checkbox', 'is_private');
		$first_name = $form->createElement('text', 'first_name');
		$first_name->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);
		$last_name = $form->createElement('text', 'last_name');
		$last_name->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);

		$phone = $form->createElement('text', 'phone');
		$phone->addValidator('stringLength', false, array(2, 50))
//                 ->setRequired(true);
						->setRequired(false);

		$email = $form->createElement('text', 'email');
		$email->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
		$email->addValidator('emailAddress', false)
						->addValidator('dbEmail', true, array('exclude_id' => $this->user->getUser()->get('id')))
						->setRequired(true)
						->addFilter('StringToLower');

		$gender = $form->createElement('select', 'gender');
		$gender->setRequired(false);
		$gender->addMultiOption('', '- select your gender -');
		$gender->addMultiOption('Male', 'Male');
		$gender->addMultiOption('Female', 'Female');
		$gender->addValidator('InArray', false, array('' => '', 'Male' => 'Male', 'Female' => 'Female'));

//				$age = $form->createElement('text', 'age');
		$age = $form->createElement('select', 'age');
		$age->setRequired(false);
		for ($i = 18; $i <= 99; $i++) {
			$age->addMultiOption($i, $i);
		}
		$age->addValidator('Int', true)
						->addValidator('Between', true, array('min' => 18, 'max' => 99, 'messages' => 'You must select age between 18 and 99'));

		$address = $form->createElement('text', 'address');
//        $address->setRequired(true);
		$address->setRequired(false);

		$city = $form->createElement('text', 'city');
//        $city->setRequired(true);
		$city->setRequired(false);

		$county = $form->createElement('text', 'county');
//        $county->setRequired(true);
		$county->setRequired(false);

		$postcode = $form->createElement('text', 'postcode');
//        $postcode->setRequired(true);
		$postcode->setRequired(false);

		$countries = Doctrine_Query::create()
						->from('Country')
						->select('id, name')
						->addWhere('active=?', '1')
						->addOrderBy('name ASC')
						->execute(array(), DOCTRINE::HYDRATE_ARRAY);

		$country = $form->createElement('select', 'country');
		$country->setRequired(true);
		foreach ($countries AS $c) {
			$country->addMultiOption($c['id'], $c['name']);
		}
		$country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' => 'This country it is not in the original select values'));
//        $country->setValue(77);
		// added at 28.11
		$beneficiary_name = $form->createElement('text', 'beneficiary_name')->setRequired();

		$bank_code = $form->createElement('text', 'bank_code')->setRequired();
		$bank_branch_code = $form->createElement('text', 'bank_branch_code')->setRequired();
		$bank_account_number = $form->createElement('text', 'bank_account_number')->setRequired();
		//$bank_name = $form->createElement('text', 'bank_name')->setRequired();
		$bank_name = $form->createElement('select', 'bank_name');
		$bank_name->addMultiOption('OCBC', 'OCBC');
		$bank_name->addMultiOption('UOB', 'UOB');
		$bank_name->addMultiOption('DBS', 'DBS');
		$bank_name->addMultiOption('StandardChartered', 'StandardChartered');
		$bank_name->addMultiOption('CitiBank', 'CitiBank');
		$bank_name->addMultiOption('HSBC ', 'HSBC');
		$bank_name->setRequired();


		$bank_name->addValidator('InArray', false, array(array_keys($bank_name->getMultiOptions()), 'messages' => 'This option it is not in the original select values'));
		$bank_address = $form->createElement('text', 'bank_address')->setRequired();
		$form->addElement($first_name)
						->addElement($is_private)
						->addElement($last_name)
						->addElement($phone)
						->addElement($email)
						->addElement($address)
						->addElement($gender)
						->addElement($age)
						->addElement($city)
						->addElement($county)
						->addElement($postcode)
						->addElement($country)
						// added at 28.11
						->addElement($beneficiary_name)
						->addElement($bank_code)
						->addElement($bank_branch_code)
						->addElement($bank_account_number)
						->addElement($bank_name)
						->addElement($bank_address);
		$form->setDefaults($this->user->getUser()->toArray());
		$addr = $this->user->getUser()->UserAddress->toArray();
		$form->setDefaults($addr);
		$form->setDefault('country', $addr['country_id']);
		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
				$user = $this->user->getUser();
//				$user->is_private = $form->getValue('is_private');
				if($form->getValue('is_private') == '1') {
					$user->is_private = 1;
				} else {
					$user->is_private = 0;
				}
				$user->first_name = $form->getValue('first_name');
				$user->last_name = $form->getValue('last_name');
				$user->phone = $form->getValue('phone');
				$user->email = $form->getValue('email');
				$user->gender = $form->getValue('gender');
				$user->age = $form->getValue('age');
				$user->beneficiary_name = $form->getValue('beneficiary_name');
				$user->bank_code = $form->getValue('bank_code');
				$user->bank_branch_code = $form->getValue('bank_branch_code');
				$user->bank_account_number = $form->getValue('bank_account_number');
				$user->bank_name = $form->getValue('bank_name');
				$user->bank_address = $form->getValue('bank_address');
				$user->UserAddress->address = $form->getValue('address');
				$user->UserAddress->city = $form->getValue('city');
				$user->UserAddress->county = $form->getValue('county');
				$user->UserAddress->postcode = $form->getValue('postcode');
				$user->UserAddress->country_id = $form->getValue('country');
				$user->save();
				$success = true;
			}
		}

		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'countries' => $form->country,
						'age' => $form->age,
						'gender' => $form->gender,
						'kkt' => $form->bank_name,
						'success' => (isset($success) ? $success : false)
				)
		);
	}

	protected function accPhoto() {
		$this->setTemplate('myaccount/addPhoto.twig');

		$m = $this->getParam('m');
		switch ($m) {
			case 'delete':
				$pic_id = $this->getParam('pic_id');
				$picObj = Doctrine_Query::create()
								->from('UserMedia um')
								->addWhere('um.id = ?', $pic_id)
								->addWhere('um.user_id = ?', $this->user->getUser()->get('id'))
								->count();
				if (!$picObj) {
					$this->forbiddenAction('You dont have acces to this picture');
				}
				$q = Doctrine_Query::create()
								->delete('UserMedia')
								->addWhere('user_id = ?', $this->user->getUser()->get('id'))
								->whereIn('id', array($pic_id));

				$numDeleted = $q->execute();
				if ($numDeleted) {
					@unlink(ROOT_PATH . '/uploads/users/images/user_' . $pic_id . '.jpg');
					@unlink(ROOT_PATH . '/uploads/users/images/thumb120x67/user_' . $pic_id . '.jpg');
				}
				break;
		}

		$form = new Zend_Form();

		$photo = new Zend_Form_Element_File('photo');
		$photo->addValidator('Extension', false, 'jpg,png,gif');
		$form->addElement($photo, 'photo');
		$u = $this->user->getUser();
		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
				require_once(ROOT_PATH . '/lib/wi/WideImage.php');
				require_once(ROOT_PATH . '/lib/Cms/Image.php');

				if ($_FILES['photo']['tmp_name']) {
					$image = new Cms_Image($_FILES['photo']['tmp_name'], '/uploads/users/images', $u, 'user');
					$image->setWidth(300);
					$image->setHeight(300);
					$image->createImage(array(
							'fileName' => 'user',
							'thumbs' => array(
									array(
											'width' => 120,
											'height' => 67,
											'dir' => '/uploads/users/images/thumb120x67'
									)
							)
					));
					$success = true;
				}
			}
		}
		$user = Doctrine_Query::create()
						->select('u.id, u.username, um.*')
						->from('User u')
						->leftJoin('u.UserMedia um')
						->addWhere('u.id = ?', $this->user->getUser()->get('id'))
						->fetchOne(array(), Doctrine::HYDRATE_ARRAY);

		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'success' => (isset($success) ? $success : false)
				),
				'user' => $user
		);
	}

	public function chPassAction() {
		$this->setTemplate('myaccount/chpass.twig');

		$form = new Zend_Form();

		$c_password = $form->createElement('password', 'c_pass');
		$c_password->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
		$c_password->addValidator('StringLength', false, array(6))
						->addValidator('chkPassword', false, array('user_id' => $this->user->getUser()->get('id')))
						->setRequired(true);

		$password = $form->createElement('password', 'new_pass');
		$password->addValidator('StringLength', false, array('min' => 6, 'messages' => 'Your new password must be at least 6 characters long.  Please try again.'))
						->setRequired(true);

		$re_password = $form->createElement('password', 'renew_pass', array(
				'validators' => array(
						array('identical', false, array('token' => 'new_pass', 'messages' => 'Password and Retype New Password fields do not match'))
						)));
		$re_password->setRequired(true);

		// Add elements to form:
		$form->addElement($c_password)
						->addElement($password)
						->addElement($re_password);

		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
				$user = $this->user->getUser();
				$user->password = $form->getValue('new_pass');
				$user->save();
				$success = true;
			}
		}

		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'success' => (isset($success) ? $success : false)
				)
		);
	}

	public function contractDownloadAction() {
		$user = $this->user->getUser();
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="contract-' . $user->id . '.pdf"');
		readfile(ROOT_PATH . '/uploads/contracts/contract.pdf');
		die;
	}

	public function editCompanyAction() {

		$is_ajax = $this->request->getParam('isajaxrequest');

		if (!$is_ajax) {
			$is_ajax = $this->request->isXmlHttpRequest();
		}
		$user = $this->user->getUser();


		$companyObj = Doctrine_Query::create()
						->select('c.*, ca.*')
						->from('Company c')
						->leftJoin('c.CompanyAddress ca')
						->addWhere('c.user_id = ?', $this->user->getUser()->get('id'))
						->addWhere('c.company_type = 1')
						->fetchOne(array());
		$company = $companyObj->toArray();

		$this->setTemplate('myaccount/edit_company.twig');

		$form = new Zend_Form();
		// Create and configure username element:
		$company_name = $form->createElement('text', 'company_name');
		$company_name->addValidator('stringLength', false, array(2, 50))
						->setRequired(true)->setValue($company['name']);
		$vat_number = $form->createElement('text', 'vat_number');
		$vat_number->addValidator('stringLength', false, array(2, 50))
						->setRequired(true)->setValue($company['vat']);

		$phone = $form->createElement('text', 'phone');
		$phone->addValidator('stringLength', false, array(2, 50))
						->setRequired(true)->setValue($company['phone']);

		/*
		  $contract = new Zend_Form_Element_File('contract');
		  $fileName = $contract->getFileName(null, false);
		  $contract->addValidator('Extension', false, 'pdf')
		  ->setRequired()
		  ->setValueDisabled(true)
		  ->addFilter('Rename',
		  array('target' => ROOT_PATH . '/uploads/contracts/contract_'. md5($user->id.'+ceva!') .'.pdf',
		  'overwrite' => true));
		 */
		$form->addElement($company_name)
						->addElement($vat_number)
//                ->addElement($contract)
						->addElement($phone);


		$address = $form->createElement('text', 'address');
		$address->setRequired(true)->setValue($company['CompanyAddress']['address']);

		$city = $form->createElement('text', 'city');
		$city->setRequired(true)->setValue($company['CompanyAddress']['city']);

		$county = $form->createElement('text', 'county');
		$county->setRequired(true)->setValue($company['CompanyAddress']['county']);

		$postcode = $form->createElement('text', 'postcode');
		$postcode->setRequired(true)->setValue($company['CompanyAddress']['postcode']);

		$g_lat = $form->createElement('hidden', 'g_lat');
		$g_lat->setValue(0)->setRequired(true)->setValue($company['CompanyAddress']['latitude']);
		$g_lng = $form->createElement('hidden', 'g_lng');
		$g_lng->setValue(0)->setRequired(true)->setValue($company['CompanyAddress']['longitude']);

		$countries = Doctrine_Query::create()
						->from('Country')
						->select('id, name')
						->addWhere('active=?', '1')
						->addOrderBy('name ASC')
						->execute(array(), DOCTRINE::HYDRATE_ARRAY);

		$country = $form->createElement('select', 'country');
		$country->setRequired(true);
		foreach ($countries AS $c) {
			$country->addMultiOption($c['id'], $c['name']);
		}
		$country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' => 'This country it is not in the original select values'));
//        $country->setValue(77);

		$form->addElement($address)
						->addElement($city)
						->addElement($county)
						->addElement($postcode)
						->addElement($country)
						->addElement($g_lat)
						->addElement($g_lng);

		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
//                if ($form->contract->receive()) {
//									if ($fileName == 'contract-'.$user->id.'.pdf') {
				$user->company_name = $form->getValue('company_name');
				$user->vat_number = $form->getValue('vat_number');
//                    $user->request_step = 2;
				$user->request_step = 3;
				$user->mrequest_at = date('Y-m-d H:i:s', time());
				$user->save();

				$company = $companyObj;
				$company->name = $form->getValue('company_name');
				$company->vat = $form->getValue('vat_number');
				$company->phone = $form->getValue('phone');
				$company->user_id = $user->id;
				$company->company_type = 1;

				$company->CompanyAddress->address = $form->getValue('address');
				$company->CompanyAddress->city = $form->getValue('city');
				$company->CompanyAddress->county = $form->getValue('county');
				$company->CompanyAddress->postcode = $form->getValue('postcode');
				$company->CompanyAddress->country_id = $form->getValue('country');

				$company->CompanyAddress->latitude = $form->getValue('g_lat');
				$company->CompanyAddress->longitude = $form->getValue('g_lng');
				$company->save();
//                    $this->setTemplate('myaccount/contract/step2.twig');
				$success = true;
//									} else {
//										$contract->addError('Please upload the contract with the same name of the file you downloaded');
//									}
//                } else {
//                    $contract->addError('Something went wrong uploading the file, please try again!');
//                }
			}
		}

		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'countries' => $form->country,
						'success' => (isset($success) ? $success : false)
				),
//            'cFile' => $c_file,
				'activated' => 'on',
				'imgajax' => $is_ajax,
		);
	}

	public function contractAction() {
		if ($this->user->hasRole('SHOP')) {
			return $this->notFoundAction();
		}

		$is_ajax = $this->request->getParam('isajaxrequest');

		if (!$is_ajax) {
			$is_ajax = $this->request->isXmlHttpRequest();
		}

//				if($this->user->hasRole('SHOP')) {
//					$this->setTemplate('myaccount/contract/contract.twig');
//					
//					$c_file = '';
//					if(file_exists(ROOT_PATH . '/uploads/contracts/contract.pdf')) {
//							$c_file = '/uploads/contracts/contract.pdf';
//					}
//					
//					$activated = SiteConfigTable::getInstance()->findOneBy('config_name', 'merchant_request', Doctrine::HYDRATE_ARRAY);
//					
//					return array(
//            'cFile' => $c_file,
//            'activated' => $activated['config_value'],
//						'imgajax' => $is_ajax
//          );
//        }

		$user = $this->user->getUser();

		if ($user->request_step == 2) {
			$this->setTemplate('myaccount/contract/step2.twig');
			return array('imgajax' => $is_ajax);
		}

		if ($user->request_step == 3) {
			$pay = $this->getParam('pay');
			$merchantFee = SiteConfigTable::getInstance()->getMerchantFee();
			$merchantFee = (int) $merchantFee['config_value'];
			if ($pay == 1 && $user->wallet >= $merchantFee) {
				$conn = Doctrine_manager::getInstance()->getCurrentConnection();
				$conn->beginTransaction();
				try {
					$user->request_step = 100;
					$kkt = 0;
					if ($this->user->hasRole('AGENT')) {
						$kkt = 1;
					}
					$user->UserRole->delete();
					$user->is_do = 1;
					$role_user = RoleTable::getInstance()->findOneByName('USER');
					$role_shop = RoleTable::getInstance()->findOneByName('SHOP');
					if ($kkt == 1) {
						$role_agent = RoleTable::getInstance()->findOneByName('AGENT');
						$userRole = new UserRole();
						$userRole->user_id = $user->id;
						$userRole->role_id = $role_agent->id;
						$userRole->save();
					}

					$userRole = new UserRole();
					$userRole->user_id = $user->id;
					$userRole->role_id = $role_user->id;
					$userRole->save();
					$userRole = new UserRole();
					$userRole->user_id = $user->id;
					$userRole->role_id = $role_shop->id;
					$userRole->save();

					if ($merchantFee > 0) {
						$user->wallet = $user->wallet - $merchantFee;
						$type = TransactionTable::$type;
						$tran = new Transaction();
						$tran->parent_id = 0;
						$tran->transaction_type = $type['merchant-fee'];
						$tran->sender_id = $this->user->getUser()->get('id');
						$tran->receiver_id = 2;
						$tran->product_name = 'Merchant Verification & Test Transaction';
						$tran->full_payment = -$merchantFee;
						$tran->save();

						$rootUser = UserTable::getInstance()->find(UserTable::BANK_ID);
						$rootUser->wallet = $rootUser->wallet + $merchantFee;
						$rootUser->save();
					}
					$user->save();

					$conn->commit();

					$this->redirect('/my-account');
				} catch (Doctrine_Exception $e) {
					$conn->rollback();
				}
			}
			$this->setTemplate('myaccount/contract/step3.twig');
			return array('imgajax' => $is_ajax, 'merchantFee' => $merchantFee);
		}

		$this->setTemplate('myaccount/contract/step1.twig');

		/*
		  $c_file = '';
		  if(file_exists(ROOT_PATH . '/uploads/contracts/contract.pdf')) {
		  //            $c_file = '/uploads/contracts/contract.pdf';
		  $c_file = '/my-account/contract/download';
		  }
		 */


		$activated = SiteConfigTable::getInstance()->findOneBy('config_name', 'merchant_request', Doctrine::HYDRATE_ARRAY);

		$form = new Zend_Form();
		// Create and configure username element:
		$company_name = $form->createElement('text', 'company_name');
		$company_name->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);
		$vat_number = $form->createElement('text', 'vat_number');
		$vat_number->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);

		$phone = $form->createElement('text', 'phone');
		$phone->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);

		/*
		  $contract = new Zend_Form_Element_File('contract');
		  $fileName = $contract->getFileName(null, false);
		  $contract->addValidator('Extension', false, 'pdf')
		  ->setRequired()
		  ->setValueDisabled(true)
		  ->addFilter('Rename',
		  array('target' => ROOT_PATH . '/uploads/contracts/contract_'. md5($user->id.'+ceva!') .'.pdf',
		  'overwrite' => true));
		 */
		$form->addElement($company_name)
						->addElement($vat_number)
//                ->addElement($contract)
						->addElement($phone);


		$address = $form->createElement('text', 'address');
		$address->setRequired(true);

		$city = $form->createElement('text', 'city');
		$city->setRequired(true);

		$county = $form->createElement('text', 'county');
		$county->setRequired(true);

		$postcode = $form->createElement('text', 'postcode');
		$postcode->setRequired(true);

		$g_lat = $form->createElement('hidden', 'g_lat');
		$g_lat->setValue(0)->setRequired(true);
		$g_lng = $form->createElement('hidden', 'g_lng');
		$g_lng->setValue(0)->setRequired(true);

		$countries = Doctrine_Query::create()
						->from('Country')
						->select('id, name')
						->addWhere('active=?', '1')
						->addOrderBy('name ASC')
						->execute(array(), DOCTRINE::HYDRATE_ARRAY);

		$country = $form->createElement('select', 'country');
		$country->setRequired(true);
		foreach ($countries AS $c) {
			$country->addMultiOption($c['id'], $c['name']);
		}
		$country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' => 'This country it is not in the original select values'));
		$country->setValue(198);

		$form->addElement($address)
						->addElement($city)
						->addElement($county)
						->addElement($postcode)
						->addElement($country)
						->addElement($g_lat)
						->addElement($g_lng);

		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
//                if ($form->contract->receive()) {
//									if ($fileName == 'contract-'.$user->id.'.pdf') {
				$user->company_name = $form->getValue('company_name');
				$user->vat_number = $form->getValue('vat_number');
//                    $user->request_step = 2;
				$user->request_step = 3;
				$user->mrequest_at = date('Y-m-d H:i:s', time());
				$user->save();

				$company = new Company();
				$company->name = $form->getValue('company_name');
				$company->vat = $form->getValue('vat_number');
				$company->phone = $form->getValue('phone');
				$company->user_id = $user->id;
				$company->company_type = 1;

				$company->CompanyAddress->address = $form->getValue('address');
				$company->CompanyAddress->city = $form->getValue('city');
				$company->CompanyAddress->county = $form->getValue('county');
				$company->CompanyAddress->postcode = $form->getValue('postcode');
				$company->CompanyAddress->country_id = $form->getValue('country');

				$company->CompanyAddress->latitude = $form->getValue('g_lat');
				$company->CompanyAddress->longitude = $form->getValue('g_lng');
				$company->save();
//                    $this->setTemplate('myaccount/contract/step2.twig');
				$this->setTemplate('myaccount/contract/step3.twig');
				$merchantFee = SiteConfigTable::getInstance()->getMerchantFee();
				$merchantFee = (int) $merchantFee['config_value'];

//                    return array('imgajax' => $is_ajax);
				return array('imgajax' => $is_ajax, 'merchantFee' => $merchantFee);
				$success = true;
//									} else {
//										$contract->addError('Please upload the contract with the same name of the file you downloaded');
//									}
//                } else {
//                    $contract->addError('Something went wrong uploading the file, please try again!');
//                }
			}
		}

		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'countries' => $form->country,
						'success' => (isset($success) ? $success : false)
				),
//            'cFile' => $c_file,
				'activated' => $activated['config_value'],
				'imgajax' => $is_ajax,
		);
	}

	public function becomeAnAgentAction() {
		if ($this->user->hasRole('AGENT')) {
			$this->redirect('/my-account/my-offers');
		}

		$this->setTemplate('myaccount/becomeAnAgent.twig');

		$form = new Zend_Form();

		$first_name = $form->createElement('text', 'first_name');
		$first_name->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);

		$last_name = $form->createElement('text', 'last_name');
		$last_name->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);

		$phone = $form->createElement('text', 'phone');
		$phone->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);

		$email = $form->createElement('text', 'email');
		$email->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
		$email->addValidator('emailAddress', false)
						->addValidator('dbEmail', true, array('exclude_id' => $this->user->getUser()->get('id')))
						->setRequired(true)
						->addFilter('StringToLower');

		$gender = $form->createElement('select', 'gender');
		$gender->setRequired(true);
		$gender->addMultiOption('', '- select your gender -');
		$gender->addMultiOption('Male', 'Male');
		$gender->addMultiOption('Female', 'Female');
		$gender->addValidator('InArray', false, array('' => '', 'Male' => 'Male', 'Female' => 'Female'));

//		$age = $form->createElement('text', 'age');
		$age = $form->createElement('select', 'age');
		$age->setRequired(true);
		for ($i = 18; $i <= 99; $i++) {
			$age->addMultiOption($i, $i);
		}
		$age->addValidator('Int', true)
						->addValidator('Between', true, array('min' => 18, 'max' => 99, 'messages' => 'You must select age between 18 and 99'));

		$address = $form->createElement('text', 'address');
		$address->setRequired(true);

		$city = $form->createElement('text', 'city');
		$city->setRequired(true);

		$county = $form->createElement('text', 'county');
		$county->setRequired(true);

		$postcode = $form->createElement('text', 'postcode');
		$postcode->setRequired(true);

		$countries = Doctrine_Query::create()
						->from('Country')
						->select('id, name')
						->addWhere('active=?', '1')
						->addOrderBy('name ASC')
						->execute(array(), DOCTRINE::HYDRATE_ARRAY);
		$country = $form->createElement('select', 'country');
		$country->setRequired(true);
		foreach ($countries AS $c) {
			$country->addMultiOption($c['id'], $c['name']);
		}
		$country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' => 'This country it is not in the original select values'));

		$terms = $form->createElement('checkbox', 'terms')
						->setRequired(true)
						->addValidator('InArray', false, array(array('1'), 'messages' => 'You must agree TERMS AND CONDITIONS'));
		$form->addElement($terms);

		$form->addElement($first_name)
						->addElement($last_name)
						->addElement($phone)
						->addElement($email)
						->addElement($address)
						->addElement($gender)
						->addElement($age)
						->addElement($city)
						->addElement($county)
						->addElement($postcode)
						->addElement($country);
		$form->setDefaults($this->user->getUser()->toArray());
		$addr = $this->user->getUser()->UserAddress->toArray();
		$form->setDefaults($addr);
		$form->setDefault('country', $addr['country_id']);
		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
				$user = $this->user->getUser();
				$user->first_name = $form->getValue('first_name');
				$user->last_name = $form->getValue('last_name');
				$user->phone = $form->getValue('phone');
				$user->email = $form->getValue('email');
				$user->gender = $form->getValue('gender');
				$user->age = $form->getValue('age');

				$user->UserAddress->address = $form->getValue('address');
				$user->UserAddress->city = $form->getValue('city');
				$user->UserAddress->county = $form->getValue('county');
				$user->UserAddress->postcode = $form->getValue('postcode');
				$user->UserAddress->country_id = $form->getValue('country');

				$is_merchant = false;
				if ($this->user->hasRole('SHOP')) {
					$is_merchant = true;
				}

				$user->agent_request_step = 100;
				$user->UserRole->delete();

				$user->save();

				$role_user = RoleTable::getInstance()->findOneByName('USER');
				$role_agent = RoleTable::getInstance()->findOneByName('AGENT');
				$userRole = new UserRole();
				$userRole->user_id = $user->id;
				$userRole->role_id = $role_user->id;
				$userRole->save();
				$userRole = new UserRole();
				$userRole->user_id = $user->id;
				$userRole->role_id = $role_agent->id;
				$userRole->save();
				if ($is_merchant) {
					$role_shop = RoleTable::getInstance()->findOneByName('SHOP');
					$userRole = new UserRole();
					$userRole->user_id = $user->id;
					$userRole->role_id = $role_shop->id;
					$userRole->save();
				}
				$this->redirect('/my-account/my-offers');
			}
		}

		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'countries' => $form->country,
						'age' => $form->age,
						'gender' => $form->gender
				)
		);
	}

	public function agentCommisionAction() {
		$this->setTemplate('myaccount/agentCommision.twig');

		$page = $this->getParam('page');

		$query = TransactionTable::getInstance()->getReceivedTransactions(array('receiver_id' => $this->user->getUser()->get('id')));

		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/agent-commision?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

		$transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$transactionType = array_flip(TransactionTable::$type);

		return array(
				'transactions' => $transactions,
				'pagination' => $pagerLayout->display(array(), true),
				'transactionType' => $transactionType
		);
	}

	public function agentAction() {
		if ($this->user->hasRole('AGENT')) {
			return $this->notFoundAction();
		}

		$is_ajax = $this->request->getParam('isajaxrequest');

		if (!$is_ajax) {
			$is_ajax = $this->request->isXmlHttpRequest();
		}

		$user = $this->user->getUser();

		if ($user->agent_request_step == 2) {
			$this->setTemplate('myaccount/contract/agent-step2.twig');
			return array('imgajax' => $is_ajax);
		}

		if ($user->agent_request_step == 3) {
			$pay = $this->getParam('pay');
			$merchantFee = SiteConfigTable::getInstance()->getMerchantFee();
			$merchantFee = (int) $merchantFee['config_value'];
			if ($pay == 1 && $user->wallet >= $merchantFee) {
				$conn = Doctrine_manager::getInstance()->getCurrentConnection();
				$conn->beginTransaction();
				try {
					$user->agent_request_step = 100;
					$user->UserRole->delete();

					$role_user = RoleTable::getInstance()->findOneByName('USER');
					$role_shop = RoleTable::getInstance()->findOneByName('AGENT');
					if ($user->is_do) {
						$role_merc = RoleTable::getInstance()->findOneByName('SHOP');
						$userRole = new UserRole();
						$userRole->user_id = $user->id;
						$userRole->role_id = $role_merc->id;
						$userRole->save();
					}
					$userRole = new UserRole();
					$userRole->user_id = $user->id;
					$userRole->role_id = $role_user->id;
					$userRole->save();
					$userRole = new UserRole();
					$userRole->user_id = $user->id;
					$userRole->role_id = $role_shop->id;
					$userRole->save();

					if ($merchantFee > 0) {
						$user->wallet = $user->wallet - $merchantFee;
						$type = TransactionTable::$type;
						$tran = new Transaction();
						$tran->parent_id = 0;
						$tran->transaction_type = $type['merchant-fee'];
						$tran->sender_id = $this->user->getUser()->get('id');
						$tran->receiver_id = 2;
						$tran->product_name = 'Agent Verification & Test Transaction';
						$tran->full_payment = -$merchantFee;
						$tran->save();

						$rootUser = UserTable::getInstance()->find(UserTable::BANK_ID);
						$rootUser->wallet = $rootUser->wallet + $merchantFee;
						$rootUser->save();
					}
					$user->save();

					$conn->commit();

					$this->redirect('/my-account');
				} catch (Doctrine_Exception $e) {
					$conn->rollback();
				}
			}
			$this->setTemplate('myaccount/contract/agent-step3.twig');
			return array('imgajax' => $is_ajax, 'merchantFee' => $merchantFee);
		}

		$this->setTemplate('myaccount/contract/agent-step1.twig');

		$activated = SiteConfigTable::getInstance()->findOneBy('config_name', 'agent_request', Doctrine::HYDRATE_ARRAY);

		$form = new Zend_Form();
		// Create and configure username element:
		$company_name = $form->createElement('text', 'company_name');
		$company_name->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);
		$vat_number = $form->createElement('text', 'vat_number');
		$vat_number->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);

		$phone = $form->createElement('text', 'phone');
		$phone->addValidator('stringLength', false, array(2, 50))
						->setRequired(true);

		$form->addElement($company_name)
						->addElement($vat_number)
						->addElement($phone);

		$address = $form->createElement('text', 'address');
		$address->setRequired(true);

		$city = $form->createElement('text', 'city');
		$city->setRequired(true);

		$county = $form->createElement('text', 'county');
		$county->setRequired(true);

		$postcode = $form->createElement('text', 'postcode');
		$postcode->setRequired(true);

		$countries = Doctrine_Query::create()
						->from('Country')
						->select('id, name')
						->addWhere('active=?', '1')
						->addOrderBy('name ASC')
						->execute(array(), DOCTRINE::HYDRATE_ARRAY);

		$country = $form->createElement('select', 'country');
		$country->setRequired(true);
		foreach ($countries AS $c) {
			$country->addMultiOption($c['id'], $c['name']);
		}
		$country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' => 'This country it is not in the original select values'));

		$form->addElement($address)
						->addElement($city)
						->addElement($county)
						->addElement($postcode)
						->addElement($country);

		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
				$user->company_name = $form->getValue('company_name');
				$user->vat_number = $form->getValue('vat_number');
//							$user->agent_request_step = 2;
				$user->agent_request_step = 3;
				$user->arequest_at = date('Y-m-d H:i:s', time());
				$user->save();

				$company = new Company();
				$company->name = $form->getValue('company_name');
				$company->vat = $form->getValue('vat_number');
				$company->phone = $form->getValue('phone');
				$company->user_id = $user->id;
				$company->company_type = 0;

				$company->CompanyAddress->address = $form->getValue('address');
				$company->CompanyAddress->city = $form->getValue('city');
				$company->CompanyAddress->county = $form->getValue('county');
				$company->CompanyAddress->postcode = $form->getValue('postcode');
				$company->CompanyAddress->country_id = $form->getValue('country');

				$company->save();
//							$this->setTemplate('myaccount/contract/agent-step2.twig');
				$this->setTemplate('myaccount/contract/agent-step3.twig');
				$merchantFee = SiteConfigTable::getInstance()->getMerchantFee();
				$merchantFee = (int) $merchantFee['config_value'];

//							return array('imgajax' => $is_ajax);
				return array('imgajax' => $is_ajax, 'merchantFee' => $merchantFee);
				$success = true;
			}
		}

		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'countries' => $form->country,
						'success' => (isset($success) ? $success : false)
				),
				'activated' => $activated['config_value'],
				'imgajax' => $is_ajax,
		);
	}

	public function addMerchantToAgentAction() {
		$this->setTemplate('myaccount/addMerchantToAgent.twig');

		$is_ajax = $this->request->getParam('isajaxrequest');

		if (!$is_ajax) {
			$is_ajax = $this->request->isXmlHttpRequest();
		}

		$users = Doctrine_Query::create()
						->select('u.*')
						->from('User u')
						->innerJoin('u.MerchantToAgent m2a ON m2a.merchant_user_id = u.id')
						->where('u.is_active = 1')
						->addWhere('m2a.agent_user_id = ?', $this->user->getUser()->get('id'))
						->fetchArray();

		$form = new Zend_Form();

		$notinArray = array();
		foreach ($users as $u) {
			$notinArray[] = $u['id'];
		}

		$ref_id = $form->createElement('text', 'ref_id');
//			$ref_id->setRequired(true);
		$form->addElement($ref_id);
		$id = $form->createElement('hidden', 'id');
		$form->addElement($id);
		$isDelete = $form->createElement('hidden', 'isDelete');
		$form->addElement($isDelete);
		if ($form->getValue('isDelete') != '1') {
			
		}

		if ($this->request->getPost()) {
			if ($form->isValid($this->request->getPost())) {
				if ($form->getValue('isDelete') == '1') {
					Doctrine_Query::create()
									->delete('MerchantToAgent m2a')
									->addWhere('m2a.merchant_user_id = ?', $form->getValue('id'))
									->addWhere('m2a.agent_user_id = ?', $this->user->getUser()->get('id'))
									->execute();
				} else {
					$usr = Doctrine_Query::create()
									->select('u.*')
									->from('User u')
									->innerJoin('u.UserRole ur')
									->innerJoin('ur.Role r')
									->WhereNotIn('u.id', $notinArray)
									->addWhere("u.is_active = 1 and r.name = 'SHOP' AND u.ref_id = '" . $form->getValue('ref_id') . "'")
									->fetchOne();
					if (!$usr) {
						$ref_id->addError('Invalid referral ID.');
					} else {
						$m2a = new MerchantToAgent();
						$m2a->merchant_user_id = $usr->id;
						$m2a->agent_user_id = $this->user->getUser()->get('id');
						$m2a->save();
					}
				}
				$this->redirect('/my-account/add-merchant');
			}
		}

		return array(
				'form' => array(
						'values' => $form->getValues(),
						'errors' => $form->getMessages(),
						'ref_id' => $form->ref_id
				),
				'imgajax' => $is_ajax, 'users' => $users, 'users_count' => count($users));
	}

	public function sentinvitationsAction() {
		$this->setTemplate('myaccount/sentInvitations.twig');
		$page = $this->getParam('page');
		if ($page < 1) {
			$page = 1;
		}

		$query = UserSentEmailsTable::getInstance()->getUserEmails(array('user_id' => $this->user->getUser()->get('id')));

		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/my-referral-id/sent-invitations?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

		// Fetching users
		$emails = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);

		return array(
				'emails' => $emails,
				'pagination' => $pagerLayout->display(array(), true),
		);
	}

	public function acceptedinvitationsAction() {
		$this->setTemplate('myaccount/acceptedInvitations.twig');
		$page = $this->getParam('page');
		if ($page < 1) {
			$page = 1;
		}

		$query = UserSentEmailsTable::getInstance()->getUserRegEmails(array('user_id' => $this->user->getUser()->get('id')));

		$pagerLayout = new PagerLayoutWithArrows(
										new Doctrine_Pager(
														$query,
														$page, 25),
										new Doctrine_Pager_Range_Sliding(array(
												'chunk' => 5
										)),
										'/my-account/my-referral-id/sent-invitations?page={%page_number}'
		);
		$pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
		$pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

		// Fetching users
		$emails = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);

		return array(
				'emails' => $emails,
				'pagination' => $pagerLayout->display(array(), true),
		);
	}

	public function getSubTreeAction() {
		$node = $this->getParam('node');
		$node2 = explode('_', $node);
		$id = $node2[1];
		$userTable = UserTable::getInstance();
		$descendents = $userTable->getDescendents(array('user_id' => $id), 1);
		$return = array();
		$x = 0;
		foreach ($descendents as $descendent) {
			if ($x == 0) {
				$return['id'] = $node;
				$return['children'] = array();
			}
			$return['children'][$x]['id'] = 'node_' . $descendent['id'];
			$return['children'][$x]['name'] = $descendent['username'];
			$x++;
		}
		header('Content-type: application/json');
		echo json_encode($return);
		die();
	}

	public function getMyReferralsAction() {
		$this->setTemplate('myaccount/viewmyreferrals.twig');
		$id = $this->getParam('refid');
		$userTable = UserTable::getInstance();
		$refs = $userTable->getDescendents(array('user_id' => $id), 20);
		foreach ($refs as $descendent) {
			if ($x == 0) {
				$return['id'] = $node;
				$return['children'] = array();
			}
			$return['children'][$x]['id'] = 'node_' . $descendent['id'];
			$return['children'][$x]['name'] = $descendent['username'];
			$x++;
		}
		return array('message' => count($return['children']));
	}

}