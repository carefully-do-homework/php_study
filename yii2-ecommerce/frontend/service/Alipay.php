<?php
namespace frontend\service;

require __DIR__ . '/../../vendor/autoload.php';
use Alipay\EasySDK\Kernel\Factory;
use Alipay\EasySDK\Kernel\Util\ResponseChecker;
use Alipay\EasySDK\Kernel\Config;
use Yii;

//1. 设置参数（全局只需设置一次）
Factory::setOptions(getOptions());

class Alipay {
    public function pay($subject, $outTradeNo, $totalAmount, $returnUrl)
    {
        $result2 = Factory::payment()->Page()->asyncNotify(yii::$app->params['openHost'] . '/cart/finish-pay');
        $result1 = Factory::payment()->Page()->pay($subject, $outTradeNo, $totalAmount, $returnUrl);

        if ($result1->body && $result2)
        {
            print_r($result1->body);
        }else {
            echo '转跳支付宝失败';
        }
    }
}

function getOptions()
{
    $options = new Config();
    $options->protocol = 'https';
    $options->gatewayHost = yii::$app->params['gatewayHost'];
    $options->signType = 'RSA2';
    $options->appId = yii::$app->params['appId'];

    // 为避免私钥随源码泄露，推荐从文件中读取私钥字符串而不是写入源码中
    $options->merchantPrivateKey = yii::$app->params['merchantPrivateKey'];

    //    $options->alipayCertPath = './alipayPublicCert.crt';
    //    $options->alipayRootCertPath = './alipayRootCert.crt';
    //    $options->merchantCertPath = './appPublicCert.crt';

    //注：如果采用非证书模式，则无需赋值上面的三个证书路径，改为赋值如下的支付宝公钥字符串即可
    $options->alipayPublicKey = yii::$app->params['alipayPublicKey'];

    //可设置异步通知接收服务地址（可选）
    //    $options->notifyUrl = "<-- 请填写您的支付类接口异步通知接收服务地址，例如：https://www.test.com/callback -->";

    //可设置AES密钥，调用AES加解密相关接口时需要（可选）
    //    $options->encryptKey = "<-- 请填写您的AES密钥，例如：aa4BtZ4tspm2wnXLb1ThQA== -->";



    return $options;
}
