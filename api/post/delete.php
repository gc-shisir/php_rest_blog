<?php  
    // Headers
    header('Access-Allow-Control-Origin:*');
    header('Content-Type:application/json');
    header('Access-Content-Allow-Methods:DELETE');
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


    // Set ID to update
    $post->id=$data->id;


    // Delete post
    if($post->delete()){
        echo json_encode(
            array(
                'message'=>'Post Deleted' 
            )
            );
    }else{
        echo json_encode(array('message'=>'Post Not Deleted'));
    }
    