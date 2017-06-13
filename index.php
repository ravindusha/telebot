<?php
    /*

    Developer: arterhacker
    Website: http://arterhacker.me
    Date: 6 Apr. 2017 - 17:15
    File: mysamplebot.php
    Desc: It is the main file of the sample bot.

    */

    // functions
    include('inc/functions.php');

    // BOT CREDENTIALS
    // My bot: https://api.telegram.org/bot[BOT_TOKEN]
    // Set a webhook: https://api.telegram.org/bot[BOT_TOKEN]/setWebHook?url=MY_URL_IS_HERE&max_connections=5
    // Replace the url of this file with "MY_URL_IS_HERE" (it should be https link)
    // and change the max connections value if you want
    $botToken       = "383941298:AAHre82sSq6zU-UUQ5AQSfATPuNCJH5n9UE"; // create your first bot with @botfather and get an bot token
    $website        = "https://api.telegram.org/bot".$botToken;
    $filepath       = "https://api.telegram.org/file/bot".$botToken."/";

    // get updates or send  update
    $update         = file_get_contents("php://input");
    $update         = json_decode($update, TRUE);

    // variables of the user and the chat
    $chatID         = isset($update["message"]["chat"]["id"]) ? $update["message"]["chat"]["id"] : "";
    $chattype       = isset($update["message"]["chat"]["type"]) ? $update["message"]["chat"]["type"] : "";
    $message        = isset($update["message"]["text"]) ? $update["message"]["text"] : "";
    $message_id     = isset($update["message"]["message_id"]) ? $update["message"]["message_id"] : "";
    $message_capt   = isset($update["message"]["caption"]) ? $update["message"]["caption"] : "";
    $message_audio  = isset($update["message"]["audio"]) ? $update["message"]["audio"] : "";
    $message_photo  = isset($update["message"]["photo"]) ? $update["message"]["photo"][getLast($update["message"]["photo"])]["file_id"] : "";
    $message_video  = isset($update["message"]["video"]) ? $update["message"]["video"] : "";
    $message_voice  = isset($update["message"]["voice"]) ? $update["message"]["voice"] : "";
    $message_doc    = isset($update["message"]["document"]) ? $update["message"]["document"] : "";
    $msg_forward    = isset($update["message"]["forward_from"]) ? $update["message"]["forward_from"] : "";
    $user_firstname = isset($update["message"]["from"]["first_name"]) ? $update["message"]["from"]["first_name"] : "unnamed";
    $user_lastname  = isset($update["message"]["from"]["last_name"]) ? $update["message"]["from"]["last_name"] : "";
    $user_username  = isset($update["message"]["from"]["username"]) ? $update["message"]["from"]["username"] : "";
    $user_id        = isset($update["message"]["from"]["id"]) ? $update["message"]["from"]["id"] : "";
    $inqueryID      = isset($update["inline_query"]["id"]) ? $update["inline_query"]["id"] : "";
    $inquery        = isset($update["inline_query"]["query"]) ? $update["inline_query"]["query"] : "";

    // variables of media files
    // like "file id", "file size", etc.
    include('inc/media.php'); // YOU CAN GET THE FILE ID OF THE RECEIVED FILE WITH THIS PHP FILE;

    // here is our demo
    // check the message with switch
    switch($message){
        case "/start":
            // we will send a keyboard to the user
            $mykeyboard    = array(
                array("!Photo", "!Video"),
                array("!Voice", "Empty"),
                array("!CLOSE!")
            );
            sendMessage($chatID, "Yay yaaaa!", keyboard($mykeyboard, 1, 0, false));
            break;

        case "!Photo":
            // you can pass an file id or post data too. I prefer the url.
            sendPhoto($chatID, "http://i.imgur.com/wGpVSsY.jpg", "Here it is!");
            break;

        case "!Video":
            // you can pass an post data or URL too. I prefer the file id.
            // it will not work for you, because this file sent to my bot and only my bot can see this.
            // so, change the file id string
            sendVideo($chatID, "BAADBAADQgADb5g5U1j4tJ6ycYhFAg", "Here is a sample video!");
            break;

        case "!Voice":
            // you can pass an post data or URL too. I prefer the file id.
            // it will not work for you, because this file sent to my bot and only my bot can see this.
            // so, change the file id string
            sendVoice($chatID, "AwADBAADQQADb5g5U5SGvcCJ8tbjAg", "Hello, I'm arterhacker.");
            sendVoice($chatID, "AwADBAADPwADb5g5UzYJ0JKgk6lxAg", "Successful.");
            break;

        case "!CLOSE!":
            sendMessage($chatID, "OK, sure! To open again, click to this: /start", 1); # 1 means that remove the keyboard
            break;

        // etc..
        // ..
        // ..

        default:
            // if media type is defined in media.php file, check it:
            if(isset($mediatype)){
                // it will send back the message to the user
                switch($mediatype){
                    case "photo":
                        sendPhoto($chatID, $message_photo, "It is your photo message.");
                        break;

                    case "voice":
                        sendVoice($chatID, $voice_file_id, "It is your voice message.");
                        break;

                    case "video":
                        sendVideo($chatID, $video_file_id, "It is your video message.");
                        break;

                    case "document":
                        sendDocument($chatID, $doc_file_id, "It is your document file.");
                        break;

                    case "audio":
                        sendAudio($chatID, $audio_file_id, "It is your audio file.");
                        break;

                    default:
                        sendMessage($chatID, "What?");
                }

            } else {
                // if not defined, send a message
                sendMessage($chatID, "*You said:* $message\n*My answer:* Hmm.\n\nTo open the keyboard: /start");
            }
        }
?>
