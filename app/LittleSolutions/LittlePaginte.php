<?php

  namespace App\LittleSolutions;

  use Illuminate\Support\Facades\DB;

  class LittlePaginte
  {
    private $tableName;

    function __construct($table)
    {
        $this->tableName = $table;
    }

    public function LitPaginate($conversationID)
    {
      return DB::table($this->tableName)->where('conversation_id', $conversationID)->get();
    }
  }
