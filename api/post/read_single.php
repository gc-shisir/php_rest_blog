<?php
    // Define headers
    header('Access-Allow-Control-Origin:*');
    header('Content-Type:application/json');

    include_once('../../models/Post.php');
    include_once('../../config/Database.php');

    // Instantiate database and connect
    $database=new Database();
    $db=$database->connect();
    
    // Instantiate blog post object
    $post=new Post($db);

    // Get id
    $post->id=isset($_GET['id']) ? $_GET['id'] : die();

    // Get Post
    $post->read_single();

    // Create array
    $post_arr=array(
        'id'=>$post->id,
        'title'=>$post->title,
        'body'=>$post->body,
        'author'=>$post->author,
        'category_id'=>$post->category_id,
        'category_name'=>$post->category_name

    );

    // Display as JSON
    echo json_encode($post_arr);



?>