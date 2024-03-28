<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 8px 0;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* .dropdown:hover .dropdown-content {
            display: block;
        } */
    </style>
</head>
<body>
    <br /><br />
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Notification System</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
                        <ul class="dropdown-menu">
                            <li>Demo</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <br />
        <form method="post" id="comment_form">
            <div class="form-group">
                <label>Enter Subject</label>
                <input type="text" name="subject" id="subject" class="form-control">
            </div>
            <div class="form-group">
                <label>Enter Description</label>
                <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="post" id="post" class="btn btn-info" value="Submit" />
            </div>
        </form>
    </div>



    <script>
        $(document).ready(function(){
        
            function load_unseen_notification(view = ''){
                $.ajax({
                    url:"fetch.php",
                    method:"POST",
                    data:{view:view},
                    dataType:"json",
                    success:function(data){
                        // console.log(data);
                        $('.dropdown-menu').html(data.notification);
                        if(data.unseen_notification > 0){
                            $('.count').html(data.unseen_notification);
                            // $('.count').html(data.notification);
                        }
                    }

                });
            }




            





            // $('.dropdown-menu').on('click', 'li', function (event) {
            //     // Prevent the default behavior of the click event
            //     // event.preventDefault();
            //     // // Stop the event propagation to prevent the dropdown menu from closing
            //     event.stopPropagation();
            //     // Your code to handle the click event on the list items goes here
            //     // For example, you can perform some action when a list item is clicked
            //     // You can also close the dropdown menu manually if needed

                
            // });

            // Add an event listener to the document body to close the dropdown menu when clicking outside
            // $(document).on('click', function () {
            //     $('.dropdown-menu').removeClass('show');
            // });

            // Add an event listener to the dropdown menu to prevent closing when clicking inside it
            // $('.dropdown-menu').on('click', function (event) {
            //     event.stopPropagation();
            // });









            
            load_unseen_notification();
            
            $('#comment_form').on('submit', function(event){
                event.preventDefault();
                if($('#subject').val() != '' && $('#comment').val() != ''){
                    var form_data = $(this).serialize();
                    $.ajax({
                        url:"insert.php",
                        method:"POST",
                        data:form_data,
                        success:function(data){
                            $('#comment_form')[0].reset();
                            load_unseen_notification();
                        }
                    });
                }
                else{
                    alert("Both Fields are Required");
                }
            });
            
            $(document).on('click', '.dropdown-toggle', function(){
                $('.count').html('');
                load_unseen_notification('yes');
            });


            // $(document).on('click', '#mute_btn', function(event){
            //     // alert("Mute Button Clicked!");
            //     let person = prompt("Mute for (min)", "");
            //     let text;
            //     if (person == null || person == "") {
            //     text = "User cancelled the prompt.";
            //     } else {
            //     console.log(person);
                
            //     }
            //     $(this).text("Unmute");
            //     // load_unseen_notification('yes');


            //     var button = document.getElementById('mute_btn');
            //     if (button.textContent === "Mute") {
            //         button.textContent = "Unmute";
            //     } else {
            //         button.textContent = "Mute";
            //     }
            //     event.stopPropagation();
            // });



            
                
            setInterval(function(){ 
                // load_unseen_notification();
            }, 5000);




            $(document).on('click', '#mute_btn', function(event){
                // prompt for mute duration
                // let person = prompt("Mute for (min)", "");
                // let text;
                // if (person == null || person == "") {
                //     text = "User cancelled the prompt.";
                // } else {
                //     console.log(person);
                // }

                // toggle the text between "Mute" and "Unmute"
                
                
                // $(this).text($(this).text() === "Mute" ? "Unmute" : "Mute");
                

                var buttonText = $(this).text();
                
                if(buttonText === "mute"){
                    console.log("Button Text: " + buttonText);
                    $('#mute_dropdown').toggle();
                    // if($(#1).click){

                    // }
                    $(this).text("unmute");
                    
                }
                else{
                    $(this).text("mute");
                    $('#mute_dropdown').hide();
                    
                }

                
                

                // stop event propagation
                // event.preventDefault();
                event.stopPropagation();
                
            });

            // $('#mute_dropdown').hide();









            // --------------------------------------------

            // $('.mute-btn').click(function() {
            //     var commentId = $(this).closest('.comment').data('comment_id');
            //     $.ajax({
            //         type: 'POST',
            //         url: 'fetch.php',
            //         data: { comment_id: comment_id },
            //         success: function(response) {
            //             // Handle success, update UI if needed
            //             console.log('Comment muted/unmuted successfully');
            //         },
            //         error: function(xhr, status, error) {
            //             // Handle error
            //             console.error(error);
            //         }
            //     });
            // });
    // ------------------









   
        });

    
    </script>

</body>
</html>


