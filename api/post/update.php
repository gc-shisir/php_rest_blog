<?php  
    // Headers
    header('Access-Allow-Control-Origin:*');
    header('Content-Type:application/json');
    header('Access-Content-Allow-Methods:PUT');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Content-Allow-Methods, Authorization,X-Requested-With');
    

    include_once('../../models/Post.php');
    include_once('../../config/Database.php');

    // Instantiate database and connect
    $database=new Database();
    $db=$database->connect();

    // Instantiate blog post object
    $post=new Post($db);

    // Get raw posted data
    $data=json_decode(file_get_contents("php://input"));

    $post->title=$data->title;
    $post->body=$data->body;
    $post->author=$data->author;
    $post->category_id=$data->category_id;

    // Set ID to update
    $post->id=$data->id;


    // Update post
    if($post->update()){
        echo json_encode(
            array(
                'message'=>'Post Updated' 
            )
            );
    }else{
        echo json_encode(array('message'=>'Post Not Updated'));
    }
    