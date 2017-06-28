<?php
    class Fork {
     
        public $data = 0;
        public $points = 0;
     
        function __construct($node) {
     
            $this->data = $node;
            $this->points += $node->watchers->totalCount * 2;
            $this->points += $node->stargazers->totalCount * 2;
            $this->points += $node->forks->totalCount * 2;
            $this->points += $node->mentionableUsers->totalCount;
            $this->points += $node->issues->totalCount;
        }
    }

    class ForkFinder {
        
        public $forks = 0;
        public $errors = 0;
        
        function __construct() {
            
            require 'session.php';
            require 'lib/curl-graphql.php';

            //check for User/Name GET data
            $owner = $_GET['owner'];
            $name = $_GET['name'];
            if($owner == "" || $name == "") {
                header("Location: http://caleb.techhounds.com/forks/query.html");
                exit();
            }

            //using library, get curl data from github
            $vars = array("owner"=>$owner, "name"=>$name, "count"=>$forks);
            $json = build_curl(file_get_contents("graphql-query.js"), $vars);
            $curlresult = json_decode(get_curl($token, $json));
            $forks = array();

            //create array of sortable Fork classes
            foreach($curlresult->data->repository->forks->edges as $edge) {
                $fork = new Fork($edge->node);
                if($fork->points > $threshold) {
                    $forks[$fork->data->nameWithOwner] = $fork; 
                }
            }

            //sort array of Fork classes
            uasort($forks, function($a, $b) {
                return $a->points < $b->points;
            });

            //set fields to be accessible
            $this->forks = $forks;
            $this->errors = $curlresult->errors;
        }
    }
?>
