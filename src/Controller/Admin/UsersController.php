<?php
namespace Rita\Users\Controller\Admin;

use Rita\Users\Controller\AppController;

/**
 * Users Controller
 *
 * @property \RitaUsers\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Users->find('all')->contain(['Roles' => ['fields' => ['id','name']]]);
        $this->set('users', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id User id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
        'contain' => []
        ]);
        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $user = $this->Users->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('شکست در عملیات!!! لطفا مجدد سعی نمایید.');
            }
        }
        $roles = $this->Users->Roles->find('list');
        $this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
        'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('عملیات ویرایش با موفقیت انجام شد.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('شکست در عملیات!!! لطفا مجدد سعی نمایید.');
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Users->delete($user)) {
            $this->Flash->success('عملیات حذف با موفقیت انجام شد.');
        } else {
            $this->Flash->error('شکست در عملیات!!! لطفا مجدد سعی نمایید.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
