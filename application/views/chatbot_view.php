<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reine Haut</title>
    <!-- Include CSS styling for the chat interface -->
    <style>
        body {
            padding-top: 100px;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
            margin: 0;
        }

        .chat-wrapper {
            width: 100%;
            max-width: 800px;
            height: 80vh;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .chat-header {
            background-color: #2B6377;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 1.25em;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            position: relative;
        }

        .chat-header img {
            margin-right: 10px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .chat-header .online-indicator {
            display: flex;
            align-items: center;
            position: absolute;
            bottom: 5px;
            left: 60px;
            font-size: 0.6em;
            color: #28a745;
        }

        .chat-header .online-indicator::before {
            content: '';
            width: 10px;
            height: 10px;
            background-color: #28a745;
            border-radius: 50%;
            margin-right: 5px;
        }

        .chat-header .close-button {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            border: none;
            font-size: 1.5em;
            color: white;
            cursor: pointer;
            outline: none;
        }

        .chat-container {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        .chat-message {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }

        .chat-message img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-message-content {
            padding: 10px;
            border-radius: 10px;
            max-width: 75%;
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        .chat-message-user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .chat-message-user img {
            margin-right: 0;
            margin-left: 10px;
        }

        .chat-message-user .chat-message-content {
            background-color: #2B6377;
            color: #ffffff;
        }

        .chat-message-bot .chat-message-content {
            background-color: #e9ecef;
            color: #333333;
        }

        .chat-options {
            margin-top: 10px;
            display: flex;
            justify-content: flex-end;
        }

        .chat-option {
            margin-left: 10px;
            padding: 8px 12px;
            background-color: #2B6377;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            outline: none;
            transition: background-color 0.3s ease;
        }

        .chat-option:hover {
            background-color: #12947f;
        }

        #chat-form {
            display: flex;
            border-top: 1px solid #e0e0e0;
            padding: 10px;
            background-color: #ffffff;
        }

        #user-input {
            flex: 1;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            margin-right: 10px;
            outline: none;
        }

        button {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #2B6377;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            outline: none;
        }

        button:hover {
            background-color: #12947f;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="chat-wrapper" id="chat-wrapper">
        <div class="chat-header">
            <img src="<?php echo base_url('uploads/bot.jpg'); ?>" alt="logo">
            ReineHelp.
            <div class="online-indicator">online</div>
            <button class="close-button" onclick="closeChat()">×</button>
        </div>
        <div class="chat-container" id="chat-container">
            <!-- Pesan obrolan akan ditambahkan di sini secara dinamis -->
        </div>
        <div class="chat-options">
            <button class="chat-option" onclick="sendOption('Apa rekomendasi skincare lokal untuk kulit kering?')">Apa rekomendasi skincare lokal untuk kulit kering?</button>
            <button class="chat-option" onclick="sendOption('Apa rekomendasi skincare lokal untuk kulit berminyak?')">Apa rekomendasi skincare lokal untuk kulit berminyak?</button>
            <button class="chat-option" onclick="sendOption('Apa rekomendasi moisturizer lokal untuk kulit berjerawat?')">Apa rekomendasi moisturizer lokal untuk kulit berjerawat?</button>
        </div>
        <form id="chat-form">
            <input type="text" id="user-input" placeholder="Type your message...">
            <button type="submit">Send</button>
        </form>
    </div>

    <!-- Include jQuery for easier AJAX handling -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tambahkan pesan selamat datang saat halaman dimuat
            $('#chat-container').append(
                '<div class="chat-message chat-message-bot">' +
                    '<img src="<?php echo base_url('uploads/bot.jpg'); ?>" alt="Bot">' +
                    '<div class="chat-message-content"><strong>ReineBot:<br/></strong> Selamat datang, ada yang bisa kami bantu?</div>' +
                '</div>'
            );

            $('#chat-form').submit(function(event) {
                event.preventDefault();
                var userInput = $('#user-input').val().trim();

                if (userInput !== '') {
                    $('#chat-container').append(
                        '<div class="chat-message chat-message-user">' +
                            '<img src="<?php echo base_url('uploads/tom.webp'); ?>" alt="User">' +
                            '<div class="chat-message-content"><strong> You:</br></strong> ' + userInput + '</div>' +
                        '</div>'
                    );
                    $('#user-input').val(''); // Clear the input field after appending the message

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('chatbot/send_message'); ?>',
                        data: { userInput: userInput },
                        success: function(response) {
                            $('#chat-container').append(
                                '<div class="chat-message chat-message-bot">' +
                                    '<img src="<?php echo base_url('uploads/bot.jpg'); ?>" alt="Bot">' +
                                    '<div class="chat-message-content"><strong>ReineBot:<br/></strong> ' + response + '</div>' +
                                '</div>'
                            );
                            $('#chat-container').animate({ scrollTop: $('#chat-container').prop("scrollHeight")}, 1000);
                        },
                        error: function() {
                            $('#chat-container').append(
                                '<div class="chat-message chat-message-bot error-message">' +
                                    '<img src="<?php echo base_url('uploads/bot.jpg'); ?>" alt="Bot">' +
                                    '<div class="chat-message-content"><strong>Error:</strong> Unable to connect to chatbot service.</div>' +
                                '</div>'
                            );
                        }
                    });
                }
            });
        });

        function sendOption(option) {
            $('#user-input').val(option); // Set the user input field to the selected option
            $('#chat-form').submit(); // Submit the form (simulate sending the message)
        }

        function closeChat() {
            window.location.href = '<?php echo base_url('/landingpage'); ?>';
        }
    </script>
</body>
</html>
