<?php
namespace RitaUsers\Controller;

use RitaUsers\Controller\AppController;

/**
 * UserRoles Controller
 *
 * @property \RitaUsers\Model\Table\UserRolesTable $UserRoles
 */
class UserRolesController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('userRoles', $this->paginate($this->UserRoles));
	}

/**
 * View method
 *
 * @param string|null $id User Role id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$userRole = $this->UserRoles->get($id, [
			'contain' => []
		]);
		$this->set('userRole', $userRole);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$userRole = $this->UserRoles->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->UserRoles->save($userRole)) {
				$this->Flash->success('The user role has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user role could not be saved. Please, try again.');
			}
		}
		$this->set(compact('userRole'));
	}

/**
 * Edit method
 *
 * @param string|null $id User Role id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$userRole = $this->UserRoles->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$userRole = $this->UserRoles->patchEntity($userRole, $this->request->data);
			if ($this->UserRoles->save($userRole)) {
				$this->Flash->success('The user role has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user role could not be saved. Please, try again.');
			}
		}
		$this->set(compact('userRole'));
	}

/**
 * Delete method
 *
 * @param string|null $id User Role id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$userRole = $this->UserRoles->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->UserRoles->delete($userRole)) {
			$this->Flash->success('The user role has been deleted.');
		} else {
			$this->Flash->error('The user role could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}
