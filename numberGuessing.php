<?php

$min = 1;
$max = 100;
$output = '';

function guessNumber($min, $max)
{
    return round(($min+$max) / 2);
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $number = intval($_POST['number']);
    if($number<$min || $number>$max)
    {
        $output = "<span>You must enter a number from {$min} to {$max}.</span>";
    }
    else
    {
        $output = "Your number was {$number}.<br><br>\n";
        $min_guess = $min;
        $max_guess = $max;

        $guessNo = 1;
        $guess = guessNumber($min_guess, $max_guess);
        while($guess != $number)
        {
            if($guess < $number)
            {
                $guessResult = 'low';
                $min_guess = $guess + 1;
            }
            else
            {
                $guessResult = 'high';
                $max_guess = $guess - 1;
            }
            $output .= "Guess number {$guessNo} was {$guess}. That was too {$guessResult}.<br>\n";
            $guess = guessNumber($min_guess, $max_guess);
            $guessNo++;
        }
        $output .= "Guess number {$guessNo} was {$guess}. Correct!<br>\n";
    }
}

?>
<html lang = en>
<head>
    <title>GuessingNumber</title>
</head>
<body>
<form action="" method="post">
    Enter a number between <?php echo $min; ?> and <?php echo $max; ?>:
    <input type="text" name="number" />
    <button type="submit">Submit</button>
</form>
<br><br>
<?php echo $output; ?>

</body>
</html>