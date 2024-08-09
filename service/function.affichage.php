<?php 

// format SELECT Threads.thread_id, title, Threads.user_id, category_name,
//  view_nb ,thread_date, description, profile_picture FROM Threads INNER JOIN
//  Categories ON Threads.category_id = Categories.category_id INNER JOIN Users ON Users.user_id = Threads.user_id";
    function threadDisplayMasher($threadTable){     
        
        $x=0;
        foreach($threadTable as $T){
        if($x === 0){
            $mash1 = '<div class="thread">
            <div class="profilephoto"><img src="';
            $x++;
        }else{
            $mash1 = '<div class="alternatethread">
            <div class="profilephoto"><img src="';
            $x=0;
        }
        $mashed1 = $T['profile_picture'];
        $mash2 =  '" alt=""></div>
        <div class="title"><h3><a href="/thread?id=';
        $mashed2 = htmlspecialchars($T['thread_id'], ENT_QUOTES, 'UTF-8');
        $mash3 = '">';
        $mashed3 = htmlspecialchars($T['title'], ENT_QUOTES, 'UTF-8');
        $mash4 = '</a></h3></div>
        <div class="category"><p class="';
        $mashed4 = htmlspecialchars($T['category_name'], ENT_QUOTES, 'UTF-8');
        $mash5 = '">';
        $mashed5 = htmlspecialchars($T['category_name'], ENT_QUOTES, 'UTF-8');
        $mash6 = '</p></div>
        <div class="views"><p>';
        $mashed6 = htmlspecialchars($T['view_nb'], ENT_QUOTES, 'UTF-8');
        $mash7 = '</p></div>
        <div class="lastactivity"><p>';
        $mashed7 = htmlspecialchars($T['thread_date'], ENT_QUOTES, 'UTF-8');
        $mash8 = '</p></div>
        </div>';

        $result = "$mash1" . "$mashed1" . "$mash2" . "$mashed2" . "$mash3" . "$mashed3"
        . "$mash4" . "$mashed4". "$mash5" . "$mashed5". "$mash6" . "$mashed6"
        . "$mash7" . "$mashed7" . "$mash8";
        echo $result;
        }
        
    }
    // format SELECT Threads.title, Users.username, Threads.description FROM Threads INNER JOIN Users ON Threads.user_id = Users.user_id WHERE thread_id = ?;
    function postHeaderMasher($postTable){
        if(empty($postTable)){
            header('Location: /404');
            return;
        }
        $mash1 = '<article class="main-post">
        <h1>';
        $mashed1 = htmlspecialchars($postTable[0]['title'], ENT_QUOTES, 'UTF-8');
        $mash2 = '</h1>
        <p>Posted by <span class="username">';
        $mashed2 = htmlspecialchars($postTable[0]['username'], ENT_QUOTES, 'UTF-8');
        $mash3 = '</span></p><p>';
        $mashed3 = htmlspecialchars($postTable[0]['description'], ENT_QUOTES, 'UTF-8');
        $mash4 = '</p></article>';
        $result = $mash1 . $mashed1 . $mash2 . $mashed2 . $mash3 . $mashed3
        . $mash4;
        echo $result;
    }
    // format SELECT username, content FROM Posts INNER JOIN USERS ON Users.user_id = Posts.user_id WHERE thread_id = ?;
    function postContentMasher($postTable){
        $i = 1;
        foreach ($postTable as $P){
            $mash1 = '<section class="comments"><h2>';
            $mashed1 = '#' . $i;
            $i++;
            $mash2 = '</h2><div class="comment"><p><span class="username">';
            
            // Using htmlspecialchars to escape HTML special characters
            $mashed2 = htmlspecialchars($P['username'], ENT_QUOTES, 'UTF-8');
            
            $mash3 = '</span> ';
            
            // Using htmlspecialchars for the content as well
            $mashed3 = htmlspecialchars($P['content'], ENT_QUOTES, 'UTF-8');
            
            $mash4 = '</p></div></section>';
            $result = $mash1 . $mashed1 . $mash2 . $mashed2 . $mash3 . $mashed3 . $mash4;
            echo $result;
        }
    }
    function categoryMenuDisplayMasher($categoryTable){
        foreach ($categoryTable as $C){
            $mash1 = '<option value="';
            $mashed1 = htmlspecialchars($C['category_name'], ENT_QUOTES, 'UTF-8');
            $mash2 = '">';
            $mashed2 = htmlspecialchars($C['category_name'], ENT_QUOTES, 'UTF-8');
            $mash3 = '</option>';
            $result = $mash1 . $mashed1 . $mash2 . $mashed2 . $mash3;
            echo $result;
        }

    }
    
    
?>