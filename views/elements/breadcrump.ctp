<div id="breadcrumb">

    <div class="seg_breadcrumb">
    
        <?php

            if( !isset( $breadcrumb_id ) ) $breadcrumb_id = 'breadcrumb';

                if( isset( $breadcrumb ) ) :

        ?>

                <div id="<?=$breadcrumb_id?>">

                    <h4>Você está em:</h4>

                <?php

                    $i = 1;

                    $total = count( $breadcrumb );

                    foreach ( $breadcrumb as $k => $v ) {

                        echo '<div class="span">»</div> ';

                        if( $i!=$total ) echo $this->Html->link( $k, $v );

                        else {

                            if( !is_numeric( $k ) ) $v = $k;
   
                            echo $this->Html->tag( 'strong', $v );

                        }

                         $i++;

                    }

                ?>

            </div>

        <?php
    
            endif;
    
        ?>
    
    </div>
 
</div>