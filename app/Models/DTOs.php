<?php 


class CreatePostDto{
    public string $title;
    public string $body;
    public ?DateTime $published_at;

    public function __construct(string $title, string $body, DateTime $published_at)
    {

      $this->title = $title;
      $this->body = $body;
      $this->published_at = $published_at;  

    }
}