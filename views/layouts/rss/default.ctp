<?php

    echo $rss->header();

    echo '<?xml-stylesheet type="text/xsl" href="', $rss->webroot('css/feed.xsl') ,'" ?>';

    $channelEl = $rss->channel(array(), $channel, $items);

    echo $rss->document(array(), $channelEl);

?>