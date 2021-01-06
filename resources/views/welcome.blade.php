
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       


        <title>tai laravel + vue + spa</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <link rel="stylesheet" href="{{asset('css/app.css')}}"/>

        <!-- Styles -->
 
    
    </head>

  <body>
    <div id="app"></div>
    <script src="{{ asset('js/app.js')}}"></script>
    
    

    <script>
  //      var socket = io('http://localhost:6001',{
  //       withCredentials: true,
  //     extraHeaders: {
  //   "my-custom-header": "abcd"
  // }
  //      })
     
  //    socket.on('demo_database_chat:message', function(data)
  //    {
  //    console.log(data)
  //    if($('#' + data.id).length == 0){
  //      $('#data').append('<p><strong>'+data.name+'</strong>:'+data.image+'</p>')
  //    }
  //    else
  //    {
  //      console.log('da co tin nhan')
  //    }
  //  }) 
    </script>
   
  </body>
</html>
