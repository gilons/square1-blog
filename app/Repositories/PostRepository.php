<?php
namespace App\Repositories;

use GuzzleHttp\Client;

class PostRepository
{

    private function apiClient()
    {
        $client = new Client();
        $response = $client->get(config('constants.remote_posts'));
        $response = (string) $response->getBody();
        return $response;

    }

    public static function fetchPosts(){
        $self = new Self();
        $response = $self->apiClient();
        $response = json_decode($response,true);
        return $response['data'];
    }



}
