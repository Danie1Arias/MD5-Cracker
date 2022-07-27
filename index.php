<!DOCTYPE html>
<head>
    <title>Daniel Arias MD5 Cracker</title>
</head>

<body>

    <h1>MD5 Cracker</h1>
    <p>This application takes an MD5 hash of a four digit pin and check all 10.000 possible four digit PINs to determinate te PIN.</p>
    <pre>
Debug output:
        <?php
            print "\n";
            $goodtext = "Not found";
            if (isset($_GET['md5'])) {
                $timePre = microtime(true);
                $hashMD5 = $_GET['md5'];
                $digits = "0123456789";
                $showTries = 15;
                $counter = 1;

                for ($i=0; $i < strlen($digits); $i++) {
                    $digit1 = $digits[$i];

                    for($j=0; $j < strlen($digits); $j++) {
                        $digit2 = $digits[$j];

                        for($k=0; $k < strlen($digits); $k++) {
                            $digit3 = $digits[$k];
                            
                            for($l=0; $l < strlen($digits); $l++) {
                                $digit4 = $digits[$l];

                                $try = $digit1.$digit2.$digit3.$digit4;
                                $check = hash('md5', $try);

                                if ( $check == $hashMD5 ) {
                                    $goodtext = $try;
                                    break; 
                                }

                                if ( $showTries > 0 ) {
                                    print "$check  $try\n";
                                    $showTries = $showTries - 1;
                                }

                                $counter = $counter + 1;
                            }
                        }
                    }
                }

                $timePost = microtime(true);
                print "Total checks: " . $counter . "\n";
                print "Elapsed time: " . $timePost-$timePre . "\n";
            }
        ?>
    </pre>

    <p>Original Text: <?= htmlentities($goodtext); ?></p>
    <form>
        <input type="text" name="md5" size="60" />
        <input type="submit" value="Crack MD5"/>
    </form>

</body>
</html>