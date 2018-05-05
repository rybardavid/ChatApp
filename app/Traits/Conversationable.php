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
        $attachedUser[] = User::where('id', $id)->get();
        return $attachedUser;

        $newConversation = new Conversation;
        $newConversation->name = 'Classic chat one to one';
        $newConversation->save();

        //$attachedUser = User::where('id', $this->id)->get();

        $attachedUser->Conversations()->attach($newConversation->id);

        if(User::where('id', $id)->exists())
        {
            $attachedUser = User::where('id', $id)->get();
            $attachedUser->Conversations()->attach($newConversation->id);
            return true;
        }
        else
        {
            $attachedUser->Conversations()->where('id', $newConversation->id)->delete();
            return false;
        }

    }

    public function testMore($id)
    {
      return User::where('id', $id)->get();
    }
}

?>
