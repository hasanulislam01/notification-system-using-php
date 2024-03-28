<?php
    include('connect.php');


    if(isset($_POST['view'])){
        if($_POST["view"] != ''){
            $update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0";
            mysqli_query($con, $update_query);
        }
        $query = "SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5";
        // $query = "SELECT * FROM comments WHERE comment_status=0";
        $result = mysqli_query($con, $query);
        $output = '';
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $output .= '<li>
                <a href="#">
                <strong>'.$row["comment_subject"].'</strong>
                <br />
                <small><em>'.$row["comment_text"].'</em></small></a>
                
                <div class="dropdown">
                <button id="mute_btn" style="margin-right: 20px;">'.$row["mute_status"].'</button>
                <div class="dropdown-content" id="mute_dropdown">
                  <a href="#" id="1">1 hour</a>
                  <a href="#" id="3">3 hours</a>
                  <a href="#" id="12">12 hours</a>
                </div>
                </div>
                </li>';
            }
        }
        else{
            $output .= '
            <li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
        }



        $status_query = "SELECT * FROM comments WHERE comment_status=0";
        $result_query = mysqli_query($con, $status_query);
        $count = mysqli_num_rows($result_query);
        $data = array(
            'notification' => $output,
            'unseen_notification'  => $count
        );

        echo json_encode($data);
    }


    // -------------------

    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_id'])) {
    //     $commentId = $_POST['comment_id'];
    
    //     // Perform necessary validation and sanitation on $commentId
    
    //     // Update the mute status in the database
    //     $query = "UPDATE comments SET mute_status = IF(mute_status = 'mute', 'unmute', 'mute') WHERE comment_id = ?";
    //     $stmt = $pdo->prepare($query);
    //     $stmt->execute([$commentId]);
    
    //     // You may want to return a response to the client
    //     echo "Success";
    // } else {
    //     // Handle invalid requests
    //     http_response_code(400);
    //     echo "Invalid request";
    // }

    // -----------------

?>

