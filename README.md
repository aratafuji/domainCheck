domainCheck
===========

高速ドメイン空き検索

概要
----
* whoisでは無く、DNSのSOAレコードを見て、空いている可能性の高いドメインを高速表示します。

同様のロジックで実装していると思われるサービス
----------------------------------------------
* http://domai.nr/
* http://domaintyper.com/
* https://domize.com/

参考
----
* http://domai.nr/about/features
** 「Domainr checks DNS to see if a domain name is available. 」
* http://blog.hansode.org/archives/51182005.html

検討
----
同様のサービスは、

1. DNSのSOAレコードを見て、空いている可能性の高いドメインを高速表示
2. ユーザーが購入の意思を示した(クリックした)時点で、whoisをチェック

という2段チェックで行っていると考えられます。

しかしながら、この方法はかなり精度が悪く、DNSを見て取得できると表示しても、購入の段階で取得できないケースが多々あります。
