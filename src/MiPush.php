<?php

namespace Qian\MiPush;


use Qian\MiPush\xmpush\Builder;
use Qian\MiPush\xmpush\Constants;
use Qian\MiPush\xmpush\IOSBuilder;
use Qian\MiPush\xmpush\Sender;

class MiPush
{
    /**
     * 小米推送安卓群发
     * app.env中如果为production，则是正式环境，否则为测试
     * debug 为测试环境topic的前缀
     * release 为正式环境topic的前缀
     * $title 标题 限制50个字内
     * $description 描述 限制125个字内
     * $payload 透传内容，json格式，例子：{'MsgID':1}
     * $regid 推送ID
     */
    public static function sendAll($title, $description, $payload)
    {
        $topic = "debug";
        if (config('app.env') == 'production')  {
            $topic = "release";
        }

        $secret = config('mipush.android.app_secret');
        $package = config('mipush.android.bundle_id');

        Constants::setSecret($secret);//AppSecret
        Constants::setPackage($package);//包名

        $message = new Builder();
        $message->title($title);  // 通知栏的title
        $message->description($description); // 通知栏的descption
        $message->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
        $message->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
//        $message->extra(Builder::notifyEffect, 1); // 此处设置预定义点击行为，1为打开app
        $message->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
        $message->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
        $message->build();
        /*$targetMessage = new TargetedMessage();
        $targetMessage->setTarget($regid, TargetedMessage::TARGET_TYPE_REGID); // 设置发送目标。可通过regID,alias和topic三种方式发送
        $targetMessage->setMessage($message);*/

        $sender = new Sender();

        $res = $sender->broadcast($message, $topic)->getRaw();
        return $res;
    }

    /**
     * ios 系统 群发消息发消息
     */
    public static function iosSendAll($title, $Description, $Payload)
    {
        $secret = config('mipush.android.app_secret');
        $package = config('mipush.android.bundle_id');
        Constants::setSecret($secret);
        Constants::setBundleId($package);

        if (config('app.env') != 'production') {
            Constants::useSandbox();
        }

        $message = new IOSBuilder();
        $message->title($title);
        $message->body($Description);
        $message->soundUrl('default');
        $message->badge('-1');
        $message->extra('payload', $Payload);
        $message->build();

        $sender = new Sender();

        $res = $sender->broadcastAll($message)->getRaw();
        return $res;

    }

    /**
     * 安卓根据alias推送
     * @param $title
     * @param $description
     * @param $payload
     * @param $alias
     * @return mixed
     */
    public static function sendToAlias($title, $description, $payload, $alias)
    {
        $alias = "debug_{$alias}";
        if (config('app.env') == 'production')  {
            $alias = "release_{$alias}";
        }
        $secret = config('mipush.android.app_secret');
        $package = config('mipush.android.bundle_id');
        Constants::setSecret($secret);//AppSecret
        Constants::setPackage($package);//包名

        $message = new Builder();
        $message->title($title);  // 通知栏的title
        $message->description($description); // 通知栏的descption
        $message->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
        $message->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
//        $message->extra(Builder::notifyEffect, 1); // 此处设置预定义点击行为，1为打开app
        $message->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
        $message->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
        $message->build();
        /*$targetMessage = new TargetedMessage();
        $targetMessage->setTarget($regid, TargetedMessage::TARGET_TYPE_REGID); // 设置发送目标。可通过regID,alias和topic三种方式发送
        $targetMessage->setMessage($message);*/

        $sender = new Sender();
        $res = $sender->sendToAlias($message, $alias)->getRaw();
        return $res;
    }

    /**
     * ios根据alias推送
     * title为副标题
     * body为描述
     * badge设置-1  APP角标不改变
     */
    public static function iosSendToAlias($title, $Description, $Payload,  $alias)
    {
        $secret = config('mipush.android.app_secret');
        $package = config('mipush.android.bundle_id');
        Constants::setSecret($secret);
        Constants::setBundleId($package);

        if (config('app.env') != 'production') {
            Constants::useSandbox();
        }

        $message = new IOSBuilder();
        $message->title($title);
        $message->body($Description);
        $message->soundUrl('default');
        $message->badge('-1');
        $message->extra('payload', $Payload);
        $message->build();

        $sender = new Sender();
        $res = $sender->sendToAlias($message,$alias)->getRaw();
        return $res;

    }
}
