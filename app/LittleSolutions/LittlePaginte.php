<?php

  namespace App\LittleSolutions;

  use Illuminate\Support\Facades\Response;
  use Illuminate\Support\Facades\DB;


  class LittlePaginte
  {
    private $tableName;

    function __construct($table)
    {
        $this->tableName = $table;
    }

    public function LitPaginate($conversationID, $perPages, $pageId)
    {

      $count = DB::table($this->tableName)->count();
      $pageCountRow = $count / $perPages;
      $pageCount = ceil($count / $perPages);
      $skipRows = $pageId * $perPages;

      if($pageId != $pageCount)
      {
        $messages = DB::table($this->tableName)->where('conversation_id', $conversationID)
                                                ->orderBy('created_at', 'DESC')
                                                ->skip($skipRows)->take($perPages)->get();
      }
      else
      {
        $lastRows = $count-$skipRows;
        $messages = DB::table($this->tableName)->where('conversation_id', $conversationID)
                                                ->orderBy('created_at', 'DESC')
                                                ->skip($skipRows)->take($lastRows)->get();
      }

      $reuslts = array(
                        'count' => $count,
                        'pageRowCount' => $pageCountRow,
                        'pageCount' => $pageCount,
                        'messages' => $messages,
                      );

      return json_encode($reuslts , JSON_FORCE_OBJECT);
    }
  }
