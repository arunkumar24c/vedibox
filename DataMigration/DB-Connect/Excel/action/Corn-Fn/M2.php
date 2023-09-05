<?php
//The first line connects to your inbox over port 143
$mbox = imap_open("https://exmail.lonestar-lab.com/owa", "me@example.com", "password");

//imap_append() appends a string to a mailbox. In this example your SENT folder.
// Notice the 'r' format for the date function, which formats the date correctly for messaging.
imap_append($mbox, "{imap.dreamhost.com:143/notls}INBOX.Sent",
    "From: me@example.com\r\n".
    "To: ".$to."\r\n".
    "Subject: ".$subject."\r\n".
    "Date: ".date("r", strtotime("now"))."\r\n".
    "\r\n".
    $body.
    "\r\n"
    );

// close mail connection.
imap_close($mbox);