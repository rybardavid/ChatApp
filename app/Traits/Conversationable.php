<?php
namespace App\Traits;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Conversation;
use App\User;
use Auth;

trait Conversationable
{
    public function createOneToOne($id)
    {
        $attachedUser[] = Auth::user();
        $attachedUser[] = User::where('id', $id)->first();

        $newConversation = new Conversation;
        $newConversation->name = 'Classic chat one to one';
        $newConversation->save();

        $attachedUser[0]->Conversations()->attach($newConversation->id);

        if(User::where('id', $id)->exists())
        {
            $attachedUser[1]->Conversations()->attach($newConversation->id);
            return true;
        }
        else
        {
            $attachedUser[0]->Conversations()->where('id', $newConversation->id)->delete();
            return false;
        }

    }

    public function getConversation($userID)
    {       

    }
}

?>
