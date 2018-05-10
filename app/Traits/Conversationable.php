<?php
namespace App\Traits;

use Illuminate\Support\Facades\Response;

use App\ReugularConversation;
use App\friendship;
use App\Messsage;
use App\User;
use Auth;

trait Conversationable
{
    public function createOneToOne($id)
    {
        $newConversation = new ReugularConversation;
        $newConversation->name = 'one to one';
        $newConversation->friendship_id = $id;
        $newConversation->save();
    }

    public function getConversations()
    {
        $myID = $this->id;
        $friendships = friendship::where('status', 1)
                                 ->where(function($query) use($myID) {
                                           $query->where('requester', $myID)
                                                 ->orWhere('user_requested', $myID);
                                        })->get();

        foreach ($friendships as $friendship)
        {
            $req = $friendship->requester;
            $user_req = $friendship->user_requested;
            $usersID = ($req != $this->id) ? $req : $user_req;

            $conversation = $friendship->Conversation()->first();

            $userName = User::find($usersID)->name;

            if($conversation->name == "one to one")
                $convName = $userName;

            $conversations[] = array(
                                      'userID' => $usersID,
                                      'userName' => $userName,
                                      'conversationID' => $conversation->id,
                                      'conversationName' => $convName,
                                    );
        }


        return (isset($conversations)) ? $conversations : Response::json('No one like you.',204);;
    }

    public function sendMessage($request)
    {
       $friendID = $request['friendUserID'];
       $message =  $request['message'];
       $convID = $request['convID'];
       
       $verif = friendship::where(function ($query) use($friendID)
                           {
                             $query->where(function ($query) use($friendID)
                                     {
                                       $query->where('requester', $this->id)
                                             ->Where('user_requested', $friendID);
                                     })
                                     ->orWhere(function ($query) use($friendID)
                                     {
                                       $query->where('requester', $friendID)
                                             ->Where('user_requested',  $this->id);
                                     });
                           })
                           ->where('status',1)->get();

        if(isset($verif))
        {
          $newMessage = new Messsage;
          $newMessage->body = $message;
          $newMessage->user_id = $this->id;
          $newMessage->conversation_id = $convID;
          $newMessage->save();
          return 'friendship exists';
        }
        else
        {
          return 'friendship doesnt exists';
        }

       return $request;
    }

}

?>
