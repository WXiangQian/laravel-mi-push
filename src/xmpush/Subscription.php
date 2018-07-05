<?php
/**
 * 订阅/取消订阅标签.
 * @author wangkuiwei
 * @name Subscription
 *
 */
namespace Qian\MiPush\xmpush;

class Subscription extends HttpBase {

    public function __construct() {
        parent::__construct();
    }

    public function subscribe($regId, $topic, $retries = 1) {
        $fields = array('registration_id' => $regId, 'topic' => $topic);
        return $this->postResult(PushRequestPath::V2_SUBSCRIBE_TOPIC(), $fields, $retries);
    }

    public function subscribeForRegids($regIdList, $topic, $retries = 1) {
        $jointRegIds = '';
        foreach ($regIdList as $regId) {
            if (isset($regId)) {
                $jointRegIds .= $regId . Constants::$comma;
            }
        }
        $fields = array('registration_id' => $jointRegIds, 'topic' => $topic);
        return $this->postResult(PushRequestPath::V2_SUBSCRIBE_TOPIC(), $fields, $retries);
    }

    public function unsubscribe($regId, $topic, $retries = 1) {
        $fields = array('registration_id' => $regId, 'topic' => $topic);
        return $this->postResult(PushRequestPath::V2_UNSUBSCRIBE_TOPIC(), $fields, $retries);
    }

    public function unsubscribeForRegids($regIdList, $topic, $retries = 1) {
        $jointRegIds = '';
        foreach ($regIdList as $regId) {
            if (isset($regId)) {
                $jointRegIds .= $regId . Constants::$comma;
            }
        }
        $fields = array('registration_id' => $jointRegIds, 'topic' => $topic);
        return $this->postResult(PushRequestPath::V2_UNSUBSCRIBE_TOPIC(), $fields, $retries);
    }

    public function subscribeTopicByAlias($aliasList, $topic, $retries = 1) {
        $jointAliases = '';
        foreach ($aliasList as $alias) {
            if (isset($alias)) {
                $jointAliases .= $alias . Constants::$comma;
            }
        }
        $fields = array('aliases' => $jointAliases, 'topic' => $topic);
        return $this->postResult(PushRequestPath::V2_SUBSCRIBE_TOPIC_BY_ALIAS(), $fields, $retries);
    }

    public function unsubscribeTopicByAlias($aliasList, $topic, $retries = 1) {
        $jointAliases = '';
        foreach ($aliasList as $alias) {
            if (isset($alias)) {
                $jointAliases .= $alias . Constants::$comma;
            }
        }
        $fields = array('aliases' => $jointAliases, 'topic' => $topic);
        return $this->postResult(PushRequestPath::V2_UNSUBSCRIBE_TOPIC_BY_ALIAS(), $fields, $retries);
    }

    public function subscribeByPackageName($regId, $topic, $packageName, $retries = 1) {
        $fields = array('registration_id' => $regId, 'topic' => $topic, 'restricted_package_name' => $packageName);
        return $this->postResult(PushRequestPath::V2_SUBSCRIBE_TOPIC(), $fields, $retries);
    }

    public function subscribeForRegidsByPackageName($regIdList, $topic, $packageName, $retries = 1) {
        $jointRegIds = '';
        foreach ($regIdList as $regId) {
            if (isset($regId)) {
                $jointRegIds .= $regId . Constants::$comma;
            }
        }
        $fields = array('registration_id' => $jointRegIds, 'topic' => $topic, 'restricted_package_name' => $packageName);
        return $this->postResult(PushRequestPath::V2_SUBSCRIBE_TOPIC(), $fields, $retries);
    }

    public function unsubscribeByPackageName($regId, $topic, $packageName, $retries = 1) {
        $fields = array('registration_id' => $regId, 'topic' => $topic, 'restricted_package_name' => $packageName);
        return $this->postResult(PushRequestPath::V2_UNSUBSCRIBE_TOPIC(), $fields, $retries);
    }

    public function unsubscribeForRegidsByPackageName($regIdList, $topic, $packageName, $retries = 1) {
        $jointRegIds = '';
        foreach ($regIdList as $regId) {
            if (isset($regId)) {
                $jointRegIds .= $regId . Constants::$comma;
            }
        }
        $fields = array('registration_id' => $jointRegIds, 'topic' => $topic, 'restricted_package_name' => $packageName);
        return $this->postResult(PushRequestPath::V2_UNSUBSCRIBE_TOPIC(), $fields, $retries);
    }

    public function subscribeTopicByPackageNameAlias($aliasList, $topic, $packageName, $retries = 1) {
        $jointAliases = '';
        foreach ($aliasList as $alias) {
            if (isset($alias)) {
                $jointAliases .= $alias . Constants::$comma;
            }
        }
        $fields = array('aliases' => $jointAliases, 'topic' => $topic, 'restricted_package_name' => $packageName);
        return $this->postResult(PushRequestPath::V2_SUBSCRIBE_TOPIC_BY_ALIAS(), $fields, $retries);
    }

    public function unsubscribeTopicByPackageNameAlias($aliasList, $topic, $packageName, $retries = 1) {
        $jointAliases = '';
        foreach ($aliasList as $alias) {
            if (isset($alias)) {
                $jointAliases .= $alias . Constants::$comma;
            }
        }
        $fields = array('aliases' => $jointAliases, 'topic' => $topic, 'restricted_package_name' => $packageName);
        return $this->postResult(PushRequestPath::V2_UNSUBSCRIBE_TOPIC_BY_ALIAS(), $fields, $retries);
    }
}

?>
