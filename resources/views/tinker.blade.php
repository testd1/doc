<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Chat</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<style class="cp-pen-styles">
body {
  font-size: 16px;
  font-family: 'Roboto', 'Arial', sans-serif;
  text-align: center;
  background-color: #f8faff;
}

section {
    margin: 42px 0 0 0;
}
.row {
    margin: 15px 19px 5px 13px;
}
</style>
</head>

<body >
  <section>
    <div class="content" id="app">
        <chat api-endpoint="/chats"></chat>
    </div>
</section> 
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
