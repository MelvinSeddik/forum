<?php

namespace Model\Manager;

use App\AbstractManager;

class SearchManager extends AbstractManager
{

    public function findResults($search)
    {

        $sql = "SELECT * FROM Topic t 
        WHERE title LIKE '%:search%'";

        $search = filter_var($search, FILTER_SANITIZE_STRING);

        return self::select($sql, [":search"=> $search], true);

    }
}

?>