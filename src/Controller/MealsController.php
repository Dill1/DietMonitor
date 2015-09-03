<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Meals Controller
 *
 * @property \App\Model\Table\MealsTable $Meals
 */
class MealsController extends AppController
{
	
	public function range() {
		$fromDate = $this->request->query('from_date');
		$toDate = $this->request->query('to_date');
		$fromTime = $this->request->query('from_time');
		$toTime = $this->request->query('to_time');

		$meals = $this->Meals->find('range', [
				'fromDate' => $fromDate,
				'toDate' => $toDate,
				'fromTime' => $fromTime,
				'toTime' => $toTime,
				'user_id' => $this->Auth->user('id')
		]);
		
		// Pass variables into the view template context.
		$this->set([
				'meals' => $meals,
		]);
		
		$this->set('_serialize', ['meals']);
	}
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
    	$this->paginate = [
    		'conditions' => [
	   			'Meals.user_id' => $this->Auth->user('id'),
    		]
    	];
    	
        $this->set([
        		'meals' => $this->paginate($this->Meals),
				'username' => $this->Auth->user('name'),
        		'usertotal' => $this->Auth->user('exp_num_calories')
        ]);
        $this->set('_serialize', ['meals']);
    }

    /**
     * View method
     *
     * @param string|null $id Meal id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $meal = $this->Meals->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('meal', $meal);
        $this->set('_serialize', ['meal']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $meal = $this->Meals->newEntity();
        if ($this->request->is('post')) {
        	$meal = $this->Meals->patchEntity($meal, $this->request->data);
        	$meal->user_id = $this->Auth->user('id');
			if ($this->Meals->save($meal)) {
                $this->Flash->success(__('The meal has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meal could not be saved. Please, try again.'));
            }
        }
        $users = $this->Meals->Users->find('list', ['limit' => 200]);
        $this->set(compact('meal', 'users'));
        $this->set('_serialize', ['meal']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Meal id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $meal = $this->Meals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $meal = $this->Meals->patchEntity($meal, $this->request->data);
			$meal->user_id = $this->Auth->user('id');
			if ($this->Meals->save($meal)) {
                $this->Flash->success(__('The meal has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meal could not be saved. Please, try again.'));
            }
        }
        $users = $this->Meals->Users->find('list', ['limit' => 200]);
        $this->set(compact('meal', 'users'));
        $this->set('_serialize', ['meal']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Meal id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $meal = $this->Meals->get($id);
        if ($this->Meals->delete($meal)) {
            $this->Flash->success(__('The meal has been deleted.'));
        } else {
            $this->Flash->error(__('The meal could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
