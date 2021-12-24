<?php  
    // Headers
    header('Access-Allow-Control-Origin:*');
    header('Content-Type:application/json');

    include_once('../../models/Post.php');
    include_once('../../config/Database.php');

    // Instantiate database and connect
    $database=new Database();
    $db=$database->connect();
    
    // Instantiate blog post object
    $post=new Post($db);

    // Blog post query
    $result=$post->read();

    // Count the rows
    $num=$result->rowCount();
    
    // Check if any posts
    if($num>0){
        $posts_arr=array();
        // here we want to embedd data array inside of {$post_array} 
        // so that we can add additional items like pagination,version info and so on to returned array
        $posts_arr['data']=array();

        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            // Here we want to extract each row and use each item as a variable
            // now we can use $body,$title instead of $row['body'],$row['title']
            extract($row);
            
            $post_item=array(
                'id'=>$id,
                'title'=>$title,
                'body'=>html_entity_decode($body),
                //Body is allowed to have html contents so we use html_entity_decode()
                'author'=>$author,
                'category_id'=>$category_id,
                'category_name'=>$category_name
            );

            // Push to "data" in array
            array_push($posts_arr['data'],$post_item);
        }

        // Turn to json and output
        echo json_encode($posts_arr);

    }else{
        // No posts
        echo json_encode(
            array('message'=>'No posts found')
        );
    }

?>