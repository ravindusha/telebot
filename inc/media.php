<?php
    /*

    Developer: arterhacker
    Website: http://arterhacker.me
    Date: 6 Apr. 2017 - 18:24
    File: media.php
    Desc: It contains media variables

    */

    // voice
    if(!empty($message_voice)){
        $mediatype          = "voice"; // define the file type
        $voice_file_id      = $update["message"]["voice"]["file_id"];
        $voice_size         = $update["message"]["voice"]["file_size"]; // 15716 = 15 kb
        $voice_mime         = $update["message"]["voice"]["mime_type"]; // audio/ogg
        $voice_duration     = $update["message"]["voice"]["duration"]; // uzunluğu saniye cinsinden

    }

    // document
    if(!empty($message_doc)){
        $mediatype          = "document"; // define the file type
        $doc_file_id        = $update["message"]["document"]["file_id"]; // dosyanın idsi
        $doc_size           = $update["message"]["document"]["file_size"]; // 15716 = 15 kb
        $doc_mime           = $update["message"]["document"]["mime_type"]; // image/png gibi örneğin
        $doc_duration       = $update["message"]["document"]["file_name"]; // dosya adı

        // thumb if available
        if(!empty($update["message"]["document"]["thumb"])){
            $doc_thumb_id       = $update["message"]["document"]["thumb"]["file_id"]; // file id
            $doc_thumb_size     = $update["message"]["document"]["thumb"]["file_size"]; // file size
            $doc_thumb_id       = $update["message"]["document"]["thumb"]["file_path"]; // indirmek için path / thumb/file_235.jpg
            $doc_thumb_wid      = $update["message"]["document"]["thumb"]["width"]; // width
            $doc_thumb_hei      = $update["message"]["document"]["thumb"]["height"]; // height
        }

    }

    // video
    if(!empty($message_video)){
        $mediatype          = "video"; // define the file type
        $video_file_id      = $update["message"]["video"]["file_id"]; // video idsi
        $video_size         = $update["message"]["video"]["file_size"]; // 1966068 = 1,99 mb
        $video_width        = $update["message"]["video"]["width"]; // width
        $video_height       = $update["message"]["video"]["height"]; // height
        $video_duration     = $update["message"]["video"]["file_name"]; // dosya adı
        $video_caption      = $update["message"]["video"]["caption"]; // dosya adı

        // thumb if available
        if(!empty($update["message"]["video"]["thumb"])){
            $video_thumb_id     = $update["message"]["video"]["thumb"]["file_id"]; // file id
            $video_thumb_size   = $update["message"]["video"]["thumb"]["file_size"]; // file size
            $video_thumb_wid    = $update["message"]["video"]["thumb"]["width"]; // width
            $video_thumb_hei    = $update["message"]["video"]["thumb"]["height"]; // height
        }

    }

    // audio
    if(!empty($message_audio)){
        $mediatype          = "audio"; // define the file type
        $audio_file_id      = $update["message"]["audio"]["file_id"];
        $audio_size         = $update["message"]["audio"]["file_size"]; // 15716 = 15 kb
        $audio_mime         = $update["message"]["audio"]["mime_type"]; // audio/ogg
        $audio_duration     = $update["message"]["audio"]["duration"]; // uzunluğu saniye cinsinden
        $audio_artist       = $update["message"]["audio"]["performer"]; // artist
        $audio_title        = $update["message"]["audio"]["title"]; // title
    }

    // photo
    if(!empty($message_photo)){
        $mediatype         = "photo";
    }

?>
