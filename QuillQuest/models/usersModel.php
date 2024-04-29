<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usersModel
 *
 * @author Sandra
 */
final class usersModel extends baseModel {

    private $user_id = 0;
    private $email = '';
    private $name = '';
    private $lastname = '';
    private $password = '';
    private $role = 0;
    private $active = 0;
    private $username = '';
    private $address = '';
    private $photo = '';
    private $phone = '';
    private $dni = '';
    private $attempts = 0;
    private $blocked = 0;
    private $date_created = '';
    private $date_last_login = '';
    private $date_last_modify = '';
    private $created_by = '';
    private $modified_by = '';
    private $deleted = 0;
    private $deleted_by = '';
    private $date_deleted = '';
    private $who_login = '';
    private $hash_remember = '';

    function __construct() {

	parent::__construct();
	parent::setTable('wi_users');
    }

    public function select($where = '', $as = '', $select = '*', $join = '') {
	return parent::select($where, $as, $select, $join);
    }

    public function selectPagination($where = '', $join = '', $order = '', $limit = '', $select = '*',$group='') {
	return parent::selectPagination($where, $join, $order, $limit, $select,$group);
    }

    public function delete($where) {
	return parent::delete($where);
    }

    public function add($indices = '', $valores = '') {

	$first = true;

	if (!empty($this->email)) {
	    if ($first) {
		$indices .= "email";
		$valores .= "'" . $this->email . "'";
		$first = false;
	    } else {
		$indices .= ",email";
		$valores .= ",'" . $this->email . "'";
	    }
	}

	if (!empty($this->name)) {
	    if ($first) {
		$indices .= "name";
		$valores .= "'" . $this->name . "'";
		$first = false;
	    } else {
		$indices .= ",name";
		$valores .= ",'" . $this->name . "'";
	    }
	}

	if (!empty($this->lastname)) {
	    if ($first) {
		$indices .= "lastname";
		$valores .= "'" . $this->lastname . "'";
		$first = false;
	    } else {
		$indices .= ",lastname";
		$valores .= ",'" . $this->lastname . "'";
	    }
	}

	if (!empty($this->password)) {
	    if ($first) {
		$indices .= "password";
		$valores .= "'" . $this->password . "'";
		$first = false;
	    } else {
		$indices .= ",password";
		$valores .= ",'" . $this->password . "'";
	    }
	}
	

	if (!empty($this->role)) {
	    if ($first) {
		$indices .= "role";
		$valores .= $this->role;
		$first = false;
	    } else {
		$indices .= ",role";
		$valores .= "," . $this->role;
	    }
	}
	
	
	if (!empty($this->dni)) {
	    if ($first) {
		$indices .= "dni";
		$valores .= "'" . $this->dni . "'";
		$first = false;
	    } else {
		$indices .= ",dni";
		$valores .= ",'" . $this->dni . "'";
	    }
	}


	if (!empty($this->address)) {
	    if ($first) {
		$indices .= "address";
		$valores .= "'" . $this->address . "'";
		$first = false;
	    } else {
		$indices .= ",address";
		$valores .= ",'" . $this->address . "'";
	    }
	}
	
	
	if (!empty($this->photo)) {
	    if ($first) {
		$indices .= "photo";
		$valores .= "'" . $this->photo . "'";
		$first = false;
	    } else {
		$indices .= ",photo";
		$valores .= ",'" . $this->photo . "'";
	    }
	}
	
	if (!empty($this->phone)) {
	    if ($first) {
		$indices .= "phone";
		$valores .= "'" . $this->phone . "'";
		$first = false;
	    } else {
		$indices .= ",phone";
		$valores .= ",'" . $this->phone . "'";
	    }
	}
	
	
	if (!empty($this->username)) {
	    if ($first) {
		$indices .= "username";
		$valores .= "'" . $this->username . "'";
		$first = false;
	    } else {
		$indices .= ",username";
		$valores .= ",'" . $this->username . "'";
	    }
	}
	

	if (!empty($this->attempts)) {
	    if ($first) {
		$indices .= "attempts";
		$valores .= $this->attempts;
		$first = false;
	    } else {
		$indices .= ",attempts";
		$valores .= "," . $this->attempts;
	    }
	}
	
	if (!empty($this->blocked)) {
	    if ($first) {
		$indices .= "blocked";
		$valores .= $this->blocked;
		$first = false;
	    } else {
		$indices .= ",blocked";
		$valores .= "," . $this->blocked;
	    }
	}
	
		
	if (!empty($this->date_created)) {
	    if ($first) {
		$indices .= "date_created";
		$valores .= "'" . $this->date_created . "'";
		$first = false;
	    } else {
		$indices .= ",date_created";
		$valores .= ",'" . $this->date_created . "'";
	    }
	}
	
	if (!empty($this->date_last_login)) {
	    if ($first) {
		$indices .= "date_last_login";
		$valores .= "'" . $this->date_last_login . "'";
		$first = false;
	    } else {
		$indices .= ",date_last_login";
		$valores .= ",'" . $this->date_last_login . "'";
	    }
	}
	
	if (!empty($this->created_by)) {
	    if ($first) {
		$indices .= "created_by";
		$valores .= "'" . $this->created_by . "'";
		$first = false;
	    } else {
		$indices .= ",created_by";
		$valores .= ",'" . $this->created_by . "'";
	    }
	}
	
	
	if (!empty($this->deleted)) {
	    if ($first) {
		$indices .= "deleted";
		$valores .= $this->deleted;
		$first = false;
	    } else {
		$indices .= ",deleted";
		$valores .= "," . $this->deleted;
	    }
	}
	
	if (!empty($this->deleted_by)) {
	    if ($first) {
		$indices .= "deleted_by";
		$valores .= "'" . $this->deleted_by . "'";
		$first = false;
	    } else {
		$indices .= ",deleted_by";
		$valores .= ",'" . $this->deleted_by . "'";
	    }
	}
	
	if (!empty($this->date_deleted)) {
	    if ($first) {
		$indices .= "date_deleted";
		$valores .= "'" . $this->date_deleted . "'";
		$first = false;
	    } else {
		$indices .= ",date_deleted";
		$valores .= ",'" . $this->date_deleted . "'";
	    }
	}
	
	if (!empty($this->who_login)) {
	    if ($first) {
		$indices .= "who_login";
		$valores .= "'" . $this->who_login . "'";
		$first = false;
	    } else {
		$indices .= ",who_login";
		$valores .= ",'" . $this->who_login . "'";
	    }
	}
	
	if (!empty($this->hash_remember)) {
	    if ($first) {
		$indices .= "hash_remember";
		$valores .= "'" . $this->hash_remember . "'";
		$first = false;
	    } else {
		$indices .= ",hash_remember";
		$valores .= ",'" . $this->hash_remember . "'";
	    }
	}

	if ($first) {
	    $indices .= "active";
	    $valores .= $this->active;
	    $first = false;
	} else {
	    $indices .= ",active";
	    $valores .= "," . $this->active;
	}

	return parent::add($indices, $valores);
    }

    public function update($campos = '', $where = '') {

	$where = 'user_id=' . $this->user_id;
	$first = true;

	if (!empty($this->email)) {
	    if ($first) {
		$campos .= " email='" . $this->email . "'";
		$first = false;
	    } else {
		$campos .= ", email='" . $this->email . "'";
	    }
	}
	
	if (!empty($this->name)) {
	    if ($first) {
		$campos .= " name='" . $this->name . "'";
		$first = false;
	    } else {
		$campos .= ", name='" . $this->name . "'";
	    }
	}
	
	if (!empty($this->lastname)) {
	    if ($first) {
		$campos .= " lastname='" . $this->lastname . "'";
		$first = false;
	    } else {
		$campos .= ", lastname='" . $this->lastname . "'";
	    }
	}
	
	if (!empty($this->password)) {
	    if ($first) {
		$campos .= " password='" . $this->password . "'";
		$first = false;
	    } else {
		$campos .= ", password='" . $this->password . "'";
	    }
	}
	

	if (!empty($this->role)) {
	    if ($first) {
		$campos .= " role=" . $this->role;
		$first = false;
	    } else {
		$campos .= ", role=" . $this->role;
	    }
	}
	
	if (!empty($this->active)) {
	    if ($first) {
		$campos .= " active=$this->active";
		$first = false;
	    } else {
		$campos .= ", active=$this->active";
	    }
	}

	if (!empty($this->dni)) {
	    if ($first) {
		$campos .= " dni='" . $this->dni . "'";
		$first = false;
	    } else {
		$campos .= ", dni='" . $this->dni . "'";
	    }
	}
	

	
	if (!empty($this->address)) {
	    if ($first) {
		$campos .= " address='" . $this->address . "'";
		$first = false;
	    } else {
		$campos .= ", address='" . $this->address . "'";
	    }
	}	

	if (!empty($this->photo)) {
	    if ($first) {
		$campos .= " photo='" . $this->photo . "'";
		$first = false;
	    } else {
		$campos .= ", photo='" . $this->photo . "'";
	    }
	}

	
	if (!empty($this->phone)) {
	    if ($first) {
		$campos .= " phone='" . $this->phone . "'";
		$first = false;
	    } else {
		$campos .= ", phone='" . $this->phone . "'";
	    }
	}

	
	if (!empty($this->username)) {
	    if ($first) {
		$campos .= " username='" . $this->username . "'";
		$first = false;
	    } else {
		$campos .= ", username='" . $this->username . "'";
	    }
	}

	
	if (!empty($this->date_last_modify)) {
	    if ($first) {
		$campos .= " date_last_modify='" . $this->date_last_modify . "'";
		$first = false;
	    } else {
		$campos .= ", date_last_modify='" . $this->date_last_modify . "'";
	    }
	}
	
	if (!empty($this->date_last_login)) {
	    if ($first) {
		$campos .= " date_last_login='" . $this->date_last_login . "'";
		$first = false;
	    } else {
		$campos .= ", date_last_login='" . $this->date_last_login . "'";
	    }
	}
	
	if (!empty($this->date_deleted)) {
	    if ($first) {
		$campos .= " date_deleted='" . $this->date_deleted . "'";
		$first = false;
	    } else {
		$campos .= ", date_deleted='" . $this->date_deleted . "'";
	    }
	}
	
	if (!empty($this->modified_by)) {
	    if ($first) {
		$campos .= " modified_by='" . $this->modified_by . "'";
		$first = false;
	    } else {
		$campos .= ", modified_by='" . $this->modified_by . "'";
	    }
	}
	
	if (!empty($this->deleted_by)) {
	    if ($first) {
		$campos .= " deleted_by='" . $this->deleted_by . "'";
		$first = false;
	    } else {
		$campos .= ", deleted_by='" . $this->deleted_by . "'";
	    }
	}
	if (!empty($this->who_login)) {
	    if ($first) {
		$campos .= " who_login='" . $this->who_login . "'";
		$first = false;
	    } else {
		$campos .= ", who_login='" . $this->who_login . "'";
	    }
	}
	
	if (!empty($this->hash_remember)) {
	    if ($first) {
		$campos .= " hash_remember='" . $this->hash_remember . "'";
		$first = false;
	    } else {
		$campos .= ", hash_remember='" . $this->hash_remember . "'";
	    }
	}
	

	

	return parent::update($campos, $where);
    }

    function updateActive() {

	$where = 'user_id=' . $this->user_id;

	$campos = " active=" . $this->active;
	
	if (!empty($this->modified_by)) {
	    $campos .= ", modified_by='" . $this->modified_by . "'";
	}
	
	if (!empty($this->date_last_modify)) {
	    $campos .= ", date_last_modify='" . $this->date_last_modify . "'";
	}

	return parent::update($campos, $where);
    }
    
    function updateUsername() {

	$where = 'user_id=' . $this->user_id;

	$campos = " username='" . $this->username."'";

	return parent::update($campos, $where);
    }

    function updatePassword() {

	$where = 'user_id=' . $this->user_id;
	$campos = " password='" . $this->password . "'";
	
	if (!empty($this->modified_by)) {
	    $campos .= ", modified_by='" . $this->modified_by . "'";
	}
	
	if (!empty($this->date_last_modify)) {
	    $campos .= ", date_last_modify='" . $this->date_last_modify . "'";
	}

	return parent::update($campos, $where);
    }

    function updateAttempts(){
	
	$where = 'user_id=' . $this->user_id;

	$campos = " attempts=" . $this->attempts;

	return parent::update($campos, $where);
	
    }

    function updateBlocked(){
	
	$where = 'user_id=' . $this->user_id;

	$campos = " attempts=" . $this->attempts.",blocked=".$this->blocked;
	
	if (!empty($this->modified_by)) {
	    $campos .= ", modified_by='" . $this->modified_by . "'";
	}
	
	if (!empty($this->date_last_modify)) {
	    $campos .= ", date_last_modify='" . $this->date_last_modify . "'";
	}

	return parent::update($campos, $where);
	
    }
    
    function updateDeleted(){
	
	
	$where = 'user_id=' . $this->user_id;

	$campos = " deleted=" . $this->deleted.",date_deleted='".$this->date_deleted."',deleted_by='".$this->deleted_by."',active=$this->active";

	return parent::update($campos, $where);
	
    }

    function updateLastLogin(){
	
	$where = 'user_id=' . $this->user_id;

	$campos = "date_last_login='".$this->date_last_login."'";

	return parent::update($campos, $where);
	
    }
    

    public function getUser_id() {
        return $this->user_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getActive() {
        return $this->active;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getAttempts() {
        return $this->attempts;
    }

    public function getBlocked() {
        return $this->blocked;
    }

    public function getDate_created() {
        return $this->date_created;
    }

    public function getDate_last_login() {
        return $this->date_last_login;
    }

    public function getDate_last_modify() {
        return $this->date_last_modify;
    }

    public function getCreated_by() {
        return $this->created_by;
    }

    public function getModified_by() {
        return $this->modified_by;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function getDeleted_by() {
        return $this->deleted_by;
    }

    public function getDate_deleted() {
        return $this->date_deleted;
    }

    public function getWho_login() {
        return $this->who_login;
    }

    public function getHash_remember() {
        return $this->hash_remember;
    }

    public function setUser_id($user_id): void {
        $this->user_id = $user_id;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setLastname($lastname): void {
        $this->lastname = $lastname;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setRole($role): void {
        $this->role = $role;
    }

    public function setActive($active): void {
        $this->active = $active;
    }

    public function setUsername($username): void {
        $this->username = $username;
    }

    public function setAddress($address): void {
        $this->address = $address;
    }

    public function setPhoto($photo): void {
        $this->photo = $photo;
    }

    public function setPhone($phone): void {
        $this->phone = $phone;
    }

    public function setDni($dni): void {
        $this->dni = $dni;
    }

    public function setAttempts($attempts): void {
        $this->attempts = $attempts;
    }

    public function setBlocked($blocked): void {
        $this->blocked = $blocked;
    }

    public function setDate_created($date_created): void {
        $this->date_created = $date_created;
    }

    public function setDate_last_login($date_last_login): void {
        $this->date_last_login = $date_last_login;
    }

    public function setDate_last_modify($date_last_modify): void {
        $this->date_last_modify = $date_last_modify;
    }

    public function setCreated_by($created_by): void {
        $this->created_by = $created_by;
    }

    public function setModified_by($modified_by): void {
        $this->modified_by = $modified_by;
    }

    public function setDeleted($deleted): void {
        $this->deleted = $deleted;
    }

    public function setDeleted_by($deleted_by): void {
        $this->deleted_by = $deleted_by;
    }

    public function setDate_deleted($date_deleted): void {
        $this->date_deleted = $date_deleted;
    }

    public function setWho_login($who_login): void {
        $this->who_login = $who_login;
    }

    public function setHash_remember($hash_remember): void {
        $this->hash_remember = $hash_remember;
    }


    
}
