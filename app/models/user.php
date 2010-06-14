<?php
class User extends AppModel {
    var $name = 'User';
    var $displayField = 'fullname';
    var $virtualFields = array('fullname' => "CONCAT(User.first_name, ' ', User.last_name)");

    var $hasMany = array(
        'OrderedProduct' => array(
                'className' => 'OrderedProduct',
                'foreignKey' => 'user_id',
                'dependent' => false,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
        ),
        'MoneyBox' => array(
                'className' => 'MoneyBox',
                'foreignKey' => 'user_id',
                'dependent' => false,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
        )
    );

    var $belongsTo = array('Seller', 'Usergroup');

    var $validate = array(
        'first_name'    => array('rule' => 'notEmpty', 'on' => 'create'),
        'last_name'     => array('rule' => 'notEmpty', 'on' => 'create'),
        'username'      => array('rule' => 'notEmpty', 'on' => 'create'),
        'password'      => array('rule' => 'notEmpty', 'on' => 'create'),
        'email'         => array('rule' => 'notEmpty', 'on' => 'create')
    );

    var $actsAs = array('Containable');

    function beforeSave($options = array()) {
        if(isset($this->data['User']['password']) 
            && $this->data['User']['password'] == Security::hash('', null, true)) {
            unset($this->data['User']['password']);
        } 

        // salvo il nuovo profilo azienda
        if(isset($this->data['Seller'])) {
            if($this->Seller->save($this->data)) {
                $this->data['User'] = am(
                    $this->data['User'],
                    array(
                    'seller_id' => $this->Seller->id,
                    'role' => 2
                    )
                );
            }
        }

        return parent::beforeSave($options);
    }

    function getAdminEmails() {
        $users = $this->find('all', array(
            'conditions' => array(
                'User.active' => 1,
                'User.role < ' => 2),
            'fields' => array('email'),
            'contain' => array()
        ));
        $emails = Set::extract('/User/email', $users);
        return $emails;
    }
}
?>