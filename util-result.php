<?php
    class Fork {
        public $data = 0;
        public $points = 0;
        function __construct($node) {
            $this->data = $node;
            $this->points += $node->watchers->totalCount;
            $this->points += $node->stargazers->totalCount;
            $this->points += $node->mentionableUsers->totalCount;
            $this->points += $node->issues->totalCount;
        }
    }

    class ForkFinder {
        
        public $forks = 0;
        public $errors = 0;
        
        function __construct() {
            
            session_start();
            require 'lib/curl-graphql.php';

            $token = $_SESSION['token'];
            if($token == "") {
                header("Location: http://caleb.techhounds.com/forks/auth.php");
                exit();
            }

            $owner = $_GET['owner'];
            $name = $_GET['name'];
            if($owner == "" || $name == "") {
                header("Location: http://caleb.techhounds.com/forks/query.html");
                exit();
            }

            $vars = json_encode(array("owner"=>$owner, "name"=>$name));
            $json = build_curl(file_get_contents("query.js"), $vars);
            $forks = json_decode(get_curl($token, $json));
            $sorted_forks = array();

            foreach($forks->data->repository->forks->edges as $edge) {
                $fork = new Fork($edge->node);
                $sorted_forks[$fork->data->nameWithOwner] = $fork; 
            }
            
            uasort($sorted_forks, function($a, $b)
            {
                return $a->points < $b->points;
            });

            $this->forks = $sorted_forks;
            $this->errors = $forks->errors;
        }
    }
?>
