<?php
class PagerLayoutWithArrows extends Doctrine_Pager_Layout
{
    public function display($options = array(), $return = false)
    {
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
        
        $str .= '<li class="all">Total: '.$pager->getNumResults().'</li>';
        
        // Possible wish to return value instead of print it on screen
        if ($return) {
            return $str;
        }

        echo $str;
    }
}

class statisticController extends Cms_Controller
{
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    
    public function userAction()
    {
        $this->setTemplate('statistic/index.twig');
        $page = $this->getParam('page', 0);
        
        $type = $this->getParam('type', 'daily');
        $action = $this->getParam('action');
        
        
        switch($type) {
            case 'monthly':
                
                $year = date('Y') + $page;
                for($x = 1; $x <= 12; $x++) {
                    $perMonth['regs'][$x] = 0;
                    $perMonth['month'][$x] = date('M', mktime(0, 0, 0, $x , 1, date("Y")));
                }

                $stats = UserTable::getInstance()->getRegistrationStatistic(array('year' => $year), 'monthly');

                foreach($stats AS $s) {
                    if (array_key_exists($s['m'], $perMonth['regs'])) {
                        $perMonth['regs'][$s['m']] = $s['total'];
                    }
                }
                return array(
                    'per_month' => $perMonth,
                    'year' =>  $year,
                    'page' => $page,
                    'type'  => $type,
                    'action'    => $action
                );
            break;
        
            default:
                
                $month = mktime(0, 0, 0, date('m') + $page  , 1, date("Y"));
                $days = date('t', $month);
                $perDay = array();
                for($x = 1; $x <= $days; $x++) {
                    $perDay[$x] = 0;
                }

                $stats = UserTable::getInstance()->getRegistrationStatistic(array('month' => date('m', $month), 'year' => date('Y', $month)));

                foreach($stats AS $s) {
                    if (array_key_exists($s['d'], $perDay)) {
                        $perDay[$s['d']] = $s['total'];
                    }
                }
                
                return array(
                    'per_day' => $perDay,
                    'month' =>  $month,
                    'page' => $page,
                    'type'  => $type,
                    'action'    => $action
                );
            break;
        }
    }
    
    public function offersAction()
    {
        $this->setTemplate('statistic/index.twig');
        
        $page = $this->getParam('page', 0);
        $type = $this->getParam('type', 'daily');
        
        $action = $this->getParam('action');
        
        switch($type) {
            case 'monthly':
                
                $year = date('Y') + $page;
                for($x = 1; $x <= 12; $x++) {
                    $perMonth['transactions'][$x] = 0;
                    $perMonth['quantity'][$x] = 0;
                    $perMonth['money'][$x] = 0;
                    $perMonth['month'][$x] = date('M', mktime(0, 0, 0, $x , 1, date("Y")));
                }

                $stats = TransactionTable::getInstance()->getBuyTransactionsStatistic(array('year' => $year), 'monthly');
                
                foreach($stats AS $s) {
                    if (array_key_exists($s['m'], $perMonth['transactions'])) {
                        $perMonth['transactions'][$s['m']] = $s['total'];
                        $perMonth['quantity'][$s['m']] = $s['qty'];
                        $perMonth['money'][$s['m']] = -$s['payment'];
                    }
                }
                return array(
                    'per_month' => $perMonth,
                    'year' =>  $year,
                    'page' => $page,
                    'type'  => $type,
                    'action'    => $action
                );
            break;
        
            default:
                
                $month = mktime(0, 0, 0, date('m') + $page  , 1, date("Y"));
                $days = date('t', $month);
                $perDay = array();
                for($x = 1; $x <= $days; $x++) {
                    $perDay['transactions'][$x] = 0;
                    $perDay['quantity'][$x] = 0;
                    $perDay['money'][$x] = 0;
                }

                $stats = TransactionTable::getInstance()->getBuyTransactionsStatistic(array('month' => date('m', $month), 'year' => date('Y', $month)));
                
                foreach($stats AS $s) {
                    if (array_key_exists($s['d'], $perDay['transactions'])) {
                        $perDay['transactions'][$s['d']] = $s['total'];
                        $perDay['quantity'][$s['d']] = $s['qty'];
                        $perDay['money'][$s['d']] = -$s['payment'];
                    }
                }
                
                return array(
                    'per_day' => $perDay,
                    'month' =>  $month,
                    'page' => $page,
                    'type'  => $type,
                    'action'    => $action
                );
            break;
        }
    }
    
    public function walletAction()
    {
        $this->setTemplate('statistic/wallet.twig');
        
        $page = $this->getParam('page', 0);
        $type = $this->getParam('type', 'daily');
        
        $action = $this->getParam('action');
        
        /*switch($type) {
            case 'monthly':
                
                $year = date('Y') + $page;
                for($x = 1; $x <= 12; $x++) {
                    $perMonth['transactions'][$x] = 0;
                    $perMonth['quantity'][$x] = 0;
                    $perMonth['money'][$x] = 0;
                    $perMonth['month'][$x] = date('M', mktime(0, 0, 0, $x , 1, date("Y")));
                }

                $stats = TransactionTable::getInstance()->getBuyTransactionsStatistic(array('year' => $year), 'monthly');
                
                foreach($stats AS $s) {
                    if (array_key_exists($s['m'], $perMonth['transactions'])) {
                        $perMonth['transactions'][$s['m']] = $s['total'];
                        $perMonth['quantity'][$s['m']] = $s['qty'];
                        $perMonth['money'][$s['m']] = -$s['payment'];
                    }
                }
                return array(
                    'per_month' => $perMonth,
                    'year' =>  $year,
                    'page' => $page,
                    'type'  => $type,
                    'action'    => $action
                );
            break;
        
            default:
                
                $month = mktime(0, 0, 0, date('m') + $page  , 1, date("Y"));
                $days = date('t', $month);
                $perDay = array();
                for($x = 1; $x <= $days; $x++) {
                    $perDay['transactions'][$x] = 0;
                    $perDay['quantity'][$x] = 0;
                    $perDay['money'][$x] = 0;
                }

                $stats = TransactionTable::getInstance()->getBuyTransactionsStatistic(array('month' => date('m', $month), 'year' => date('Y', $month)));
                
                foreach($stats AS $s) {
                    if (array_key_exists($s['d'], $perDay['transactions'])) {
                        $perDay['transactions'][$s['d']] = $s['total'];
                        $perDay['quantity'][$s['d']] = $s['qty'];
                        $perDay['money'][$s['d']] = -$s['payment'];
                    }
                }
                
                return array(
                    'per_day' => $perDay,
                    'month' =>  $month,
                    'page' => $page,
                    'type'  => $type,
                    'action'    => $action
                );
            break;
        }*/
        
     $q = UserTable::getInstance()->createQuery()
             ->select('id, SUM(wallet) w, SUM(virtual_wallet) as vw')
             ->whereNotIn('id', array(UserTable::BANK_ID))
             ->fetchOne(array(), doctrine::HYDRATE_ARRAY);

        return array(
                    'wallet' => $q['w'],
                    'virtual_wallet' =>  $q['vw'],
            'action'    => $action
                );
    }
}