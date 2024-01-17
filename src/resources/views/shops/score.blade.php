<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="fc3Ry1CEmofdyhmKH47kUVVCRj5sL5BF8scYOHu0">
    <title>Rese</title>
    <link rel="stylesheet" href="http://localhost/css/sanitize.css">
    <link rel="stylesheet" href="http://localhost/css/app.css">
    <link rel="stylesheet" href="http://localhost/css/login.css">
    <link rel="stylesheet" href="http://localhost/css/thanks.css">
    <link rel="stylesheet" href="http://localhost/css/detail.css">
    <link rel="stylesheet" href="http://localhost/css/register.css">
    <link rel="stylesheet" href="http://localhost/css/done.css">
    <link rel="stylesheet" href="http://localhost/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include FontAwesome -->
    
    <style>
        /* ここにスタイルを追加 */
    </style>
</head>

<body>
    <header>
        <form id="ratingForm">
            <label for="score">評価 (1-5):</label>
            <input type="number" id="score" name="score" min="1" max="5" required>
            <label for="comment">コメント:</label>
            <textarea id="comment" name="comment"></textarea>
            <button type="submit">評価する</button>
        </form>
    </header>

    <!-- ページ遷移用のJavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        document.getElementById('ratingForm').addEventListener('submit', function (event) {
            event.preventDefault();

            // フォームデータを取得
            const formData = new FormData(event.target);

            // バックエンドに評価を送信するためのAPI呼び出し
            // ここでAjaxやFetch APIを使用するなど
            // 例: fetch('/api/rate', { method: 'POST', body: formData })
            //     .then(response => response.json())
            //     .then(data => console.log(data))
            //     .catch(error => console.error('Error:', error));

            // 成功時の処理
            // 例: ユーザーに成功メッセージを表示
        });
    </script>
</body>

</html>
