<?php
use App\Models\Publication;
  function alertsInfos()
    {
        $articles_count = Publication::where('status', 1)->where("publications.type_publication_id", 2)->count();

        if($articles_count === 0){

            return $articles_count;

        }else{

            
            $alert_infos = Publication::where('status', 1)->where("publications.type_publication_id", 2)->get();

            return  $alert_infos;

        }
    }

    
