<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Users']
        ];
        $posts = $this->paginate($this->Posts);

        $this->set(compact('posts'));
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     *    When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Categories', 'Users', 'Tags', 'Comments']
        ]);

        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful
     *    add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity(
                $post, 
                $this->request->data
            );
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(
                    __('The post not saved. Please, try again.')
                );
            }
        }
        $categories = $this->Posts->Categories
            ->find('list', ['limit' => 200]);
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $tags = $this->Posts->Tags->find('list', ['limit' => 200]);
        $this->set(compact('post', 'categories', 'users', 'tags'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|void Redirects 
     *      on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException 
     *      When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity(
                $post, 
                $this->request->data
            );
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(
                    __('The post not saved. Please, try again.')
                );
            }
        }
        $categories = $this->Posts->Categories
            ->find('list', ['limit' => 200]);
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $tags = $this->Posts->Tags->find('list', ['limit' => 200]);
        $this->set(compact('post', 'categories', 'users', 'tags'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException 
     *      When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(
                __('The post could not be deleted. Please, try again.')
            );
        }
        return $this->redirect(['action' => 'index']);
    }
}
