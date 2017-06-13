<?php
    /*

    Developer: arterhacker
    Website: http://arterhacker.me
    Date: 6 Apr. 2017 - 16:45
    File: functions.php
    Desc: It contains useful functions
    to use the Telegram Bot API easily

    */

    // send message function
    // https://core.telegram.org/bots/api#sendmessage
    function sendMessage($chatID, $message, $keyboard = "", $replyto = "", $parse = "Markdown"){
        sendAction($chatID, "typing"); // send an action; "bot is typing.."
        if($keyboard !== 1){ # if you don't want to remove keyboard, leave blank
            $url = $GLOBALS["website"]."/sendMessage?text=".urlencode($message)."&parse_mode=".$parse."&reply_to_message_id=".$replyto."&chat_id=".$chatID."&reply_markup=".$keyboard;
        } else {
            // it removes the keyboard sent by the bot
            $replykeyboard = json_encode(array("remove_keyboard" => true));
            $url = $GLOBALS["website"]."/sendMessage?text=".urlencode($message)."&parse_mode=".$parse."&reply_to_message_id=".$replyto."&chat_id=".$chatID."&reply_markup=".$replykeyboard;
        }

        // send the message
        $export = file_get_contents($url);
        // then return the sent message id
        $export = json_decode($export, TRUE);
        $msg_id = $export["result"]["message_id"];
    }

    // forward message function
    // https://core.telegram.org/bots/api#forwardmessage
    function forwardMessage($chatID, $who, $message_id, $notification = true){
        // $who: Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
        // $message_id: Message identifier in the chat specified in from_chat_id
        $url = $GLOBALS["website"]."/forwardMessage?chat_id=".$chatID."&from_chat_id=".$who."&disable_notification=".$notification."&message_id=".$message_id;
        file_get_contents($url);
    }

    // edit message function
    // https://core.telegram.org/bots/api#editmessagetext
    function editMessage($chatID, $message, $msg_id, $reply = ""){
        // don't forget, sendMessage() function returns the message_id of sent message
        // if the sent process is succesfull.
        $url = $GLOBALS["website"]."/editMessageText?text=".urlencode($message)."&message_id=".$msg_id."&parse_mode=Markdown&chat_id=".$chatID."&reply_markup=".$reply;
        file_get_contents($url);
    }

    // send photo function
    // https://core.telegram.org/bots/api#sendphoto
    function sendPhoto($chatID, $image, $description = " "){
        // $image: URL or file id of the photo
        sendAction($chatID, "upload_photo"); // send an action; "bot is sending a photo.."
        $url = $GLOBALS["website"]."/sendPhoto?photo=".$image."&caption=".urlencode($description)."&parse_mode=Markdown&chat_id=".$chatID;
        file_get_contents($url);
    }

    // send voice function
    // https://core.telegram.org/bots/api#sendvoice
    function sendVoice($chatID, $voice_id, $caption = ""){
        // $voice_id: Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.

        sendAction($chatID, "record_audio"); // send an action; "bot is recording a voice message.."
        $url = $GLOBALS["website"]."/sendVoice?voice=".$voice_id."&caption=".urlencode($caption)."&parse_mode=Markdown&chat_id=".$chatID;
        file_get_contents($url);
    }

    // send video function
    // https://core.telegram.org/bots/api#sendvideo
    function sendVideo($chatID, $video, $caption = ""){
        // $video:     Video to send. Pass a file_id as String to send a video that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using multipart/form-data.

        sendAction($chatID, "upload_video"); // send an action; "bot is sending a video.."
        //$url = $GLOBALS["website"]."/sendVideo?video=".$video."&caption=".urlencode($caption)."&parse_mode=Markdown&chat_id=".$chatID;
        $url = $video."&caption=".urlencode($caption)."&parse_mode=Markdown&chat_id=".$chatID;
        file_get_contents($url);
    }

    // send audio function
    // https://core.telegram.org/bots/api#sendaudio
    function sendAudio($chatID, $audio, $caption = ""){
        // $audio: Audio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data.

        sendAction($chatID, "upload_audio"); // send an action; "bot is sending an audio.."
        $url = $GLOBALS["website"]."/sendAudio?audio=".$audio."&caption=".urlencode($caption)."&parse_mode=Markdown&chat_id=".$chatID;
        file_get_contents($url);
    }

    // send document function
    // https://core.telegram.org/bots/api#senddocument
    function sendDocument($chatID, $doc, $caption = ""){
        // $doc: File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.

        sendAction($chatID, "upload_document"); // send an action; "bot is sending a document.."
        $url = $GLOBALS["website"]."/sendDocument?document=".$doc."&caption=".urlencode($caption)."&parse_mode=Markdown&chat_id=".$chatID;
        file_get_contents($url);
    }

    // send chat action function
    // https://core.telegram.org/bots/api#sendchataction
    function sendAction($chatID, $action){
        // typing, upload_photo, record_video, upload_video, record_audio, upload_audio, upload_document, find_location
        $url = $GLOBALS["website"]."/sendChatAction?action=".$action."&chat_id=".$chatID;
        file_get_contents($url);
    }

    // send an answer to the callback query
    // more info at https://core.telegram.org/bots/api#answercallbackquery
    function ansCall($queryID, $text = ""){
        $url = $GLOBALS["website"]."/answerCallbackQuery?callback_query_id=".$queryID."&text=".$text;
        file_get_contents($url);
    }

    // send an answer to the inline mode query
    // more info at https://core.telegram.org/bots/api#answerinlinequery
    function ansIn($queryID, $results){

        $url = $GLOBALS["website"]."/answerInlineQuery?inline_query_id=".$queryID."&results=".$results;
        file_get_contents($url);
    }

    // Please create a pull request if you think that is complicated
    // send a keyboard with buttons
    // sample usage:
    // sendMessage($chatID, "My message with a keyboard", keyboard(array("First button", "Second button"), array("Third button", "Fourth button")))
    // it sends a keyboard like this:
    // [First Button]     [Second Button]
    // [Third Button]     [Fourth Button]
    // You will understand that why did I create the "isarray" variable when you make a complicated and automated buttons
    #  You can remove this keyboard by editing the message with editMessage() function
    #  https://core.telegram.org/bots/api#replykeyboardmarkup
    #  https://core.telegram.org/bots/api#keyboardbutton
    function keyboard($array, $isarray = 0, $back = 0, $onetime = true){
        if(count($array) >= 2 && $isarray == 1){
            $keyboard     = $array;
            if($back == 1){
                $keyboard[] = array("🔙");
            }
        } else {
            if($back == 1){
                $keyboard     = array($array, array("🔙"));
            } else {
                $keyboard     = array($array);
            }
        }

        $resp           = array("keyboard" => $keyboard,"resize_keyboard" => true,"one_time_keyboard" => $onetime);
        $reply          = json_encode($resp);

        return $reply;
    }

    // inline keyboard
    // you can use this like that:
    // $newkeyboard = array(
    //         array(
    //             array("text" => "My button callback data", "callback_data" => "My callback query"),
    //             array("text" => "I can add one more button", "mycallback" => "My callback data")
    //         ),
    //         array(
    //             array("text" => "My button with url", "url" => "http://myurl.com.or")
    //         )
    //    );
    //
    // sendMessage($chatID, "My message with an inline keyboard", inkeyboard($newkeyboard, 0));
    //
    // You can remove this keyboard by editing the message with editMessage() function
    // https://core.telegram.org/bots/api#inlinekeyboardmarkup
    // https://core.telegram.org/bots/api#inlinekeyboardbutton
    function inkeyboard($keyboard, $addarray = 1){
        // $keyboard: this should be an array
        if($addarray == 1) $keyboard     = array($array);

        $resp           = array("inline_keyboard" => $keyboard);
        $reply          = json_encode($resp);

        return $reply;
    }


    // to download profile photos of the user
    // https://core.telegram.org/bots/api#getuserprofilephotos
    function getUserPhoto($userID){
        $userphoto      = file_get_contents($GLOBALS["website"]."/getUserProfilePhotos?user_id=".$userID);
        $userphoto      = json_decode($userphoto, TRUE);
        $userphoto      = $userphoto["result"]["photos"];
        $a              = 0;
        foreach ($userphoto as $photo) {
            $a++;
            $photo_id       = $photo[2]["file_id"];
            $photo_link     = getFile($photo_id); // you can see the getFile() function in the next function below
            $link           = $GLOBALS["filepath"]."".$photo_link;

            $ext = pathinfo($link, PATHINFO_EXTENSION);

            // you can change 'photos/' string to change the directory
            $downloadTo = fopen('photos/'.$userID."_".$a.'.'.$ext, 'wb');

            $ch         = curl_init();
            curl_setopt($ch, CURLOPT_URL, $link);
            curl_setopt($ch, CURLOPT_FILE, $downloadTo);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $output      = curl_exec($ch);
            curl_close($ch);

        }

    }

    // to get the url of a file with its id
    // https://core.telegram.org/bots/api#getfile
    function getFile($fileID){
        $getFile         = file_get_contents($GLOBALS["website"]."/getFile?file_id=".$fileID);
        $getFile         = json_decode($getFile, TRUE);
        $getFile         = $getFile["result"]["file_path"];

        return $getFile;
    }

    // to download the file with file id (it also uses the getFile function)
    function downFile($fileID){
        $file_id        = getFile($fileID);
        $file_link      = $GLOBALS["filepath"]."".$file_id;
        $ext            = pathinfo($file_link, PATHINFO_EXTENSION);

        $make_unique    = rand(100000000,999999999999);
        $downloadTo     = fopen("files/".$make_unique.".".$ext, 'wb'); // you can change the directory

        $filepath       = "files/".$make_unique.".".$ext; // change the directory

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file_link);
        curl_setopt($ch, CURLOPT_FILE, $downloadTo);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);

        return $filepath;
    }

    // telegram allows you to download the received photo from user in different sizes
    // you can get the bigger size of the received photo like this:
    // $message_photo     = $update["message"]["photo"][getLast($update["message"]["photo"])]["file_id"];
    function getLast($fileid){
        end($fileid);
        $output     = key($fileid);
        return $output;
    }

    // delete html codes
    function hdel($var){
        $var = filter_var($var, FILTER_SANITIZE_STRING);
        return $var;
    }

    // add slashes before save it to the database
    function ss($text) {
        return addslashes(trim($text));
    }

    // remove slashes before send it to the user
    function ss1($text) {
        return stripslashes($text);
    }

    // allows only a-z 0-9 . and -
    // it can be useful, idk
    function clearName($input){
        $inpt = preg_replace("/[^a-zA-Z0-9]+/", "", $input);
        return $inpt;
    }

    // you can clear names containing emoji
    // mysql database doesn't allow emojis on some servers
    function removeEmoji($text) {

        $clean_text = "";

        // Match Emoticons
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clean_text = preg_replace($regexEmoticons, '', $text);

        // Match Miscellaneous Symbols and Pictographs
        $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clean_text = preg_replace($regexSymbols, '', $clean_text);

        // Match Transport And Map Symbols
        $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clean_text = preg_replace($regexTransport, '', $clean_text);

        // Match Miscellaneous Symbols
        $regexMisc = '/[\x{2600}-\x{26FF}]/u';
        $clean_text = preg_replace($regexMisc, '', $clean_text);

        // Match Dingbats
        $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
        $clean_text = preg_replace($regexDingbats, '', $clean_text);

        return $clean_text;

    }

?>
