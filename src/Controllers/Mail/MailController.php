<?php

namespace App\Controllers\Mail;

use App\Controllers\Controller;
use App\Models\Message;
use App\Models\User;

class MailController extends Controller
{
    /**
     * Render received messages
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function getReceivedMessages($request, $response)
    {
        $messages = Message::where([
            'to' => $_SESSION['user'],
            'type' => 1,
        ])->get();
        
        $this->view->getEnvironment()->addGlobal('messages', $messages);
        
        return $this->view->render($response, 'mail/received.twig');
    }
    
    /**
     * Render sent messages
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function getSentMessages($request, $response)
    {
        $messages = Message::where([
            'from' => $_SESSION['user'],
            'type' => 2,
        ])->get();
        
        $this->view->getEnvironment()->addGlobal('messages', $messages);
        
        return $this->view->render($response, 'mail/sent.twig');
    }
    
    /**
     * Render new message form
     *
     * @param Request $request
     * @param Response $response
     * @return View
     */
    public function getNew($request, $response)
    {
        return $this->view->render($response, 'mail/new.twig');
    }
    
    /**
     * Check if 
     * 
     * @param type $user
     * @return boolean
     */
    private function validateUserObject($nickname)
    {
        $user = User::where('nickname', $nickname);
        
        if ($user->count() === 0) {
            return false;
        }
        
        if ($user->first()->id == $_SESSION['user']) {
            return false;
        }
        
        return true;
    }

    /**
     * Render new message form with nickname parameter
     *
     * @param Request $request
     * @param Response $response
     * @param Array $args
     * @return View
     */
    public function getNewWithNickname($request, $response, $args)
    {
        if ($this->validateNickname($args['nickname'])) {
            $this->view->getEnvironment()->addGlobal('nickname', $args['nickname']);
        }
        
        return $this->view->render($response, 'mail/new.twig');
    }
    
    /**
     * Send message from one player to another
     *
     * @param Integer $sender
     * @param Integer $receiver
     * @param String $subject
     * @param String $content
     * @return void
     */
    private function sendNewMessage($sender, $receiver, $subject, $content)
    {
        $mailto = Message::create([
            'from' => $sender,
            'to' => $receiver,
            'subject' => $subject,
            'content' => $content,
            'status' => 1, // Status "1" is not viewed
            'type' => 1, // Message type "1" is for receiver
        ]);
        
        $mailfrom = Message::create([
            'from' => $sender,
            'to' => $receiver,
            'subject' => $subject,
            'content' => $content,
            'status' => 0,
            'type' => 2, // Message type "2" is for sender
        ]);
    }
    
    /**
     * Try to send message
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function postNew($request, $response)
    {
        if ($this->validator->validateNewMail($request)->getErrorsCount() > 0) {
            $_SESSION['errors'] = $this->validator->getErrors();
            return $response->withRedirect($this->router->pathFor('mail.new'));
        }
        
        $to = User::where('nickname', $request->getParam('to'))->first();
        
        if (!$to) {
            $this->flash->addMessage('danger', 'Nie udało się odnaleźć gracza o tym nicku.');
            return $response->withRedirect($this->router->pathFor('mail.new'));
        }
        
        $this->sendNewMessage($this->auth->user()->id, $To->id, $request->getParam('subject'), $request->getParam('content'));
        $this->flash->addMessage('success', 'Wiadomość została wysłana');

        return $response->withRedirect($this->router->pathFor('mail.sent'));
    }
    
    /**
     * Try to delete message
     * 
     * @param Request $request
     * @param Response $response
     * @return void
     */
    private function deleteMessage($request, $response, $args) {
        $msg = Message::find($args['id']);
        
        if (!msg) {
            $this->flash->addMessage('danger', 'Podana wiadomość nie istnieje.');
            return;
        }
        
        if ($msg->from == $_SESSION['user'] && $msg->type == 2) {
            $msg->delete();
            $this->flash->addMessage('success', 'Wiadomość usunięta.');
            return;
        }
        
        if ($msg->to == $_SESSION['user'] && $msg->type == 1) {
            $msg->delete();
            $this->flash->addMessage('success', 'Wiadomość usunięta.');
            return;
        }
        
        $this->flash->addMessage('danger', 'Podana wiadomość nie istnieje.');
        return;
    }
    
    /**
     * Try to delete received message
     * 
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getDeleteReceived($request, $response, $args) {
        $this->deleteMessage($request, $response, $args);
        return $response->withRedirect($this->router->pathFor('mail.received'));
    }
    
    /**
     * Try to delete sent message
     * 
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getDeleteSent($request, $response, $args) {
        $this->deleteMessage($request, $response, $args);
        return $response->withRedirect($this->router->pathFor('mail.sent'));
    }
}
