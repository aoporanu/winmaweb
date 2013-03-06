<?php

class PagerLayoutWithArrows extends Doctrine_Pager_Layout {

	public function display($options = array(), $return = false) {
        $pager = $this->getPager();
        $str = '';

        // First page
        $this->addMaskReplacement('page', '&laquo;', true);
        $options['page_number'] = $pager->getFirstPage();
        $str .= $this->processPage($options);

        // Previous page
        $this->addMaskReplacement('page', '&lsaquo;', true);
        $options['page_number'] = $pager->getPreviousPage();
        $str .= $this->processPage($options);

        // Pages listing
        $this->removeMaskReplacement('page');
        $str .= parent::display($options, true);

        // Next page
        $this->addMaskReplacement('page', '&rsaquo;', true);
        $options['page_number'] = $pager->getNextPage();
        $str .= $this->processPage($options);

        // Last page
        $this->addMaskReplacement('page', '&raquo;', true);
        $options['page_number'] = $pager->getLastPage();
        $str .= $this->processPage($options);

        // No
        $this->addMaskReplacement('page', 'All pages:', true);
        
		$str .= '<li class="all">Total: ' . $pager->getNumResults() . '</li>';
        
        // Possible wish to return value instead of print it on screen
        if ($return) {
            return $str;
        }

        echo $str;
    }

}

class reportsController extends Cms_Controller {

	public function init() {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    
	public function showAction() {
        $this->setTemplate('reports/show.twig');
        $show = $this->getParam('show');
        $page = $this->getParam('page', 1);
        $s = '';
		switch ($show) {
			case 'all_users':
				$show = 'all_users';
                $query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->orderBy('t.id DESC');
				break;
			case 'normal_users':
				$show = 'normal_users';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('r.is_do != 1')
						->andWhere('r.agent_request_step != 100')
						->orderBy('t.id DESC');
				break;
			case 'agent_users':
				$show = 'agent_users';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('r.is_do = 0')
						->andWhere('r.agent_request_step != 0')
						->orderBy('t.id DESC');
				break;
			case 'merchant_users':
				$show = 'merchant_users';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('r.is_do = 1')
						->orderBy('t.id DESC');
				break;
			case 'all_transactions':
				$show = 'all_transactions';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type IN (0, 1, 2)')
						->orderBy('t.id DESC');
				break;
			case 'net-transactions':
				$show = 'net-transactions';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type = 10')
						->orderBy('t.id DESC');
				break;
			case 'ag-transactions':
				$show = 'ag-transactions';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type = 10')
						->orderBy('t.id DESC');
				break;
			case 'all_share':
				$show = 'all_share';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type IN (3, 4, 5, 6, 11)')
						->orderBy('t.id DESC');
				break;
			case 'wmw_share':
				$show = 'wmw_share';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type IN (3, 11)')
						->orderBy('t.id DESC');
				break;
			case 'merc_share':
				$show = 'merc_share';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type IN(5, 6, 4, 10)')
						->orderBy('t.id DESC');
				break;
			case 'all_payout':
				$show = 'all_payout';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.status IN (-1, 0, 1, 2)')
						->orderBy('t.id DESC');
				break;
			case 'pending-payout':
				$show = 'pending-payout';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.status = 1')
						->orderBy('t.id DESC');
				break;
			case 'paid-payout':
				$show = 'paid-payout';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.status = 2')
						->orderBy('t.id DESC');
				break;
			case 'all_payment':
				$show = 'all_payment';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type IN (1, 80, 85)')
						->orderBy('t.id DESC');
				break;
			case 'my_money-payment':
				$show = 'my_money-payment';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type = 1')
						->orderBy('t.id DESC');
				break;
			case 'credit-payment':
				$show = 'credit-payment';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type = 80')
						->orderBy('t.id DESC');
				break;
			case 'payza-payment':
				$show = 'payza-payment';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.transaction_type = 85')
						->orderBy('t.id DESC');
				break;
            default:
				$show = 'unset';
				$query = Doctrine_Query::create()
						->select('t.created_at, t.full_payment, t.status, t.receiver_id, t.transaction_type, r.username, r.ref_id, r.wallet, r.virtual_wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->orderBy('t.id DESC');
				break;
		}
		$searchP = '';
		$search = $this->getParam('search');
		if ($search == '1') {
			$from_date = $this->getParam('from_date');
			$to_date = $this->getParam('to_date');
			$sq = $this->getParam('search_username');
			$ds = $this->getParam('deal_search');
			if (!empty($ds) && empty($from_date) && empty($to_date)) {
				$query = Doctrine_Query::create()
						->select('t.*, r.username, r.ref_id, r.wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.product_name LIKE "%' . $ds . '%"')
						->orderBy('t.id DESC');
				$searchP = '&search=1&deal=' . $ds;
			}
			if (!empty($ds) && !empty($from_date) && !empty($to_date)) {
				$query = Doctrine_Query::create()
						->select('t.*, r.username, r.ref_id, r.wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.product_name LIKE "%' . $ds . '%"')
						->addWhere('t.created_at >= ?', $from_date. ' 00:00:00')
												->addWhere('t.created_at >= ?', $from_date. ' 00:00:00')
						->orderBy('t.id DESC');
				$searchP = '&search=1&deal=' . $ds;
			}
			if (!empty($ds) && !empty($from_date) && empty($to_date)) {
				$query = Doctrine_Query::create()
						->select('t.*, r.username, r.ref_id, r.wallet')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('t.product_name LIKE "%' . $ds . '%"')
						->addWhere('t.created_at >= ?', $from_date. ' 00:00:00')
						->orderBy('t.id DESC');
				$searchP = '&search=1&deal=' . $ds;
			}
			if (!empty($sq) && !empty($from_date) && !empty($to_date)) {
				$query = Doctrine_Query::create()
						->select('t.*, r.username, r.ref_id')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('r.username LIKE "' . $sq . '%"')
						->addWhere('t.created_at >= ?', $from_date. ' 00:00:00')
						->andWhere('t.created_at <= ?', $to_date. ' 23:59:59')
						->orderBy('t.id DESC');
				$searchP = '&search=1&username=' . $sq . '&from=' . $from_date . '&to=' . $to_date;
			}
			if (!empty($sq) && empty($from_date) && empty($to_date)) {
				$query = Doctrine_Query::create()
						->select('t.*, r.username, r.ref_id')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('r.username LIKE "' . $sq . '%"')
						->orderBy('t.id DESC');
				$searchP = '&search=1&username=' . $sq . '&from=' . $from_date . '&to=' . $to_date;
			}
			if (!empty($sq) && !empty($from_date) && empty($to_date)) {
				$query = Doctrine_Query::create()
						->select('t.*, r.username, r.ref_id')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->where('r.username LIKE ' . $sq . '%')
						->addWhere('t.created_at >= ?', $from_date. ' 00:00:00')
						->orderBy('t.id DESC');
				$searchP = '&search=1&username=' . $sq . '&from=' . $from_date;
			}
			if (empty($sq) && !empty($from_date) && empty($to_date)) {
				$query = Doctrine_Query::create()
						->select('t.*, r.username, r.ref_id')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->addWhere('t.created_at >= ?', $from_date. ' 00:00:00')
						->orderBy('t.id DESC');
				$searchP = '&search=1&username=' . $sq . '&from=' . $from_date;
			}
			if (empty($sq) && empty($from_date) && !empty($to_date)) {
				$query = Doctrine_Query::create()
						->select('t.*, r.username, r.ref_id')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->andWhere('t.created_at <= ?', $to_date. ' 23:59:59')
						->orderBy('t.id DESC');
				$searchP = '&search=1&username=' . $sq . '&from=' . $from_date;
			}
			if (empty($sq) && !empty($from_date) && !empty($to_date)) {
				$query = Doctrine_Query::create()
						->select('t.*, r.username, r.ref_id')
						->from('Transaction t')
						->leftJoin('t.Receiver r')
						->andWhere('t.created_at <= ?', $to_date. ' 23:59:59')
						->addWhere('t.created_at >= ?', $from_date. ' 00:00:00')
						->orderBy('t.id DESC');
				$searchP = '&search=1&username=' . $sq . '&from=' . $from_date;
			}
			if (empty($sq) && empty($from_date) && empty($to_date) && empty($ds)) {
				return array('message' => 'You have to input a value in at least one of the search form fields');
			}
		}
		$export = $this->getParam('export');
		if ($export == 1) {
			$merchants = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			$to_csv = array();
			foreach ($merchants as $merchant) {
				if ($merchant['status'] == '1') {
					$merchant['status'] = 'pending';
				}
				if ($merchant['status'] == '0') {
					$merchant['status'] = 'OK';
				}
				if ($merchant['status'] == '2') {
					$merchant['status'] = 'completed';
				}
				if ($merchant['transaction_type'] == '80') {
					$merchant['transaction_type'] = 'WMW';
				}
				if ($merchant['transaction_type'] == '85') {
					$merchant['transaction_type'] = 'Payza';
				}
				if ($merchant['transaction_type'] == '1') {
					$merchant['transaction_type'] = 'Deal Purchase';
				}
				if ($merchant['transaction_type'] == '4') {
					$merchant['transaction_type'] = 'Deal Owner Share';
				}
				if ($merchant['transaction_type'] == '3') {
					$merchant['transaction_type'] = 'Bank Share';
				}
				if ($merchant['transaction_type'] == '10') {
					$merchant['transaction_type'] = 'Level Comission';
				}
				if ($merchant['transaction_type'] == '11') {
					$merchant['transaction_type'] = 'Bank Share Left (after calculating the deal owner share)';
				}
				if ($merchant['transaction_type'] == '9') {
					$merchant['transaction_type'] = 'Merchant Comission';
				}
				if ($merchant['transaction_type'] == '0') {
					$merchant['transaction_type'] = 'Deposit';
				}
				if ($merchant['transaction_type'] == '75') {
					$merchant['transaction_type'] = 'Deposit Paypal Fee';
				}
				$to_csv[] = array($merchant['id'], $merchant['created_at'], $merchant['full_payment'], $merchant['status'], $merchant['Receiver']['username'], $merchant['transaction_type'], $merchant['full_payment']);
			}
			$filename = $show.'_main_report.csv';
			header("Content-type: text/csv");
//			header('Content-Disposition: attachment; filename="'.$show.'"_main_report.csv"');
			header("Content-Disposition: attachment; filename=$filename");
			$fp = fopen('php://output', 'w');
			$table_header = array('Transaction ID', 'Date', 'Full Payment', 'Status', 'Receiver ID', 'Transaction type', 'Balance');
			fputcsv($fp, $table_header);
			foreach ($to_csv as $csv) {
				fputcsv($fp, $csv);
			}
			exit();	
			fclose($fp);
		}
		if ($export == 2) {
			// this means we'll export to PDF
			$merchants = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			$to_csv = array();
			foreach ($merchants as $merchant) {
				if ($merchant['status'] == '1') {
					$merchant['status'] = 'pending';
				}
				if ($merchant['status'] == '0') {
					$merchant['status'] = 'OK';
				}
				if ($merchant['status'] == '2') {
					$merchant['status'] = 'completed';
				}
				if ($merchant['transaction_type'] == '80') {
					$merchant['transaction_type'] = 'WMW';
				}
				if ($merchant['transaction_type'] == '85') {
					$merchant['transaction_type'] = 'Payza';
				}
				if ($merchant['transaction_type'] == '1') {
					$merchant['transaction_type'] = 'Deal Purchase';
				}
				if ($merchant['transaction_type'] == '4') {
					$merchant['transaction_type'] = 'Deal Owner Share';
				}
				if ($merchant['transaction_type'] == '3') {
					$merchant['transaction_type'] = 'Bank Share';
				}
				if ($merchant['transaction_type'] == '10') {
					$merchant['transaction_type'] = 'Level Comission';
				}
				if ($merchant['transaction_type'] == '11') {
					$merchant['transaction_type'] = 'Bank Share Left (after calculating the deal owner share)';
				}
				if ($merchant['transaction_type'] == '9') {
					$merchant['transaction_type'] = 'Merchant Comission';
				}
				if ($merchant['transaction_type'] == '0') {
					$merchant['transaction_type'] = 'Deposit';
				}
				if ($merchant['transaction_type'] == '75') {
					$merchant['transaction_type'] = 'Deposit Paypal Fee';
				}
				$to_csv[] = array($merchant['id'], $merchant['created_at'], $merchant['full_payment'], $merchant['status'], $merchant['Receiver']['username'], $merchant['transaction_type'], $merchant['Receiver']['wallet']);
			}
			ob_start();
            include_once ROOT_PATH . '/lib/dompdf/report.php';
            $voucher_content = ob_get_contents();
						print_r($voucher_content);
            ob_end_clean();
			
            include_once ROOT_PATH . '/lib/dompdf/dompdf_config.inc.php';
//			$old_limit = ini_set("memory_limit", "40M"); 
            $dompdf = new DOMPDF();
            $dompdf->set_paper('a4', 'portrait');
            $dompdf->load_html($voucher_content);
            $dompdf->render();
			$dompdf->stream($show . '-report.pdf');
			// We'll be outputting a PDF
			$pdf = $dompdf->output();
		}
		$pagerLayout = new PagerLayoutWithArrows(
						new Doctrine_Pager(
								$query,
								$page, 25),
						new Doctrine_Pager_Range_Sliding(array(
							'chunk' => 5
						)),
						'/admin/reports?page={%page_number}' . $s
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $merchants = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        return array(
            'merchants' => $merchants,
            'pagination' => $pagerLayout->display(array(), true),
			'show' => $show,
			'sq' => $sq
		);
	}

	public function merchantAction() {
        $this->setTemplate('reports/merchant.twig');
        
        $id = $this->getParam('id');
        $page = $this->getParam('page', 1);
        $merchant = UserTable::getInstance()->find($id);
		if (!$merchant->id) {
            return $this->notFoundAction();
        }
        
        $start_time = $this->getParam('start_time');
        $end_time = $this->getParam('end_time');
        
        
        $query = Doctrine_Query::create()
                            ->select('t.*, s.*, p.*')
                            ->from('Transaction t')
                            ->leftJoin('t.Sender s')
                            ->leftJoin('t.Product p')
                            ->addWhere('t.receiver_id = ?', $merchant->id)
                            ->addWhere('t.parent_id = 0')
                            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['buy'], TransactionTable::$type['buy-wmw']))
                            ->orderBy('t.id DESC');
        
		if (!empty($start_time)) {
			$s = '&start_time=' . urlencode($start_time);
            $query->addWhere('t.created_at >= ?', date('Y-m-d H:i:s', strtotime($start_time)));
        }
        
		if (!empty($end_time)) {
			$e = '&end_time=' . urlencode($end_time);
            $query->addWhere('t.created_at <= ?', date('Y-m-d H:i:s', strtotime($end_time)));
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
						'/admin/reports/merchant/' . $id . '?page={%page_number}' . $s . $e
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        $mda = array();
		foreach ($transactions as $key => $transaction) {
            $hmm = Doctrine_Query::create()
            ->select('t.*, r.*')
            ->from('Transaction t')
            ->leftJoin('t.Receiver r')
            ->addWhere('t.parent_id = ?', $transaction['id'])
            ->fetchArray();
			foreach ($hmm as $sub) {
				if ($sub['transaction_type'] == TransactionTable::$type['do-share']) {
                    $transactions[$key]['merchant_share'] = $sub;
                }
				if ($sub['transaction_type'] == TransactionTable::$type['level-commission']) {
                    $transactions[$key]['level'] = $sub;
                }
				if ($sub['transaction_type'] == TransactionTable::$type['merchant-commission']) {
                    $transactions[$key]['agent_share'] = $sub;
                }
				if ($sub['transaction_type'] == TransactionTable::$type['bank-share-left']) {
                    $transactions[$key]['bank_share'] = $sub;
                }
            }
        }
        $format = $this->getParam('format');
		if ($format == 'csv') {
            $fisier = ROOT_PATH . '/mda.csv';
            //$date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			if ($fp = fopen($fisier, 'w')) {
                //fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Code\n");
                //echo '<pre>';
                //print_r($transactions);die;
				foreach ($transactions as $valori) {
                    //fputcsv($fp, $valori['email'], ',', '"');
					fputs($fp, "Product: " . $valori['product_name'] . ",Product Price:" . $valori['product_price'] . ",Bought By: " . $valori['Sender']['first_name'] . " " . $valori['Sender']['last_name'] . "(" . $valori['Sender']['ref_id'] . ")," . $valori['created_at'] . "\n");
                    //foreach($valori['merchant_share'] as $share) {
                        
					fputs($fp, " ,Merchant Share Sub-Transaction:,Merchant Receive:" . $valori['merchant_share']['full_payment'] . ",Merchant Name: " . $valori['merchant_share']['Receiver']['first_name'] . " " . $valori['merchant_share']['Receiver']['last_name'] . "(" . $valori['merchant_share']['Receiver']['ref_id'] . ")," . $valori['merchant_share']['created_at'] . "\n");
					fputs($fp, " ,Agent Share Sub-Transaction:,Agent Receive:" . $valori['agent_share']['full_payment'] . ",Agent Name: " . $valori['agent_share']['Receiver']['first_name'] . " " . $valori['agent_share']['Receiver']['last_name'] . "(" . $valori['agent_share']['Receiver']['ref_id'] . ")," . $valori['agent_share']['created_at'] . "\n");
					fputs($fp, " ,Bank Share Sub-Transaction:,Bank Receive:" . $valori['bank_share']['full_payment'] . ",BANK," . $valori['bank_share']['created_at'] . "\n");
					fputs($fp, " ,5th Level Share Sub-Transaction:,User Receive:" . $valori['level']['full_payment'] . ",User Name: " . $valori['level']['Receiver']['first_name'] . " " . $valori['level']['Receiver']['last_name'] . "(" . $valori['level']['Receiver']['ref_id'] . ")," . $valori['level']['created_at'] . "\n");
                    //}
                }

                fclose($fp);
            }
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"merchant.csv\"");

            // citire fisier in string si afisare
            echo file_get_contents($fisier);

            die;
        }
        
		return array('transactions' => $transactions, 'pagination' => $pagerLayout->display(array(), true), 'merchant' => $merchant, 'start_time' => $start_time, 'end_time' => $end_time);
    }
    
	public function agentAction() {
        $this->setTemplate('reports/agent.twig');
        
        $id = $this->getParam('id');
        $page = $this->getParam('page', 1);
        $merchant = UserTable::getInstance()->find($id);
		if (!$merchant->id) {
            return $this->notFoundAction();
        }
        
        $start_time = $this->getParam('start_time');
        $end_time = $this->getParam('end_time');
        
        
        $query = Doctrine_Query::create()
                            ->select('t.*, r.*, p.*')
                            ->from('Transaction t')
                            ->leftJoin('t.Product p')
                            ->leftJoin('t.Receiver r')
                            ->addWhere('t.receiver_id = ?', $merchant->id)
                            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['merchant-commission']))
                            ->orderBy('t.id DESC');
        
		if (!empty($start_time)) {
			$s = '&start_time=' . urlencode($start_time);
            $query->addWhere('t.created_at >= ?', date('Y-m-d H:i:s', strtotime($start_time)));
        }
        
		if (!empty($end_time)) {
			$e = '&end_time=' . urlencode($end_time);
            $query->addWhere('t.created_at <= ?', date('Y-m-d H:i:s', strtotime($end_time)));
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
						'/admin/reports/agent/' . $id . '?page={%page_number}' . $s . $e
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        $mda = array();
		foreach ($transactions as $key => $transaction) {
            $hmm = Doctrine_Query::create()
            ->select('t.*, r.*, s.*')
            ->from('Transaction t')
            ->leftJoin('t.Receiver r')
            ->leftJoin('t.Sender s')
            ->addWhere('t.id = ?', $transaction['parent_id'])
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
            $transactions[$key]['parent_transaction'] = $hmm;
        }
        
        $format = $this->getParam('format');
		if ($format == 'csv') {
            $fisier = ROOT_PATH . '/mda.csv';
            //$date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			if ($fp = fopen($fisier, 'w')) {
                //fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Code\n");
                //echo '<pre>';
                //print_r($transactions);die;
				foreach ($transactions as $valori) {
                    //fputcsv($fp, $valori['email'], ',', '"');
					fputs($fp, " Agent Received: " . $valori['full_payment'] . ",Product Price:" . $valori['parent_transaction']['product_price'] . ",Product name:" . $valori['parent_transaction']['product_name'] . ",Agent Name: " . $valori['Receiver']['first_name'] . " " . $valori['Receiver']['last_name'] . "(" . $valori['Receiver']['ref_id'] . ")," . $valori['created_at'] . "\n");
                    //foreach($valori['merchant_share'] as $share) {
                        
					fputs($fp, " ,Parent Transaction:,Product Bought By:" . $valori['parent_transaction']['Sender']['first_name'] . " " . $valori['parent_transaction']['Sender']['last_name'] . "(" . $valori['parent_transaction']['Sender']['ref_id'] . "),Merchant Name: " . $valori['parent_transaction']['Receiver']['first_name'] . " " . $valori['parent_transaction']['Receiver']['last_name'] . "(" . $valori['parent_transaction']['Receiver']['ref_id'] . ")," . $valori['parent_transaction']['created_at'] . "\n");
                    //}
                }

                fclose($fp);
            }
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"agent.csv\"");

            // citire fisier in string si afisare
            echo file_get_contents($fisier);

            die;
        }
        
		return array('transactions' => $transactions, 'pagination' => $pagerLayout->display(array(), true), 'merchant' => $merchant, 'start_time' => $start_time, 'end_time' => $end_time);
    }
    
	public function userAction() {
        $this->setTemplate('reports/user.twig');
        
        $id = $this->getParam('id');
        $page = $this->getParam('page', 1);
        $merchant = UserTable::getInstance()->find($id);
		if (!$merchant->id) {
            return $this->notFoundAction();
        }
        
        $start_time = $this->getParam('start_time');
        $end_time = $this->getParam('end_time');
        
        
        $query = Doctrine_Query::create()
                            ->select('t.*, r.*, p.*')
                            ->from('Transaction t')
                            ->leftJoin('t.Product p')
                            ->leftJoin('t.Receiver r')
                            ->addWhere('t.sender_id = ?', $merchant->id)
                            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['buy'], TransactionTable::$type['buy-wmw'], TransactionTable::$type['deposit'], TransactionTable::$type['withdraw'], TransactionTable::$type['donation']))
                            ->orderBy('t.id DESC');
        
		if (!empty($start_time)) {
			$s = '&start_time=' . urlencode($start_time);
            $query->addWhere('t.created_at >= ?', date('Y-m-d H:i:s', strtotime($start_time)));
        }
        
		if (!empty($end_time)) {
			$e = '&end_time=' . urlencode($end_time);
            $query->addWhere('t.created_at <= ?', date('Y-m-d H:i:s', strtotime($end_time)));
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
						'/admin/reports/user/' . $id . '?page={%page_number}' . $s . $e
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        $mda = array();
		foreach ($transactions as $key => $transaction) {
			/* $hmm = Doctrine_Query::create()
            ->select('t.*, r.*, s.*')
            ->from('Transaction t')
            ->leftJoin('t.Receiver r')
            ->leftJoin('t.Sender s')
            ->addWhere('t.id = ?', $transaction['parent_id'])
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
			  $transactions[$key]['parent_transaction'] = $hmm; */
        }
        $format = $this->getParam('format');
		if ($format == 'csv') {
            $fisier = ROOT_PATH . '/mda.csv';
            //$date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			if ($fp = fopen($fisier, 'w')) {
                //fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Code\n");
                //echo '<pre>';
                //print_r($transactions);die;
				fputs($fp, " User Name: " . $merchant->first_name . " " . $merchant->last_name . " (" . $merchant->ref_id . ") \n\n");
				foreach ($transactions as $valori) {
                    //fputcsv($fp, $valori['email'], ',', '"');
					if ($valori['transaction_type'] == 0) {
						fputs($fp, " Deposit: " . $valori['full_payment'] . ",Deposit Transaction," . $valori['created_at'] . "\n");
                    }
					if ($valori['transaction_type'] == 2) {
						fputs($fp, " Withdrawn: " . $valori['full_payment'] . ",Withdrawn Transaction," . $valori['created_at'] . "\n");
                    }
					if ($valori['transaction_type'] == 55) {
						fputs($fp, " Charity Name: " . $valori['product_name'] . "Donated:" . $valori['full_payment'] . ",Donation Transaction," . $valori['created_at'] . "\n");
                    }
					if ($valori['transaction_type'] == 1) {
						fputs($fp, " Product Name: " . $valori['product_name'] . " Product Price:" . $valori['full_payment'] . " Merchant:" . $valori['Receiver']['first_name'] . " " . $valori['Receiver']['last_name'] . " (" . $valori['Receiver']['ref_id'] . "),Buy Transaction," . $valori['created_at'] . "\n");
                    }
                    //foreach($valori['merchant_share'] as $share) {
                    //}
                }

                fclose($fp);
            }
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"user.csv\"");

            // citire fisier in string si afisare
            echo file_get_contents($fisier);

            die;
        }
		return array('transactions' => $transactions, 'pagination' => $pagerLayout->display(array(), true), 'merchant' => $merchant, 'start_time' => $start_time, 'end_time' => $end_time);
    }
    
	public function productAction() {
        $this->setTemplate('reports/product.twig');
        
        $id = $this->getParam('id');
        $page = $this->getParam('page', 1);
        $product = ProductTable::getInstance()->find($id);
		if (!$product->id) {
            return $this->notFoundAction();
        }
        
        $start_time = $this->getParam('start_time');
        $end_time = $this->getParam('end_time');
        
        
        $query = Doctrine_Query::create()
                            ->select('t.*, s.*, p.*')
                            ->from('Transaction t')
                            ->leftJoin('t.Sender s')
                            ->leftJoin('t.Product p')
                            ->addWhere('t.product_id = ?', $product->id)
                            ->addWhere('t.parent_id = 0')
                            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['buy'], TransactionTable::$type['buy-wmw']))
                            ->orderBy('t.id DESC');
        
		if (!empty($start_time)) {
			$s = '&start_time=' . urlencode($start_time);
            $query->addWhere('t.created_at >= ?', date('Y-m-d H:i:s', strtotime($start_time)));
        }
        
		if (!empty($end_time)) {
			$e = '&end_time=' . urlencode($end_time);
            $query->addWhere('t.created_at <= ?', date('Y-m-d H:i:s', strtotime($end_time)));
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
						'/admin/reports/merchant/' . $id . '?page={%page_number}' . $s . $e
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        $mda = array();
		foreach ($transactions as $key => $transaction) {
            $hmm = Doctrine_Query::create()
            ->select('t.*, r.*')
            ->from('Transaction t')
            ->leftJoin('t.Receiver r')
            ->addWhere('t.parent_id = ?', $transaction['id'])
            ->fetchArray();
			foreach ($hmm as $sub) {
				if ($sub['transaction_type'] == TransactionTable::$type['do-share']) {
                    $transactions[$key]['merchant_share'] = $sub;
                }
				if ($sub['transaction_type'] == TransactionTable::$type['level-commission']) {
                    $transactions[$key]['level'] = $sub;
                }
				if ($sub['transaction_type'] == TransactionTable::$type['merchant-commission']) {
                    $transactions[$key]['agent_share'] = $sub;
                }
				if ($sub['transaction_type'] == TransactionTable::$type['bank-share-left']) {
                    $transactions[$key]['bank_share'] = $sub;
                }
            }
        }
        
        $format = $this->getParam('format');
		if ($format == 'csv') {
            $fisier = ROOT_PATH . '/mda.csv';
            //$date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			if ($fp = fopen($fisier, 'w')) {
                //fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Code\n");
                //echo '<pre>';
                //print_r($transactions);die;
				foreach ($transactions as $valori) {
                    //fputcsv($fp, $valori['email'], ',', '"');
					fputs($fp, "Product: " . $valori['product_name'] . ",Product Price:" . $valori['product_price'] . ",Bought By: " . $valori['Sender']['first_name'] . " " . $valori['Sender']['last_name'] . "(" . $valori['Sender']['ref_id'] . ")," . $valori['created_at'] . "\n");
                    //foreach($valori['merchant_share'] as $share) {
                        
					fputs($fp, " ,Merchant Share Sub-Transaction:,Merchant Receive:" . $valori['merchant_share']['full_payment'] . ",Merchant Name: " . $valori['merchant_share']['Receiver']['first_name'] . " " . $valori['merchant_share']['Receiver']['last_name'] . "(" . $valori['merchant_share']['Receiver']['ref_id'] . ")," . $valori['merchant_share']['created_at'] . "\n");
					fputs($fp, " ,Agent Share Sub-Transaction:,Agent Receive:" . $valori['agent_share']['full_payment'] . ",Agent Name: " . $valori['agent_share']['Receiver']['first_name'] . " " . $valori['agent_share']['Receiver']['last_name'] . "(" . $valori['agent_share']['Receiver']['ref_id'] . ")," . $valori['agent_share']['created_at'] . "\n");
					fputs($fp, " ,Bank Share Sub-Transaction:,Bank Receive:" . $valori['bank_share']['full_payment'] . ",BANK," . $valori['bank_share']['created_at'] . "\n");
					fputs($fp, " ,5th Level Share Sub-Transaction:,User Receive:" . $valori['level']['full_payment'] . ",User Name: " . $valori['level']['Receiver']['first_name'] . " " . $valori['level']['Receiver']['last_name'] . "(" . $valori['level']['Receiver']['ref_id'] . ")," . $valori['level']['created_at'] . "\n");
                    //}
                }

                fclose($fp);
            }
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"product.csv\"");

            // citire fisier in string si afisare
            echo file_get_contents($fisier);

            die;
        }
        
        
		return array('transactions' => $transactions, 'pagination' => $pagerLayout->display(array(), true), 'product' => $product, 'start_time' => $start_time, 'end_time' => $end_time);
    }
    
	public function allAgentsAction() {
        $this->setTemplate('reports/all_agents.twig');
        
        $page = $this->getParam('page', 1);

        $start_time = $this->getParam('start_time');
        $end_time = $this->getParam('end_time');
        
        
        $query = Doctrine_Query::create()
                            ->select('t.*, r.*, p.*')
                            ->from('Transaction t')
                            ->leftJoin('t.Product p')
                            ->leftJoin('t.Receiver r')
                            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['merchant-commission']))
                            ->orderBy('t.id DESC');
        
		if (!empty($start_time)) {
			$s = '&start_time=' . urlencode($start_time);
            $query->addWhere('t.created_at >= ?', date('Y-m-d H:i:s', strtotime($start_time)));
        }
        
		if (!empty($end_time)) {
			$e = '&end_time=' . urlencode($end_time);
            $query->addWhere('t.created_at <= ?', date('Y-m-d H:i:s', strtotime($end_time)));
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
						'/admin/reports/all-agent?page={%page_number}' . $s . $e
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        $mda = array();
		foreach ($transactions as $key => $transaction) {
            $hmm = Doctrine_Query::create()
            ->select('t.*, r.*, s.*')
            ->from('Transaction t')
            ->leftJoin('t.Receiver r')
            ->leftJoin('t.Sender s')
            ->addWhere('t.id = ?', $transaction['parent_id'])
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
            $transactions[$key]['parent_transaction'] = $hmm;
        }
        
        $haha = Doctrine_Query::create()
            ->select('t.id, sum(t.full_payment)')
            ->from('Transaction t')
            ->addWhere('t.status = 0')
            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['merchant-commission']))
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        $total = $haha['sum'];
        
        $haha = Doctrine_Query::create()
            ->select('t.id, sum(t.full_payment)')
            ->from('Transaction t')
            ->addWhere('t.status = 1')
            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['merchant-commission']))
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        $pendingTotal = $haha['sum'];
        
        $format = $this->getParam('format');
		if ($format == 'csv') {
            $fisier = ROOT_PATH . '/mda.csv';
            //$date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			if ($fp = fopen($fisier, 'w')) {
                //fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Code\n");
                //echo '<pre>';
                //print_r($transactions);die;
				foreach ($transactions as $valori) {
                    //fputcsv($fp, $valori['email'], ',', '"');
					fputs($fp, " Agent Received: " . $valori['full_payment'] . ",Agent Name: " . $valori['Receiver']['first_name'] . " " . $valori['Receiver']['last_name'] . "(" . $valori['Receiver']['ref_id'] . ")," . $valori['created_at'] . "\n");
                    //foreach($valori['merchant_share'] as $share) {
                    //}
                }

                fclose($fp);
            }
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"user.csv\"");

            // citire fisier in string si afisare
            echo file_get_contents($fisier);

            die;
        }
        
        return array('transactions' => $transactions, 'pagination' => $pagerLayout->display(array(), true), 'start_time' => $start_time, 'end_time' => $end_time, 'total' => $total, 'total_pending' => $pendingTotal);
    }
    
	public function allMerchantsAction() {
        $this->setTemplate('reports/all_merchants.twig');
        
        $page = $this->getParam('page', 1);

        $start_time = $this->getParam('start_time');
        $end_time = $this->getParam('end_time');
        
        
        $query = Doctrine_Query::create()
                            ->select('t.*, r.*, p.*')
                            ->from('Transaction t')
                            ->leftJoin('t.Product p')
                            ->leftJoin('t.Receiver r')
                            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['do-share']))
                            ->orderBy('t.id DESC');
        
		if (!empty($start_time)) {
			$s = '&start_time=' . urlencode($start_time);
            $query->addWhere('t.created_at >= ?', date('Y-m-d H:i:s', strtotime($start_time)));
        }
        
		if (!empty($end_time)) {
			$e = '&end_time=' . urlencode($end_time);
            $query->addWhere('t.created_at <= ?', date('Y-m-d H:i:s', strtotime($end_time)));
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
						'/admin/reports/all-merchants?page={%page_number}' . $s . $e
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        $mda = array();
		foreach ($transactions as $key => $transaction) {
            $hmm = Doctrine_Query::create()
            ->select('t.*, r.*, s.*')
            ->from('Transaction t')
            ->leftJoin('t.Receiver r')
            ->leftJoin('t.Sender s')
            ->addWhere('t.id = ?', $transaction['parent_id'])
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
            $transactions[$key]['parent_transaction'] = $hmm;
        }
        
        $haha = Doctrine_Query::create()
            ->select('t.id, sum(t.full_payment)')
            ->from('Transaction t')
            ->addWhere('t.status = 2')
            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['do-share']))
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        $total = $haha['sum'];
        
        $haha = Doctrine_Query::create()
            ->select('t.id, sum(t.full_payment)')
            ->from('Transaction t')
            ->addWhere('t.status = 1')
            ->andWhereIn('t.transaction_type', array(TransactionTable::$type['do-share']))
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        $pendingTotal = $haha['sum'];
        
        $format = $this->getParam('format');
		if ($format == 'csv') {
            $fisier = ROOT_PATH . '/mda.csv';
            //$date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			if ($fp = fopen($fisier, 'w')) {
                //fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Code\n");
                //echo '<pre>';
                //print_r($transactions);die;
				foreach ($transactions as $valori) {
                    //fputcsv($fp, $valori['email'], ',', '"');
					fputs($fp, " Merchant Received: " . $valori['full_payment'] . ",Merchant Name: " . $valori['Receiver']['first_name'] . " " . $valori['Receiver']['last_name'] . "(" . $valori['Receiver']['ref_id'] . ")," . $valori['created_at'] . "\n");
                    //foreach($valori['merchant_share'] as $share) {
                    //}
                }

                fclose($fp);
            }
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"user.csv\"");

            // citire fisier in string si afisare
            echo file_get_contents($fisier);

            die;
        }
        
        return array('transactions' => $transactions, 'pagination' => $pagerLayout->display(array(), true), 'start_time' => $start_time, 'end_time' => $end_time, 'total' => $total, 'total_pending' => $pendingTotal);
    }
    
	public function bankAction() {
        $this->setTemplate('reports/bank.twig');
        
        $page = $this->getParam('page', 1);

        $start_time = $this->getParam('start_time');
        $end_time = $this->getParam('end_time');
        
        
        $query = Doctrine_Query::create()
                            ->select('t.*, abs(t.full_payment) as full_payment')
                            ->from('Transaction t')
                            ->addWhere('t.receiver_id = 2')
                            ->andWhereNotIn('t.transaction_type', array(TransactionTable::$type['bank-share']))
                            ->orderBy('t.id DESC');
        
		if (!empty($start_time)) {
			$s = '&start_time=' . urlencode($start_time);
            $query->addWhere('t.created_at >= ?', date('Y-m-d H:i:s', strtotime($start_time)));
        }
        
		if (!empty($end_time)) {
			$e = '&end_time=' . urlencode($end_time);
            $query->addWhere('t.created_at <= ?', date('Y-m-d H:i:s', strtotime($end_time)));
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
						'/admin/reports/bank?page={%page_number}' . $s . $e
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        $mda = array();
		foreach ($transactions as $key => $transaction) {
            $hmm = Doctrine_Query::create()
            ->select('t.*, r.*, s.*')
            ->from('Transaction t')
            ->leftJoin('t.Receiver r')
            ->leftJoin('t.Sender s')
            ->addWhere('t.id = ?', $transaction['parent_id'])
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
            $transactions[$key]['parent_transaction'] = $hmm;
        }
        
        $haha = Doctrine_Query::create()
            ->select('t.id, sum(abs(t.full_payment))')
            ->from('Transaction t')
            ->addWhere('t.status = 0')
            ->addWhere('t.receiver_id = 2')
            ->andWhereNotIn('t.transaction_type', array(TransactionTable::$type['bank-share']))
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        $total = $haha['sum'];
        
        $haha = Doctrine_Query::create()
            ->select('t.id, sum(abs(t.full_payment))')
            ->from('Transaction t')
            ->addWhere('t.status = 1')
            ->addWhere('t.receiver_id = 2')
            ->andWhereNotIn('t.transaction_type', array(TransactionTable::$type['bank-share']))
            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        $pendingTotal = $haha['sum'];
        
        $transactionType = array_flip(TransactionTable::$type);
        
        $format = $this->getParam('format');
		if ($format == 'csv') {
            $fisier = ROOT_PATH . '/mda.csv';
            //$date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
			if ($fp = fopen($fisier, 'w')) {
                //fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Code\n");
                //echo '<pre>';
                fputs($fp, "Amount, Type, Date\n");
				foreach ($transactions as $valori) {
                    //fputcsv($fp, $valori['email'], ',', '"');
					fputs($fp, $valori['full_payment'] . "," . $transactionType[$valori['transaction_type']] . "," . $valori['created_at'] . "\n");
                    //foreach($valori['merchant_share'] as $share) {
                    //}
                }

                fclose($fp);
            }
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"user.csv\"");

            // citire fisier in string si afisare
            echo file_get_contents($fisier);

            die;
        }
        
        return array('types' => $transactionType, 'transactions' => $transactions, 'pagination' => $pagerLayout->display(array(), true), 'start_time' => $start_time, 'end_time' => $end_time, 'total' => $total, 'total_pending' => $pendingTotal);
    }

}