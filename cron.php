<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
define('ROOT_PATH', dirname(__FILE__));
ini_set('include_path', ROOT_PATH . '/lib');

require_once('Doctrine/Doctrine.php');
spl_autoload_register(array('Doctrine', 'autoload'));
$manager = Doctrine_Manager::getInstance();
//$conn = Doctrine_Manager::connection('mysql://root:12345@localhost/winmaweb2');
//$conn = Doctrine_Manager::connection('mysql://db_user:Yj7CWLC567KtL2o@localhost/city');
$conn = Doctrine_Manager::connection('mysql://root:@localhost/winmaweb');

$conn->setCharset('utf8');

$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);

Doctrine_Core::loadModels(ROOT_PATH . '/models/generated');
Doctrine_Core::loadModels(ROOT_PATH . '/models');
Doctrine_Core::loadModels(ROOT_PATH . '/DQ');

$conn = Doctrine_manager::getInstance()->getCurrentConnection();
$conn->beginTransaction();

try {
    $products = ProductTable::getInstance()->createQuery()
        ->addWhere('is_active = 0')
        ->addWhere('status <> ?', ProductTable::STATUS_VERIFIED)
        ->addWhere('endtime < ?', date('Y-m-d H:i:s'))
        ->limit(5)
        ->execute();
    foreach($products as $product) {
        $tr = TransactionTable::getInstance()->getStandByTransactions(array('product_id' => $product->id));
        $product->status = ProductTable::STATUS_VERIFIED;
        $product->slug = $product->slug . '#expired';
        $product->save();
        //$trCol = new Doctrine_Collection('Transaction');
        foreach($tr as $t) {
            if($t->transaction_type == TransactionTable::$type['buy']) {
                //lets get the coupon
                $coupon = CouponTable::getInstance()->getTransactionCoupon(array('transaction_id' => $t->id));
                if($coupon->id) {
                    $coupon->delete();
                }
                $t->status = TransactionTable::$status['refund'];
                $t->save();
                //TransactionTable::getInstance()->createQuery()->delete()->addWhere('parent_id = ?', $t->get('id'))->execute();
                /*$trChild = TransactionTable::getInstance()->getStandByChildTransactions(array('parent_id' => $t->get('id')));
                foreach($trChild as $cc) {
                    $trChild2 = TransactionTable::getInstance()->getStandByChildTransactions2(array('parent_id' => $cc->get('id')));
                    foreach($trChild2 as $cc2) {
                        $cc2->delete();
                    }
                    $cc->delete();
                }*/
                TransactionTable::getInstance()->createQuery()->delete()->addWhere('parent_id = ?', $t->id)->execute();
                
                //refund transaction
                $refundTran = new Transaction();
                $refundTran->transaction_type = TransactionTable::$type['product-refund'];
                $refundTran->parent_id = $t->id; // parent transaction is the bank share tran
                //the money from
                $refundTran->sender_id = UserTable::BANK_ID;
                $refundTran->receiver_id = $t->sender_id; 
                $refundTran->hint = 'Refund for a product that did not become active after endtime';
                $refundTran->full_payment = abs($t->full_payment);
                $refundTran->status = TransactionTable::$status['ok']; //status standby, as this might be reverted if the deal is not on
                $refundTran->save();
                if($t->transaction_type == 1) {
                    $query = 'UPDATE user SET wallet = wallet + :price WHERE id = :user_id';
                    $result = $conn->execute($query, array('user_id' => $t->sender_id, 'price' => abs($t->full_payment)));
                }
                if($t->transaction_type == 80) {
                    $query = 'UPDATE user SET virtual_wallet = virtual_wallet + :price WHERE id = :user_id';
                    $result = $conn->execute($query, array('user_id' => $t->sender_id, 'price' => abs($t->full_payment)));
                }
            } 

        }
    }
    $conn->commit();
} catch (Exception $e) {
    echo $e->getMessage();
    $conn->rollback();
}

?>