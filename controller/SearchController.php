<?php

namespace Controller;

use Model\Manager\SearchManager;

class SearchController
{



    public function getSearchResults($post)
    {

        $search = $post["search"];
        $searchModel = new SearchManager;
        $results = $searchModel->findResults($search);


        return 
        [
            "view"=> "searchResults.php",
            "data"=> $results
        ];
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>