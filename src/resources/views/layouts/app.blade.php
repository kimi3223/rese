<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <header>
        <div class="header-logo">
            <a href="{{ url('/') }}"><h1>Rese</h1></a>
            <img src="/path/to/your/logo.png" alt="Logo" class="logo-image">
        </div>

        <!-- 検索ボタン -->
        <span id="searchButton" class="search-button" onclick="toggleSearch()">Search...</span>

        <!-- ここに他のナビゲーションメニューを追加 -->
    </header>

    <!-- 検索フォーム -->
    <div id="searchForm" style="display: none;">
        <!-- ここに検索フォームのHTMLを追加 -->
        <!-- 例: <form action="{{ url('/search') }}" method="get">...</form> -->
        <!-- ここに検索ボタンや入力フィールドを配置してください -->
    </div>

    <!-- コンテンツ部分 -->
    @yield('content')

    <!-- JavaScriptの例 -->
    <script>
        function toggleSearch() {
            var searchForm = document.getElementById('searchForm');
            searchForm.style.display = (searchForm.style.display === 'none') ? 'block' : 'none';
        }
    </script>
</body>
</html>