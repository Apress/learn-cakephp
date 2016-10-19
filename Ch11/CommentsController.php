<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent(
            'Auth',
            [
                'loginRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ]
            ]
        );
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Posts']
        ];
        $comments = $this->paginate($this->Comments);

        $this->set(compact('comments'));
        $this->set('_serialize', ['comments']);
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Users', 'Posts']
        ]);

        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity(
                $comment,
                $this->request->data
            );
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(
                    __('The comment could not be saved. Please, try again.')
                );
            }
        }
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $posts = $this->Comments->Posts->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'users', 'posts'));
        $this->set('_serialize', ['comment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            }
        }
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $posts = $this->Comments->Posts->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'users', 'posts'));
        $this->set('_serialize', ['comment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
