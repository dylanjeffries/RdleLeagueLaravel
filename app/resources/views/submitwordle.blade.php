<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Rdle League</title>
    </head>

    <body>
        <form action="/submitwordle" method="post">
            @csrf
            Wordle Attempts
            <select name="attempts">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">DNF</option>
            </select>
            <input type="submit" name="submit" value="Submit Wordle">
            <input type="submit" name="submit" value="Cancel">
        </form> 
    </body>

</html>