<?php
	
    require( 'godaddy_ddns/godaddy_ddns.php' );

    $external_ip     =   file_get_contents( 'http://ipecho.net/plain' );

    $update         =   array(
        array( 
            'domain' => 'your.domain.com' , 
            'key' => 'your_godaddy_api_key' , 
            'secret' => 'your_godaddy_api_secret' , 
            'records' => array(
                array( 'type' => 'A' , 'name' => '@' , 'ttl' => '3600' ) , 
                array( 'type' => 'A' , 'name' => 'www' , 'ttl' => '3600' ) , 
            ) 
        )
    );
    
	foreach ( $update as $item ) {

        $ddns           =   new GoDaddyDDNS( $item[ 'domain' ] , $item[ 'key' ] , $item[ 'secret' ] );
        if ( !empty( $item[ 'records' ] ) ) 
            foreach ( $item[ 'records' ] as $record ) 
                $ddns -> updateRecord( $record[ 'type' ] , $record[ 'name' ] , $external_ip , $record[ 'ttl' ] );

    }

?>
