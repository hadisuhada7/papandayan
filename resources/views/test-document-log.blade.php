<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Document Log</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Test Document Log</h1>
    
    <div id="result"></div>
    
    <h3>Form Test</h3>
    <form id="testForm">
        @csrf
        <label>Name: <input type="text" id="name" value="Test User"></label><br><br>
        <label>Email: <input type="email" id="email" value="test@example.com"></label><br><br>
        <button type="button" id="submitBtn">Submit Test</button>
    </form>
    
    <h3>Console Output</h3>
    <div id="console" style="background: #f0f0f0; padding: 10px; min-height: 200px; font-family: monospace;"></div>
    
    <script>
        function log(msg) {
            console.log(msg);
            $('#console').append('<div>' + new Date().toLocaleTimeString() + ': ' + msg + '</div>');
        }
        
        $(document).ready(function() {
            log('Page loaded');
            log('CSRF Token: ' + $('meta[name="csrf-token"]').attr('content'));
            log('jQuery version: ' + $.fn.jquery);
            
            $('#submitBtn').click(function() {
                log('=== Button clicked ===');
                
                var name = $('#name').val();
                var email = $('#email').val();
                var url = "{{ route('front.document.download.with.log', 1) }}";
                
                log('Name: ' + name);
                log('Email: ' + email);
                log('URL: ' + url);
                
                var data = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: name,
                    email: email
                };
                
                log('Sending AJAX...');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        log('SUCCESS!');
                        log('Response: ' + JSON.stringify(response));
                        $('#result').html('<div style="color: green">Success! Log ID: ' + response.log_id + '</div>');
                    },
                    error: function(xhr, status, error) {
                        log('ERROR!');
                        log('Status: ' + xhr.status);
                        log('Response: ' + xhr.responseText);
                        log('Error: ' + error);
                        $('#result').html('<div style="color: red">Error: ' + xhr.status + ' - ' + xhr.responseText + '</div>');
                    }
                });
            });
        });
    </script>
</body>
</html>
