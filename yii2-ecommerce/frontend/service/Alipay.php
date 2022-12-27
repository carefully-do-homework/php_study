<?php

require __DIR__ . '/../../vendor/autoload.php';
use Alipay\EasySDK\Kernel\Factory;
use Alipay\EasySDK\Kernel\Util\ResponseChecker;
use Alipay\EasySDK\Kernel\Config;

//1. 设置参数（全局只需设置一次）
Factory::setOptions(getOptions());

try {
    //2. 发起API调用（以支付能力下的统一收单交易创建接口为例）
    $result = Factory::payment()->Page()->pay("iPhone6 16G", "4", "0.01", '1');
    var_dump($result);
//    $responseChecker = new ResponseChecker();
//    //3. 处理响应或异常
//    if ($responseChecker->success($result)) {
//        echo "调用成功". PHP_EOL;
//    } else {
//        echo "调用失败，原因：". $result->msg."，".$result->subMsg.PHP_EOL;
//    }
} catch (Exception $e) {
    echo "调用失败，". $e->getMessage(). PHP_EOL;;
}

function getOptions()
{
    $options = new Config();
    $options->protocol = 'https';
    $options->gatewayHost = 'openapi.alipaydev.com';
    $options->signType = 'RSA2';

    $options->appId = '2021000122603429';

    // 为避免私钥随源码泄露，推荐从文件中读取私钥字符串而不是写入源码中
    $options->merchantPrivateKey = 'MIIEowIBAAKCAQEAhN4r9JO2tBceqBKglC4BRWpBkFo27Bge5/W8s8Lv/fUP0pyq4PNR/S06NsYpC4qKykPivuuh4y53CrZH3JzJlEIPf38EIafJlSUYFiZlmp+HYfzGvXxTZAF098ffVobj6CnizgbgmRc+RpJJRvfYvGuwT/FisNyK/vGy0k5gb/CYBx0t+ki46AP/Txp8EFaZKIImSpSIQM1mUso3CTyasOWjf3hmaoxiA8N0tlNNnHbBcxyc3ez13pOsg/VCEiMT9pVXiXsjaUSf/3l0Juze08ART5eUMtegxfDqJxL3l6tvG1BBlgPlAUPGntbTNjWBELCBpag1xrxHZSGiZROWFQIDAQABAoIBAGJ2GfC2/i/a6jb3BtSIexyrr0Z/9C9leJHAw0Qbc6mozz7uJpto9Rs/RuKMWqJY2p0lTYTaLS+joUfo6LwN3Dvn8IA06iTeqD3ELWNMtQKusa7lmYmV9l4nzjxIe7MtZvsG/zJaWlpYpSe7BF55EL4gt5mmcdJKvR5Mko3S0xhgCWOQROkmpIAg/Biv17BZ13SViR46nzLBSAIpw9vnjrKLJDZxQSI6xbhFa62IHkTEBPnSUeym14UaOz4gh1McbuflBeaCupadd2bpNR1jQfYNF0E31BgFmn0ctI8C2EHylYFSB7qabgKhEHljJKoPdfbTKv76KPj1EKkg/yNaxoECgYEA0TgAbHGbeZoPM4/jJAWLy2OTQhoa2RjzT1cjOEBtABwdyJXzwXGhYEi2Ze/g596u16rkE+zKkKG6CpWsW7rBbclig4U0sGjQnz0XTY7z022J3XVRHtnU1J7h632K2QzTqX4LOQciFtZgQJaXAqeSiKsXAdc/BTLYfS0Ktr4/gPECgYEAopO6osOJfUzPUQ6G0hxumfOL1kOfIjfc/CJzCttujDjSERIJBDb10s/K12mJxVhkwNC7c4PGQ9GX8Pm5c+1Tnf50QU/OzwzvW+VeyaDGE194OPFmQfxzXbUEADak73dww/WuKACs5oviIEvOhAYcyX4P/FelKlzDfXrzca9xJ2UCgYBB0GQRuQs3jYcKqVDCnBwFtyUzvhKECJ1BcB/cKigfyLh1yPYM/DnPmBAIsRUG274UieWFfw+Zv8ZOXhcCJBWE+7zJsrWIaPB3pzgVZcq9z892otkJ42xYFkLrWWq8LJTI1KWjIuNOW9Gbf8OxShWGeIucQKHKeNwxRGICaoZ/gQKBgB6jlrXcAgpSMnQFN9VbNGDhLEZqIhBx1LzTxTiTmCbnAnfjHT3lGbjsHj8wjZ1ahkpsTBd+Cxx24JqyhYfafzq0XLZ+UuxkdKut84ouOYYnJOIeZHYlHJzZY3Ki2byjluXnZDX3wp4EWM5bWwU4na4/isW0wtTT/KemR0DynnGdAoGBAMtOjgoh1t3J856tul0IAHr0yr2Nbcfp4KsMqaGFBv4MrpKBifbsExFvU30H32l+SG+Rd1rjZsHwNL/YBux00U0r/pW6PAgeGydRFu2i/+fUs08F567OmdriuoblGC59e0M4zYHKbp8PGL2PUHzS0ellwbJDYYPecdTC666846RM';

//    $options->alipayCertPath = './alipayPublicCert.crt';
//    $options->alipayRootCertPath = './alipayRootCert.crt';
//    $options->merchantCertPath = './appPublicCert.crt';

    //注：如果采用非证书模式，则无需赋值上面的三个证书路径，改为赋值如下的支付宝公钥字符串即可
     $options->alipayPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiCTmIzdKZ+aFffFzsIFFfwGCNwhjBXL8nL1OHL9DKWQWxjTC9I2NqKU04TWxz5FC1KRt3y+sZMUAqojmeLzy6TZh6L7cQuLZclqKjIp8K4OcFXF2LkIlMcZLCFdnH7UzykcXT4a6ogMozRy2LRNtbgP7Gh2AI1LnBBsOnlmv6gsFvmgKgH5+gUKJQn+nrpqduw0agcn3xejYmDllnmvrDWInij0m1xiLrs0AINalOjFuZLTZ5JLmrz8cBg/XgMPlFNGZMXNGq+f89o4xkhhyKhfPajxt02WtN1A6qymPQbBcpdi6OFLq0R3AYaO8XxLITOpiSqWQ+cMhSfPL8WTw5QIDAQAB';

    //可设置异步通知接收服务地址（可选）
//    $options->notifyUrl = "<-- 请填写您的支付类接口异步通知接收服务地址，例如：https://www.test.com/callback -->";

    //可设置AES密钥，调用AES加解密相关接口时需要（可选）
//    $options->encryptKey = "<-- 请填写您的AES密钥，例如：aa4BtZ4tspm2wnXLb1ThQA== -->";



    return $options;
}