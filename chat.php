<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <script src="./js/jquery.js"></script>
    <script>
        var selectedUserId = null;
        
        function loadChat() {
            if (selectedUserId !== null) {
                $.ajax({
                    url: "load_message.php",
                    type: "POST",
                    data: { receiver_id: selectedUserId },
                    success: function(response) {
                        $("#chatMessages").html(response);
                    }
                });
            }
        }

        function sendMessage() {
            if (selectedUserId !== null) {
                var message = $("#messageInput").val();
                $.ajax({
                    url: "send_message.php",
                    type: "POST",
                    data: { receiver_id: selectedUserId, message: message },
                    success: function(response) {
                        $("#messageInput").val("");
                        loadChat();
                    }
                });
            }
        }

        setInterval(loadChat, 1000);

        $(document).ready(function() {
            loadChat();
        });
    </script>
</head>
<body>
    <h5>Select a User to Chat With:</h5>
    
    <div id="userList">
        <?php 
        $user_id = $user_data['user_id'];
        $users_query = "SELECT * FROM users WHERE user_id != $user_id";
        $users_result = mysqli_query($con, $users_query);
        
        if (mysqli_num_rows($users_result) > 0) {
            while ($users_row = mysqli_fetch_assoc($users_result)) {
                $receiverId = $users_row['user_id'];
                $receiverName = "{$users_row['user_firstname']} {$users_row['user_lastname']}";
                
                echo "<button class='btn btn-dark fw-bold mt-3 w-100' onclick='selectedUserId=$receiverId; loadChat();'>$receiverName</button><br>";
            }
        }
        ?>
    </div>

    <div id="chatMessages">
        
    </div>
    
    <input type="text" class="bg-secondary text-white form-control p-2 mt-1" id="messageInput" placeholder="Type your message">
    <button class="btn btn-dark fw-bold mt-3" onclick="sendMessage()">Send</button>
</body>
</html>
