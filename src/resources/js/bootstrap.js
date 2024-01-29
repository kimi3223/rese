window._ = require('lodash');

/**
 * リクエストを簡単に発行できるようにする axios HTTP ライブラリをロードします
 * Laravel バックエンドに。このライブラリは、
 * 「XSRF」トークン Cookie の値に基づくヘッダーとしての CSRF トークン。
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo は、チャンネルに登録してリスニングするための表現力豊かな API を公開します
 * Laravel によってブロードキャストされるイベントの場合。エコーとイベント放送
 * チームは堅牢なリアルタイム Web アプリケーションを簡単に構築できます。
 */

// 'laravel-echo' から Echo をインポートします。

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
// ブロードキャスター: 'プッシャー',
// キー: process.env.MIX_PUSHER_APP_KEY,
// クラスター: process.env.MIX_PUSHER_APP_CLUSTER,
//forceTLS: true
// });