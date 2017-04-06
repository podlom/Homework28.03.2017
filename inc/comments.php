<?php

global $siteHeader, $commentsDbFile, $errorMessages;
$siteHeader = 'Comments';
$commentsDbFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'comments.dat';
$errorMessages = [];

if (!empty($_POST)) {
    if (empty($_POST['uname'])) {
        $errorMessages[] = '<p class="err">Username can`t be empty</p>';
    }
    if (empty($_POST['uemail'])) {
        $errorMessages[] = '<p class="err">Email can`t be empty</p>';
    }
    if (empty($_POST['ucomment'])) {
        $errorMessages[] = '<p class="err">Comment text can`t be empty</p>';
    }
    if (empty($errorMessages)) {
        addComment($_POST);
    }
}

function readComments() {
    $commentsData = [];
    global $commentsDbFile;
    if (file_exists($commentsDbFile)) {
        $commentsData = file_get_contents($commentsDbFile);
        if ($commentsData !== false) {
            $commentsData = unserialize($commentsData);
        }
    }
    return $commentsData;
}

function addComment($data) {
    global $commentsDbFile;
    $aOld = readComments();
    $data['AddedDt'] = date('Y-m-d H:i:s');
    $newData = [];
    if (is_array($aOld)) {
        $newData = array_merge($aOld, [$data]);
    } else {
        $newData[] = $data;
    }
    $sData = serialize($newData);
    file_put_contents($commentsDbFile, $sData);
}

function getComments() {
    $aComm = readComments();
    if (!empty($aComm)) {
        foreach ($aComm as $c) {
            echo "<pre>{$c['AddedDt']} Commented by " . "<a href=" . $c['uemail'] . ">{$c['uname']}</a>" . ': <br>' . $c['ucomment'] .'<br></pre>';
        }
    }
}

    if (!empty($errorMessages)) {
        foreach ($errorMessages as $msg) {
            echo $msg . '<br>';
        }
    }

?>
<form action="inc/comments.php" method="post">
    <div>
        <label for="uname">Username *:</label>
        <input required type="text" name="uname">
    </div>
    <div>
        <label for="uemail">Email *:</label>
        <input required type="email" name="uemail">
    </div>
    <div>
        <label for="ucomment">Comment *:</label><br>
        <textarea required name="ucomment" placeholder="Inout your comment"></textarea>
    </div>
    <input type="submit" value="Ok">
   <div>* - required fields</div>
</form>
<hr>
<?php
    getComments();
?>
