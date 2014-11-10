<?php

     App::uses('AppController', 'Controller');

     /**
      * Transactions Controller
      *
      * @property Transaction $Transaction
      * @property PaginatorComponent $Paginator
      */
     class TransactionsController extends AppController {

         /**
          * Components
          *
          * @var array
          */
         public $components = array('Paginator');

         /**
          * index method
          *
          * @return void
          */
         public function index() {
             $userId = $this->Session->read('Auth.User.id'); 
             $this->Transaction->recursive = 0;
             $this->set('transactions', $this->paginate(
                                 'Transaction', array(
                                         'Transaction.user_id'=>$userId
                                 )
             ));
         }

         /**
          * view method
          *
          * @throws NotFoundException
          * @param string $id
          * @return void
          */
         public function view($id = null) {
             if (!$this->Transaction->exists($id)) {
                 throw new NotFoundException(__('Invalid transaction'));
             }
             $options = array('conditions' => array('Transaction.' . $this->Transaction->primaryKey => $id));
             $this->set('transaction', $this->Transaction->find('first', $options));
         }

         /**
          * add method
          *
          * @return void
          */
         public function add() {
             if ($this->request->is('post')) {
                 $this->Transaction->create();
                 if ($this->Transaction->save($this->request->data)) {
                     $this->Session->setFlash(__('The transaction has been saved'), 'flash/success');
                     $this->redirect(array('action' => 'index'));
                 } else {
                     $this->Session->setFlash(__('The transaction could not be saved. Please, try again.'), 'flash/error');
                 }
             }
             $users = $this->Transaction->User->find('list');
             $transactionsTypes = $this->Transaction->TransactionsType->find('list');
             $accounts = $this->Transaction->Account->find('list');
             $categoriesTypes = $this->Transaction->CategoriesType->find('list');
             $originsDestinations = $this->Transaction->OriginsDestination->find('list');
             $this->set(compact('users', 'transactionsTypes', 'accounts', 'categoriesTypes', 'originsDestinations'));
         }

         /**
          * edit method
          *
          * @throws NotFoundException
          * @param string $id
          * @return void
          */
         public function edit($id = null) {
             $this->Transaction->id = $id;
             if (!$this->Transaction->exists($id)) {
                 throw new NotFoundException(__('Invalid transaction'));
             }
             if ($this->request->is('post') || $this->request->is('put')) {
                 if ($this->Transaction->save($this->request->data)) {
                     $this->Session->setFlash(__('The transaction has been saved'), 'flash/success');
                     $this->redirect(array('action' => 'index'));
                 } else {
                     $this->Session->setFlash(__('The transaction could not be saved. Please, try again.'), 'flash/error');
                 }
             } else {
                 $options = array('conditions' => array('Transaction.' . $this->Transaction->primaryKey => $id));
                 $this->request->data = $this->Transaction->find('first', $options);
             }
             $users = $this->Transaction->User->find('list');
             $transactionsTypes = $this->Transaction->TransactionsType->find('list');
             $accounts = $this->Transaction->Account->find('list');
             $categoriesTypes = $this->Transaction->CategoriesType->find('list');
             $originsDestinations = $this->Transaction->OriginsDestination->find('list');
             $this->set(compact('users', 'transactionsTypes', 'accounts', 'categoriesTypes', 'originsDestinations'));
         }

         /**
          * delete method
          *
          * @throws NotFoundException
          * @throws MethodNotAllowedException
          * @param string $id
          * @return void
          */
         public function delete($id = null) {
             if (!$this->request->is('post')) {
                 throw new MethodNotAllowedException();
             }
             $this->Transaction->id = $id;
             if (!$this->Transaction->exists()) {
                 throw new NotFoundException(__('Invalid transaction'));
             }
             if ($this->Transaction->delete()) {
                 $this->Session->setFlash(__('Transaction deleted'), 'flash/success');
                 $this->redirect(array('action' => 'index'));
             }
             $this->Session->setFlash(__('Transaction was not deleted'), 'flash/error');
             $this->redirect(array('action' => 'index'));
         }

     }
     
