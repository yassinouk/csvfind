<?php
// compile C and Rust versions
echo "Compiling...\n";
exec( "gcc -o c-csvfind-test csvfind.c" );
exec( "rustc -O -o rust-csvfind-test csvfind.rs" );

// run tests
echo "Testing...\n";
test( "php csvfind.php output.csv winkpad", 5 );
test( "./c-csvfind-test output.csv winkpad", 5 );
test( "./rust-csvfind-test output.csv winkpad", 5 );

// remove test compilations
unlink( "c-csvfind-test" );
unlink( "rust-csvfind-test" );

function test( string $command, int $times ) {
    $start = microtime( true );
    for( $i = 0; $i < $times; $i++ ) {
        exec( $command );
    }
    $end = microtime( true );

    printf( "%fs: %s\n", $end-$start, $command );
}
