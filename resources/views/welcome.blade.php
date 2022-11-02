<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Atlas Lift</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    </head>
    <body>
        <div class="container">
            <div>
                <label for="contestants">Enter contestants info: </label>
                <textarea name="contestants" id="contestants" cols="30" rows=""></textarea>
            </div>

            <div>
                <button type="button" class="mt-2" id="submit">Submit</button>
            </div>

            <div id="output_div" class="mb-5">
                <label for="result">Your bet</label>
                <div id="result"></div>
            </div>
        </div>

        <script>
            $(document).on('click', '#submit', function() {
                let atlas_info = $('#contestants').val();
                $.ajax({
                    url: "{{ url('get-contestants-lift-details') }}",
                    type: 'GET',
                    data: {
                        'info': atlas_info
                    },
                    success: function(response) {
                        if(response.status == 1) {
                            let result = response.response;
                            let html = '';
                            result.map(function(value, key) {
                                html += `${(value> 0) ? value : '' }<br>`;
                            });
                            $('#result').html(html);
                        } else {
                            $('#result').html(response.msg);
                        }
                        // console.log(response);
                    },
                    error: function(response) {

                    }
                })
            })
        </script>
    </body>
</html>
