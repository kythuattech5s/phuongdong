<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CronMailController extends Controller
{
    public function cronmail()
    {
        set_time_limit(0);
        $hLock=fopen("cronmail.lock", "w+");
        if(!flock($hLock, LOCK_EX | LOCK_NB)){
            die("Already running. Exiting...");
        }
        while (true) {
            $mails = \App\Models\QueueEmail::where('status', 0)->orderBy('id', 'asc')->take(1)->get();
            if ($mails->count() == 0) {
                continue;
            }
            foreach ($mails as $k => $mail) {
                $mail->status = 1;
                $mail->save();
                $attachments = json_decode($mail->attach_file,true);
                $attachments = is_array($attachments)?$attachments:[];
                try {
                    $ret = app('MailHelper')->setEmail($mail->to)
                    ->setSubject($mail->title)
                    ->setBcc(is_array($bcc = json_decode($mail->bcc)) ? $bcc : [])
                    ->setCc(is_array($cc = json_decode($mail->cc)) ? $cc : [])
                    ->setContent(function() use ($mail){
                        return $mail->content;
                    })
                    ->send();
                    $result = $ret['message'];
                } catch (Exception $e) {
                    $result = 'Đã lỗi';
                }
                $mail->status = 2;
                $mail->result = $result;
                $mail->save();
                sleep(2);
            }   
        }
        flock($hLock, LOCK_UN);
        fclose($hLock);
        unlink('cronmail.lock');
    }
}
