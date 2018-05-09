<?php
namespace App\Traits;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

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
        $friendships = friendship::where('requester', $this->id)->orWhere('user_requested', $this->id)->get();

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


        return $conversations;
    }


    /*public function SaveMessage($conversationId)
    {
        //$conversation = ReugularConversation::where('id', $conversationId)->first();


    }

    public function testMsg()
    {
        $convId = 4;
        $message = "fhdsuifndsnfj dfs ndsihfnusdinfi fhdsui";

        $conv = ReugularConversation::where('id', $convId)->first();

        if(isset($conv))
        {
           $status = $conv->Friendship()->pluck('status');
           $status = (integer)$status[0];

           if($status)
           {
              $message = new Messsage;
              $message->user_id = Auth::id();
              $message->conversation_id = $convId;
              $message->body = "jkurvap ico";
              $message->save();
              return Response::json('message was sent',200);
           }
           else
           {
             return Response::json('Friendship doesnt exists.',202);
           }
        }
        else
        {
           return Response::json('Friendship doesnt exists.',202);
        }

        $friendship = $conv->Friendship()->get();

        return $friendship;
    }*/

}

?>
